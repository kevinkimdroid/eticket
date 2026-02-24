<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0f172a">
    <title>Sign In - eTicket KE</title>
    <meta name="description" content="Sign in to your eTicket KE organizer dashboard.">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'], display: ['DM Serif Display', 'Georgia', 'serif'] },
                    colors: { navy: { 900: '#0f172a', 800: '#1e293b', 700: '#334155' }, accent: { DEFAULT: '#1e40af', 600: '#2563eb' } }
                }
            }
        }
    </script>
    <style>
        @media (max-width: 640px) { input, select, textarea, button { font-size: 16px !important; } }
        .font-display { font-family: 'DM Serif Display', Georgia, serif; }
    </style>
</head>
<body class="min-h-screen min-h-[100dvh] font-sans antialiased flex">
    {{-- Left panel: branding (hidden on mobile) --}}
    <div class="hidden lg:flex lg:w-1/2 bg-navy-900 flex-col justify-between p-12 xl:p-16">
        <a href="{{ route('events.index') }}" class="flex items-center gap-2">
            <span class="font-display text-2xl text-white">eTicket</span>
            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-[0.2em]">KE</span>
        </a>
        <div>
            <h2 class="font-display text-3xl xl:text-4xl text-white leading-tight">Organizer dashboard</h2>
            <p class="mt-4 text-slate-400 max-w-sm">Manage events, track bookings, and scan tickets — all in one place.</p>
        </div>
        <p class="text-xs text-slate-500">Event ticketing for Kenya</p>
    </div>

    {{-- Right panel: form --}}
    <div class="flex-1 flex flex-col justify-center p-6 sm:p-12 lg:p-16 bg-slate-50">
        <div class="w-full max-w-md mx-auto">
            <a href="{{ route('events.index') }}" class="lg:hidden flex items-center justify-center gap-2 mb-10">
                <span class="font-display text-2xl text-navy-900">eTicket</span>
                <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-[0.2em]">KE</span>
            </a>

            <div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-accent to-accent-600"></div>
                <div class="p-8 sm:p-10">
                    <h1 class="font-display text-2xl sm:text-3xl text-slate-900">Sign in</h1>
                    <p class="text-slate-500 mt-1">Access your organizer dashboard</p>

                    @if($errors->any())
                    <div class="mt-6 p-4 bg-red-50 border border-red-100 rounded-lg flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        <div class="text-sm text-red-700">
                            @foreach($errors->all() as $e) <p>{{ $e }}</p> @endforeach
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('login.attempt') }}" method="POST" class="mt-6 space-y-5">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                            <input type="email" id="email" name="email" required autocomplete="email" value="{{ old('email') }}" class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-accent focus:border-accent transition" placeholder="you@example.com">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                            <input type="password" id="password" name="password" required autocomplete="current-password" class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-accent focus:border-accent transition" placeholder="••••••••">
                        </div>
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-accent focus:ring-accent">
                            <span class="text-sm text-slate-600">Remember me</span>
                        </label>
                        <button type="submit" class="w-full py-3.5 bg-navy-900 text-white text-sm font-semibold rounded-lg hover:bg-navy-800 transition min-h-[52px] flex items-center justify-center">
                            Sign in
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-x-4 gap-y-2 text-sm">
                <a href="{{ route('events.index') }}" class="text-slate-500 hover:text-accent transition">← Back to events</a>
                <span class="text-slate-300 hidden sm:inline">·</span>
                <a href="{{ route('shop.index') }}" class="text-slate-500 hover:text-accent transition">Shop</a>
                <span class="text-slate-300 hidden sm:inline">·</span>
                <a href="{{ route('contact') }}" class="text-slate-500 hover:text-accent transition">Contact</a>
            </div>
        </div>
    </div>
</body>
</html>
