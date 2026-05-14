<x-main-layout>
    <div class="relative py-20 overflow-hidden bg-gradient-to-br from-red-900 via-red-800 to-black sm:py-32">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="relative z-10 px-6 mx-auto max-w-7xl lg:px-8">
            <div class="grid items-center gap-12 md:grid-cols-2">
                <div class="text-left animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1 mb-6 text-xs font-semibold text-red-200 border rounded-full bg-red-950/50 border-red-500/30">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        Platform Resmi Mahasiswa TI Telkom
                    </div>
                    <h1 class="mb-6 text-5xl font-extrabold leading-tight tracking-tight text-white sm:text-6xl">
                        Dimz Store <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-300">Digital Knowledge Hub</span>
                    </h1>
                    <p class="max-w-lg mt-4 text-lg leading-8 text-gray-300">
                        Solusi praktis jual beli buku digital. Integrasi pembayaran QRIS otomatis, tanpa ribet konfirmasi manual. Bayar, langsung download.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-10">
                        <a href="{{ route('catalog.index') }}"
                           class="px-8 py-4 bg-white text-red-900 font-bold rounded-xl shadow-[0_0_20px_rgba(255,255,255,0.3)]
                                  hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] hover:scale-105 transition-all duration-300 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            Buka Katalog
                        </a>

                        <a href="#features"
                           class="px-8 py-4 font-semibold text-red-100 transition-all duration-300 border border-red-400 rounded-xl hover:bg-red-900/50">
                            Pelajari Cara Kerja
                        </a>
                    </div>
                </div>

                <div class="relative hidden md:block group">
                    <div class="absolute transition duration-1000 opacity-25 -inset-1 bg-gradient-to-r from-red-600 to-orange-600 rounded-2xl blur group-hover:opacity-75 group-hover:duration-200"></div>
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                         alt="Digital Library"
                         class="relative rounded-2xl shadow-2xl border-4 border-white/10 w-full object-cover h-[400px] transform rotate-2 group-hover:rotate-0 transition-all duration-500 ease-out">

                    <div class="absolute flex items-center gap-3 p-4 bg-white shadow-xl -bottom-6 -left-6 rounded-xl animate-bounce-slow">
                        <div class="p-2 bg-green-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Status Sistem</p>
                            <p class="text-sm font-bold text-gray-800">Auto-Delivery Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-10 border-red-900 bg-red-950 border-y">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="grid grid-cols-2 gap-8 text-center divide-x md:grid-cols-4 divide-red-900/50">
                <div>
                    <p class="text-3xl font-bold text-white">100%</p>
                    <p class="mt-1 text-xs tracking-widest text-red-300 uppercase">Digital</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-white">QRIS</p>
                    <p class="mt-1 text-xs tracking-widest text-red-300 uppercase">Pembayaran</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-white">24/7</p>
                    <p class="mt-1 text-xs tracking-widest text-red-300 uppercase">Akses</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-white">Desktop</p>
                    <p class="mt-1 text-xs tracking-widest text-red-300 uppercase">Optimized</p>
                </div>
            </div>
        </div>
    </div>

    <div id="features" class="py-24 bg-gray-50">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="text-sm font-bold tracking-wide text-red-800 uppercase">Keunggulan Kami</h2>
                <h3 class="mt-2 text-3xl font-extrabold text-gray-900 md:text-4xl">Flow Transaksi Modern</h3>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <div class="p-8 transition-transform duration-300 bg-white border-b-4 border-red-800 shadow-lg rounded-2xl hover:-translate-y-2">
                    <div class="flex items-center justify-center mb-6 text-red-700 bg-red-100 w-14 h-14 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                        </svg>
                    </div>
                    <h4 class="mb-2 text-xl font-bold text-gray-900">QRIS Dynamic</h4>
                    <p class="text-gray-600">Scan kode QR yang unik untuk setiap transaksi. Terverifikasi oleh sistem OrderKuota secara realtime.</p>
                </div>

                <div class="p-8 transition-transform duration-300 bg-white border-b-4 border-red-800 shadow-lg rounded-2xl hover:-translate-y-2">
                    <div class="flex items-center justify-center mb-6 text-red-700 bg-red-100 w-14 h-14 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                    </div>
                    <h4 class="mb-2 text-xl font-bold text-gray-900">Verifikasi Instan</h4>
                    <p class="text-gray-600">Sistem otomatis mendeteksi pembayaran. Tidak perlu kirim bukti transfer ke admin.</p>
                </div>

                <div class="p-8 transition-transform duration-300 bg-white border-b-4 border-red-800 shadow-lg rounded-2xl hover:-translate-y-2">
                    <div class="flex items-center justify-center mb-6 text-red-700 bg-red-100 w-14 h-14 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </div>
                    <h4 class="mb-2 text-xl font-bold text-gray-900">Auto-Delivery</h4>
                    <p class="text-gray-600">File buku digital (PDF/EPUB) langsung tersedia di dashboard user detik itu juga.</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- BEST SELLER SECTION --}}
    <div class="py-12 bg-white">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-sm font-bold tracking-wide text-red-800 uppercase">Pilihan Terbaik</h2>
                    <h3 class="mt-1 text-3xl font-extrabold text-gray-900">Buku Terpopuler</h3>
                </div>
                <a href="{{ route('catalog.index') }}" class="flex items-center gap-2 text-sm font-bold text-red-900 hover:text-red-700 transition">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($books as $book)
                    <div class="catalog-card group rounded-2xl bg-white shadow-lg border border-gray-100 overflow-hidden hover:-translate-y-1 transition-all duration-300 relative flex flex-col h-full">
                        {{-- Cover --}}
                        <div class="relative">
                            @if(!empty($book->cover_path))
                                <img src="{{ asset('storage/'.$book->cover_path) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover"/>
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-xs">No Cover</div>
                            @endif
                            
                            {{-- Clickable Overlay --}}
                            <a href="{{ route('catalog.show', $book->slug) }}" class="absolute inset-0 z-10"></a>

                            <div class="absolute top-2 left-2 z-20">
                                <span class="px-2 py-1 rounded-md bg-white/90 backdrop-blur text-[10px] font-bold text-gray-800 border border-gray-200 shadow-sm">
                                    {{ $book->genre ?? 'Umum' }}
                                </span>
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="font-bold text-gray-900 leading-snug line-clamp-2 mb-1 group-hover:text-red-700 transition">
                                {{ $book->title }}
                            </h3>
                            <div class="text-xs text-gray-500 mb-3">
                                {{ $book->publisher->name ?? 'Admin' }}
                            </div>

                            <div class="mt-auto">
                                <div class="text-lg font-black text-[#5C0F14] mb-3">
                                    Rp {{ number_format($book->price, 0, ',', '.') }}
                                </div>

                                {{-- Action Buttons --}}
                                <div class="grid grid-cols-5 gap-2 relative z-20">
                                    {{-- Detail Button (2 cols) --}}
                                    <a href="{{ route('catalog.show', $book->slug) }}" 
                                       class="col-span-2 flex items-center justify-center py-2 text-xs font-bold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                        Detail
                                    </a>

                                    {{-- Buy Button (2 cols) --}}
                                    <form action="{{ route('cart.add', $book->id) }}" method="POST" class="col-span-2">
                                        @csrf
                                        <button type="submit" class="w-full py-2 text-xs font-bold text-white bg-[#5C0F14] rounded-lg hover:bg-red-900 transition flex items-center justify-center">
                                            Beli
                                        </button>
                                    </form>

                                    {{-- Cart Icon AJAX (1 col) --}}
                                    <button type="button"
                                            onclick="addToCartAjax(event, '{{ route('cart.add', $book->id) }}', this)"
                                            class="col-span-1 flex items-center justify-center rounded-lg bg-orange-100 text-orange-600 hover:bg-orange-200 transition"
                                            title="Tambah ke Keranjang">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-10">Belum ada buku populer.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- INFO SECTIONS (Anchors) --}}
    <div class="bg-gray-50 py-12 space-y-12">
        {{-- FAQ --}}
        <section id="faq" class="scroll-mt-24 bg-white py-10 border-y border-gray-100">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-sm font-bold tracking-wide text-red-800 uppercase mb-2">Bantuan</h2>
                    <h3 class="text-3xl font-extrabold text-gray-900">Pertanyaan Umum (FAQ)</h3>
                </div>

                <div class="space-y-4" x-data="{ active: null }">
                    {{-- Q1 --}}
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <button @click="active = active === 1 ? null : 1" class="flex items-center justify-between w-full px-6 py-4 text-left font-bold text-gray-900 bg-gray-50 hover:bg-gray-100 transition">
                            <span>Bagaimana cara membeli buku?</span>
                            <svg class="w-5 h-5 transform transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 1" x-collapse class="px-6 py-4 text-gray-600 bg-white">
                            Pilih buku di katalog, klik "Beli" atau "Tambah ke Keranjang", lalu lakukan checkout. Pembayaran via QRIS akan diverifikasi otomatis oleh sistem.
                        </div>
                    </div>

                    {{-- Q2 --}}
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <button @click="active = active === 2 ? null : 2" class="flex items-center justify-between w-full px-6 py-4 text-left font-bold text-gray-900 bg-gray-50 hover:bg-gray-100 transition">
                            <span>Apakah file bisa didownload ulang?</span>
                            <svg class="w-5 h-5 transform transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 2" x-collapse class="px-6 py-4 text-gray-600 bg-white">
                            Ya! File buku yang sudah dibeli akan tersimpan di menu "Order Saya" di dashboard dan bisa didownload kapan saja sepuasnya.
                        </div>
                    </div>

                    {{-- Q3 --}}
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <button @click="active = active === 3 ? null : 3" class="flex items-center justify-between w-full px-6 py-4 text-left font-bold text-gray-900 bg-gray-50 hover:bg-gray-100 transition">
                            <span>Metode pembayaran apa yang tersedia?</span>
                            <svg class="w-5 h-5 transform transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 3" x-collapse class="px-6 py-4 text-gray-600 bg-white">
                            Saat ini kami mendukung QRIS (scan pakai GoPay, OVO, Dana, ShopeePay, Mobile Banking) untuk verifikasi instan.
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-main-layout>

<script>
    // AJAX Add to Cart (Shared Logic - reused across pages)
    // AJAX Add to Cart (Shared Logic - reused across pages)
    async function addToCartAjax(event, url, btn) {
        event.preventDefault();
        
        // Visual Feedback Parsing
        const originalContent = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        `;

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            });

            const data = await response.json();

            if (data.success) {
                // Success State
                btn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                `;

                // Dispatch Custom Event to Update Navbar
                window.dispatchEvent(new CustomEvent('cart-updated', { 
                    detail: { count: data.cart_count } 
                }));

            } else {
                console.error('Failed to add to cart');
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            // Reset after 1s
            setTimeout(() => {
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }, 1000);
        }
    }
</script>
