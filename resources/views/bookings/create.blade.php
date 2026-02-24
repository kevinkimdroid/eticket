@extends('layouts.app')
@section('title', 'Book Tickets')
@section('content')
<a href="{{ route('events.show', $event) }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-900 mb-10 transition">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    Back to event
</a>

<div class="max-w-lg w-full">
    <div class="bg-white border border-slate-200 overflow-hidden rounded-2xl sm:rounded-none">
        <div class="p-6 border-b border-slate-200 bg-slate-50 border-l-4 border-l-accent">
            <h1 class="font-display text-xl text-slate-900">{{ $event->title }}</h1>
            <p class="mt-1 text-sm text-slate-500">{{ $event->venue }} · {{ $event->event_date->format('M j, Y') }}</p>
        </div>
        <form action="{{ route('bookings.store') }}" method="POST" class="p-6" id="bookingForm">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ticket type</label>
                    <select name="ticket_type_id" required class="w-full border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-accent focus:border-accent" id="ticketType">
                        @foreach($event->ticketTypes as $tt)
                        @if(($tt->quantity - $tt->sold) > 0)
                        <option value="{{ $tt->id }}" data-price="{{ $tt->price }}" data-avail="{{ $tt->quantity - $tt->sold }}">
                            {{ $tt->name }} — {{ config('app.currency_symbol') }} {{ number_format($tt->price) }} ({{ $tt->quantity - $tt->sold }} left)
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Quantity</label>
                    <input type="number" name="quantity" min="1" required class="w-full border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-accent focus:border-accent" placeholder="1" id="quantity" value="{{ old('quantity', 1) }}">
                </div>
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Full name</label>
                        <input type="text" name="customer_name" required class="w-full border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-accent focus:border-accent" value="{{ old('customer_name') }}" placeholder="John Kamau">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="customer_email" required class="w-full border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-accent focus:border-accent" value="{{ old('customer_email') }}" placeholder="john@example.com">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phone <span class="text-slate-400 font-normal">(for M-Pesa)</span></label>
                    <input type="tel" name="customer_phone" class="w-full border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-accent focus:border-accent" value="{{ old('customer_phone') }}" placeholder="07XX XXX XXX">
                </div>
            </div>
            <div class="mt-6 p-4 bg-slate-50 border border-slate-200">
                <p class="text-sm text-slate-600">Total: <span class="font-semibold text-slate-900" id="totalDisplay">{{ config('app.currency_symbol') }} 0</span></p>
            </div>
            <button type="submit" class="mt-6 w-full py-4 bg-navy-900 text-white text-sm font-semibold hover:bg-navy-800 active:bg-navy-700 transition min-h-[52px] rounded-xl sm:rounded-none">
                Continue to payment
            </button>
        </form>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ticketSelect = document.getElementById('ticketType');
    var qtyInput = document.getElementById('quantity');
    var totalDisplay = document.getElementById('totalDisplay');
    function updateTotal() {
        var opt = ticketSelect.options[ticketSelect.selectedIndex];
        var price = parseFloat(opt ? opt.dataset.price : 0) || 0;
        var qty = parseInt(qtyInput.value || 1);
        var max = parseInt(opt ? opt.dataset.avail : 999) || 999;
        if (qty > max) qtyInput.value = max;
        var total = price * (parseInt(qtyInput.value || 1));
        totalDisplay.textContent = '{{ config("app.currency_symbol") }} ' + total.toLocaleString();
    }
    ticketSelect.addEventListener('change', updateTotal);
    qtyInput.addEventListener('input', updateTotal);
    updateTotal();
});
</script>
@endpush
@endsection
