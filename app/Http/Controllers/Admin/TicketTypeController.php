<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function store(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $event->ticketTypes()->create($validated);

        return back()->with('success', 'Ticket type added.');
    }

    public function destroy(TicketType $ticketType): RedirectResponse
    {
        if ($ticketType->sold > 0) {
            return back()->withErrors(['message' => 'Cannot delete - tickets already sold.']);
        }
        $ticketType->delete();

        return back()->with('success', 'Ticket type removed.');
    }
}
