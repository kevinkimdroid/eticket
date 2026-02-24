@extends('layouts.app')
@section('title', 'Frequently Asked Questions')
@section('meta_description', 'FAQ for eTicket KE. Find answers to common questions about booking tickets, payments, and e-tickets.')
@section('content')
<div class="max-w-3xl">
    <p class="text-xs font-semibold text-slate-500 uppercase tracking-[0.2em] mb-2">Help</p>
    <h1 class="font-display text-4xl sm:text-5xl text-slate-900 tracking-tight">Frequently Asked Questions</h1>
    <p class="mt-4 text-lg text-slate-600">Common questions about booking tickets and using eTicket KE.</p>

    <div class="mt-12 space-y-6">
        <div class="p-6 bg-white border border-slate-200">
            <h2 class="font-display text-lg text-slate-900">How do I book tickets?</h2>
            <p class="mt-2 text-slate-600">Select an event, choose your ticket type and quantity, enter your details, and complete payment. You'll receive an e-ticket instantly via email or on the confirmation page.</p>
        </div>

        <div class="p-6 bg-white border border-slate-200">
            <h2 class="font-display text-lg text-slate-900">What payment methods do you accept?</h2>
            <p class="mt-2 text-slate-600">We accept M-Pesa, Visa/Mastercard (via Stripe), and cash at venue for events that allow it. The available options depend on the event organizer's settings.</p>
        </div>

        <div class="p-6 bg-white border border-slate-200">
            <h2 class="font-display text-lg text-slate-900">How do I get my ticket?</h2>
            <p class="mt-2 text-slate-600">After payment, you'll receive an e-ticket with a unique QR code. You can access it anytime from the confirmation page or the link sent to your email. Present the QR code at the event entrance for check-in.</p>
        </div>

        <div class="p-6 bg-white border border-slate-200">
            <h2 class="font-display text-lg text-slate-900">Can I get a refund?</h2>
            <p class="mt-2 text-slate-600">Refund policies are set by each event organizer. Please contact the organizer directly for refund requests. You can usually find their contact details on the event page.</p>
        </div>

        <div class="p-6 bg-white border border-slate-200">
            <h2 class="font-display text-lg text-slate-900">I want to sell tickets for my event. How do I start?</h2>
            <p class="mt-2 text-slate-600">Create an account and <a href="{{ route('login') }}" class="text-accent font-semibold hover:underline">login</a> to access the organizer dashboard. From there you can create events, set ticket types and prices, and manage bookings.</p>
        </div>

        <div class="p-6 bg-white border border-slate-200">
            <h2 class="font-display text-lg text-slate-900">Is my payment secure?</h2>
            <p class="mt-2 text-slate-600">Yes. Payments are processed through secure providers (M-Pesa, Stripe). We do not store full card details. All transactions use industry-standard encryption.</p>
        </div>
    </div>
</div>
@endsection
