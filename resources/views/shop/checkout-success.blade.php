@extends('layouts.app')
@section('title', 'Order Confirmed')
@section('meta_description', 'Your eTicket KE order has been received.')
@section('content')
<div class="max-w-xl mx-auto text-center py-12">
    <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-6">
        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    </div>
    <h1 class="font-display text-3xl text-slate-900">Order Received</h1>
    <p class="mt-2 text-slate-600">Thank you for your order. Your order code is <strong>{{ $order->order_code }}</strong>.</p>
    <p class="mt-4 text-slate-600">We'll contact you at <strong>{{ $order->customer_phone }}</strong> within 24 hours to confirm payment and arrange delivery.</p>
    <div class="mt-8 p-6 bg-slate-50 border border-slate-200 rounded-lg text-left">
        <h2 class="font-display text-lg text-slate-900 mb-4">Order Summary</h2>
        @foreach($order->items as $item)
        <div class="flex justify-between py-2">
            <span>{{ $item['name'] }} × {{ $item['qty'] }}</span>
            <span>{{ config('app.currency_symbol') }} {{ number_format($item['price'] * $item['qty']) }}</span>
        </div>
        @endforeach
        <div class="flex justify-between font-semibold pt-4 mt-4 border-t border-slate-200">
            <span>Total</span>
            <span>{{ config('app.currency_symbol') }} {{ number_format($order->total) }}</span>
        </div>
    </div>
    <a href="{{ route('shop.index') }}" class="inline-block mt-8 px-6 py-3 bg-navy-900 text-white font-semibold hover:bg-navy-800 transition rounded">Continue Shopping</a>
</div>
@endsection
