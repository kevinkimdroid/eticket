@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('meta_description', 'Privacy Policy for eTicket KE. Learn how we collect, use, and protect your personal information.')
@section('content')
<div class="max-w-3xl">
    <p class="text-xs font-semibold text-slate-500 uppercase tracking-[0.2em] mb-2">Legal</p>
    <h1 class="font-display text-4xl sm:text-5xl text-slate-900 tracking-tight">Privacy Policy</h1>
    <p class="mt-2 text-slate-500 text-sm">Last updated: {{ now()->format('F j, Y') }}</p>

    <div class="mt-12 space-y-8 text-slate-600 leading-relaxed">
        <section>
            <h2 class="text-lg font-bold text-slate-900">1. Information We Collect</h2>
            <p class="mt-2">When you book tickets or create an account, we collect information such as your name, email address, phone number, and payment details. This information is necessary to process your bookings and provide e-tickets.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">2. How We Use Your Information</h2>
            <p class="mt-2">We use your information to process ticket purchases, send e-tickets and confirmation emails, facilitate check-in at events, and communicate with you about your bookings. We may also use aggregated data to improve our platform.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">3. Payment Information</h2>
            <p class="mt-2">Payment processing is handled by secure third-party providers (M-Pesa, Stripe). We do not store full card numbers. Payment data is transmitted securely and processed in accordance with industry standards.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">4. Sharing with Event Organizers</h2>
            <p class="mt-2">When you book tickets for an event, we share your name, email, and contact details with the event organizer so they can manage their event and communicate with attendees.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">5. Data Security</h2>
            <p class="mt-2">We implement appropriate security measures to protect your personal information against unauthorized access, alteration, or disclosure.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">6. Your Rights</h2>
            <p class="mt-2">You may request access to, correction of, or deletion of your personal data. Contact us at <a href="mailto:support@eticket.co.ke" class="text-accent font-medium hover:underline">support@eticket.co.ke</a> for such requests.</p>
        </section>

        <section>
            <h2 class="text-lg font-bold text-slate-900">7. Contact</h2>
            <p class="mt-2">For privacy-related questions, please <a href="{{ route('contact') }}" class="text-accent font-medium hover:underline">contact us</a>.</p>
        </section>
    </div>
</div>
@endsection
