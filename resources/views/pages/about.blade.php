@extends('layouts.app')
@section('title', 'About Us')
@section('meta_description', 'eTicket KE is Kenya\'s event ticketing platform. We help organizers sell tickets and attendees book events with M-Pesa, card or cash.')
@section('content')
<div class="max-w-3xl">
    <p class="text-sm font-semibold text-slate-500 uppercase tracking-[0.2em] mb-2">About</p>
    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl text-slate-900 tracking-tight">Event ticketing for Kenya</h1>
    <p class="mt-4 text-xl text-slate-600 leading-relaxed">eTicket KE helps event organizers sell tickets and attendees book events across Kenya. Concerts, conferences, festivals — we handle the ticketing so you can focus on the experience.</p>

    <div class="mt-14 space-y-12">
        <section>
            <h2 class="font-display text-2xl sm:text-3xl text-slate-900">What We Do</h2>
            <p class="mt-3 text-lg text-slate-600 leading-relaxed">We provide a secure platform for selling and buying event tickets. Organizers list their events; attendees book online and pay with M-Pesa, card, or cash at venue. E-tickets are delivered instantly with QR codes for check-in.</p>
        </section>

        <section>
            <h2 class="font-display text-2xl sm:text-3xl text-slate-900">How It Works</h2>
            <ul class="mt-4 space-y-2 text-lg text-slate-600">
                <li class="flex items-start gap-2"><span class="text-accent mt-1">•</span> E-tickets with QR codes for fast check-in</li>
                <li class="flex items-start gap-2"><span class="text-accent mt-1">•</span> M-Pesa for mobile payments</li>
                <li class="flex items-start gap-2"><span class="text-accent mt-1">•</span> Card payments via Stripe</li>
                <li class="flex items-start gap-2"><span class="text-accent mt-1">•</span> Cash at venue where supported</li>
                <li class="flex items-start gap-2"><span class="text-accent mt-1">•</span> Organizer dashboard for events and bookings</li>
            </ul>
        </section>

        <section>
            <h2 class="font-display text-2xl sm:text-3xl text-slate-900">Our Location</h2>
            <p class="mt-3 text-lg text-slate-600 leading-relaxed">We operate from Nairobi and serve events across Kenya. For support or partnership inquiries, visit our <a href="{{ route('contact') }}" class="text-accent font-medium hover:underline">contact page</a>.</p>
        </section>
    </div>

    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 mt-14 px-8 py-4 bg-navy-900 text-white text-lg font-semibold hover:bg-navy-800 transition">
        Browse Events
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>
</div>
@endsection
