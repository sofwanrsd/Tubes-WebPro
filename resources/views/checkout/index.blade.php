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
                Konfirmasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Order</span>
            </h1>
            <p class="text-[#F8F8F8]/70 max-w-2xl mx-auto text-lg leading-relaxed">
                Satu langkah lagi! Pastikan pesananmu sudah benar sebelum lanjut ke pembayaran.
            </p>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="relative z-20 -mt-8 pb-24 px-6 mx-auto max-w-7xl lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- LEFT: ITEMS LIST (8 cols) --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Items Card --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                        <h2 class="font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5C0F14]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Item Pesanan ({{ count($items) }})
                        </h2>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @foreach($items as $it)
                            <div class="p-4 sm:p-6 flex gap-4 sm:gap-6 hover:bg-gray-50/80 transition-colors">
                                {{-- Book Cover --}}
                                <div class="shrink-0 w-20 sm:w-24 aspect-[3/4] rounded-lg overflow-hidden bg-gray-100 shadow-sm border border-gray-200">
                                    @if(!empty($it['cover_path']))
                                        <img src="{{ str_starts_with($it['cover_path'], 'http') ? $it['cover_path'] : asset('storage/'.$it['cover_path']) }}"
                                             alt="{{ $it['title'] }}"
                                             class="w-full h-full object-cover" />
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-center p-1 bg-[#5C0F14]">
                                            <span class="text-[8px] text-[#F8F8F8]/60 uppercase tracking-widest">Dimz</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col h-full justify-between">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#5C0F14]/10 text-[#5C0F14] border border-[#5C0F14]/10">
                                                    {{ $it['genre'] ?? 'Umum' }}
                                                </span>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-900 truncate pr-4">{{ $it['title'] }}</h3>
                                            <p class="text-sm text-gray-500">Oleh: {{ $it['author_name'] ?? 'Admin' }}</p>
                                        </div>
                                        
                                        <div class="flex items-center justify-between mt-4">
                                            <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-md border border-green-100">
                                                Digital License (Lifetime)
                                            </span>
                                            <span class="text-lg font-black text-[#5C0F14]">
                                                {{ $formatRupiah($it['price']) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3 text-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mt-0.5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm">
                        <p class="font-bold">Informasi Penting</p>
                        <p class="opacity-80">Produk digital tidak dapat dikembalikan setelah pembelian berhasil. Mohon pastikan pilihanmu sudah benar.</p>
                    </div>
                </div>
            </div>

            {{-- RIGHT: SUMMARY CARD (4 cols) --}}
            <div class="lg:col-span-4 sticky top-24">
                <form method="POST" action="{{ route('checkout.submit') }}">
                    @csrf
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden ring-1 ring-black/5">
                        {{-- Header --}}
                        <div class="relative px-6 py-6 bg-gradient-to-br from-[#5C0F14] to-[#2E0508] text-center overflow-hidden">
                             <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 16px 16px;"></div>
                            <h2 class="relative z-10 text-lg font-bold text-[#E6B65C] uppercase tracking-widest">Rincian Pembayaran</h2>
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
                                <span class="text-base font-bold text-gray-800">Total Estimasi</span>
                                <div class="text-right">
                                    <span class="text-2xl font-black text-[#5C0F14]">{{ $formatRupiah($subtotal) }}</span>
                                    <span class="text-xs font-bold text-[#5C0F14] block">+ Rp ???</span>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="px-6 pb-6">
                            <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 text-center">
                                <p class="text-xs text-gray-500 mb-2 font-semibold uppercase">Metode Pembayaran</p>
                                <div class="flex justify-center">
                                     <div class="h-10 px-6 bg-white border border-gray-200 rounded-lg flex items-center justify-center shadow-sm">
                                        <span class="text-sm font-black text-gray-800 tracking-wider">QRIS</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action --}}
                        <div class="p-6 pt-0 space-y-4">
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <div class="relative flex items-center">
                                    <input type="checkbox" name="agree" value="1" required
                                           class="w-5 h-5 border-gray-300 rounded text-[#5C0F14] focus:ring-[#5C0F14] focus:ring-offset-0 transition cursor-pointer">
                                </div>
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">
                                    Saya menyetujui <a href="{{ route('terms') }}" target="_blank" class="text-[#5C0F14] font-bold underline decoration-dotted hover:decoration-solid">Syarat & Ketentuan</a> pembelian barang digital.
                                </span>
                            </label>

                            @error('agree')
                                <p class="text-xs text-red-600 font-bold bg-red-50 p-2 rounded">{{ $message }}</p>
                            @enderror

                            <button type="submit"
                               class="group relative flex items-center justify-center w-full px-6 py-4 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-black text-lg shadow-lg shadow-red-900/40 hover:bg-[#4a0b10] hover:scale-[1.02] hover:shadow-red-900/60 transition-all duration-300 overflow-hidden">
                                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
                                <span class="relative flex items-center gap-3">
                                    Konfirmasi & Bayar
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('cart.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                        &larr; Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
