<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0f172a">
    <title>Ticket - {{ $booking->event->title }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'], display: ['DM Serif Display', 'Georgia', 'serif'] }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen min-h-[100dvh] bg-slate-50 flex items-center justify-center p-4 font-sans antialiased" style="padding-top: max(1rem, env(safe-area-inset-top)); padding-bottom: max(1rem, env(safe-area-inset-bottom)); padding-left: max(1rem, env(safe-area-inset-left)); padding-right: max(1rem, env(safe-area-inset-right));">
    <div class="w-full max-w-md">
        <div class="bg-white border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200 bg-slate-50">
                <div class="flex items-center gap-2 mb-2">
                    <span class="font-display text-lg text-slate-900">eTicket</span>
                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">KE</span>
                </div>
                <h1 class="font-display text-xl text-slate-900">{{ $booking->event->title }}</h1>
                <p class="text-slate-500 text-sm mt-1">{{ $booking->event->venue }}</p>
                <p class="text-slate-400 text-xs mt-2">{{ $booking->event->event_date->format('l, F j, Y') }} · {{ $booking->event->event_date->format('g:i A') }}</p>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start gap-6">
                    <div>
                        <p class="text-2xl font-mono font-semibold tracking-widest text-slate-900">{{ $booking->booking_code }}</p>
                        <p class="text-slate-700 mt-2 font-medium">{{ $booking->customer_name }}</p>
                        <p class="text-slate-500 text-sm">{{ $booking->ticketType->name }} × {{ $booking->quantity }}</p>
                        <span class="inline-block mt-3 px-2.5 py-1 text-xs font-semibold {{ in_array($booking->status, ['paid', 'pay_at_venue']) ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $booking->status === 'pay_at_venue' ? 'Pay at entrance' : ucfirst($booking->status) }}
                        </span>
                    </div>
                    <div class="flex-shrink-0 p-3 border border-slate-200">
                        <img src="{{ route('tickets.qr', $booking->booking_code) }}" alt="QR Code" class="w-28 h-28" width="112" height="112">
                    </div>
                </div>
                <p class="text-xs text-slate-500 mt-6 text-center">Present this ticket at the entrance. Staff will scan the QR code to check you in.</p>
            </div>
        </div>
        <p class="text-center text-slate-400 text-xs mt-6">eTicket KE · Save or bookmark this page</p>
    </div>
</body>
</html>
