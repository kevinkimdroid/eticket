@extends('layouts.app')
@section('title', 'eTicketFANS')
@section('meta_description', 'Earn eTicketPoints to redeem for complimentary tickets or merchandise.')
@section('content')
<div class="max-w-3xl">
    <p class="text-xs font-semibold text-accent uppercase tracking-[0.2em] mb-2">eTicketFANS</p>
    <h1 class="font-display text-4xl sm:text-5xl text-slate-900 tracking-tight">Earn points. Redeem rewards.</h1>
    <p class="mt-4 text-lg text-slate-600 leading-relaxed">Join eTicketFANS and earn eTicketPoints on every ticket purchase. Redeem points for complimentary event tickets.</p>

    <div class="mt-14 space-y-12">
        <section class="bg-white border border-slate-200 p-8 rounded-2xl sm:rounded-none">
            <h2 class="font-display text-2xl text-slate-900">How it works</h2>
            <ul class="mt-6 space-y-4 text-slate-600">
                <li class="flex items-start gap-3">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-accent/10 text-accent font-semibold flex items-center justify-center text-sm">1</span>
                    <span><strong class="text-slate-900">Book tickets</strong> — Earn 10 eTicketPoints for every KSh 100 spent on event tickets.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-accent/10 text-accent font-semibold flex items-center justify-center text-sm">2</span>
                    <span><strong class="text-slate-900">Accumulate points</strong> — Points never expire. Build your balance over time.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-accent/10 text-accent font-semibold flex items-center justify-center text-sm">3</span>
                    <span><strong class="text-slate-900">Redeem rewards</strong> — Use points for complimentary event tickets.</span>
                </li>
            </ul>
        </section>

        <section>
            <h2 class="font-display text-2xl text-slate-900">Reward tiers</h2>
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white border border-slate-200 p-6 rounded-2xl sm:rounded-none">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Bronze</p>
                    <p class="mt-2 font-display text-xl text-slate-900">0 – 499 pts</p>
                    <p class="mt-2 text-sm text-slate-600">Earn points on every ticket purchase.</p>
                </div>
                <div class="bg-white border border-accent/30 p-6 rounded-2xl sm:rounded-none border-l-4 border-l-accent">
                    <p class="text-xs font-semibold text-accent uppercase tracking-wider">Silver</p>
                    <p class="mt-2 font-display text-xl text-slate-900">500 – 1,499 pts</p>
                    <p class="mt-2 text-sm text-slate-600">Unlock complimentary tickets to select events.</p>
                </div>
                <div class="bg-white border border-slate-200 p-6 rounded-2xl sm:rounded-none">
                    <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Gold</p>
                    <p class="mt-2 font-display text-xl text-slate-900">1,500+ pts</p>
                    <p class="mt-2 text-sm text-slate-600">VIP perks and early access to select events.</p>
                </div>
            </div>
        </section>

        <section>
            <h2 class="font-display text-2xl text-slate-900">Start earning today</h2>
            <p class="mt-3 text-slate-600 leading-relaxed">Create an account or sign in to track your points. Every ticket you buy brings you closer to free tickets and exclusive merchandise.</p>
            <div class="mt-6 flex flex-wrap gap-4">
                <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-navy-900 text-white font-semibold hover:bg-navy-800 transition rounded">Browse Events</a>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50 transition rounded">Visit Shop</a>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 text-accent font-semibold hover:underline">Sign In</a>
            </div>
        </section>
    </div>
</div>
@endsection
