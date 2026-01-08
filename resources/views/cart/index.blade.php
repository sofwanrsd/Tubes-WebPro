<x-main-layout>
    @php
        $formatRupiah = fn($n) => 'Rp ' . number_format((int)$n, 0, ',', '.');
    @endphp

    {{-- HERO HEADER --}}
    <div class="relative pt-24 pb-12 overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-gradient-to-b from-[#5C0F14] via-[#2E0508] to-gray-50 z-0"></div>
        <div class="absolute inset-0 opacity-20 z-0" 
             style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-[#F8F8F8] tracking-tight mb-4">
                Keranjang <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Belanja</span>
            </h1>
            <p class="text-[#F8F8F8]/70 max-w-2xl mx-auto text-lg leading-relaxed">
                Review kembali buku digital pilihanmu sebelum melanjutkan ke pembayaran.
            </p>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="relative z-20 -mt-8 pb-24 px-6 mx-auto max-w-7xl lg:px-8">
        @if(count($items) === 0)
            {{-- EMPTY STATE --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-16 text-center max-w-2xl mx-auto">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-50 text-[#5C0F14] mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Keranjang Masih Kosong</h2>
                <p class="text-gray-500 mb-8">Wah, belum ada buku yang kamu pilih nih. Yuk cari buku favoritmu di katalog!</p>
                <a href="{{ route('catalog.index') }}"
                   class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-bold hover:bg-[#4a0b10] hover:shadow-lg hover:shadow-red-900/20 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Jelajahi Katalog
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                {{-- LEFT: ITEMS LIST (8 cols) --}}
                <div class="lg:col-span-8 space-y-6">
                    @foreach($items as $it)
                        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:border-[#E6B65C]/30 transition-all duration-300">
                            <div class="p-5 flex flex-col sm:flex-row gap-6">
                                {{-- Book Cover --}}
                                <div class="shrink-0 relative w-full sm:w-32 aspect-[3/4] rounded-xl overflow-hidden bg-gray-100 shadow-inner">
                                    @if(!empty($it['coverPath']))
                                        <img src="{{ str_starts_with($it['coverPath'], 'http') ? $it['coverPath'] : asset('storage/'.$it['coverPath']) }}"
                                             alt="{{ $it['title'] }}"
                                             class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500" />
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-center p-2 bg-[#5C0F14]">
                                            <span class="text-[10px] text-[#F8F8F8]/60 uppercase tracking-widest">Dimz Store</span>
                                            <span class="text-xs text-[#E6B65C] font-bold mt-1">No Cover</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 mb-2">
                                            <span class="px-2.5 py-1 rounded-md bg-[#5C0F14]/5 text-[#5C0F14] text-[10px] font-bold uppercase tracking-wider border border-[#5C0F14]/10">
                                                {{ $it['genre'] ?? 'Umum' }}
                                            </span>
                                        </div>

                                        <h3 class="text-xl font-bold text-gray-900 leading-tight mb-1 group-hover:text-[#5C0F14] transition-colors">
                                            <a href="{{ route('catalog.show', $it['slug'] ?? '#') }}">
                                                {{ $it['title'] }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-500 font-medium">
                                            Oleh: <span class="text-gray-700">{{ $it['author_name'] ?? 'Admin' }}</span>
                                        </p>
                                    </div>

                                    <div class="mt-4 flex flex-wrap items-end justify-between gap-4 border-t border-gray-50 pt-4">
                                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-green-50 border border-green-100 text-green-700 text-xs font-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            Digital License (Lifetime)
                                        </div>

                                        <div class="text-right">
                                            <div class="text-lg font-black text-[#5C0F14]">
                                                {{ $formatRupiah($it['price']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Remove Button (absolute top-right) --}}
                            @if(\Illuminate\Support\Facades\Route::has('cart.remove'))
                                <form method="POST" action="{{ route('cart.remove', $it['id']) }}" class="absolute top-4 right-4 z-10">
                                    @csrf
                                    <button type="submit" 
                                            class="group/btn flex items-center justify-center p-2 rounded-full bg-white text-gray-300 shadow-sm border border-gray-100 hover:border-red-200 hover:text-red-600 hover:bg-red-50 transition-all duration-300"
                                            title="Hapus dari keranjang">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover/btn:rotate-12 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 000-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Hapus</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- RIGHT: SUMMARY CARD (4 cols) --}}
                <div class="lg:col-span-4">
                    <div class="sticky top-24">
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden ring-1 ring-black/5">
                            {{-- Gradient Header --}}
                            <div class="relative px-6 py-8 bg-gradient-to-br from-[#5C0F14] to-[#2E0508] text-center overflow-hidden">
                                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 16px 16px;"></div>
                                <h2 class="relative z-10 text-lg font-bold text-[#E6B65C] uppercase tracking-widest">Order Summary</h2>
                                <p class="relative z-10 text-[#F8F8F8]/60 text-xs mt-1">{{ count($items) }} buku terpilih</p>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="flex justify-between items-center text-sm text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-gray-900">{{ $formatRupiah($subtotal) }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm text-gray-600">
                                    <span>Kode Unik (Acak)</span>
                                    <span class="font-bold text-[#5C0F14] text-xs uppercase tracking-wider">Rp ???</span>
                                </div>

                                <div class="border-t border-dashed border-gray-200 my-4"></div>

                                <div class="flex justify-between items-end">
                                    <span class="text-base font-bold text-gray-800">Total Tagihan</span>
                                    <div class="text-right">
                                        <span class="text-2xl font-black text-[#5C0F14]">{{ $formatRupiah($subtotal) }}</span>
                                        <span class="text-xs font-bold text-[#5C0F14] block">+ Rp ???</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 pt-0 space-y-3">
                            <div class="p-6 pt-0 space-y-3">
                                @if(\Illuminate\Support\Facades\Route::has('checkout.index'))
                                    <a href="{{ route('checkout.index') }}"
                                       class="group relative flex items-center justify-center w-full px-6 py-4 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-black text-lg shadow-lg shadow-red-900/40 hover:bg-[#4a0b10] hover:scale-[1.02] hover:shadow-red-900/60 transition-all duration-300 overflow-hidden">
                                        <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
                                        <span class="relative flex items-center gap-3">
                                            Lanjut ke Pembayaran
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </span>
                                    </a>
                                @else
                                    <button disabled class="flex items-center justify-center gap-2 w-full px-6 py-4 rounded-xl bg-gray-200 text-gray-400 font-bold cursor-not-allowed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        Checkout Belum Tersedia
                                    </button>
                                @endif

                                <a href="{{ route('catalog.index') }}"
                                   class="flex items-center justify-center w-full px-6 py-3 rounded-xl border-2 border-dashed border-gray-300 text-gray-500 font-bold hover:border-[#5C0F14] hover:text-[#5C0F14] hover:bg-red-50 transition-colors duration-300">
                                    &larr; Tambah Buku Lain
                                </a>
                            </div>

                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-main-layout>

