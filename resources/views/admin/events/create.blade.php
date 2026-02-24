@extends('layouts.admin')
@section('title', 'New Event')
@section('content')
<h1 class="text-2xl font-bold mb-6">New Event</h1>
<form action="{{ route('admin.events.store') }}" method="POST" class="bg-white rounded shadow p-6 max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block font-medium mb-1">Title</label>
        <input type="text" name="title" required class="w-full border rounded px-3 py-2">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Description</label>
        <textarea name="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Venue</label>
        <input type="text" name="venue" required class="w-full border rounded px-3 py-2">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Category</label>
        <select name="category" class="w-full border rounded px-3 py-2">
            <option value="">Select category</option>
            <option value="concert">Concert</option>
            <option value="conference">Conference</option>
            <option value="film">Film & Theatre</option>
            <option value="sports">Sports</option>
            <option value="festival">Festival</option>
            <option value="comedy">Comedy</option>
            <option value="other">Other</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Event Date & Time</label>
        <input type="datetime-local" name="event_date" required class="w-full border rounded px-3 py-2">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Payment Mode</label>
        <select name="payment_mode" class="w-full border rounded px-3 py-2">
            <option value="both">Both – Online (M-Pesa/Card) or pay at venue</option>
            <option value="immediate">Immediate – Online payment only</option>
            <option value="venue">Pay at venue – No online payment required</option>
        </select>
        <p class="text-sm text-slate-500 mt-1">Control how attendees pay for tickets</p>
    </div>
    <div class="mb-4">
        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_featured" value="1" class="rounded border-slate-300">
            <span class="font-medium">Featured event</span>
        </label>
        <p class="text-sm text-slate-500 mt-1">Show in featured section on homepage</p>
    </div>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Create Event</button>
</form>
@endsection
