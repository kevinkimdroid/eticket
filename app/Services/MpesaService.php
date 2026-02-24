<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaService
{
    protected string $baseUrl;
    protected string $consumerKey;
    protected string $consumerSecret;
    protected string $shortcode;
    protected string $passkey;

    public function __construct()
    {
        $env = config('services.mpesa.env', 'sandbox');
        $this->baseUrl = $env === 'sandbox'
            ? 'https://sandbox.safaricom.co.ke'
            : 'https://api.safaricom.co.ke';
        $this->consumerKey = config('services.mpesa.consumer_key', '');
        $this->consumerSecret = config('services.mpesa.consumer_secret', '');
        $this->shortcode = config('services.mpesa.shortcode', '');
        $this->passkey = config('services.mpesa.passkey', '');
    }

    public function isConfigured(): bool
    {
        return !empty($this->consumerKey) && !empty($this->consumerSecret) && !empty($this->shortcode) && !empty($this->passkey);
    }

    protected function getAccessToken(): ?string
    {
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get("{$this->baseUrl}/oauth/v1/generate?grant_type=client_credentials");

        if ($response->successful()) {
            return $response->json('access_token');
        }
        Log::error('M-Pesa auth failed: ' . $response->body());
        return null;
    }

    public function stkPush(string $phone, float $amount, string $reference): array
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return ['success' => false, 'message' => 'Could not authenticate with M-Pesa'];
        }

        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) === 9 && str_starts_with($phone, '7')) {
            $phone = '254' . $phone;
        } elseif (strlen($phone) === 10 && str_starts_with($phone, '0')) {
            $phone = '254' . substr($phone, 1);
        }

        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $payload = [
            'BusinessShortCode' => $this->shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => (int) round($amount),
            'PartyA' => $phone,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => route('mpesa.callback'),
            'AccountReference' => substr($reference, 0, 12),
            'TransactionDesc' => 'Ticket payment',
        ];

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/mpesa/stkpush/v1/processrequest", $payload);

        $data = $response->json();
        if ($response->successful() && isset($data['CheckoutRequestID'])) {
            return ['success' => true, 'CheckoutRequestID' => $data['CheckoutRequestID']];
        }
        Log::error('M-Pesa STK push failed: ' . $response->body());
        return ['success' => false, 'message' => $data['errorMessage'] ?? 'Payment request failed'];
    }
}
