<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function checkout(Booking $booking): RedirectResponse
    {
        if ($booking->status !== 'pending') {
            return redirect()->route('tickets.show', $booking->booking_code);
        }

        $key = config('services.stripe.key');
        if (empty($key)) {
            return redirect()->route('bookings.payment', $booking)
                ->withErrors(['payment' => 'Stripe is not configured. Use cash payment for demo.']);
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'kes',
                        'product_data' => [
                            'name' => $booking->event->title . ' - ' . $booking->ticketType->name,
                            'description' => $booking->quantity . ' ticket(s)',
                        ],
                        'unit_amount' => (int) $booking->total_amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('bookings.stripe.success', ['booking' => $booking->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('bookings.payment', $booking),
            ]);

            return redirect()->away($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe error: ' . $e->getMessage());
            return redirect()->route('bookings.payment', $booking)
                ->withErrors(['payment' => 'Payment failed. Please try again.']);
        }
    }

    public function success(Request $request, Booking $booking): RedirectResponse
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return redirect()->route('events.index')->withErrors(['payment' => 'Invalid session.']);
        }

        $key = config('services.stripe.secret');
        if (empty($key)) {
            return redirect()->route('tickets.show', $booking->booking_code);
        }

        \Stripe\Stripe::setApiKey($key);

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if ($session->payment_status === 'paid') {
                $booking->update([
                    'status' => 'paid',
                    'stripe_payment_id' => $session->payment_intent ?? $sessionId,
                ]);
                try {
                    \Illuminate\Support\Facades\Mail::to($booking->customer_email)->send(new \App\Mail\TicketConfirmation($booking));
                } catch (\Throwable $e) {
                    Log::warning('Ticket email failed: ' . $e->getMessage());
                }
            }
        } catch (\Exception $e) {
            Log::error('Stripe success error: ' . $e->getMessage());
        }

        return redirect()->route('tickets.show', $booking->booking_code)
            ->with('success', 'Payment successful! Your ticket is ready.');
    }
}
