@extends('layouts.app')
@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with eTicket KE. Support, partnership inquiries, and order assistance.')
@section('content')
<div class="max-w-2xl">
    <p class="text-xs font-semibold text-slate-500 uppercase tracking-[0.2em] mb-2">Support</p>
    <h1 class="font-display text-4xl sm:text-5xl text-slate-900 tracking-tight">Contact Us</h1>
    <p class="mt-4 text-lg text-slate-600">We're here to help with tickets, orders, and event inquiries.</p>

    <div class="mt-14 space-y-8">
        <div class="grid sm:grid-cols-2 gap-6">
            <div class="p-6 bg-white border border-slate-200">
                <div class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <h3 class="font-display text-lg text-slate-900">Phone</h3>
                <a href="tel:+254713045514" class="mt-1 text-accent font-medium hover:underline">+254 713 045 514</a>
                <p class="mt-1 text-sm text-slate-500">Mon–Fri, 8am–6pm EAT</p>
            </div>
            <div class="p-6 bg-white border border-slate-200">
                <div class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-display text-lg text-slate-900">Email</h3>
                <a href="mailto:support@eticket.co.ke" class="mt-1 text-accent font-medium hover:underline">support@eticket.co.ke</a>
                <p class="mt-1 text-sm text-slate-500">We reply within 24 hours</p>
            </div>
        </div>

        <div class="p-6 bg-white border border-slate-200">
            <div class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="font-display text-lg text-slate-900">Office</h3>
            <p class="mt-2 text-slate-600">Westlands, Nairobi</p>
            <p class="text-sm text-slate-500">Kenya</p>
        </div>

        <div class="p-6 bg-slate-50 border border-slate-200">
            <h3 class="font-display text-lg text-slate-900">Organizer Partnership</h3>
            <p class="mt-2 text-slate-600">Interested in selling tickets for your event? <a href="{{ route('login') }}" class="text-accent font-semibold hover:underline">Sign in</a> to get started.</p>
        </div>
    </div>
</div>
@endsection
