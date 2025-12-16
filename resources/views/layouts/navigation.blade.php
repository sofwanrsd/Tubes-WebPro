<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-bold text-lg">
                        Dimz Store
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a class="inline-flex items-center px-1 pt-1 text-sm font-medium" href="{{ route('home') }}">Home</a>
                    <a class="inline-flex items-center px-1 pt-1 text-sm font-medium" href="{{ route('catalog.index') }}">Catalog</a>
                    <a class="inline-flex items-center px-1 pt-1 text-sm font-medium" href="{{ route('cart.index') }}">Cart</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm">Login</a>
                        <a href="{{ route('register') }}" class="text-sm font-semibold">Register</a>
                    </div>
                @endguest

                @auth
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
                            {{-- Dashboard = dashboard user untuk semua role --}}
                            <x-dropdown-link :href="route('dashboard')">Dashboard</x-dropdown-link>

                            <x-dropdown-link :href="route('orders.index')">Riwayat Transaksi</x-dropdown-link>

                            {{-- Request upgrade hanya user murni --}}
                            @if($isUserOnly)
                                <form method="POST" action="{{ route('upgrade.publisher.request') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('upgrade.publisher.request')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Request Upgrade Publisher
                                    </x-dropdown-link>
                                </form>
                            @endif

                            {{-- My Studio = dashboard publisher (publisher + admin) --}}
                            @if($isPublisher || $isAdmin)
                                <x-dropdown-link :href="route('publisher.dashboard')">My Studio</x-dropdown-link>
                            @endif

                            {{-- Admin Panel = admin saja --}}
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

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
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
        <div class="pt-2 pb-3 space-y-1">
            <a class="block px-4 py-2" href="{{ route('home') }}">Home</a>
            <a class="block px-4 py-2" href="{{ route('catalog.index') }}">Catalog</a>
            <a class="block px-4 py-2" href="{{ route('cart.index') }}">Cart</a>

            @guest
                <a class="block px-4 py-2" href="{{ route('login') }}">Login</a>
                <a class="block px-4 py-2 font-semibold" href="{{ route('register') }}">Register</a>
            @endguest

            @auth
                @php
                    $u = auth()->user();
                    $isAdmin = $u && $u->hasRole('admin');
                    $isPublisher = $u && $u->hasRole('publisher');
                    $isUserOnly = $u && $u->hasRole('user') && !$isAdmin && !$isPublisher;
                @endphp

                <a class="block px-4 py-2" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="block px-4 py-2" href="{{ route('orders.index') }}">Riwayat Transaksi</a>

                @if($isUserOnly)
                    <form method="POST" action="{{ route('upgrade.publisher.request') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2">
                            Request Upgrade Publisher
                        </button>
                    </form>
                @endif

                @if($isPublisher || $isAdmin)
                    <a class="block px-4 py-2" href="{{ route('publisher.dashboard') }}">My Studio</a>
                @endif

                @if($isAdmin)
                    <a class="block px-4 py-2" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                @endif

                <a class="block px-4 py-2" href="{{ route('profile.edit') }}">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
