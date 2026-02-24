<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::withCount('bookings')->orderBy('event_date', 'desc')->get();

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue' => 'required|string|max:255',
            'category' => 'nullable|string|in:concert,conference,film,sports,festival,comedy,other',
            'event_date' => 'required|date',
            'payment_mode' => 'in:immediate,venue,both',
            'is_featured' => 'boolean',
        ]);

        Event::create(array_merge($validated, ['is_active' => true, 'is_featured' => $request->boolean('is_featured')]));

        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function edit(Event $event): View
    {
        $event->load('ticketTypes');

        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue' => 'required|string|max:255',
            'category' => 'nullable|string|in:concert,conference,film,sports,festival,comedy,other',
            'event_date' => 'required|date',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'payment_mode' => 'in:immediate,venue,both',
        ]);

        $event->update(array_merge($validated, ['is_featured' => $request->boolean('is_featured')]));

        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }
}
