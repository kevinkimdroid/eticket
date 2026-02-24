<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'events' => Event::count(),
            'bookings' => Booking::count(),
            'paid' => Booking::whereIn('status', ['paid', 'pay_at_venue'])->count(),
            'checked_in' => Booking::whereNotNull('checked_in_at')->count(),
            'revenue' => Booking::where('status', 'paid')->sum('total_amount'),
            'today_checkins' => Booking::whereNotNull('checked_in_at')->whereDate('checked_in_at', today())->count(),
        ];

        $recentBookings = Booking::with(['event', 'ticketType'])->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
