@extends('layouts.admin')
@section('title', 'Bookings')
@section('content')
<h1 class="text-2xl font-bold mb-6">Bookings</h1>
<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50">
            <tr>
                <th class="text-left p-3">Code</th>
                <th class="text-left p-3">Customer</th>
                <th class="text-left p-3">Event</th>
                <th class="text-left p-3">Amount</th>
                <th class="text-left p-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $b)
            <tr class="border-t">
                <td class="p-3 font-mono">{{ $b->booking_code }}</td>
                <td class="p-3">{{ $b->customer_name }}</td>
                <td class="p-3">{{ $b->event->title }}</td>
                <td class="p-3">{{ config('app.currency_symbol') }} {{ number_format($b->total_amount) }}</td>
                <td class="p-3">
                    <span class="px-2 py-0.5 rounded text-sm {{ $b->checked_in_at ? 'bg-indigo-100' : (in_array($b->status, ['paid','pay_at_venue']) ? 'bg-green-100' : 'bg-amber-100') }}">
                        {{ $b->checked_in_at ? 'Checked in' : ($b->status === 'pay_at_venue' ? 'Pay at venue' : $b->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-6 text-slate-500 text-center">No bookings</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $bookings->links() }}
@endsection
