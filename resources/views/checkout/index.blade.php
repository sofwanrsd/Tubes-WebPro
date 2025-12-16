<x-app-layout>
    <div class="min-h-[calc(100vh-4rem)] flex flex-col bg-gradient-to-b from-red-950 via-red-900 to-black">
        <div class="flex-1 py-10">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 px-4">

                {{-- Header --}}
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-white/90 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        Checkout
                    </div>

                    <h2 class="mt-4 text-3xl font-extrabold text-white tracking-tight">
                        Konfirmasi Pesanan
                    </h2>
                    <p class="mt-2 text-white/70">
                        Cek item kamu dulu, lalu lanjut buat order & pembayaran.
                    </p>
                </div>

                {{-- Card --}}
                <div class="bg-white/95 backdrop-blur shadow-2xl rounded-2xl border border-white/20 overflow-hidden">

                    {{-- Top bar --}}
                    <div class="px-6 py-5 bg-gradient-to-r from-red-800 via-red-700 to-red-800 text-white">
                        <div class="flex items-center justify-between">
                            <div class="font-extrabold text-lg">Ringkasan Item</div>
                            <div class="text-sm text-white/80">
                                {{ is_countable($items) ? count($items) : 0 }} item
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- Items --}}
                        <div class="space-y-3">
                            @foreach($items as $it)
                                <div class="flex items-center justify-between gap-4 rounded-xl border border-gray-200 bg-white px-4 py-3 hover:bg-gray-50 transition">
                                    <div class="min-w-0">
                                        <div class="font-bold text-gray-900 truncate">
                                            {{ $it['title'] }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-0.5">
                                            Digital item • Auto-delivery • Qty: 1
                                        </div>
                                    </div>

                                    <div class="shrink-0 text-right">
                                        <div class="text-xs text-gray-500 font-semibold">Harga</div>
                                        <div class="font-extrabold text-red-800">
                                            Rp {{ number_format($it['price'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- TOTAL AKHIR (subtotal ditaro di bawah sini) --}}
                        <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-xs font-bold text-gray-800 uppercase tracking-wide">
                                        Total Akhir
                                    </div>
                                    <div class="text-sm text-gray-600 mt-1">
                                        Saat QRIS muncul, sistem akan menambahkan <span class="font-bold text-gray-900">kode unik</span>
                                        (auto-generate) supaya pembayaran terdeteksi realtime.
                                    </div>
                                </div>
                                <div class="shrink-0">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 text-gray-700 text-xs font-bold">
                                        Pending
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4">
                                <div class="space-y-2 text-sm">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-700 font-semibold">Subtotal</span>
                                        <span class="font-extrabold text-gray-900">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-700 font-semibold">Kode unik QRIS</span>
                                        <span class="font-extrabold text-gray-500">akan muncul</span>
                                    </div>

                                    <div class="border-t border-red-200/70 pt-3 flex items-center justify-between">
                                        <span class="text-gray-700 font-semibold">Perkiraan total</span>
                                        <span class="font-extrabold text-red-800">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}+
                                        </span>
                                    </div>

                                    <div class="text-[11px] text-gray-600 mt-2">
                                        *Total akhir bisa berubah sedikit (kode unik) setelah kamu klik lanjut bayar.
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Form --}}
                        <form method="POST" action="{{ route('checkout.submit') }}" class="mt-6 space-y-4">
                            @csrf

                            <label class="flex items-start gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 hover:bg-gray-50 transition cursor-pointer">
                                <input type="checkbox" name="agree" value="1"
                                       class="mt-1 rounded border-gray-300 text-red-700 focus:ring-red-200">
                                <span class="text-sm text-gray-700">
                                    Saya menyetujui <span class="font-bold text-gray-900">Syarat & Ketentuan</span>.
                                    <span class="block text-xs text-gray-500 mt-1">
                                        Setelah pembayaran terverifikasi, file digital tersedia otomatis di akun kamu.
                                    </span>
                                </span>
                            </label>

                            @error('agree')
                                <div class="text-red-600 text-sm font-semibold">{{ $message }}</div>
                            @enderror

                            <button
                                class="w-full px-5 py-3 bg-red-800 text-white rounded-xl font-extrabold
                                       hover:bg-red-700 transition shadow-[0_0_18px_rgba(185,28,28,0.25)]
                                       focus:outline-none focus:ring-2 focus:ring-red-300">
                                Buat Order & Lanjut Bayar
                            </button>

                            <div class="text-center text-[11px] text-gray-500">
                                Dengan menekan tombol di atas, kamu akan lanjut ke proses pembayaran (QRIS).
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Universal Footer --}}
        <x-footer />
    </div>
</x-app-layout>
