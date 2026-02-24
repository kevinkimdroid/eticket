<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = Booking::with(['event', 'ticketType'])->latest()->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function scan(): View
    {
        return view('admin.scan');
    }

    public function lookup(Request $request): JsonResponse
    {
        $code = strtoupper($request->input('code'));
        $booking = Booking::where('booking_code', $code)->with(['event', 'ticketType'])->first();

        if (!$booking) {
            return response()->json(['found' => false, 'message' => 'Ticket not found']);
        }

        return response()->json([
            'found' => true,
            'booking' => [
                'id' => $booking->id,
                'code' => $booking->booking_code,
                'customer_name' => $booking->customer_name,
                'event' => $booking->event->title,
                'ticket_type' => $booking->ticketType->name,
                'quantity' => $booking->quantity,
                'status' => $booking->status,
                'checked_in_at' => $booking->checked_in_at?->toIso8601String(),
            ],
        ]);
    }

    public function export(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Code', 'Customer', 'Email', 'Phone', 'Event', 'Ticket Type', 'Qty', 'Amount', 'Status', 'Date']);
            foreach (Booking::with(['event', 'ticketType'])->latest()->cursor() as $b) {
                fputcsv($handle, [
                    $b->booking_code, $b->customer_name, $b->customer_email, $b->customer_phone,
                    $b->event->title, $b->ticketType->name, $b->quantity, $b->total_amount,
                    $b->checked_in_at ? 'Checked in' : $b->status, $b->created_at->format('Y-m-d H:i'),
                ]);
            }
            fclose($handle);
        }, 'bookings-' . date('Y-m-d') . '.csv', ['Content-Type' => 'text/csv']);
    }

    public function checkIn(Booking $booking): JsonResponse
    {
        if (!in_array($booking->status, ['paid', 'pay_at_venue'])) {
            return response()->json(['success' => false, 'message' => 'Ticket not paid'], 400);
        }

        if ($booking->checked_in_at) {
            return response()->json(['success' => false, 'message' => 'Already checked in'], 400);
        }

        $booking->update(['checked_in_at' => now()]);

        return response()->json(['success' => true, 'message' => 'Checked in successfully']);
    }
}
