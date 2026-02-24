<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    public function show(string $code)
    {
        $booking = Booking::where('booking_code', $code)->with(['event', 'ticketType'])->firstOrFail();

        return view('tickets.show', compact('booking'));
    }

    public function qr(string $code): Response
    {
        $url = route('tickets.show', $code);
        $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(200)->generate($url);

        return response($qr)->header('Content-Type', 'image/svg+xml');
    }
}
