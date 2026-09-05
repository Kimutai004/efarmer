<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\Goat;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Services\MpesaService;
use App\Http\Controllers\PaymentController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProcessMpesaPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 10;

    protected array $data;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(MpesaService $mpesa): array
    {
        $data = $this->data;
        $quantity = $data['quantity'] ?? 1;

        $goat = Goat::findOrFail($data['goat_id']);

        if ($goat->status !== 'available') {
            return [
                'success' => false,
                'message' => 'This goat is no longer available.',
            ];
        }

        $subtotal = $goat->selling_price * $quantity;
        $transportFee = PaymentController::TRANSPORT_FEE * $quantity;
        $totalAmount = $subtotal + $transportFee;
        $reference = 'EF-' . strtoupper(Str::random(8));

        $quantityLabel = $quantity > 1 ? " (x{$quantity})" : '';
        $result = $mpesa->stkPush(
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
                    PaymentController::TRANSPORT_FEE,
                    $quantity
                ),
                'mpesa_response' => json_encode($result),
            ]);

            return [
                'success' => true,
                'reference' => $reference,
                'goat' => $goat,
                'checkout_id' => $result['checkout_request_id'] ?? null,
            ];
        }

        return [
            'success' => false,
            'message' => $result['message'],
        ];
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('M-Pesa payment processing failed', [
            'data' => $this->data,
            'error' => $exception->getMessage(),
        ]);
    }
}
