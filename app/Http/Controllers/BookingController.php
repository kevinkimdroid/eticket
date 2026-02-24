<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(Event $event): View
    {
        $event->load('ticketTypes');

        return view('bookings.create', compact('event'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'nullable|string|max:15',
        ]);

        $ticketType = TicketType::findOrFail($validated['ticket_type_id']);
        $available = $ticketType->quantity - $ticketType->sold;

        if ($validated['quantity'] > $available) {
            return back()->withErrors(['quantity' => "Only {$available} tickets available."])->withInput();
        }

        $total = $ticketType->price * $validated['quantity'];
        $validated['booking_code'] = strtoupper(Str::random(8));
        $validated['total_amount'] = $total;

        $event = $ticketType->event;
        $validated['status'] = ($event->payment_mode === Event::PAYMENT_VENUE) ? 'pay_at_venue' : 'pending';

        $booking = Booking::create($validated);
        $ticketType->increment('sold', $validated['quantity']);

        if ($event->payment_mode === Event::PAYMENT_VENUE) {
            return redirect()->route('tickets.show', $booking->booking_code)
                ->with('success', 'Ticket reserved! Pay at the venue on event day.');
        }

        return redirect()->route('bookings.payment', $booking);
    }

    public function payment(Booking $booking): View|RedirectResponse
    {
        if ($booking->status !== 'pending') {
            return redirect()->route('tickets.show', $booking->booking_code);
        }

        return view('bookings.payment', compact('booking'));
    }

    public function pay(Request $request, Booking $booking): RedirectResponse
    {
        if ($booking->status !== 'pending') {
            return redirect()->route('tickets.show', $booking->booking_code);
        }

        $paymentMethod = $request->input('payment');

        if ($paymentMethod === 'stripe' && config('services.stripe.key')) {
            return redirect()->route('bookings.stripe', $booking);
        }

        if ($paymentMethod === 'mpesa') {
            return redirect()->route('bookings.mpesa', $booking);
        }

        if ($paymentMethod === 'cash') {
            $booking->update(['status' => 'paid']);
            try {
                \Illuminate\Support\Facades\Mail::to($booking->customer_email)->send(new \App\Mail\TicketConfirmation($booking));
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('Ticket email failed: ' . $e->getMessage());
            }
            return redirect()->route('tickets.show', $booking->booking_code)
                ->with('success', 'Payment recorded. Your ticket is ready!');
        }

        return back()->withErrors(['payment' => 'Please select a payment method.']);
    }
}
