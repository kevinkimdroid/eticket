@extends('layouts.app')
@section('title', 'Terms of Service')
@section('meta_description', 'Terms of Service for eTicket KE. Read our terms and conditions for using our event ticketing platform.')
@section('content')
<div class="max-w-3xl">
    <p class="text-xs font-semibold text-slate-500 uppercase tracking-[0.2em] mb-2">Legal</p>
    <h1 class="font-display text-4xl sm:text-5xl text-slate-900 tracking-tight">Terms of Service</h1>
    <p class="mt-2 text-slate-500 text-sm">Last updated: {{ now()->format('F j, Y') }}</p>

    <div class="mt-12 space-y-8 text-slate-600 leading-relaxed">
        <section>
            <h2 class="text-lg font-bold text-slate-900">1. Acceptance of Terms</h2>
            <p class="mt-2">By accessing or using eTicket KE ("the Platform"), you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">2. Use of the Platform</h2>
            <p class="mt-2">eTicket KE provides an event ticketing platform that allows organizers to list events and sell tickets, and attendees to purchase tickets. You agree to use the Platform only for lawful purposes and in accordance with these terms.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">3. Payments and Refunds</h2>
            <p class="mt-2">Payments are processed through M-Pesa, Stripe, or cash at venue as specified by the event organizer. Refund policies are determined by each event organizer. Please contact the organizer directly for refund requests.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">4. Tickets</h2>
            <p class="mt-2">Tickets purchased through eTicket KE are valid only for the specified event. Tickets are non-transferable unless otherwise stated by the organizer. Lost or stolen tickets should be reported to the event organizer.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">5. Organizer Responsibilities</h2>
            <p class="mt-2">Event organizers are responsible for the accuracy of event information, fulfillment of events, and handling of attendee inquiries. eTicket KE acts as a platform facilitating the sale of tickets between organizers and attendees.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">6. Limitation of Liability</h2>
            <p class="mt-2">eTicket KE is not liable for events cancelled by organizers, changes to event details, or any disputes between organizers and attendees. Our liability is limited to the amount paid for the ticket in question.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">7. Contact</h2>
            <p class="mt-2">For questions about these terms, please <a href="{{ route('contact') }}" class="text-accent font-medium hover:underline">contact us</a>.</p>
        </section>
    </div>
</div>
@endsection
