@extends('layouts.app')
@section('title', 'Checkout')
@section('meta_description', 'Complete your eTicket KE merchandise order.')
@section('content')
<div class="mb-6 sm:mb-12">
    <h1 class="font-display text-3xl sm:text-5xl text-slate-900 tracking-tight">Checkout</h1>
    <p class="mt-2 text-slate-600">Confirm your order and delivery details.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
    <div>
        <h2 class="font-display text-xl text-slate-900 mb-4">Order Summary</h2>
        <div class="bg-white border border-slate-200 rounded-lg divide-y divide-slate-100">
            @foreach($items as $item)
            <div class="p-4 flex justify-between items-center">
                <div>
                    <p class="font-medium text-slate-900">{{ $item->product->name }}</p>
                    <p class="text-sm text-slate-500">{{ $item->qty }} × {{ config('app.currency_symbol') }} {{ number_format($item->product->price) }}</p>
                </div>
                <span class="font-semibold text-slate-900">{{ config('app.currency_symbol') }} {{ number_format($item->subtotal) }}</span>
            </div>
            @endforeach
        </div>
        <div class="mt-4 flex justify-between items-center text-lg font-semibold">
            <span>Total</span>
            <span>{{ config('app.currency_symbol') }} {{ number_format($total) }}</span>
        </div>
    </div>

    <div>
        <h2 class="font-display text-xl text-slate-900 mb-4">Delivery Details</h2>
        <form action="{{ route('shop.checkout.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="customer_name" class="block text-sm font-medium text-slate-700 mb-1">Full name</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required class="w-full border border-slate-300 px-4 py-2.5 rounded focus:ring-2 focus:ring-accent focus:border-accent">
                @error('customer_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="customer_phone" class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" required placeholder="e.g. 0712 345 678" class="w-full border border-slate-300 px-4 py-2.5 rounded focus:ring-2 focus:ring-accent focus:border-accent">
                @error('customer_phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="customer_email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" required class="w-full border border-slate-300 px-4 py-2.5 rounded focus:ring-2 focus:ring-accent focus:border-accent">
                @error('customer_email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="delivery_address" class="block text-sm font-medium text-slate-700 mb-1">Delivery address</label>
                <textarea name="delivery_address" id="delivery_address" rows="3" required class="w-full border border-slate-300 px-4 py-2.5 rounded focus:ring-2 focus:ring-accent focus:border-accent">{{ old('delivery_address') }}</textarea>
                <p class="mt-1 text-sm text-slate-500">Include area, building, and any landmarks.</p>
                @error('delivery_address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="notes" class="block text-sm font-medium text-slate-700 mb-1">Notes (optional)</label>
                <textarea name="notes" id="notes" rows="2" class="w-full border border-slate-300 px-4 py-2.5 rounded focus:ring-2 focus:ring-accent focus:border-accent">{{ old('notes') }}</textarea>
            </div>
            <p class="text-sm text-slate-600">We'll contact you within 24 hours to confirm payment (M-Pesa or bank transfer) and arrange delivery.</p>
            <button type="submit" class="w-full px-6 py-4 bg-navy-900 text-white font-semibold hover:bg-navy-800 transition rounded">Place Order</button>
        </form>
    </div>
</div>
@endsection
