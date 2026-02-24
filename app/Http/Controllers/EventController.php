<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $query = Event::where('is_active', true)
            ->where('event_date', '>=', now())
            ->with('ticketTypes');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('title', 'like', "%{$q}%")
                    ->orWhere('venue', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $sort = $request->get('sort', 'upcoming');
        if ($sort === 'weekend') {
            $query->whereBetween('event_date', [now()->startOfWeek()->addDays(5), now()->endOfWeek()]);
        } elseif ($sort === 'week') {
            $query->whereBetween('event_date', [now(), now()->endOfWeek()]);
        } elseif ($sort === 'month') {
            $query->whereBetween('event_date', [now(), now()->endOfMonth()]);
        }

        $query->orderBy('event_date');

        $events = $query->get();
        $featuredEvents = Event::where('is_active', true)
            ->where('event_date', '>=', now())
            ->where('is_featured', true)
            ->orderBy('event_date')
            ->with('ticketTypes')
            ->take(6)
            ->get();

        $schemaScripts = [
            json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => 'eTicket KE',
                'url' => url('/'),
                'description' => 'Book event tickets in Kenya. Pay with M-Pesa, card or cash.',
            ]),
        ];
        if ($events->isNotEmpty()) {
            $itemList = $events->take(5)->map(fn ($e, $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'item' => [
                    '@type' => 'Event',
                    'name' => $e->title,
                    'startDate' => $e->event_date->toIso8601String(),
                    'location' => ['@type' => 'Place', 'name' => $e->venue],
                ],
            ])->values()->all();
            $schemaScripts[] = json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'ItemList',
                'itemListElement' => $itemList,
            ]);
        }

        return view('events.index', compact('events', 'featuredEvents', 'schemaScripts'));
    }

    public function show(Event $event): View
    {
        $event->load('ticketTypes');
        $eventSchema = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $event->title,
            'startDate' => $event->event_date->toIso8601String(),
            'eventStatus' => 'https://schema.org/EventScheduled',
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
            'location' => ['@type' => 'Place', 'name' => $event->venue],
        ]);
        return view('events.show', compact('event', 'eventSchema'));
    }

    public function calendar(): View
    {
        $events = Event::where('is_active', true)
            ->where('event_date', '>=', now()->startOfMonth())
            ->where('event_date', '<=', now()->addMonths(2)->endOfMonth())
            ->orderBy('event_date')
            ->with('ticketTypes')
            ->get();

        return view('events.calendar', compact('events'));
    }
}
