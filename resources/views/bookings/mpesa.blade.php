@extends('layouts.app')
@section('title', 'M-Pesa Payment')
@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white border border-slate-200 overflow-hidden">
        <div class="p-6 text-center border-b border-slate-200 bg-slate-50">
            <div class="w-14 h-14 rounded-full border border-slate-200 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <h1 class="font-display text-xl text-slate-900">M-Pesa Payment</h1>
            <p class="text-slate-600 mt-2 font-semibold">{{ config('app.currency_symbol') }} {{ number_format($booking->total_amount) }}</p>
            <p class="text-sm text-slate-500 mt-1">You will receive a prompt on your phone</p>
        </div>
        <form id="mpesaForm" class="p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">M-Pesa Number</label>
                <input type="tel" id="phone" class="w-full border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-accent focus:border-accent" placeholder="07XX XXX XXX" value="{{ $booking->customer_phone }}" required>
            </div>
            <button type="submit" class="w-full py-4 bg-navy-900 text-white font-semibold hover:bg-navy-800 transition" id="submitBtn">
                Pay with M-Pesa
            </button>
        </form>
        <div id="status" class="p-6 hidden"></div>
        <div class="p-4 border-t border-slate-200 text-center">
            <a href="{{ route('bookings.payment', $booking) }}" class="text-sm text-slate-500 hover:text-slate-900 transition">← Use different payment method</a>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.getElementById('mpesaForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submitBtn');
    const status = document.getElementById('status');
    btn.disabled = true;
    btn.textContent = 'Sending...';
    status.classList.add('hidden');
    try {
        const res = await fetch('{{ route("mpesa.initiate", $booking) }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify({ phone: document.getElementById('phone').value })
        });
        const data = await res.json();
        status.classList.remove('hidden');
        if (data.success) {
            status.innerHTML = '<p class="text-emerald-600 font-medium">✓ ' + data.message + '</p><p class="text-sm text-slate-500 mt-2">Complete the payment on your phone, then <a href="{{ route("tickets.show", $booking->booking_code) }}" class="text-accent hover:underline">view your ticket</a></p>';
        } else {
            status.innerHTML = '<p class="text-red-600 font-medium">' + (data.message || 'Failed') + '</p>';
            btn.disabled = false;
            btn.textContent = 'Try Again';
        }
    } catch (err) {
        status.classList.remove('hidden');
        status.innerHTML = '<p class="text-red-600 font-medium">Network error. Please try again.</p>';
        btn.disabled = false;
        btn.textContent = 'Pay with M-Pesa';
    }
});
</script>
@endpush
@endsection
