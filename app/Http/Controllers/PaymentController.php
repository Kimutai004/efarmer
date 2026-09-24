<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Goat;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Services\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $mpesa;
    protected int $transportFee;

    public function __construct(MpesaService $mpesa)
    {
        $this->mpesa = $mpesa;
        $this->transportFee = (int) config('mpesa.transport_fee_per_goat', 300);
    }

    public function checkout(Goat $goat)
    {
        if ($goat->status !== 'available') {
            return back()->with('error', 'This goat is no longer available.');
        }

        // Eager load photos to avoid N+1 query
        $goat->load('primaryPhoto');

        return view('payments.checkout', compact('goat'));
    }

    public function initiate(Request $request)
    {
        $data = $request->validate([
            'goat_id' => 'required|exists:goats,id',
            'quantity' => 'required|integer|min:1|max:10',
            'phone' => 'required|string|max:15',
            'name' => 'required|string|max:150',
            'email' => 'nullable|email',
            'delivery_address' => 'required|string|max:500',
            'delivery_town' => 'required|string|max:100',
            'delivery_notes' => 'nullable|string|max:300',
        ]);

        $goat = Goat::findOrFail($data['goat_id']);
        $quantity = $data['quantity'];

        if ($goat->status !== 'available') {
            return back()->with('error', 'This goat is no longer available.');
        }

        $subtotal = $goat->selling_price * $quantity;
        $transportFee = $this->transportFee * $quantity;
        $totalAmount = $subtotal + $transportFee;
        $reference = 'EF-' . strtoupper(Str::random(8));

        $quantityLabel = $quantity > 1 ? " (x{$quantity})" : '';
        $result = $this->mpesa->stkPush(
            $data['phone'],
            $totalAmount,
            $reference,
            'Payment for ' . ($goat->name ?? $goat->tag_number) . $quantityLabel . ' (incl. transport)'
        );

        if ($result['success']) {
            Payment::create([
                'sale_id' => null,
                'payment_reference' => $reference,
                'amount' => $totalAmount,
                'payment_method' => 'mpesa',
                'phone_number' => $data['phone'],
                'status' => 'pending',
                'notes' => sprintf(
                    'Buyer: %s | Goat: %s | Qty: %d | Delivery: %s, %s | Transport: KES %s (KES %s × %d)',
                    $data['name'],
                    $goat->tag_number,
                    $quantity,
                    $data['delivery_address'],
                    $data['delivery_town'],
                    $transportFee,
                    $this->transportFee,
                    $quantity
                ),
                'mpesa_response' => json_encode($result),
            ]);

            return view('payments.pending', [
                'reference' => $reference,
                'goat' => $goat,
                'checkout_id' => $result['checkout_request_id'] ?? null,
            ]);
        }

        return back()->with('error', $result['message']);
    }

    public function callback(Request $request)
    {
        $payload = $request->all();

        Log::info('M-Pesa Callback', ['payload' => $payload]);

        $stkCallback = $payload['Body']['stkCallback'] ?? null;

        if (!$stkCallback) {
            return response()->json(['status' => 'received']);
        }

        $checkoutId = $stkCallback['CheckoutRequestID'] ?? null;
        $merchantId = $stkCallback['MerchantRequestID'] ?? null;
        $resultCode = $stkCallback['ResultCode'] ?? null;

        // Try to find payment by checkout ID in mpesa_response
        $payment = Payment::where('mpesa_response', 'like', "%{$checkoutId}%")->first();

        // Fallback: try to find by merchant ID
        if (!$payment && $merchantId) {
            $payment = Payment::where('mpesa_response', 'like', "%{$merchantId}%")->first();
        }

        // Fallback: try to find by phone number and pending status
        if (!$payment) {
            $phone = $stkCallback['CallbackMetadata']['Item'][4]['Value'] ?? null;
            if ($phone) {
                $phone = '254' . substr($phone, -9);
                $payment = Payment::where('phone_number', $phone)
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'desc')
                    ->first();
            }
        }

        // Last fallback: get the most recent pending payment
        if (!$payment) {
            $payment = Payment::where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->first();
        }

        if (!$payment) {
            Log::warning('Payment not found for callback', [
                'checkout_id' => $checkoutId,
                'merchant_id' => $merchantId,
            ]);
            return response()->json(['status' => 'received']);
        }

        if ($resultCode == 0) {
            $items = $stkCallback['CallbackMetadata']['Item'] ?? [];
            $transactionId = null;
            $amount = null;

            foreach ($items as $item) {
                if ($item['Name'] === 'MpesaReceiptNumber') {
                    $transactionId = $item['Value'] ?? null;
                }
                if ($item['Name'] === 'Amount') {
                    $amount = $item['Value'] ?? null;
                }
            }

            $payment->update([
                'status' => 'completed',
                'transaction_id' => $transactionId,
                'payment_date' => now(),
                'amount' => $amount ?? $payment->amount,
            ]);

            // Extract buyer info from notes
            $buyerName = 'Unknown';
            $goatTag = '';
            if (preg_match('/Buyer:\s*([^|]+)/', $payment->notes, $nameMatch)) {
                $buyerName = trim($nameMatch[1]);
            }
            if (preg_match('/Goat:\s*([^|]+)/', $payment->notes, $goatMatch)) {
                $goatTag = trim($goatMatch[1]);
            }

            // Find the goat
            $goat = Goat::where('tag_number', $goatTag)->first();

            // Create or find customer
            $customer = Customer::firstOrCreate(
                ['phone' => $payment->phone_number],
                [
                    'name' => $buyerName,
                    'email' => null,
                    'location' => 'Kenya',
                ]
            );

            // Create sale record
            if ($goat) {
                // Extract quantity from payment notes (format: "Buyer: ... | Goat: ... | Qty: X | ...")
                $quantity = 1;
                if (preg_match('/Qty:\s*(\d+)/', $payment->notes, $matches)) {
                    $quantity = (int) $matches[1];
                }

                $subtotal = $goat->selling_price * $quantity;

                DB::transaction(function () use ($payment, $customer, $goat, $quantity, $subtotal) {
                    $sale = Sale::create([
                        'invoice_number' => $payment->payment_reference,
                        'customer_id' => $customer->id,
                        'sale_date' => now(),
                        'subtotal' => $subtotal,
                        'discount' => 0,
                        'total' => $payment->amount,
                        'amount_paid' => $payment->amount,
                        'balance' => 0,
                        'status' => 'completed',
                        'payment_status' => 'paid',
                        'notes' => 'M-Pesa payment: ' . $payment->transaction_id,
                    ]);

                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'goat_id' => $goat->id,
                        'quantity' => $quantity,
                        'unit_price' => $goat->selling_price,
                        'total' => $subtotal,
                    ]);

                    // Update payment with sale_id
                    $payment->update(['sale_id' => $sale->id]);

                    // Mark goat as sold
                    $goat->update([
                        'status' => 'sold',
                        'sold_at' => now(),
                    ]);
                });
            }

            Log::info('Payment completed', [
                'reference' => $payment->payment_reference,
                'transaction_id' => $transactionId,
                'customer_id' => $customer->id ?? null,
            ]);
        } else {
            $payment->update([
                'status' => 'failed',
                'notes' => $payment->notes . ' | Failed: ' . ($stkCallback['ResultDesc'] ?? 'Unknown error'),
            ]);

            Log::info('Payment failed', [
                'reference' => $payment->payment_reference,
                'reason' => $stkCallback['ResultDesc'] ?? 'Unknown',
            ]);
        }

        return response()->json(['status' => 'received']);
    }

    public function status(Request $request)
    {
        $data = $request->validate([
            'reference' => 'required|string',
        ]);

        $payment = Payment::where('payment_reference', $data['reference'])->first();

        if (!$payment) {
            return response()->json(['status' => 'not_found']);
        }

        if ($payment->status === 'completed') {
            return response()->json([
                'status' => 'completed',
                'reference' => $payment->payment_reference,
                'amount' => $payment->amount,
                'redirect' => route('payment.receipt', ['reference' => $payment->payment_reference]),
            ]);
        }

        return response()->json([
            'status' => $payment->status,
            'reference' => $payment->payment_reference,
            'amount' => $payment->amount,
        ]);
    }

    public function receipt($reference)
    {
        $payment = Payment::where('payment_reference', $reference)->firstOrFail();

        if ($payment->status !== 'completed') {
            return redirect()->route('payment.status', ['reference' => $reference]);
        }

        return view('payments.receipt', compact('payment'));
    }
}