@php
    $cartCount = is_array(session('cart')) ? count(session('cart')) : 0;

    // Link styles (navbar)
    $linkBase   = (isset($linkBase) && $linkBase) ? $linkBase : 'inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold transition';
    $linkIdle   = (isset($linkIdle) && $linkIdle) ? $linkIdle : 'text-white/90 bg-black/10 border border-white/10 hover:bg-white/10 hover:border-white/20';
    $linkActive = (isset($linkActive) && $linkActive) ? $linkActive : 'text-white bg-black/20 border border-white/20 shadow-sm ring-1 ring-white/15';

    // Button styles
    $btnNav     = (isset($btnNav) && $btnNav) ? $btnNav : 'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold transition border border-white/20 bg-black/10 hover:bg-white/10 text-white';
    $btnPrimary = (isset($btnPrimary) && $btnPrimary) ? $btnPrimary : 'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold transition bg-white/95 text-slate-900 hover:bg-white';

    $isHome    = request()->routeIs('home');
    $isCatalog = request()->routeIs('catalog.*');
    $isCart    = request()->routeIs('cart.*') || request()->routeIs('checkout.*') || request()->routeIs('payment.*');
@endphp

<nav x-data="{ open: false }"
     class="sticky top-0 z-50 border-b border-white/10 bg-red-800/85 text-white backdrop-blur">

    <div class="container-app">
        <div class="flex h-16 items-center justify-between gap-3">

            {{-- Left: Brand + desktop links --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-2">
                    <span class="grid h-9 w-9 place-items-center rounded-2xl bg-white/10 text-white shadow-sm border border-white/10">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l2.4 6.8L21 9l-5.4 4.1L17.8 20 12 16.3 6.2 20l2.2-6.9L3 9l6.6-.2L12 2z" />
                        </svg>
                    </span>
                    <div class="leading-tight">
                        <div class="text-sm font-extrabold tracking-tight text-white">Dimz Store</div>
                        <div class="text-[11px] text-white/80 -mt-0.5 hidden sm:block">E-book • QRIS • Auto download</div>
                    </div>
                </a>

                <div class="hidden sm:flex items-center gap-1 pl-2">
                    <a href="{{ route('home') }}" class="{{ $linkBase }} {{ $isHome ? $linkActive : $linkIdle }}">Home</a>
                    <a href="{{ route('catalog.index') }}" class="{{ $linkBase }} {{ $isCatalog ? $linkActive : $linkIdle }}">Catalog</a>
                    <a href="{{ route('cart.index') }}" class="{{ $linkBase }} {{ $isCart ? $linkActive : $linkIdle }}">
                        <span>Cart</span>
                        @if($cartCount > 0)
                            <span class="ml-1 inline-flex items-center rounded-full bg-white/15 px-2 py-0.5 text-xs font-bold text-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>

            {{-- Right: auth / account --}}
            <div class="hidden sm:flex items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" class="{{ $btnNav }}">Login</a>
                    <a href="{{ route('register') }}" class="{{ $btnPrimary }}">Register</a>
                @endguest

                @auth
                    <a href="{{ route('cart.index') }}" class="{{ $btnNav }}" title="Cart">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 6h15l-1.5 9h-13z" />
                            <path d="M6 6l-2-3H1" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                        @if($cartCount > 0)
                            <span class="ml-1 inline-flex items-center rounded-full bg-white/15 px-2 py-0.5 text-xs font-bold text-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="{{ $btnNav }}">
                                <span class="hidden md:inline">My Account</span>
                                <span class="md:hidden">Menu</span>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')">Dashboard</x-dropdown-link>
                            <x-dropdown-link :href="route('orders.index')">Riwayat Transaksi</x-dropdown-link>

                            @php $u = auth()->user(); @endphp

                            @if($u && ($u->hasRole('publisher') || $u->hasRole('admin')))
                                <x-dropdown-link :href="route('publisher.dashboard')">My Studio</x-dropdown-link>
                            @endif

                            @if($u && $u->hasRole('admin'))
                                <x-dropdown-link :href="route('admin.dashboard')">Admin Panel</x-dropdown-link>
                            @endif

                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>

                            {{-- logout MUST be POST --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-100 focus:outline-none transition">
                                    Logout
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            {{-- Mobile hamburger --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="{{ $btnNav }}" aria-label="Toggle navigation">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-transition class="sm:hidden border-t border-white/10 bg-red-800/85 backdrop-blur">
        <div class="container-app py-3 flex flex-col gap-2">
            <a href="{{ route('home') }}" class="{{ $linkBase }} {{ $isHome ? $linkActive : $linkIdle }}">Home</a>
            <a href="{{ route('catalog.index') }}" class="{{ $linkBase }} {{ $isCatalog ? $linkActive : $linkIdle }}">Catalog</a>
            <a href="{{ route('cart.index') }}" class="{{ $linkBase }} {{ $isCart ? $linkActive : $linkIdle }}">
                <span>Cart</span>
                @if($cartCount > 0)
                    <span class="ml-1 inline-flex items-center rounded-full bg-white/15 px-2 py-0.5 text-xs font-bold text-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            <div class="h-px bg-white/20 my-2"></div>

            @guest
                <a href="{{ route('login') }}" class="{{ $btnNav }} w-full">Login</a>
                <a href="{{ route('register') }}" class="{{ $btnPrimary }} w-full">Register</a>
            @endguest

            @auth
                <a href="{{ route('dashboard') }}" class="{{ $btnNav }} w-full">Dashboard</a>
                <a href="{{ route('orders.index') }}" class="{{ $btnNav }} w-full">Riwayat</a>
                <a href="{{ route('profile.edit') }}" class="{{ $btnNav }} w-full">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="{{ $btnPrimary }} w-full" type="submit">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
