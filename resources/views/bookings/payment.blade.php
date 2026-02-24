@extends('layouts.app')
@section('title', 'Complete Payment')
@section('content')
<div class="max-w-md w-full mx-auto">
    <div class="bg-white border border-slate-200 overflow-hidden rounded-2xl sm:rounded-none">
        <div class="p-6 border-b border-slate-200 bg-slate-50 border-l-4 border-l-accent">
            <h1 class="font-display text-xl text-slate-900">Complete payment</h1>
            <div class="mt-4 p-4 bg-white border border-slate-200">
                <p class="font-medium text-slate-900 break-words">{{ $booking->event->title }}</p>
                <p class="text-sm text-slate-500 mt-1">{{ $booking->ticketType->name }} × {{ $booking->quantity }}</p>
                <p class="text-2xl font-semibold text-slate-900 mt-3">{{ config('app.currency_symbol') }} {{ number_format($booking->total_amount) }}</p>
                <p class="text-xs text-slate-500 mt-2">Order: <span class="font-mono">{{ $booking->booking_code }}</span></p>
            </div>
        </div>
        <form action="{{ route('bookings.pay', $booking) }}" method="POST" class="p-6">
            @csrf
            @php $mode = $booking->event->payment_mode ?? 'both'; $hasOnline = config('services.stripe.key') || config('services.mpesa.consumer_key'); @endphp
            <p class="text-sm text-slate-600 mb-4">Choose how to pay:</p>
            <div class="space-y-2">
                @if(in_array($mode, ['both', 'immediate']) && config('services.mpesa.consumer_key'))
                <label class="flex items-center gap-4 p-4 border border-slate-200 rounded-lg cursor-pointer hover:border-slate-300 transition has-[:checked]:border-accent has-[:checked]:bg-accent/5">
                    <input type="radio" name="payment" value="mpesa" class="w-4 h-4 text-accent" {{ $hasOnline ? 'checked' : '' }}>
                    <div class="flex-1">
                        <span class="font-medium text-slate-900">M-Pesa (online)</span>
                        <p class="text-sm text-slate-500">Pay now with your phone</p>
                    </div>
                </label>
                @endif
                @if(in_array($mode, ['both', 'immediate']) && config('services.stripe.key'))
                <label class="flex items-center gap-4 p-4 border border-slate-200 rounded-lg cursor-pointer hover:border-slate-300 transition has-[:checked]:border-accent has-[:checked]:bg-accent/5">
                    <input type="radio" name="payment" value="stripe" class="w-4 h-4 text-accent" {{ !config('services.mpesa.consumer_key') ? 'checked' : '' }}>
                    <div class="flex-1">
                        <span class="font-medium text-slate-900">Card (online)</span>
                        <p class="text-sm text-slate-500">Visa, Mastercard — pay now</p>
                    </div>
                </label>
                @endif
                @if($mode === 'both')
                <label class="flex items-center gap-4 p-4 border border-slate-200 rounded-lg cursor-pointer hover:border-slate-300 transition has-[:checked]:border-accent has-[:checked]:bg-accent/5">
                    <input type="radio" name="payment" value="cash" class="w-4 h-4 text-accent" {{ !$hasOnline ? 'checked' : '' }}>
                    <div class="flex-1">
                        <span class="font-medium text-slate-900">Pay at gate</span>
                        <p class="text-sm text-slate-500">Cash or M-Pesa on event day</p>
                    </div>
                </label>
                @endif
            </div>
            @if(!config('services.stripe.key') && !config('services.mpesa.consumer_key'))
            <p class="text-xs text-amber-600 mt-3">Configure Stripe or M-Pesa in .env for online payments.</p>
            @endif
            <button type="submit" class="w-full mt-6 py-4 bg-navy-900 text-white text-base font-semibold hover:bg-navy-800 active:bg-navy-700 transition min-h-[52px] rounded-xl sm:rounded-none">
                Complete purchase
            </button>
        </form>
    </div>
</div>
@endsection
