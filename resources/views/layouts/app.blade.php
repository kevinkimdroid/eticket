<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, maximum-scale=5, user-scalable=yes">
    <meta name="theme-color" content="#0f172a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>@yield('title', 'Events') - eTicket KE | Premium Event Ticketing</title>
    <meta name="description" content="@yield('meta_description', 'Book event tickets in Kenya. Pay with M-Pesa, card or cash. Instant e-tickets with QR codes for concerts, conferences & festivals.')">
    <meta name="keywords" content="event tickets Kenya, M-Pesa tickets, book events Nairobi, concert tickets Kenya, e-tickets">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta property="og:title" content="@yield('og_title', 'eTicket KE - Premium Event Ticketing')">
    <meta property="og:description" content="@yield('og_description', 'Book tickets for concerts, conferences & festivals. Pay with M-Pesa or card. Instant e-tickets.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_KE">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title') - eTicket KE">
    @stack('meta')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['DM Serif Display', 'Georgia', 'serif']
                    },
                    colors: {
                        navy: { 900: '#0f172a', 800: '#1e293b', 700: '#334155' },
                        accent: { DEFAULT: '#1e40af', 600: '#2563eb', 700: '#1d4ed8' }
                    }
                }
            }
        }
    </script>
    @stack('styles')
    <style>
        @media (max-width: 640px) {
            input, select, textarea, button { font-size: 16px !important; }
            * { -webkit-tap-highlight-color: transparent; }
        }
        .safe-bottom { padding-bottom: env(safe-area-inset-bottom, 0); }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .font-display { font-family: 'DM Serif Display', Georgia, serif; }
        @media (max-width: 640px) {
            main { padding-bottom: calc(5rem + env(safe-area-inset-bottom, 0)) !important; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen min-h-[100dvh] flex flex-col overflow-x-hidden font-sans antialiased">
    <nav class="bg-navy-900 sticky top-0 z-50 border-b border-accent/20" style="padding-top: env(safe-area-inset-top, 0);">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16 sm:h-18">
                <a href="{{ route('events.index') }}" class="flex items-center gap-2 min-h-[44px]">
                    <span class="font-display text-xl text-white tracking-tight">eTicket</span>
                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-[0.2em]">KE</span>
                </a>
                <div class="flex items-center gap-1">
                    <button type="button" id="navToggle" class="sm:hidden p-2 -mr-2 text-slate-400 hover:text-white min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="Menu" aria-expanded="false">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div id="navLinks" class="hidden sm:flex items-center gap-1">
                        <a href="{{ route('events.index') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition {{ request()->routeIs('events.index') || request()->routeIs('events.show') ? 'text-white' : '' }}">Events</a>
                        <a href="{{ route('events.calendar') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition {{ request()->routeIs('events.calendar') ? 'text-white' : '' }}">Calendar</a>
                        <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition {{ request()->routeIs('about') ? 'text-white' : '' }}">About</a>
                        <a href="{{ route('faq') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition {{ request()->routeIs('faq') ? 'text-white' : '' }}">FAQ</a>
                        <a href="{{ route('contact') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition {{ request()->routeIs('contact') ? 'text-white' : '' }}">Contact</a>
                        <a href="{{ route('shop.index') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition {{ request()->routeIs('shop.*') ? 'text-white' : '' }}">Shop</a>
                        <a href="{{ route('fans') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition {{ request()->routeIs('fans') ? 'text-white' : '' }}">eTicketFANS</a>
                        <a href="{{ route('shop.cart') }}" class="relative px-4 py-2 text-slate-300 hover:text-white transition" title="Cart">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            @if(($cartCount = count(session('cart', []))) > 0)
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-accent text-white text-[10px] font-bold rounded-full flex items-center justify-center">{{ $cartCount }}</span>
                            @endif
                        </a>
                        @auth
                        @if(auth()->user()->canAccessDashboard())
                        <a href="{{ route('admin.dashboard') }}" class="ml-2 px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-accent hover:bg-accent-600 transition">Logout</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="ml-2 px-5 py-2 text-sm font-semibold text-white bg-accent hover:bg-accent-600 transition">Sign In</a>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="ml-2 px-5 py-2 text-sm font-semibold text-white bg-accent hover:bg-accent-600 transition">Sign In</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div id="navMobile" class="sm:hidden hidden border-t border-white/10 bg-navy-800 px-4 py-4" style="padding-bottom: calc(1rem + env(safe-area-inset-bottom, 0));">
            <a href="{{ route('events.index') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">Events</a>
            <a href="{{ route('events.calendar') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">Calendar</a>
            <a href="{{ route('about') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">About</a>
            <a href="{{ route('faq') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">FAQ</a>
            <a href="{{ route('contact') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">Contact</a>
            <a href="{{ route('shop.index') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">Shop</a>
            <a href="{{ route('shop.cart') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">Cart @php $cartCount = count(session('cart', [])); @endphp @if($cartCount > 0)<span class="text-accent">({{ $cartCount }})</span>@endif</a>
            <a href="{{ route('fans') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">eTicketFANS</a>
            @auth
            @if(auth()->user()->canAccessDashboard())
            <a href="{{ route('admin.dashboard') }}" class="block py-3 text-slate-300 font-medium border-b border-white/5">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="w-full py-3 text-center font-semibold text-white bg-accent rounded">Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block mt-3 py-3 text-center font-semibold text-white bg-accent rounded">Sign In</a>
            @endif
            @else
            <a href="{{ route('login') }}" class="block mt-3 py-3 text-center font-semibold text-white bg-accent rounded">Sign In</a>
            @endauth
        </div>
    </nav>
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 py-6 sm:py-14 safe-bottom" style="padding-left: max(1rem, env(safe-area-inset-left)); padding-right: max(1rem, env(safe-area-inset-right));">
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg flex items-center gap-3 text-sm">
                <svg class="w-5 h-5 flex-shrink-0 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg flex items-center gap-3 text-sm">
                <svg class="w-5 h-5 flex-shrink-0 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                <p class="font-semibold mb-2">Please fix the following:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
    <footer class="bg-navy-900 text-slate-400 mt-auto hidden sm:block" style="padding-bottom: env(safe-area-inset-bottom, 0);">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-14" style="padding-left: max(1rem, env(safe-area-inset-left)); padding-right: max(1rem, env(safe-area-inset-right));">
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-10">
                <div class="col-span-2 sm:col-span-4 lg:col-span-2">
                    <span class="font-display text-lg text-white">eTicket</span>
                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider ml-1">KE</span>
                    <p class="mt-3 text-sm text-slate-500 max-w-xs leading-relaxed">Event ticketing for Kenya. Secure checkout. Instant e-tickets. M-Pesa, card, and cash.</p>
                    <div class="mt-6">
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Newsletter</h3>
                        <p class="text-sm text-slate-500 mb-3">Subscribe for updates on events and offers.</p>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="email" name="email" placeholder="Your email" required class="flex-1 min-w-0 px-3 py-2 text-sm bg-white/10 border border-white/20 text-white placeholder-slate-500 rounded focus:ring-2 focus:ring-accent focus:border-accent">
                            <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-accent hover:bg-accent-600 transition rounded">Subscribe</button>
                        </form>
                    </div>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-4">Platform</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('events.index') }}" class="hover:text-accent-600 transition">Events</a></li>
                        <li><a href="{{ route('events.calendar') }}" class="hover:text-accent-600 transition">Calendar</a></li>
                        <li><a href="{{ route('shop.index') }}" class="hover:text-accent-600 transition">Shop</a></li>
                        <li><a href="{{ route('fans') }}" class="hover:text-accent-600 transition">eTicketFANS</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-accent-600 transition">About</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-accent-600 transition">FAQ</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-accent-600 transition">Organizer Login</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-4">Support</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('contact') }}" class="hover:text-accent-600 transition">Contact</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-accent-600 transition">Terms</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-accent-600 transition">Privacy</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-4">Payments</h3>
                    <p class="text-sm">M-Pesa · Card · Cash</p>
                </div>
            </div>
            <div class="mt-14 pt-8 border-t border-white/10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-xs text-slate-500">&copy; {{ date('Y') }} eTicket KE. All rights reserved.</p>
                <p class="text-xs text-slate-500">Secure ticketing platform</p>
            </div>
        </div>
    </footer>
    {{-- Mobile bottom nav (app-like) --}}
    <nav class="sm:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-t border-slate-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]" style="padding-bottom: env(safe-area-inset-bottom, 0);">
        <div class="flex items-center justify-around h-16">
            <a href="{{ route('events.index') }}" class="flex flex-col items-center justify-center flex-1 min-h-[48px] py-2 {{ request()->routeIs('events.index') || request()->routeIs('events.show') ? 'text-accent' : 'text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="text-xs font-medium mt-1">Events</span>
            </a>
            <a href="{{ route('events.calendar') }}" class="flex flex-col items-center justify-center flex-1 min-h-[48px] py-2 {{ request()->routeIs('events.calendar') ? 'text-accent' : 'text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <span class="text-xs font-medium mt-1">Calendar</span>
            </a>
            <a href="{{ route('shop.index') }}" class="flex flex-col items-center justify-center flex-1 min-h-[48px] py-2 {{ request()->routeIs('shop.*') ? 'text-accent' : 'text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span class="text-xs font-medium mt-1">Shop</span>
            </a>
            <a href="{{ route('about') }}" class="flex flex-col items-center justify-center flex-1 min-h-[48px] py-2 {{ request()->routeIs('about') ? 'text-accent' : 'text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-xs font-medium mt-1">About</span>
            </a>
            <a href="{{ route('contact') }}" class="flex flex-col items-center justify-center flex-1 min-h-[48px] py-2 {{ request()->routeIs('contact') ? 'text-accent' : 'text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="text-xs font-medium mt-1">Contact</span>
            </a>
            @auth
            @if(auth()->user()->canAccessDashboard())
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center flex-1 min-h-[48px] py-2 {{ request()->routeIs('admin.*') ? 'text-accent' : 'text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                <span class="text-xs font-medium mt-1">Dashboard</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="flex flex-col items-center justify-center flex-1 min-h-[48px] py-2 {{ request()->routeIs('login') ? 'text-accent' : 'text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span class="text-xs font-medium mt-1">Sign In</span>
            </a>
            @endif
            @else
            <a href="{{ route('login') }}" class="flex flex-col items-center justify-center flex-1 min-h-[48px] py-2 {{ request()->routeIs('login') ? 'text-accent' : 'text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span class="text-xs font-medium mt-1">Sign In</span>
            </a>
            @endauth
        </div>
    </nav>
    @stack('scripts')
    <script>
        (function() {
            var t = document.getElementById('navToggle');
            var m = document.getElementById('navMobile');
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
