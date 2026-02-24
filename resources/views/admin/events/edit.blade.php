@extends('layouts.admin')
@section('title', 'Edit Event')
@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Event</h1>
<form action="{{ route('admin.events.update', $event) }}" method="POST" class="bg-white rounded shadow p-6 max-w-lg mb-8">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block font-medium mb-1">Title</label>
        <input type="text" name="title" required class="w-full border rounded px-3 py-2" value="{{ $event->title }}">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Description</label>
        <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ $event->description }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Venue</label>
        <input type="text" name="venue" required class="w-full border rounded px-3 py-2" value="{{ $event->venue }}">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Category</label>
        <select name="category" class="w-full border rounded px-3 py-2">
            <option value="">Select category</option>
            <option value="concert" {{ $event->category === 'concert' ? 'selected' : '' }}>Concert</option>
            <option value="conference" {{ $event->category === 'conference' ? 'selected' : '' }}>Conference</option>
            <option value="film" {{ $event->category === 'film' ? 'selected' : '' }}>Film & Theatre</option>
            <option value="sports" {{ $event->category === 'sports' ? 'selected' : '' }}>Sports</option>
            <option value="festival" {{ $event->category === 'festival' ? 'selected' : '' }}>Festival</option>
            <option value="comedy" {{ $event->category === 'comedy' ? 'selected' : '' }}>Comedy</option>
            <option value="other" {{ $event->category === 'other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Event Date & Time</label>
        <input type="datetime-local" name="event_date" required class="w-full border rounded px-3 py-2"
            value="{{ $event->event_date->format('Y-m-d\TH:i') }}">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Payment Mode</label>
        <select name="payment_mode" class="w-full border rounded px-3 py-2">
            <option value="both" {{ $event->payment_mode === 'both' ? 'selected' : '' }}>Both – Online or pay at venue</option>
            <option value="immediate" {{ $event->payment_mode === 'immediate' ? 'selected' : '' }}>Immediate – Online only</option>
            <option value="venue" {{ $event->payment_mode === 'venue' ? 'selected' : '' }}>Pay at venue only</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="flex items-center gap-2">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ $event->is_active ? 'checked' : '' }}>
            <span>Active</span>
        </label>
    </div>
    <div class="mb-4">
        <label class="flex items-center gap-2">
            <input type="hidden" name="is_featured" value="0">
            <input type="checkbox" name="is_featured" value="1" {{ $event->is_featured ? 'checked' : '' }}>
            <span>Featured event</span>
        </label>
        <p class="text-sm text-slate-500 mt-1">Show in featured section on homepage</p>
    </div>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
</form>
<h2 class="text-lg font-semibold mb-4">Ticket Types</h2>
<div class="space-y-4">
    @foreach($event->ticketTypes as $tt)
    <div class="bg-white rounded shadow p-4 flex justify-between items-center">
        <span>{{ $tt->name }} - {{ config('app.currency_symbol') }} {{ number_format($tt->price) }} ({{ $tt->sold }}/{{ $tt->quantity }} sold)</span>
        @if($tt->sold == 0)
        <form action="{{ route('admin.ticket-types.destroy', $tt) }}" method="POST" onsubmit="return confirm('Delete?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-600 text-sm">Delete</button>
        </form>
        @endif
    </div>
    @endforeach
</div>
<form action="{{ route('admin.ticket-types.store', $event) }}" method="POST" class="mt-4 bg-white rounded shadow p-4">
    @csrf
    <h3 class="font-medium mb-3">Add Ticket Type</h3>
    <div class="flex gap-2 flex-wrap">
        <input type="text" name="name" placeholder="Name" required class="border rounded px-3 py-2">
        <input type="number" name="price" placeholder="Price" step="0.01" min="0" required class="border rounded px-3 py-2">
        <input type="number" name="quantity" placeholder="Qty" min="1" required class="border rounded px-3 py-2">
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Add</button>
    </div>
</form>
@endsection
