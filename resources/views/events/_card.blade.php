@php
    $minPrice = $event->ticketTypes->isNotEmpty() ? $event->ticketTypes->min('price') : 0;
    $totalAvail = $event->ticketTypes->sum(fn($t) => $t->quantity - $t->sold);
    $soldOut = $totalAvail <= 0;
    $categoryLabels = ['concert'=>'Concert','conference'=>'Conference','film'=>'Film & Theatre','sports'=>'Sports','festival'=>'Festival','comedy'=>'Comedy','other'=>'Other'];
    $cat = $categoryLabels[$event->category ?? ''] ?? '';
    $paymentLabels = ['immediate'=>'Online only','venue'=>'Pay at gate','both'=>'Online or at gate'];
    $paymentLabel = $paymentLabels[$event->payment_mode ?? 'both'] ?? 'Online or at gate';
@endphp
<a href="{{ route('events.show', $event) }}" class="group block bg-white border border-slate-200 overflow-hidden hover:border-accent/30 hover:shadow-lg transition-all duration-300 rounded-2xl sm:rounded-none">
    <div class="aspect-[4/3] bg-slate-100 flex items-center justify-center relative border-l-4 border-l-accent/40">
        <svg class="w-14 h-14 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        @if($soldOut)
        <span class="absolute top-4 right-4 px-2 py-1 bg-navy-900 text-white text-sm font-semibold uppercase tracking-wider">Sold Out</span>
        @elseif($event->is_featured ?? false)
        <span class="absolute top-4 right-4 px-2 py-1 bg-accent text-white text-sm font-semibold uppercase tracking-wider">Featured</span>
        @endif
    </div>
    <div class="p-4 sm:p-6">
        @if($cat)<p class="text-sm font-medium text-accent uppercase tracking-wider">{{ $cat }}</p>@endif
        <p class="text-sm font-medium text-slate-500 uppercase tracking-wider {{ $cat ? 'mt-1' : '' }}">{{ $event->event_date->format('D, M j, Y') }} · {{ $event->event_date->format('g:i A') }}</p>
        <h2 class="mt-2 font-display text-xl sm:text-2xl text-slate-900 group-hover:text-accent transition line-clamp-2">{{ $event->title }}</h2>
        <p class="mt-1 text-base text-slate-500">{{ $event->venue }}</p>
        <div class="mt-6 pt-4 border-t border-slate-100">
            <div class="flex items-center justify-between">
                @if($soldOut)
                <span class="text-base font-medium text-slate-400">Sold Out</span>
                @elseif($minPrice == 0)
                <span class="text-base font-semibold text-slate-900">Free</span>
                @else
                <span class="text-base font-semibold text-slate-900">{{ config('app.currency_symbol') }} {{ number_format($minPrice) }} <span class="font-normal text-slate-500">from</span></span>
                @endif
                <span class="text-base font-medium text-accent group-hover:underline">Buy Tickets</span>
            </div>
            @if(!$soldOut)
            <p class="mt-2 text-sm text-slate-500"><span class="font-medium text-slate-700">{{ $totalAvail }}</span> tickets left · {{ $paymentLabel }}</p>
            @endif
        </div>
    </div>
</a>
