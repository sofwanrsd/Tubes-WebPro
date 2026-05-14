<x-dashboard-layout>
    @php
        $booksOwned = (int)($booksOwned ?? 0);
        $totalSpend = (int)($totalSpend ?? 0);
        $pending    = (int)($pending ?? 0);
    @endphp

    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                Dashboard User
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-2">
                        Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">{{ auth()->user()->name }}!</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Akses cepat ke semua buku digitalmu dan pantau status transaksi terkini.
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('catalog.index') }}"
                       class="px-6 py-3 rounded-xl bg-[#E6B65C] text-[#5C0F14] font-bold hover:bg-[#d4a040] transition shadow-lg shadow-orange-900/20">
                        Beli Buku Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- STATS GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Books Owned --}}
        <div class="group relative rounded-2xl bg-white border border-gray-100 p-6 shadow-lg overflow-hidden hover:-translate-y-1 transition-all duration-300">
            <div class="absolute top-0 right-0 p-16 bg-[#5C0F14] opacity-[0.03] rounded-full translate-x-1/2 -translate-y-1/2 group-hover:scale-110 transition-transform"></div>
            
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-orange-50 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Koleksi Buku</div>
                    <div class="text-4xl font-black text-[#5C0F14]">{{ $booksOwned }}</div>
                </div>
            </div>
            <div class="mt-4 text-xs text-gray-500 font-medium border-t border-gray-100 pt-3">
                Buku digital yang sudah kamu miliki.
            </div>
        </div>

        {{-- Pending Payment --}}
        <div class="group relative rounded-2xl bg-gradient-to-br from-red-50 to-white border border-red-100 p-6 shadow-lg overflow-hidden hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 rounded-xl bg-white text-red-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                         <div class="text-xs font-bold text-red-600 uppercase tracking-wider">Menunggu Pembayaran</div>
                         <div class="text-4xl font-black text-red-700">{{ $pending }}</div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-xs text-red-600/80 font-medium border-t border-red-200/50 pt-3">
                Segera selesaikan pembayaranmu.
            </div>
        </div>

        {{-- Total Spend --}}
        <div class="group relative rounded-2xl bg-gradient-to-br from-green-50 to-white border border-green-100 p-6 shadow-lg overflow-hidden hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-white text-green-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                     <div class="text-xs font-bold text-green-600 uppercase tracking-wider">Total Belanja</div>
                     <div class="text-2xl font-black text-green-700">Rp {{ number_format($totalSpend, 0, ',', '.') }}</div>
                </div>
            </div>
             <div class="mt-4 text-xs text-green-600/80 font-medium border-t border-green-200/50 pt-3">
                Akumulasi transaksi berhasil.
            </div>
        </div>
    </div>

    {{-- FEATURES / INFO ROW --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Info 1 --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm flex items-start gap-4">
            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-[#5C0F14]/10 flex items-center justify-center text-[#5C0F14]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Auto-Delivery System</h3>
                <p class="text-sm text-gray-500 mt-1">File buku digitalmu langsung masuk ke menu "Order" segera setelah pembayaran sukses.</p>
            </div>
        </div>

        {{-- Info 2 --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm flex items-start gap-4">
             <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-[#E6B65C]/10 flex items-center justify-center text-[#d4a040]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">QRIS Dynamic</h3>
                <p class="text-sm text-gray-500 mt-1">Gunakan satu QR Code untuk transaksi yang aman, cepat, dan terverifikasi otomatis.</p>
            </div>
        </div>

        {{-- CTA Small --}}
        <a href="{{ route('orders.index') }}" class="group relative rounded-2xl overflow-hidden flex items-center justify-between p-6 bg-[#5C0F14] text-white shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="relative z-10">
                <div class="text-xs font-bold text-[#E6B65C] uppercase tracking-wider mb-1">Menu Utama</div>
                <h3 class="text-xl font-bold group-hover:text-[#E6B65C] transition-colors">Lihat Pesanan Saya</h3>
            </div>
             <div class="relative z-10 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center group-hover:bg-[#E6B65C] group-hover:text-[#5C0F14] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </div>
            
            {{-- Decoration --}}
            <div class="absolute inset-0 bg-gradient-to-r from-[#5C0F14] to-[#3a0a0d]"></div>
            <div class="absolute right-0 top-0 p-16 bg-[#E6B65C] opacity-10 rounded-full blur-2xl translate-x-10 -translate-y-10"></div>
        </a>
    </div>

    </div>
</x-dashboard-layout>
