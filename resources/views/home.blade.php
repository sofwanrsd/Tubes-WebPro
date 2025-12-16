<x-app-layout>
    <div class="relative bg-gradient-to-br from-red-900 via-red-800 to-black py-20 sm:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-left animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-950/50 border border-red-500/30 text-red-200 text-xs font-semibold mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        Platform Resmi Mahasiswa TI Telkom
                    </div>
                    <h1 class="text-5xl font-extrabold tracking-tight text-white sm:text-6xl mb-6 leading-tight">
                        Dimz Store <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-300">Digital Knowledge Hub</span>
                    </h1>
                    <p class="mt-4 text-lg leading-8 text-gray-300 max-w-lg">
                        Solusi praktis jual beli buku digital. Integrasi pembayaran QRIS otomatis, tanpa ribet konfirmasi manual. Bayar, langsung download.
                    </p>

                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="{{ route('catalog.index') }}"
                           class="px-8 py-4 bg-white text-red-900 font-bold rounded-xl shadow-[0_0_20px_rgba(255,255,255,0.3)]
                                  hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] hover:scale-105 transition-all duration-300 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            Buka Katalog
                        </a>

                        <a href="#features"
                           class="px-8 py-4 border border-red-400 text-red-100 font-semibold rounded-xl hover:bg-red-900/50 transition-all duration-300">
                            Pelajari Cara Kerja
                        </a>
                    </div>
                </div>

                <div class="relative hidden md:block group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-orange-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                         alt="Digital Library"
                         class="relative rounded-2xl shadow-2xl border-4 border-white/10 w-full object-cover h-[400px] transform rotate-2 group-hover:rotate-0 transition-all duration-500 ease-out">

                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl flex items-center gap-3 animate-bounce-slow">
                        <div class="bg-green-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Status Sistem</p>
                            <p class="text-sm font-bold text-gray-800">Auto-Delivery Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-red-950 py-10 border-y border-red-900">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-red-900/50">
                <div>
                    <p class="text-3xl font-bold text-white">100%</p>
                    <p class="text-xs text-red-300 uppercase tracking-widest mt-1">Digital</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-white">QRIS</p>
                    <p class="text-xs text-red-300 uppercase tracking-widest mt-1">Pembayaran</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-white">24/7</p>
                    <p class="text-xs text-red-300 uppercase tracking-widest mt-1">Akses</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-white">Desktop</p>
                    <p class="text-xs text-red-300 uppercase tracking-widest mt-1">Optimized</p>
                </div>
            </div>
        </div>
    </div>

    <div id="features" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-red-800 font-bold tracking-wide uppercase text-sm">Keunggulan Kami</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Flow Transaksi Modern</h3>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-red-800 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6 text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">QRIS Dynamic</h4>
                    <p class="text-gray-600">Scan kode QR yang unik untuk setiap transaksi. Terverifikasi oleh sistem Xendit secara realtime.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-red-800 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6 text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Verifikasi Instan</h4>
                    <p class="text-gray-600">Sistem otomatis mendeteksi pembayaran. Tidak perlu kirim bukti transfer ke admin.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-red-800 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6 text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Auto-Delivery</h4>
                    <p class="text-gray-600">File buku digital (PDF/EPUB) langsung tersedia di dashboard user detik itu juga.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Universal Footer --}}
    <x-footer />
</x-app-layout>
