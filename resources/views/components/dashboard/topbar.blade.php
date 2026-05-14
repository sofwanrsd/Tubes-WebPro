@php
    $hour = date('H');
    $greeting = match(true) {
        $hour < 12 => 'Good Morning',
        $hour < 18 => 'Good Afternoon',
        default => 'Good Evening',
    };
@endphp

<header class="sticky top-0 z-40 flex h-20 flex-shrink-0 items-center justify-between border-b border-white/10 bg-[#5C0F14]/95 backdrop-blur-md px-4 shadow-sm transition-all duration-200 sm:px-6 lg:px-8">
    
    <div class="flex items-center gap-4">
        {{-- Mobile menu button --}}
        <button type="button" class="-m-2.5 p-2.5 text-gray-200 lg:hidden hover:text-[#E6B65C] transition" @click="sidebarOpen = true">
            <span class="sr-only">Open sidebar</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        {{-- Desktop toggle button --}}
        <button type="button" class="-m-2.5 p-2.5 text-gray-400 hidden lg:block hover:text-white transition" @click="desktopSidebarOpen = !desktopSidebarOpen">
            <span class="sr-only">Toggle sidebar</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
            </svg>
        </button>

        {{-- Data Greeting Logic is already at top --}}
        
        {{-- Greeting Section --}}
        <div class="hidden sm:block ml-2">
            <h1 class="text-xl font-bold text-[#F8F8F8]">
                {{ $greeting }}, <span class="text-[#E6B65C]">{{ explode(' ', auth()->user()->name)[0] }}</span> 👋
            </h1>
            <p class="text-xs text-gray-300 font-medium">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-3 lg:gap-6">
        
        {{-- Search and Notifications Removed --}}

        {{-- Vertical Separator --}}
        <div class="hidden lg:block lg:h-8 lg:w-px lg:bg-white/10" aria-hidden="true"></div>

        {{-- Premium User Dropdown (Matched to Navbar) --}}
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
                
                <svg class="h-4 w-4 text-gray-400 group-hover:text-[#5C0F14] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                
                {{-- Header: Email & Greeting --}}
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50/50 rounded-t-2xl">
                    <p class="truncate text-sm font-bold text-[#5C0F14]">{{ auth()->user()->email }}</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Hai, {{ explode(' ', auth()->user()->name)[0] }}</p>
                </div>

                <div class="p-2 space-y-1">
                    {{-- 1. Profil --}}
                    <a href="{{ route('profile.edit') }}" class="flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-[#5C0F14]/5 hover:text-[#5C0F14] transition-colors group">
                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-[#5C0F14]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil
                    </a>
                    
                    {{-- 2. Catalog --}}
                    <a href="{{ route('catalog.index') }}" class="flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-[#5C0F14]/5 hover:text-[#5C0F14] transition-colors group">
                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-[#5C0F14]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Catalog
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
    </div>
</header>
