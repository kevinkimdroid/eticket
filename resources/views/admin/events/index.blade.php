@extends('layouts.admin')
@section('title', 'Events')
@section('content')
<h1 class="text-2xl font-bold mb-6 flex justify-between items-center">
    Events
    <a href="{{ route('admin.events.create') }}" class="text-sm px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">+ New Event</a>
</h1>
<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50">
            <tr>
                <th class="text-left p-3">Event</th>
                <th class="text-left p-3">Date</th>
                <th class="text-left p-3">Venue</th>
                <th class="text-left p-3">Bookings</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $e)
            <tr class="border-t">
                <td class="p-3 font-medium">{{ $e->title }}</td>
                <td class="p-3">{{ $e->event_date->format('M d, Y') }}</td>
                <td class="p-3">{{ $e->venue }}</td>
                <td class="p-3">{{ $e->bookings_count }}</td>
                <td class="p-3"><a href="{{ route('admin.events.edit', $e) }}" class="text-indigo-600 hover:underline">Edit</a></td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-6 text-slate-500 text-center">No events</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
