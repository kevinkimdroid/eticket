@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Dashboard</h1>
    <p class="text-slate-500 mt-1">Overview of your events and bookings</p>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-10">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-5 hover:shadow-md transition-shadow overflow-hidden relative">
        <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-100/50 rounded-bl-full"></div>
        <div class="relative">
            <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-slate-500 text-sm font-medium">Events</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['events'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-5 hover:shadow-md transition-shadow overflow-hidden relative">
        <div class="absolute top-0 right-0 w-20 h-20 bg-slate-100 rounded-bl-full"></div>
        <div class="relative">
            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
            </div>
            <p class="text-slate-500 text-sm font-medium">Bookings</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['bookings'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-5 hover:shadow-md transition-shadow overflow-hidden relative">
        <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-100/50 rounded-bl-full"></div>
        <div class="relative">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-slate-500 text-sm font-medium">Confirmed</p>
            <p class="text-2xl font-bold text-emerald-600 mt-0.5">{{ $stats['paid'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-5 hover:shadow-md transition-shadow overflow-hidden relative">
        <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-100/50 rounded-bl-full"></div>
        <div class="relative">
            <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <p class="text-slate-500 text-sm font-medium">Checked In</p>
            <p class="text-2xl font-bold text-indigo-600 mt-0.5">{{ $stats['checked_in'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-5 hover:shadow-md transition-shadow overflow-hidden relative">
        <div class="absolute top-0 right-0 w-20 h-20 bg-amber-100/50 rounded-bl-full"></div>
        <div class="relative">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-slate-500 text-sm font-medium">Today</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['today_checkins'] }}</p>
        </div>
    </div>
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl shadow-lg p-5 text-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-bl-full"></div>
        <div class="relative">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center mb-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-indigo-100 text-sm font-medium">Revenue</p>
            <p class="text-2xl font-bold mt-0.5">{{ config('app.currency_symbol') }} {{ number_format($stats['revenue']) }}</p>
        </div>
    </div>
</div>

{{-- Quick actions --}}
<div class="flex flex-wrap gap-3 mb-8">
    <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Event
    </a>
    <a href="{{ route('admin.scan') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 font-medium transition shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
        Scan Ticket
    </a>
    <a href="{{ route('admin.bookings.export') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 font-medium transition shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        Export CSV
    </a>
</div>

{{-- Recent bookings --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
    <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Recent Bookings</h2>
            <p class="text-slate-500 text-sm mt-0.5">Latest ticket purchases</p>
        </div>
        <a href="{{ route('admin.bookings.index') }}" class="text-sm px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-medium transition inline-flex items-center gap-2 w-fit">
            View all
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50/80">
                <tr>
                    <th class="text-left p-4 font-medium text-slate-600 text-sm">Code</th>
                    <th class="text-left p-4 font-medium text-slate-600 text-sm">Customer</th>
                    <th class="text-left p-4 font-medium text-slate-600 text-sm hidden md:table-cell">Event</th>
                    <th class="text-left p-4 font-medium text-slate-600 text-sm">Amount</th>
                    <th class="text-left p-4 font-medium text-slate-600 text-sm">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings as $b)
                <tr class="border-t border-slate-100 hover:bg-slate-50/50 transition">
                    <td class="p-4 font-mono text-sm font-medium text-slate-800">{{ $b->booking_code }}</td>
                    <td class="p-4 text-slate-700">{{ $b->customer_name }}</td>
                    <td class="p-4 text-slate-600 hidden md:table-cell">{{ Str::limit($b->event->title, 25) }}</td>
                    <td class="p-4 font-semibold text-slate-800">{{ config('app.currency_symbol') }} {{ number_format($b->total_amount) }}</td>
                    <td class="p-4">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium {{ $b->checked_in_at ? 'bg-indigo-100 text-indigo-700' : (in_array($b->status, ['paid','pay_at_venue']) ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700') }}">
                            @if($b->checked_in_at)
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            @endif
                            {{ $b->checked_in_at ? 'Checked in' : ($b->status === 'pay_at_venue' ? 'Pay at venue' : $b->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-12 text-center">
                        <div class="inline-flex flex-col items-center gap-3 text-slate-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                            <p class="font-medium">No bookings yet</p>
                            <a href="{{ route('admin.events.create') }}" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Create your first event →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
