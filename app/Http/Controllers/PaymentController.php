<?php

namespace App\Http\Controllers;

use App\Models\Goat;
use App\Models\Payment;
use App\Services\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $mpesa;
    protected const TRANSPORT_FEE = 300;

    public function __construct(MpesaService $mpesa)
    {
        $this->mpesa = $mpesa;
    }

    public function checkout(Goat $goat)
    {
        if ($goat->status !== 'available') {
            return back()->with('error', 'This goat is no longer available.');
        }

        return view('payments.checkout', compact('goat'));
    }

    public function initiate(Request $request)
    {
        $data = $request->validate([
            'goat_id' => 'required|exists:goats,id',
            'phone' => 'required|string|max:15',
            'name' => 'required|string|max:150',
            'email' => 'nullable|email',
            'delivery_address' => 'required|string|max=500',
            'delivery_town' => 'required|string|max=100',
            'delivery_notes' => 'nullable|string|max=300',
        ]);

        $goat = Goat::findOrFail($data['goat_id']);

        if ($goat->status !== 'available') {
            return back()->with('error', 'This goat is no longer available.');
        }

        $totalAmount = $goat->selling_price + self::TRANSPORT_FEE;
        $reference = 'EF-' . strtoupper(Str::random(8));

        $result = $this->mpesa->stkPush(
            $data['phone'],
            $totalAmount,
            $reference,
            'Payment for ' . ($goat->name ?? $goat->tag_number) . ' (incl. transport)'
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
                    'Buyer: %s | Goat: %s | Delivery: %s, %s | Transport: KES 300',
                    $data['name'],
                    $goat->tag_number,
                    $data['delivery_address'],
                    $data['delivery_town']
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
        $resultCode = $stkCallback['ResultCode'] ?? null;

        $payment = Payment::where('mpesa_response', 'like', "%{$checkoutId}%")->first();

        if (!$payment) {
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

            // Mark goat as reserved
            $goat = Goat::where('tag_number', $this->extractGoatTag($payment->notes))->first();
            if ($goat) {
                $goat->update(['status' => 'reserved']);
            }
        } else {
            $payment->update([
                'status' => 'failed',
                'notes' => $payment->notes . ' | Failed: ' . ($stkCallback['ResultDesc'] ?? 'Unknown error'),
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

    protected function extractGoatTag(string $notes): ?string
    {
        if (preg_match('/Goat:\s*([^\s|]+)/', $notes, $matches)) {
            return $matches[1];
        }
        return null;
    }
}