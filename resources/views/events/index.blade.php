@extends('layouts.app')
@section('title', 'Events')
@push('meta')
@foreach($schemaScripts as $script)
<script type="application/ld+json">{!! $script !!}</script>
@endforeach
@endpush
@section('meta_description', 'Discover and book tickets for upcoming events in Kenya. Concerts, conferences, festivals. Pay with M-Pesa, card or cash. Instant e-tickets.')
@section('content')
{{-- Hero --}}
<div class="mb-6 sm:mb-12">
    <p class="text-xs font-semibold text-accent uppercase tracking-[0.2em] mb-2">Discover</p>
    <h1 class="font-display text-3xl sm:text-5xl lg:text-6xl text-slate-900 tracking-tight">Upcoming Events</h1>
    <p class="mt-3 sm:mt-4 text-base sm:text-lg text-slate-600 max-w-2xl">Find concerts, conferences, and festivals. Secure checkout. Instant e-tickets.</p>
</div>

{{-- Search & Filter (TikoHUB-style) --}}
<form method="GET" action="{{ route('events.index') }}" class="mb-8 space-y-4">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search events..." class="w-full border border-slate-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-accent focus:border-accent rounded-lg sm:rounded-none">
        </div>
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
            <select name="category" class="border border-slate-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-accent focus:border-accent rounded-lg sm:rounded-none bg-white">
                <option value="">All types</option>
                <option value="concert" {{ request('category') === 'concert' ? 'selected' : '' }}>Concert</option>
                <option value="conference" {{ request('category') === 'conference' ? 'selected' : '' }}>Conference</option>
                <option value="film" {{ request('category') === 'film' ? 'selected' : '' }}>Film & Theatre</option>
                <option value="sports" {{ request('category') === 'sports' ? 'selected' : '' }}>Sports</option>
                <option value="festival" {{ request('category') === 'festival' ? 'selected' : '' }}>Festival</option>
                <option value="comedy" {{ request('category') === 'comedy' ? 'selected' : '' }}>Comedy</option>
                <option value="other" {{ request('category') === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <select name="sort" class="border border-slate-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-accent focus:border-accent rounded-lg sm:rounded-none bg-white">
                <option value="upcoming" {{ request('sort') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                <option value="weekend" {{ request('sort') === 'weekend' ? 'selected' : '' }}>This Weekend</option>
                <option value="week" {{ request('sort') === 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('sort') === 'month' ? 'selected' : '' }}>This Month</option>
            </select>
            <button type="submit" class="px-4 py-2.5 bg-navy-900 text-white text-sm font-medium hover:bg-navy-800 transition rounded-lg sm:rounded-none">Filter</button>
        </div>
    </div>
</form>

{{-- Featured Events --}}
@if(isset($featuredEvents) && $featuredEvents->count() > 0)
<h2 class="text-lg font-semibold text-slate-900 mb-4">Featured Events</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-12 -mx-4 sm:mx-0 px-4 sm:px-0">
    @foreach($featuredEvents as $event)
        @include('events._card', ['event' => $event])
    @endforeach
</div>
<h2 class="text-lg font-semibold text-slate-900 mb-4 mt-8">All Events</h2>
@endif

@if($events->count() > 0)
<p class="text-sm font-medium text-slate-500 mb-6 sm:mb-8">{{ $events->count() }} {{ Str::plural('event', $events->count()) }} available</p>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8 -mx-4 sm:mx-0 px-4 sm:px-0">
    @foreach($events as $event)
        @include('events._card', ['event' => $event])
    @endforeach
</div>
@else
<div class="bg-white border border-slate-200 p-16 sm:p-20 text-center rounded-2xl sm:rounded-none">
    <svg class="w-12 h-12 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    <h3 class="font-display text-2xl text-slate-900">No events match your search</h3>
    <p class="mt-2 text-slate-500">Try adjusting your filters or check back later.</p>
    <a href="{{ route('events.index') }}" class="inline-block mt-6 px-6 py-3 bg-navy-900 text-white text-sm font-semibold hover:bg-navy-800 transition">View all events</a>
</div>
@endif

{{-- Trust - hidden on mobile --}}
<div class="mt-16 sm:mt-24 pt-12 sm:pt-16 border-t border-slate-200 hidden sm:block">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-center gap-12 sm:gap-24">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-slate-900">Secure checkout</p>
                <p class="text-sm text-slate-500">M-Pesa & Stripe</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-slate-900">Instant delivery</p>
                <p class="text-sm text-slate-500">E-tickets with QR codes</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-slate-900">24/7 support</p>
                <p class="text-sm text-slate-500"><a href="{{ route('contact') }}" class="text-accent hover:underline">Contact us</a></p>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 sm:mt-12 text-center hidden sm:block">
    <a href="{{ route('login') }}" class="text-sm font-medium text-accent hover:text-accent-600 transition">Organizer login →</a>
</div>
@endsection
