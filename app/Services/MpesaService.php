<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaService
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $passkey;
    protected $shortcode;
    protected $baseUrl;
    protected $callbackUrl;
    protected $env;

    public function __construct()
    {
        $this->consumerKey = config('mpesa.consumer_key');
        $this->consumerSecret = config('mpesa.consumer_secret');
        $this->passkey = config('mpesa.passkey');
        $this->shortcode = config('mpesa.shortcode');
        $this->env = config('mpesa.env', 'sandbox');
        $this->callbackUrl = config('mpesa.callback_url');

        $this->baseUrl = $this->env === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    public function getAccessToken(): ?string
    {
        $credentials = base64_encode($this->consumerKey . ':' . $this->consumerSecret);

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials,
        ])->get($this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials');

        if ($response->successful()) {
            return $response->json('access_token');
        }

        Log::error('M-Pesa token generation failed', [
            'response' => $response->json(),
        ]);

        return null;
    }

    public function stkPush(string $phone, float $amount, string $reference, string $description = 'Payment'): array
    {
        $token = $this->getAccessToken();

        if (!$token) {
            return [
                'success' => false,
                'message' => 'Failed to connect to M-Pesa. Please try again.',
            ];
        }

        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $payload = [
            'BusinessShortCode' => $this->shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => (int) round($amount),
            'PartyA' => $this->formatPhone($phone),
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $this->formatPhone($phone),
            'CallBackURL' => $this->callbackUrl,
            'AccountReference' => $reference,
            'TransactionDesc' => $description,
        ];

        $response = Http::withToken($token)
            ->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', $payload);

        $result = $response->json();

        Log::info('M-Pesa STK Push', [
            'payload' => $payload,
            'response' => $result,
        ]);

        if ($response->successful() && isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
            return [
                'success' => true,
                'checkout_request_id' => $result['CheckoutRequestID'] ?? null,
                'merchant_request_id' => $result['MerchantRequestID'] ?? null,
                'message' => $result['CustomerMessage'] ?? 'Enter your M-Pesa PIN to complete payment.',
            ];
        }

        return [
            'success' => false,
            'message' => $result['errorMessage'] ?? 'Payment request failed. Please try again.',
        ];
    }

    public function queryStkStatus(string $checkoutRequestId): array
    {
        $token = $this->getAccessToken();

        if (!$token) {
            return ['success' => false, 'message' => 'Failed to connect to M-Pesa.'];
        }

        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $response = Http::withToken($token)->post(
            $this->baseUrl . '/mpesa/stkpushquery/v1/query',
            [
                'BusinessShortCode' => $this->shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'CheckoutRequestID' => $checkoutRequestId,
            ]
        );

        return $response->json();
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