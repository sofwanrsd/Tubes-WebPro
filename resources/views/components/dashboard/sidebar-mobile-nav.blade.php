@php
    // Dark Wine Theme Logic (matching desktop sidebar)
    $isActive = fn($route) => request()->routeIs($route) 
        ? 'bg-black/20 text-[#E6B65C] border-l-4 border-[#E6B65C]' 
        : 'text-gray-200 hover:bg-white/5 hover:text-[#E6B65C] border-l-4 border-transparent';
    
    $iconClass = fn($route) => request()->routeIs($route) 
        ? 'text-[#E6B65C]' 
        : 'text-gray-400 group-hover:text-[#E6B65C]';
    
    $user = auth()->user();
@endphp

<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <div class="px-3 mb-2 text-xs font-semibold text-[#E6B65C]/70 uppercase tracking-wider">Menu</div>
            <ul role="list" class="-mx-2 mt-2 space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ $isActive('dashboard') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                        <svg class="{{ $iconClass('dashboard') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Ringkasan
                    </a>
                </li>
                <li>
                    <a href="{{ route('library.index') }}" class="{{ $isActive('library.index') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                        <svg class="{{ $iconClass('library.index') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Koleksi Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders.index') }}" class="{{ $isActive('orders.*') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                        <svg class="{{ $iconClass('orders.*') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Pesanan Saya
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="{{ $isActive('profile.*') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                        <svg class="{{ $iconClass('profile.*') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil
                    </a>
                </li>
                @if($user && !$user->hasRole('publisher') && !$user->hasRole('admin'))
                    <li>
                        <a href="{{ route('upgrade.publisher.create') }}" class="{{ $isActive('upgrade.publisher.create') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                            <svg class="{{ $iconClass('upgrade.publisher.create') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Gabung Publisher
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        @if($user && ($user->hasRole('publisher') || $user->hasRole('admin')))
            <li>
                <div class="px-3 mb-2 text-xs font-semibold text-[#E6B65C]/70 uppercase tracking-wider">Studio Penerbit</div>
                <ul role="list" class="-mx-2 mt-2 space-y-1">
                    <li>
                        <a href="{{ route('publisher.dashboard') }}" class="{{ $isActive('publisher.dashboard') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                            <svg class="{{ $iconClass('publisher.dashboard') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Dasbor
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('publisher.books.index') }}" class="{{ $isActive('publisher.books.*') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                            <svg class="{{ $iconClass('publisher.books.*') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Buku Saya
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('publisher.orders.index') }}" class="{{ $isActive('publisher.orders.*') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                            <svg class="{{ $iconClass('publisher.orders.*') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Pantau Pesanan
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if($user && $user->hasRole('admin'))
            <li>
                <div class="px-3 mb-2 text-xs font-semibold text-[#E6B65C]/70 uppercase tracking-wider">Panel Admin</div>
                <ul role="list" class="-mx-2 mt-2 space-y-1">
                     <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ $isActive('admin.dashboard') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                            <svg class="{{ $iconClass('admin.dashboard') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                            </svg>
                            Dasbor
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="{{ $isActive('admin.orders.*') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                            <svg class="{{ $iconClass('admin.orders.*') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Kelola Pesanan
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('admin.users.index') }}" class="{{ $isActive('admin.users.*') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                            <svg class="{{ $iconClass('admin.users.*') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Kelola Pengguna
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('admin.books.index') }}" class="{{ $isActive('admin.books.*') }} group flex gap-x-3 rounded-r-xl px-3 py-2.5 text-sm font-medium transition-all">
                            <svg class="{{ $iconClass('admin.books.*') }} h-5 w-5 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Kelola Buku
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</nav>
