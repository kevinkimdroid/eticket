<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#1e293b">
    <title>@yield('title', 'Admin') - eTicket KE</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca' },
                        accent: { 500: '#10b981', 600: '#059669' }
                    }
                }
            }
        }
    </script>
    @stack('styles')
    <style>
        @media (max-width: 640px) {
            input, select, textarea, button { font-size: 16px !important; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen min-h-[100dvh]">
    <nav class="bg-slate-800 text-white shadow-lg" style="padding-top: env(safe-area-inset-top, 0);">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-bold text-white">
                <span class="bg-gradient-to-r from-indigo-400 to-emerald-400 bg-clip-text text-transparent">eTicket</span>
                <span class="text-xs font-medium text-slate-300 bg-slate-700/50 px-2 py-0.5 rounded">Admin</span>
            </a>
            <a href="{{ route('events.index') }}" class="hidden sm:inline-flex items-center gap-2 px-3 py-2 text-sm text-slate-300 hover:text-white hover:bg-white/10 rounded-lg transition">View Site →</a>
            <button type="button" id="adminNavToggle" class="lg:hidden p-2 -mr-2 rounded-lg hover:bg-white/10 min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="Menu" aria-expanded="false">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div id="adminNavLinks" class="hidden lg:flex items-center gap-1 xl:gap-2">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 hover:bg-white/10 rounded-lg min-h-[44px] flex items-center gap-2 transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : '' }}">Dashboard</a>
                <a href="{{ route('admin.events.index') }}" class="px-3 py-2 hover:bg-white/10 rounded-lg min-h-[44px] flex items-center gap-2 transition {{ request()->routeIs('admin.events.*') ? 'bg-white/10' : '' }}">Events</a>
                <a href="{{ route('admin.bookings.index') }}" class="px-3 py-2 hover:bg-white/10 rounded-lg min-h-[44px] flex items-center gap-2 transition {{ request()->routeIs('admin.bookings.*') ? 'bg-white/10' : '' }}">Bookings</a>
                <a href="{{ route('admin.bookings.export') }}" class="px-3 py-2 hover:bg-white/10 rounded-lg min-h-[44px] flex items-center text-sm transition">Export</a>
                <a href="{{ route('admin.scan') }}" class="px-3 py-2 hover:bg-white/10 rounded-lg min-h-[44px] flex items-center gap-2 transition {{ request()->routeIs('admin.scan') ? 'bg-white/10' : '' }}">Scan</a>
                @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="px-3 py-2 hover:bg-white/10 rounded-lg min-h-[44px] flex items-center gap-2 transition {{ request()->routeIs('admin.users.*') ? 'bg-white/10' : '' }}">Users</a>
                @endif
                @endauth
                <form action="{{ route('logout') }}" method="POST" class="inline ml-2">
                    @csrf
                    <button type="submit" class="px-3 py-2 hover:bg-red-500/20 hover:text-red-300 rounded-lg min-h-[44px] flex items-center transition">Logout</button>
                </form>
            </div>
        </div>
        <div id="adminNavMobile" class="lg:hidden hidden border-t border-slate-700 px-4 py-3" style="padding-bottom: calc(0.75rem + env(safe-area-inset-bottom, 0));">
            <a href="{{ route('events.index') }}" class="block py-3 hover:text-indigo-300 border-b border-slate-700">View Site →</a>
            <a href="{{ route('admin.dashboard') }}" class="block py-3 hover:text-indigo-300 border-b border-slate-700">Dashboard</a>
            <a href="{{ route('admin.events.index') }}" class="block py-3 hover:text-indigo-300 border-b border-slate-700">Events</a>
            <a href="{{ route('admin.bookings.index') }}" class="block py-3 hover:text-indigo-300 border-b border-slate-700">Bookings</a>
            <a href="{{ route('admin.bookings.export') }}" class="block py-3 hover:text-indigo-300 border-b border-slate-700">Export CSV</a>
            <a href="{{ route('admin.scan') }}" class="block py-3 hover:text-indigo-300 border-b border-slate-700">Scan Ticket</a>
            @auth
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.users.index') }}" class="block py-3 hover:text-indigo-300 border-b border-slate-700">Users</a>
            @endif
            @endauth
            <form action="{{ route('logout') }}" method="POST" class="pt-3">
                @csrf
                <button type="submit" class="text-red-300 hover:text-red-200 font-medium">Logout</button>
            </form>
        </div>
    </nav>
    <main class="max-w-6xl mx-auto px-4 py-6 sm:py-8" style="padding-left: max(1rem, env(safe-area-inset-left)); padding-right: max(1rem, env(safe-area-inset-right)); padding-bottom: calc(2rem + env(safe-area-inset-bottom, 0));">
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
    @stack('scripts')
    <script>
        (function() {
            var t = document.getElementById('adminNavToggle');
            var m = document.getElementById('adminNavMobile');
            if (t && m) {
                t.addEventListener('click', function() {
                    var isHidden = m.classList.toggle('hidden');
                    t.setAttribute('aria-expanded', isHidden ? 'false' : 'true');
                });
            }
        })();
    </script>
</body>
</html>
