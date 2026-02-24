@extends('layouts.app')
@section('title', $product->name)
@section('meta_description', Str::limit($product->description, 160))
@section('content')
<div class="mb-8">
    <a href="{{ route('shop.index') }}" class="text-sm font-medium text-slate-500 hover:text-accent transition">← Back to Shop</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
    <div class="aspect-square bg-slate-100 flex items-center justify-center rounded-2xl sm:rounded-none border-l-4 border-l-accent/40">
        <svg class="w-24 h-24 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
    </div>
    <div>
        <p class="text-xs font-medium text-accent uppercase tracking-wider">{{ $product->category_label }}</p>
        <h1 class="font-display text-3xl sm:text-4xl text-slate-900 mt-2">{{ $product->name }}</h1>
        <p class="mt-4 text-slate-600">{{ $product->description }}</p>
        <div class="mt-8">
            <span class="text-2xl font-semibold text-slate-900">{{ config('app.currency_symbol') }} {{ number_format($product->price) }}</span>
        </div>
        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8 flex gap-4">
            @csrf
            <label class="flex items-center gap-2">
                <span class="text-sm font-medium text-slate-600">Qty</span>
                <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" class="w-20 border border-slate-300 px-3 py-2 text-sm rounded focus:ring-2 focus:ring-accent focus:border-accent">
            </label>
            <button type="submit" class="px-6 py-3 bg-navy-900 text-white text-sm font-semibold hover:bg-navy-800 transition rounded">Add to Cart</button>
        </form>
        <p class="mt-4 text-sm text-slate-500">{{ $product->stock }} in stock</p>
    </div>
</div>
@endsection
