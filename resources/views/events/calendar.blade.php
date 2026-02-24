@extends('layouts.app')
@section('title', 'Event Calendar')
@section('meta_description', 'Browse upcoming events by date. Concerts, conferences, festivals across Kenya.')
@section('content')
<div class="mb-6 sm:mb-12">
    <p class="text-xs font-semibold text-accent uppercase tracking-[0.2em] mb-2">Browse by date</p>
    <h1 class="font-display text-3xl sm:text-5xl lg:text-6xl text-slate-900 tracking-tight">Event Calendar</h1>
    <p class="mt-3 sm:mt-4 text-base sm:text-lg text-slate-600 max-w-2xl">Find events happening this month and beyond.</p>
</div>

@if($events->count() > 0)
@php
    $byMonth = $events->groupBy(fn($e) => $e->event_date->format('F Y'));
@endphp
@foreach($byMonth as $month => $monthEvents)
<section class="mb-12">
    <h2 class="text-xl font-display text-slate-900 mb-6 pb-2 border-b border-slate-200">{{ $month }}</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 -mx-4 sm:mx-0 px-4 sm:px-0">
        @foreach($monthEvents as $event)
            @include('events._card', ['event' => $event])
        @endforeach
    </div>
</section>
@endforeach
@else
<div class="bg-white border border-slate-200 p-16 sm:p-20 text-center rounded-2xl sm:rounded-none">
    <svg class="w-12 h-12 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    <h3 class="font-display text-2xl text-slate-900">No upcoming events</h3>
    <p class="mt-2 text-slate-500">Check back soon for new events.</p>
    <a href="{{ route('events.index') }}" class="inline-block mt-6 px-6 py-3 bg-navy-900 text-white text-sm font-semibold hover:bg-navy-800 transition">Browse all events</a>
</div>
@endif
@endsection
