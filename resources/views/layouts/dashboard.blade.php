<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full bg-gray-50" x-data="{ desktopSidebarOpen: true, sidebarOpen: false }">
        
        {{-- Mobile Sidebar Overlay --}}
        <div x-show="sidebarOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/80"
                 @click="sidebarOpen = false"></div>

            <div class="fixed inset-0 flex">
                <div x-show="sidebarOpen" 
                     x-transition:enter="transition ease-in-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in-out duration-300 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full"
                     class="relative mr-16 flex w-full max-w-xs flex-1">
                    
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Sidebar Component (Mobile Clone) --}}
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-[#5C0F14] px-6 pb-4">
                        <div class="flex h-16 shrink-0 items-center">
                             <a href="{{ route('home') }}" class="flex items-center gap-2">
                                <span class="text-2xl font-black text-[#E6B65C] tracking-tighter">DIMZ</span>
                                <span class="text-sm font-bold text-gray-200">STORE</span>
                            </a>
                        </div>
                        
                        {{-- Mobile Nav reuse --}}
                        @include('components.dashboard.sidebar-mobile-nav')
                        
                    </div>
                </div>
            </div>
        </div>

        {{-- Desktop Sidebar --}}
        <x-dashboard.sidebar />

        <div class="flex flex-col min-h-screen transition-all duration-300 ease-in-out"
             :class="desktopSidebarOpen ? 'lg:pl-64' : 'lg:pl-0'">
            <x-dashboard.topbar />

            <main class="flex-1 py-10">
                <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
                    {{ $slot }}
                </div>
            </main>
            

        </div>
    </body>
</html>
