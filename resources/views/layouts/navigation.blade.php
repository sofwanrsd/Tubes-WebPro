@php
    $cartCount = is_array(session('cart')) ? count(session('cart')) : 0;

    $isHome    = request()->routeIs('home');
    $isCatalog = request()->routeIs('catalog.*');
    $isCart    = request()->routeIs('cart.*') || request()->routeIs('checkout.*') || request()->routeIs('payment.*');

    // Pill style (samain feel kaya tombol keranjang)
    $pillBase   = 'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold transition border text-white';
    $pillIdle   = 'border-white/20 bg-black/10 hover:bg-black/20 hover:border-white/35 hover:ring-1 hover:ring-white/15';
    $pillActive = 'border-white/35 bg-black/25 ring-1 ring-white/15 shadow-sm';

    // khusus link kecil (Login/Register) tapi tetap pill
    $pillSmallBase = 'inline-flex items-center justify-center rounded-xl px-3 py-2 text-sm font-semibold transition border text-white';
    $pillSmallIdle = 'border-white/20 bg-black/10 hover:bg-black/20 hover:border-white/35 hover:ring-1 hover:ring-white/15';
@endphp

<nav x-data="{ open: false }"
     class="sticky top-0 z-50 border-b border-white/10 bg-gradient-to-r from-[#FF4B2B]/70 via-[#FF416C]/65 to-[#FF4B2B]/70 text-white backdrop-blur">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT --}}
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="font-bold text-lg hover:opacity-90 transition">
                    Dimz Store
                </a>

                {{-- DESKTOP NAV: Home & Catalog jadi pill (ada border) --}}
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('home') }}"
                       class="{{ $pillBase }} {{ $isHome ? $pillActive : $pillIdle }}">
                        Home
                    </a>

                    <a href="{{ route('catalog.index') }}"
                       class="{{ $pillBase }} {{ $isCatalog ? $pillActive : $pillIdle }}">
                        Catalog
                    </a>
                </div>
            </div>

            {{-- RIGHT (DESKTOP) --}}
            <div class="hidden sm:flex sm:items-center gap-3">
                @guest
                    {{-- Login/Register jadi pill + Cart tetap pill --}}
                    <a href="{{ route('login') }}" class="{{ $pillSmallBase }} {{ $pillSmallIdle }}">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="{{ $pillSmallBase }} {{ $pillSmallIdle }}">
                        Register
                    </a>

                    <a href="{{ route('cart.index') }}" class="{{ $pillBase }} {{ $isCart ? $pillActive : $pillIdle }}" title="Cart">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 6h15l-1.5 9h-13z" />
                            <path d="M6 6l-2-3H1" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                        @if($cartCount > 0)
                            <span class="ml-1 inline-flex items-center rounded-full bg-white/20 px-2 py-0.5 text-xs font-bold text-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                @endguest

                @auth
                    <a href="{{ route('cart.index') }}" class="{{ $pillBase }} {{ $isCart ? $pillActive : $pillIdle }}" title="Cart">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 6h15l-1.5 9h-13z" />
                            <path d="M6 6l-2-3H1" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                        @if($cartCount > 0)
                            <span class="ml-1 inline-flex items-center rounded-full bg-white/20 px-2 py-0.5 text-xs font-bold text-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    @php
                        $u = auth()->user();
                        $isAdmin = $u && $u->hasRole('admin');
                        $isPublisher = $u && $u->hasRole('publisher');
                        $isUserOnly = $u && $u->hasRole('user') && !$isAdmin && !$isPublisher;
                    @endphp

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>My Account</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')">Dashboard</x-dropdown-link>
                            <x-dropdown-link :href="route('orders.index')">Riwayat Transaksi</x-dropdown-link>

                            @if($isUserOnly)
                                <form method="POST" action="{{ route('upgrade.publisher.request') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('upgrade.publisher.request')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Request Upgrade Publisher
                                    </x-dropdown-link>
                                </form>
                            @endif

                            @if($isPublisher || $isAdmin)
                                <x-dropdown-link :href="route('publisher.dashboard')">My Studio</x-dropdown-link>
                            @endif

                            @if($isAdmin)
                                <x-dropdown-link :href="route('admin.dashboard')">Admin Panel</x-dropdown-link>
                            @endif

                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            {{-- HAMBURGER (MOBILE) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white/90 hover:text-white hover:bg-black/10 focus:outline-none transition">
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-2 px-4">
            <a class="{{ $pillBase }} {{ $isHome ? $pillActive : $pillIdle }} w-full" href="{{ route('home') }}">Home</a>
            <a class="{{ $pillBase }} {{ $isCatalog ? $pillActive : $pillIdle }} w-full" href="{{ route('catalog.index') }}">Catalog</a>

            <a href="{{ route('cart.index') }}" class="{{ $pillBase }} {{ $isCart ? $pillActive : $pillIdle }} w-full">
                <span>Cart</span>
                @if($cartCount > 0)
                    <span class="ml-1 inline-flex items-center rounded-full bg-white/20 px-2 py-0.5 text-xs font-bold text-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @guest
                <a class="{{ $pillSmallBase }} {{ $pillSmallIdle }} w-full" href="{{ route('login') }}">Login</a>
                <a class="{{ $pillSmallBase }} {{ $pillSmallIdle }} w-full" href="{{ route('register') }}">Register</a>
            @endguest

            @auth
                <a class="{{ $pillSmallBase }} {{ $pillSmallIdle }} w-full" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="{{ $pillSmallBase }} {{ $pillSmallIdle }} w-full" href="{{ route('orders.index') }}">Riwayat Transaksi</a>

                <a class="{{ $pillSmallBase }} {{ $pillSmallIdle }} w-full" href="{{ route('profile.edit') }}">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="{{ $pillSmallBase }} {{ $pillSmallIdle }} w-full">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
