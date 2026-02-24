@extends('layouts.app')
@section('title', $event->title)
@section('meta_description', Str::limit($event->description ?? $event->title . ' at ' . $event->venue . '. Book tickets now.', 160))
@section('og_title', $event->title . ' - eTicket KE')
@section('og_description', $event->title . ' at ' . $event->venue . ' on ' . $event->event_date->format('F j, Y') . '. Book tickets.')
@push('meta')
<script type="application/ld+json">{!! $eventSchema !!}</script>
@endpush
@section('content')
<a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-900 mb-6 sm:mb-10 min-h-[44px] items-center -ml-1 sm:ml-0" style="-webkit-tap-highlight-color: transparent;">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    All events
</a>

<div class="bg-white border border-slate-200 overflow-hidden rounded-2xl sm:rounded-none">
    <div class="md:flex">
        <div class="md:w-96 flex-shrink-0 aspect-[4/3] md:aspect-auto md:min-h-[400px] bg-slate-100 flex items-center justify-center border-l-4 border-l-accent/40">
            <svg class="w-20 h-20 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="flex-1 p-5 sm:p-8 md:p-12">
            <h1 class="font-display text-3xl sm:text-4xl text-slate-900 tracking-tight">{{ $event->title }}</h1>
            <div class="mt-4 flex flex-wrap gap-x-8 gap-y-2 text-sm text-slate-600">
                <span class="flex items-center gap-2"><svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>{{ $event->venue }}</span>
                <span class="flex items-center gap-2"><svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>{{ $event->event_date->format('l, F j, Y') }} · {{ $event->event_date->format('g:i A') }}</span>
            </div>
            @php
                $paymentBadges = [
                    'immediate' => ['Pay online only', 'bg-accent/10 text-accent'],
                    'venue' => ['Pay at gate only', 'bg-amber-100 text-amber-800'],
                    'both' => ['Pay online or at gate', 'bg-emerald-100 text-emerald-800'],
                ];
                $pm = $event->payment_mode ?? 'both';
                $badge = $paymentBadges[$pm] ?? $paymentBadges['both'];
            @endphp
            <span class="inline-block mt-4 text-sm font-semibold px-3 py-1.5 rounded {{ $badge[1] }}">{{ $badge[0] }}</span>
            @if($event->description)
            <p class="mt-6 text-slate-600 leading-relaxed">{{ $event->description }}</p>
            @endif
            <div class="mt-10">
                <h2 class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-4">Tickets</h2>
                <div class="space-y-2">
                    @foreach($event->ticketTypes as $tt)
                    @php $left = $tt->quantity - $tt->sold; @endphp
                    <div class="flex items-center justify-between py-4 px-5 border border-slate-200 rounded-lg {{ $left <= 0 ? 'bg-slate-50 opacity-75' : '' }}">
                        <div>
                            <span class="font-medium text-slate-900">{{ $tt->name }}</span>
                            <span class="ml-3 inline-flex items-center gap-1 text-sm font-medium {{ $left <= 5 ? 'text-amber-600' : 'text-slate-500' }}">
                                <span class="font-semibold">{{ $left }}</span> {{ $left === 1 ? 'ticket' : 'tickets' }} left
                            </span>
                        </div>
                        <span class="font-semibold text-slate-900">{{ config('app.currency_symbol') }} {{ number_format($tt->price) }}</span>
                    </div>
                    @endforeach
                </div>
                @php $totalLeft = $event->ticketTypes->sum(fn($t) => $t->quantity - $t->sold); @endphp
                @if($totalLeft > 0)
                <a href="{{ route('bookings.create', $event) }}" class="mt-6 inline-flex items-center justify-center w-full sm:w-auto px-10 py-4 bg-accent text-white text-base font-semibold hover:bg-accent-600 active:bg-accent-700 transition min-h-[52px] rounded-xl sm:rounded-none" style="-webkit-tap-highlight-color: transparent;">
                    Get Tickets — {{ $totalLeft }} {{ $totalLeft === 1 ? 'ticket' : 'tickets' }} available
                </a>
                @else
                <p class="mt-6 text-sm text-slate-500 font-medium">Sold out</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
