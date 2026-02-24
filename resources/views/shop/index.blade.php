@extends('layouts.app')
@section('title', 'Shop')
@section('meta_description', 'eTicket KE merchandise, apparel and collectibles. Event-branded gear.')
@section('content')
<div class="mb-6 sm:mb-12">
    <p class="text-sm font-semibold text-accent uppercase tracking-[0.2em] mb-2">Shop</p>
    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl text-slate-900 tracking-tight">Merchandise</h1>
    <p class="mt-3 sm:mt-4 text-lg sm:text-xl text-slate-600 max-w-2xl leading-relaxed">Event apparel, accessories and collectibles. All prices in Kenyan Shillings (KSh).</p>
</div>

<form method="GET" action="{{ route('shop.index') }}" class="mb-8 flex flex-col sm:flex-row gap-3">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." class="flex-1 border border-slate-300 px-4 py-3 text-base focus:ring-2 focus:ring-accent focus:border-accent rounded-lg sm:rounded-none">
    <select name="category" class="border border-slate-300 px-4 py-3 text-base focus:ring-2 focus:ring-accent focus:border-accent rounded-lg sm:rounded-none bg-white">
        <option value="">All categories</option>
        @foreach(\App\Models\Product::CATEGORIES as $key => $label)
        <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    <button type="submit" class="px-4 py-3 bg-navy-900 text-white text-base font-medium hover:bg-navy-800 transition rounded-lg sm:rounded-none">Filter</button>
</form>

@if($products->count() > 0)
<p class="text-base font-medium text-slate-500 mb-6">{{ $products->count() }} {{ Str::plural('product', $products->count()) }}</p>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 -mx-4 sm:mx-0 px-4 sm:px-0">
    @foreach($products as $product)
    <a href="{{ route('shop.show', $product) }}" class="group block bg-white border border-slate-200 overflow-hidden hover:border-accent/30 hover:shadow-lg transition-all duration-300 rounded-2xl sm:rounded-none">
        <div class="aspect-square bg-slate-100 flex items-center justify-center border-l-4 border-l-accent/40">
            <svg class="w-16 h-16 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        </div>
        <div class="p-4 sm:p-6">
            <p class="text-sm font-medium text-accent uppercase tracking-wider">{{ $product->category_label }}</p>
            <h2 class="mt-2 font-display text-xl sm:text-2xl text-slate-900 group-hover:text-accent transition line-clamp-2">{{ $product->name }}</h2>
            <p class="mt-1 text-base text-slate-500 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-base font-semibold text-slate-900">{{ config('app.currency_symbol') }} {{ number_format($product->price) }}</span>
                <span class="text-base font-medium text-accent group-hover:underline">View</span>
            </div>
        </div>
    </a>
    @endforeach
</div>
@else
<div class="bg-white border border-slate-200 p-16 sm:p-20 text-center rounded-2xl sm:rounded-none">
    <svg class="w-12 h-12 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
    <h3 class="font-display text-2xl sm:text-3xl text-slate-900">No products found</h3>
    <p class="mt-2 text-base text-slate-500">Try adjusting your search or check back later.</p>
    <a href="{{ route('shop.index') }}" class="inline-block mt-6 px-6 py-3 bg-navy-900 text-white text-base font-semibold hover:bg-navy-800 transition">View all</a>
</div>
@endif
@endsection
