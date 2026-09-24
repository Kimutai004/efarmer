<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MpesaService
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $baseUrl;
    protected $callbackUrl;
    protected $accountReference;
    protected $routeCode;
    protected $operation;
    protected $orgShortCode;
    protected $orgPassKey;

    public function __construct()
    {
        $this->consumerKey = config('mpesa.consumer_key');
        $this->consumerSecret = config('mpesa.consumer_secret');
        $this->accountReference = config('mpesa.account_reference');
        $this->callbackUrl = config('mpesa.callback_url');
        $this->baseUrl = rtrim(config('mpesa.base_url'), '/');
        $this->routeCode = config('mpesa.route_code');
        $this->operation = config('mpesa.operation');
        $this->orgShortCode = config('mpesa.org_shortcode');
        $this->orgPassKey = config('mpesa.org_passkey');
    }

    public function getAccessToken(): ?string
    {
        $credentials = base64_encode($this->consumerKey . ':' . $this->consumerSecret);

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Basic ' . $credentials,
        ])->post($this->baseUrl . '/token?grant_type=client_credentials', [
            'grant_type' => 'client_credentials',
        ]);

        if ($response->successful()) {
            return $response->json('access_token');
        }

        Log::error('KCB Buni token generation failed', [
            'response' => $response->json(),
        ]);

        return null;
    }

    public function stkPush(string $phone, float $amount, string $reference, string $description = 'Payment'): array
    {
        if (blank($this->accountReference)) {
            Log::error('KCB Buni STK Push cannot start without an account reference.');

            return [
                'success' => false,
                'message' => 'Payment is not configured. Please contact support.',
            ];
        }

        $token = $this->getAccessToken();

        if (!$token) {
            return [
                'success' => false,
                'message' => 'Failed to connect to M-Pesa. Please try again.',
            ];
        }

        $payload = [
            'phoneNumber' => $this->formatPhone($phone),
            'amount' => (string) (int) round($amount),
            'invoiceNumber' => '522533-' . $this->accountReference . '-' . $reference,
            'sharedShortCode' => true,
            'orgShortCode' => $this->orgShortCode,
            'orgPassKey' => $this->orgPassKey,
            'callbackUrl' => $this->callbackUrl,
            'transactionDescription' => substr($description, 0, 30),
        ];

        $response = Http::withToken($token)->withHeaders([
            'routeCode' => $this->routeCode,
            'operation' => $this->operation,
            'messageId' => (string) Str::uuid(),
        ])
            ->post($this->baseUrl . '/mm/api/request/1.0.0/stkpush', $payload);

        $result = $response->json();
        $gatewayResponse = $result['response'] ?? [];

        Log::info('KCB Buni M-Pesa STK Push', [
            'payload' => $payload,
            'response' => $result,
        ]);

        if ($response->successful() && ($result['header']['statusCode'] ?? null) === '0' && ($gatewayResponse['ResponseCode'] ?? null) === '0') {
            return [
                'success' => true,
                'checkout_request_id' => $gatewayResponse['CheckoutRequestID'] ?? null,
                'merchant_request_id' => $gatewayResponse['MerchantRequestID'] ?? null,
                'message' => $gatewayResponse['CustomerMessage'] ?? 'Enter your M-Pesa PIN to complete payment.',
            ];
        }

        return [
            'success' => false,
            'message' => $result['header']['statusDescription'] ?? $result['fault']['description'] ?? 'Payment request failed. Please try again.',
        ];
    }

    protected function formatPhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) === 9) {
            $phone = '254' . $phone;
        } elseif (strlen($phone) === 10 && $phone[0] === '0') {
            $phone = '254' . substr($phone, 1);
        } elseif (strlen($phone) === 12 && str_starts_with($phone, '254')) {
            // already formatted
        } elseif (strlen($phone) === 13 && str_starts_with($phone, '+254')) {
            $phone = ltrim($phone, '+');
        }

        return $phone;
    }
}