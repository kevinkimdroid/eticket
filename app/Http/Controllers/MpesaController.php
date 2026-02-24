<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\MpesaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    public function initiate(Request $request, Booking $booking): JsonResponse
    {
        if ($booking->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Booking already paid']);
        }

        $phone = $request->input('phone') ?? $booking->customer_phone;
        if (empty($phone)) {
            return response()->json(['success' => false, 'message' => 'Phone number required for M-Pesa']);
        }

        $mpesa = new MpesaService();
        if (!$mpesa->isConfigured()) {
            return response()->json(['success' => false, 'message' => 'M-Pesa not configured']);
        }

        $result = $mpesa->stkPush($phone, (float) $booking->total_amount, $booking->booking_code);

        if ($result['success']) {
            \Illuminate\Support\Facades\Cache::put('mpesa_' . $result['CheckoutRequestID'], $booking->id, now()->addMinutes(15));
            return response()->json(['success' => true, 'message' => 'Enter M-Pesa PIN on your phone']);
        }

        return response()->json(['success' => false, 'message' => $result['message']]);
    }

    public function callback(Request $request): void
    {
        Log::info('M-Pesa callback: ' . $request->getContent());
        $json = $request->all();
        $body = $json['Body']['stkCallback'] ?? null;
        if (!$body || ($body['ResultCode'] ?? 1) !== 0) {
            return;
        }
        $checkoutId = $body['CheckoutRequestID'] ?? null;
        $metadata = $body['CallbackMetadata']['Item'] ?? [];
        $mpesaReceipt = null;
        foreach ($metadata as $item) {
            if (($item['Name'] ?? '') === 'MpesaReceiptNumber') {
                $mpesaReceipt = $item['Value'] ?? null;
                break;
            }
        }
        $bookingId = $checkoutId ? \Illuminate\Support\Facades\Cache::pull('mpesa_' . $checkoutId) : null;
        if ($bookingId) {
            $booking = Booking::find($bookingId);
            if ($booking && $booking->status === 'pending') {
                $booking->update(['status' => 'paid', 'stripe_payment_id' => $mpesaReceipt ?? 'MPESA']);
                try {
                    \Illuminate\Support\Facades\Mail::to($booking->customer_email)->send(new \App\Mail\TicketConfirmation($booking));
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Ticket email failed: ' . $e->getMessage());
                }
            }
        }
    }
}
