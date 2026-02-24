@extends('layouts.app')
@section('title', 'Cart')
@section('meta_description', 'Your eTicket KE shopping cart.')
@section('content')
<div class="mb-6 sm:mb-12">
    <h1 class="font-display text-3xl sm:text-5xl text-slate-900 tracking-tight">Your Cart</h1>
    <p class="mt-2 text-slate-600">Review and update your items.</p>
</div>

@if(count($items) > 0)
<form action="{{ route('cart.update') }}" method="POST">
    @csrf
    <div class="bg-white border border-slate-200 rounded-2xl sm:rounded-none overflow-hidden">
        <div class="divide-y divide-slate-100">
            @foreach($items as $item)
            <div class="p-4 sm:p-6 flex flex-col sm:flex-row gap-4 sm:items-center">
                <div class="flex-1 flex gap-4">
                    <div class="w-20 h-20 flex-shrink-0 bg-slate-100 rounded flex items-center justify-center">
                        <svg class="w-8 h-8 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <div>
                        <a href="{{ route('shop.show', $item->product) }}" class="font-display text-lg text-slate-900 hover:text-accent">{{ $item->product->name }}</a>
                        <p class="text-sm text-slate-500 mt-1">{{ config('app.currency_symbol') }} {{ number_format($item->product->price) }} each</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2">
                        <span class="text-sm text-slate-600">Qty</span>
                        <input type="number" name="qty[{{ $item->product->id }}]" value="{{ $item->qty }}" min="1" max="{{ $item->product->stock }}" class="w-16 border border-slate-300 px-2 py-1.5 text-sm rounded focus:ring-2 focus:ring-accent">
                    </label>
                    <span class="font-semibold text-slate-900 w-24 text-right">{{ config('app.currency_symbol') }} {{ number_format($item->subtotal) }}</span>
                    <form action="{{ route('cart.remove', $item->product) }}" method="POST" class="inline" onsubmit="return confirm('Remove this item?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">Remove</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="p-4 sm:p-6 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <button type="submit" class="px-4 py-2 bg-slate-200 text-slate-800 text-sm font-medium hover:bg-slate-300 transition rounded">Update Cart</button>
            <div class="flex items-center gap-6">
                <span class="text-lg font-semibold text-slate-900">Total: {{ config('app.currency_symbol') }} {{ number_format($total) }}</span>
                <a href="{{ route('shop.checkout') }}" class="px-6 py-3 bg-navy-900 text-white text-sm font-semibold hover:bg-navy-800 transition rounded">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</form>
@else
<div class="bg-white border border-slate-200 p-16 sm:p-20 text-center rounded-2xl sm:rounded-none">
    <svg class="w-12 h-12 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
    <h3 class="font-display text-2xl text-slate-900">Your cart is empty</h3>
    <p class="mt-2 text-slate-500">Add some merchandise from our shop.</p>
    <a href="{{ route('shop.index') }}" class="inline-block mt-6 px-6 py-3 bg-navy-900 text-white text-sm font-semibold hover:bg-navy-800 transition">Browse Shop</a>
</div>
@endif
@endsection
