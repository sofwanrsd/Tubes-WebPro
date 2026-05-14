<x-dashboard-layout>
    @php
        $booksTotal      = (int)($booksTotal ?? 0);
        $booksPublished  = (int)($booksPublished ?? 0);
        $salesCount      = (int)($salesCount ?? 0);
        $revenue         = (int)($revenue ?? 0);

        $pctPublished = $booksTotal > 0 ? round(($booksPublished / $booksTotal) * 100) : 0;
        $fmt = fn($n) => 'Rp ' . number_format((int)$n, 0, ',', '.');
    @endphp

    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                Publisher Studio
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-2">
                        Dashboard <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Publisher</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Kelola karya tulismu, pantau performa penjualan, dan raih pendapatan dari setiap buku yang terjual.
                    </p>
                </div>
                
                <div class="flex gap-3">
                    @if(\Illuminate\Support\Facades\Route::has('publisher.sales.index'))
                        <a href="{{ route('publisher.sales.index') }}"
                           class="px-6 py-3 rounded-xl border border-[#E6B65C]/30 bg-[#E6B65C]/10 text-[#E6B65C] font-bold hover:bg-[#E6B65C] hover:text-[#5C0F14] transition backdrop-blur-sm">
                            Lihat Penjualan
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        {{-- Total Books --}}
        <div class="relative group rounded-2xl bg-white p-6 shadow-xl border border-gray-100 overflow-hidden hover:-translate-y-1 transition duration-300">
            <div class="absolute right-0 top-0 w-24 h-24 bg-gray-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-[#5C0F14]/5"></div>
            <div class="relative z-10">
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Total Buku</div>
                <div class="text-3xl font-black text-[#5C0F14]">{{ $booksTotal }}</div>
                <div class="mt-2 text-xs font-medium text-gray-400">Karya diupload</div>
            </div>
        </div>

        {{-- Published --}}
        <div class="relative group rounded-2xl bg-white p-6 shadow-xl border border-gray-100 overflow-hidden hover:-translate-y-1 transition duration-300">
             <div class="absolute right-0 top-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-green-100/50"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Published</div>
                    <span class="text-[10px] font-black px-2 py-0.5 rounded-lg bg-green-100 text-green-700">
                        {{ $pctPublished }}%
                    </span>
                </div>
                <div class="text-3xl font-black text-gray-900">{{ $booksPublished }}</div>
                 <div class="mt-3 w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-green-500 to-emerald-400" style="width: {{ $pctPublished }}%"></div>
                </div>
            </div>
        </div>

        {{-- Sales --}}
        <div class="relative group rounded-2xl bg-white p-6 shadow-xl border border-gray-100 overflow-hidden hover:-translate-y-1 transition duration-300">
            <div class="absolute right-0 top-0 w-24 h-24 bg-[#E6B65C]/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-[#E6B65C]/20"></div>
            <div class="relative z-10">
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Penjualan</div>
                <div class="text-3xl font-black text-[#5C0F14]">{{ $salesCount }}</div>
                <div class="mt-2 text-xs font-medium text-gray-400">Eksemplar terjual</div>
            </div>
        </div>

        {{-- Revenue --}}
        <div class="relative group rounded-2xl bg-gradient-to-br from-[#5C0F14] to-[#2E0508] p-6 shadow-xl overflow-hidden hover:-translate-y-1 transition duration-300">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 16px 16px;"></div>
            <div class="relative z-10">
                <div class="text-xs font-bold text-[#E6B65C]/80 uppercase tracking-wider mb-2">Total Pendapatan</div>
                <div class="text-2xl font-black text-[#E6B65C] truncate" title="{{ $fmt($revenue) }}">
                    {{ $fmt($revenue) }}
                </div>
                <div class="mt-2 text-xs font-medium text-white/50">Saldo Publisher</div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Left: Getting Started --}}
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl">
                 <div class="flex items-center gap-3 mb-6">
                    <div class="p-3 rounded-xl bg-[#5C0F14]/5 text-[#5C0F14]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-900">Mulai Menulis</h3>
                        <p class="text-sm text-gray-500">Panduan singkat mempublikasikan karyamu.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                    <div class="p-5 rounded-2xl bg-gray-50 border border-gray-100 group hover:border-[#E6B65C]/30 transition">
                        <div class="text-xs font-black text-gray-300 mb-2 group-hover:text-[#E6B65C] transition">01</div>
                        <h4 class="font-bold text-gray-900 mb-1">Upload Buku</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">Siapkan cover menarik dan file PDF bukumu.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-gray-50 border border-gray-100 group hover:border-[#E6B65C]/30 transition">
                        <div class="text-xs font-black text-gray-300 mb-2 group-hover:text-[#E6B65C] transition">02</div>
                        <h4 class="font-bold text-gray-900 mb-1">Publish</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">Aktifkan status publikasi agar muncul di katalog.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-gray-50 border border-gray-100 group hover:border-[#E6B65C]/30 transition">
                        <div class="text-xs font-black text-gray-300 mb-2 group-hover:text-[#E6B65C] transition">03</div>
                        <h4 class="font-bold text-gray-900 mb-1">Cuan!</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">Dapatkan royalti dari setiap pembelian.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                     <a href="{{ route('publisher.books.index') }}"
                        class="px-6 py-3 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-bold hover:bg-[#4a0b10] transition shadow-lg shadow-red-900/20">
                        Kelola Buku Saya
                    </a>

                    @if(\Illuminate\Support\Facades\Route::has('publisher.books.create'))
                        <a href="{{ route('publisher.books.create') }}"
                           class="px-6 py-3 rounded-xl border border-gray-200 text-gray-700 font-bold hover:bg-gray-50 transition">
                            + Tambah Baru
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right: Payout Info --}}
        <div class="lg:col-span-4">
            <div class="rounded-2xl border border-gray-100 bg-[#FFFBF0] p-6 shadow-xl sticky top-24">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="font-black text-[#5C0F14]">Info Pencairan</h3>
                    <span class="px-2 py-1 rounded-lg bg-[#E6B65C]/20 text-[#5C0F14] text-[10px] font-bold uppercase tracking-wide">Manual</span>
                </div>
                
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                    Saldo akan bertambah otomatis saat status transaksi <span class="font-bold text-[#5C0F14]">Paid</span>. Untuk saat ini, proses pencairan (Withdraw) dilakukan secara manual.
                </p>

                <div class="p-4 rounded-xl bg-white border border-[#E6B65C]/20 shadow-sm mb-4">
                    <div class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Saldo Tersedia</div>
                    <div class="text-2xl font-black text-[#5C0F14]">{{ $fmt($revenue) }}</div>
                </div>

                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20mencairkan%20saldo%20publisher."
                   target="_blank"
                   class="flex items-center justify-center w-full py-3 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-bold text-sm hover:bg-[#4a0b10] transition shadow-lg shadow-red-900/20">
                    Hubungi Admin (Cairkan)
                </a>
            </div>
        </div>
    </div>
</x-dashboard-layout>
