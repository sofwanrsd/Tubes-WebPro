@php
    $cartCount = is_array(session('cart')) ? count(session('cart')) : 0;

    $isHome    = request()->routeIs('home');
    $isCatalog = request()->routeIs('catalog.*');
    $isCart    = request()->routeIs('cart.*') || request()->routeIs('checkout.*') || request()->routeIs('payment.*');

    // Pill style (Dark Wine Theme: #5C0F14 bg, #F8F8F8 text, #E6B65C hover/active)
    $pillBase   = 'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold transition border';
    
    // Idle: Transparent with subtle border, text off-white
    $pillIdle   = 'border-[#F8F8F8]/20 text-[#F8F8F8] hover:text-[#E6B65C] hover:border-[#E6B65C]/50 hover:bg-[#5C0F14]/80';
    
    // Active: Gold Border, White/Gold text, subtle background
    $pillActive = 'border-[#E6B65C] text-[#E6B65C] bg-[#E6B65C]/10 shadow-sm shadow-[#E6B65C]/20';

    // Small pill (Login/Register)
    $pillSmallBase = 'inline-flex items-center justify-center rounded-xl px-3 py-2 text-sm font-semibold transition border';
@endphp

<nav x-data="{ open: false }"
     class="sticky top-0 z-50 border-b border-[#F8F8F8]/10 bg-[#5C0F14] text-[#F8F8F8] backdrop-blur-md shadow-lg shadow-black/10">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT --}}
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="font-black text-2xl tracking-tight text-[#F8F8F8] hover:text-[#E6B65C] transition duration-300">
                    Dimz Store
                </a>

                {{-- DESKTOP NAV --}}
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('home') }}"
                       class="{{ $pillBase }} {{ $isHome ? $pillActive : $pillIdle }}">
                        Home
                    </a>

                    <a href="{{ route('catalog.index') }}"
                       class="{{ $pillBase }} {{ $isCatalog ? $pillActive : $pillIdle }}">
                        Catalog
                    </a>
                    
                    <a href="{{ $isHome ? '#faq' : route('home').'#faq' }}"
                       class="{{ $pillBase }} {{ $pillIdle }}">
                        FAQ
                    </a>
                </div>
            </div>

            {{-- RIGHT (DESKTOP) --}}
            <div class="hidden sm:flex sm:items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="{{ $pillSmallBase }} {{ $pillIdle }}">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="{{ $pillSmallBase }} {{ $pillIdle }}">
                        Register
                    </a>

                    <a href="{{ route('cart.index') }}" 
                       class="{{ $pillBase }} {{ $isCart ? $pillActive : $pillIdle }}" 
                       title="Cart"
                       x-data="{ count: {{ $cartCount }} }"
                       @cart-updated.window="count = $event.detail.count">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 6h15l-1.5 9h-13z" />
                            <path d="M6 6l-2-3H1" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                        <span x-show="count > 0" 
                              x-text="count"
                              class="ml-1 inline-flex items-center rounded-full bg-[#E6B65C] px-2 py-0.5 text-xs font-bold text-[#5C0F14]">
                        </span>
                    </a>
                @endguest

                @auth
                    <a href="{{ route('cart.index') }}"
                       class="{{ $pillBase }} {{ $isCart ? $pillActive : $pillIdle }}" 
                       title="Cart"
                       x-data="{ count: {{ $cartCount }} }"
                       @cart-updated.window="count = $event.detail.count">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 6h15l-1.5 9h-13z" />
                            <path d="M6 6l-2-3H1" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                        <span x-show="count > 0" 
                              x-text="count"
                              class="ml-1 inline-flex items-center rounded-full bg-[#E6B65C] px-2 py-0.5 text-xs font-bold text-[#5C0F14]">
                        </span>
                    </a>

                    {{-- Premium User Dropdown (Alpine) --}}
                    <div class="relative ml-2" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" 
                                @click.away="dropdownOpen = false"
                                class="flex items-center gap-2 group focus:outline-none transition">
                            
                            <div class="relative inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-[#E6B65C] to-[#CCA050] shadow-md ring-2 ring-[#5C0F14] group-hover:ring-[#E6B65C] transition-all">
                                <span class="font-bold leading-none text-[#5C0F14] text-base">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>

                            <div class="hidden lg:block text-left">
                                <p class="text-sm font-bold text-[#F8F8F8] group-hover:text-[#E6B65C] transition">{{ auth()->user()->name }}</p>
                            </div>
                            
                            <svg class="h-4 w-4 text-[#F8F8F8]/70 group-hover:text-[#E6B65C] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="dropdownOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 z-50 mt-3 w-56 origin-top-right rounded-2xl bg-white text-gray-800 shadow-xl ring-1 ring-black/5 focus:outline-none"
                             style="display: none;">
                            
                            {{-- Header --}}
                            <div class="px-5 py-3 border-b border-gray-100 bg-gray-50/50 rounded-t-2xl">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">My Account</p>
                            </div>

                            <div class="p-2 space-y-1">
                                {{-- 1. Dashboard --}}
                                <a href="{{ route('dashboard') }}" class="flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-[#5C0F14]/5 hover:text-[#5C0F14] transition-colors group">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-[#5C0F14]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    Dashboard
                                </a>

                                {{-- 2. Profil --}}
                                <a href="{{ route('profile.edit') }}" class="flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-[#5C0F14]/5 hover:text-[#5C0F14] transition-colors group">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-[#5C0F14]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil
                                </a>
                            </div>

                            <div class="border-t border-gray-100 p-2">
                                {{-- 3. Logout --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center rounded-xl px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 transition-colors group">
                                        <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- HAMBURGER (MOBILE) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#F8F8F8] hover:text-[#E6B65C] focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#5C0F14] border-t border-[#F8F8F8]/10">
        <div class="pt-2 pb-3 space-y-2 px-4 shadow-inner">
            <a class="{{ $pillBase }} {{ $isHome ? $pillActive : $pillIdle }} w-full justify-start" href="{{ route('home') }}">Home</a>
            <a class="{{ $pillBase }} {{ $isCatalog ? $pillActive : $pillIdle }} w-full justify-start" href="{{ route('catalog.index') }}">Catalog</a>

            <a href="{{ route('cart.index') }}" class="{{ $pillBase }} {{ $isCart ? $pillActive : $pillIdle }} w-full justify-start">
                <span>Cart</span>
                @if($cartCount > 0)
                    <span class="ml-auto inline-flex items-center rounded-full bg-[#E6B65C] px-2 py-0.5 text-xs font-bold text-[#5C0F14]">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @guest
                <div class="pt-4 border-t border-[#F8F8F8]/10 mt-2"></div>
                <a class="{{ $pillSmallBase }} {{ $pillIdle }} w-full justify-start" href="{{ route('login') }}">Login</a>
                <a class="{{ $pillSmallBase }} {{ $pillIdle }} w-full justify-start" href="{{ route('register') }}">Register</a>
            @endguest

            @auth
                <div class="pt-4 border-t border-[#F8F8F8]/10 mt-2">
                    <div class="flex items-center gap-3 px-2 pb-2">
                        <div class="h-8 w-8 rounded-full bg-[#E6B65C] flex items-center justify-center text-[#5C0F14] font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="text-sm font-bold text-[#F8F8F8]">{{ auth()->user()->name }}</div>
                    </div>
                </div>
                
                <a class="{{ $pillSmallBase }} {{ $pillIdle }} w-full justify-start pl-8" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="{{ $pillSmallBase }} {{ $pillIdle }} w-full justify-start pl-8" href="{{ route('profile.edit') }}">Profil</a>

                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left rounded-xl px-4 py-2 text-sm font-bold text-red-300 hover:text-red-100 hover:bg-black/20 transition">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
