<?php

namespace Tests\Feature;

use App\Mail\PaymentReceiptMail;
use App\Models\Goat;
use App\Models\Payment;
use App\Services\MpesaService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class PaymentReceiptTest extends TestCase
{
    use DatabaseTransactions;

    private function makeGoat(array $overrides = []): Goat
    {
        return Goat::create(array_merge([
            'tag_number' => 'RCPT-' . strtoupper(Str::random(8)),
            'name' => 'Test Goat',
            'gender' => 'female',
            'selling_price' => 12000,
            'status' => 'available',
        ], $overrides));
    }

    private function makePayment(Goat $goat, array $overrides = []): Payment
    {
        return Payment::create(array_merge([
            'sale_id' => null,
            'payment_reference' => 'EF-' . strtoupper(Str::random(8)),
            'amount' => 12300,
            'payment_method' => 'mpesa',
            'phone_number' => '25471234567',
            'email' => 'buyer@example.com',
            'status' => 'pending',
            'notes' => sprintf(
                'Buyer: Jane Wanjiku | Goat: %s | Qty: 1 | Delivery: Nakuru, Nakuru Town | Transport: KES 300 (KES 300 × 1)',
                $goat->tag_number
            ),
            'mpesa_response' => json_encode(['checkout_request_id' => 'ws_CO_TEST_1']),
        ], $overrides));
    }

    public function test_checkout_form_uses_controller_field_names_and_includes_email()
    {
        $goat = $this->makeGoat();

        $response = $this->get(route('checkout', ['goat' => $goat]));

        $response->assertOk();
        $response->assertSee('name="name"', false);
        $response->assertSee('name="phone"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="delivery_address"', false);
        $response->assertDontSee('name="buyer_name"', false);
        $response->assertDontSee('name="phone_number"', false);
        $response->assertDontSee('name="delivery_county"', false);
    }

    public function test_initiate_requires_email()
    {
        $goat = $this->makeGoat();

        $response = $this->post(route('payment.initiate'), [
            'goat_id' => $goat->id,
            'quantity' => 1,
            'phone' => '0712345678',
            'name' => 'Jane Wanjiku',
            'delivery_address' => 'Nakuru',
            'delivery_town' => 'Nakuru Town',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_initiate_persists_buyer_email_on_payment()
    {
        $mpesa = $this->mock(MpesaService::class);
        $mpesa->shouldReceive('stkPush')->once()->andReturn([
            'success' => true,
            'checkout_request_id' => 'ws_CO_TEST_1',
            'message' => 'Success',
        ]);

        $goat = $this->makeGoat();

        $response = $this->post(route('payment.initiate'), [
            'goat_id' => $goat->id,
            'quantity' => 1,
            'phone' => '0712345678',
            'name' => 'Jane Wanjiku',
            'email' => 'jane@example.com',
            'delivery_address' => 'Nakuru',
            'delivery_town' => 'Nakuru Town',
        ]);

        $response->assertOk();

        $payment = Payment::where('email', 'jane@example.com')->latest('id')->first();
        $this->assertNotNull($payment);
        $this->assertSame('pending', $payment->status);
        $this->assertSame('0712345678', $payment->phone_number);
    }

    public function test_successful_callback_completes_payment_and_queues_receipt_email()
    {
        Mail::fake();

        $goat = $this->makeGoat();
        $payment = $this->makePayment($goat);

        $response = $this->postJson('/api/mpesa/callback', [
            'Body' => [
                'stkCallback' => [
                    'MerchantRequestID' => 'merchant-test',
                    'CheckoutRequestID' => 'ws_CO_TEST_1',
                    'ResultCode' => 0,
                    'CallbackMetadata' => [
                        'Item' => [
                            ['Name' => 'MpesaReceiptNumber', 'Value' => 'QAX12345'],
                            ['Name' => 'Amount', 'Value' => 12300],
                            ['Name' => 'PhoneNumber', 'Value' => 25471234567],
                        ],
                    ],
                ],
            ],
        ]);

        $response->assertOk();

        $payment->refresh();
        $this->assertSame('completed', $payment->status);
        $this->assertSame('QAX12345', $payment->transaction_id);

        $this->assertDatabaseHas('goats', [
            'tag_number' => $goat->tag_number,
            'status' => 'sold',
        ]);

        Mail::assertQueued(PaymentReceiptMail::class, function (PaymentReceiptMail $mail) {
            return $mail->hasTo('buyer@example.com');
        });
    }

    public function test_cancelled_callback_marks_payment_cancelled_without_receipt_email()
    {
        Mail::fake();

        $goat = $this->makeGoat();
        $payment = $this->makePayment($goat);

        $response = $this->postJson('/api/mpesa/callback', [
            'Body' => [
                'stkCallback' => [
                    'MerchantRequestID' => 'merchant-test',
                    'CheckoutRequestID' => 'ws_CO_TEST_1',
                    'ResultCode' => 1032,
                    'ResultDesc' => 'Request cancelled by user',
                ],
            ],
        ]);

        $response->assertOk();

        $payment->refresh();
        $this->assertSame('cancelled', $payment->status);
        $this->assertStringContainsString('Cancelled: Request cancelled by user', $payment->notes);

        Mail::assertNotQueued(PaymentReceiptMail::class);
    }

    public function test_status_endpoint_returns_cancelled_reason_for_pending_page()
    {
        $goat = $this->makeGoat();
        $payment = $this->makePayment($goat);

        $this->postJson('/api/mpesa/callback', [
            'Body' => [
                'stkCallback' => [
                    'MerchantRequestID' => 'merchant-test',
                    'CheckoutRequestID' => 'ws_CO_TEST_1',
                    'ResultCode' => 1032,
                    'ResultDesc' => 'Request cancelled by user',
                ],
            ],
        ])->assertOk();

        $response = $this->postJson(route('payment.status'), [
            'reference' => $payment->payment_reference,
        ]);

        $response->assertOk();
        $response->assertJsonPath('status', 'cancelled');
        $response->assertJsonPath('reason', 'Request cancelled by user');
    }

    public function test_failed_callback_does_not_queue_receipt_email()
    {
        Mail::fake();

        $goat = $this->makeGoat();
        $payment = $this->makePayment($goat);

        $response = $this->postJson('/api/mpesa/callback', [
            'Body' => [
                'stkCallback' => [
                    'MerchantRequestID' => 'merchant-test',
                    'CheckoutRequestID' => 'ws_CO_TEST_1',
                    'ResultCode' => 1037,
                    'ResultDesc' => 'Unable to lock subscriber, a transaction is already in process for the current subscriber',
                ],
            ],
        ]);

        $response->assertOk();

        $payment->refresh();
        $this->assertSame('failed', $payment->status);
        $this->assertStringContainsString('Failed: Unable to lock subscriber', $payment->notes);

        Mail::assertNotQueued(PaymentReceiptMail::class);
    }

    public function test_receipt_email_renders_with_reference_and_amounts()
    {
        $goat = $this->makeGoat();
        $payment = $this->makePayment($goat, ['payment_date' => now()]);

        $html = (new PaymentReceiptMail($payment))->render();

        $this->assertStringContainsString($payment->payment_reference, $html);
        $this->assertStringContainsString('Payment successful', $html);
        $this->assertStringContainsString('12,300', $html);
        $this->assertStringContainsString('Jane Wanjiku', $html);
        $this->assertStringContainsString('Official receipt', $html);
        $this->assertStringContainsString('M-Pesa receipt', $html);
    }
}
