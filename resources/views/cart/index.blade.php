<x-app-layout>
    @php
        $cart = session('cart', []);

        // Normalisasi item cart (qty dipaksa 1)
        $items = [];
        foreach ($cart as $key => $raw) {
            $item = is_array($raw) ? $raw : (array) $raw;

            $id       = $item['id'] ?? (is_numeric($key) ? $key : ($item['book_id'] ?? $key));
            $title    = $item['title'] ?? ($item['name'] ?? ($item['book']['title'] ?? 'Untitled'));
            $price    = (int) ($item['price'] ?? ($item['book']['price'] ?? 0));

            // FIX: qty selalu 1 (buku digital gak perlu lebih dari 1)
            $qty      = 1;

            $coverPath = $item['cover_path'] ?? ($item['cover'] ?? ($item['book']['cover_path'] ?? null));
            $slug      = $item['slug'] ?? ($item['book']['slug'] ?? null);

            $items[] = [
                'id' => $id,
                'title' => $title,
                'price' => $price,
                'qty' => $qty,
                'coverPath' => $coverPath,
                'slug' => $slug,
            ];
        }

        $subtotal = 0;
        foreach ($items as $it) $subtotal += ($it['price'] * $it['qty']);

        $formatRupiah = fn($n) => 'Rp ' . number_format((int)$n, 0, ',', '.');
    @endphp

    {{-- HERO --}}
    <div class="relative bg-gradient-to-br from-red-900 via-red-800 to-black py-12 sm:py-16 overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-950/50 border border-red-500/30 text-red-200 text-xs font-semibold mb-4">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        Keranjang Belanja
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        Review Pesananmu
                    </h1>
                    <p class="mt-2 text-gray-300">
                        Pastikan item sudah sesuai, lalu lanjut checkout.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            @if(count($items) === 0)
                <div class="rounded-2xl border border-gray-200 bg-white p-10 text-center shadow-sm">
                    <div class="mx-auto w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-red-700 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.5l1.5 9h13.5l1.5-7.5H6" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm9 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900">Keranjang kamu kosong</h2>
                    <p class="text-gray-600 mt-2">Yuk pilih buku dulu di katalog.</p>
                    <a href="{{ route('catalog.index') }}"
                       class="inline-block mt-6 px-8 py-3 rounded-xl bg-red-800 text-white font-bold hover:bg-red-700 transition">
                        Buka Katalog
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- LEFT: ITEMS --}}
                    <div class="lg:col-span-2 space-y-5">
                        @foreach($items as $it)
                            @php $lineTotal = $it['price']; @endphp {{-- qty selalu 1 --}}

                            <div class="group rounded-2xl bg-white shadow-lg border border-gray-100 overflow-hidden relative">
                                <div class="p-6 flex flex-col sm:flex-row gap-5">
                                    {{-- Cover --}}
                                    <div class="w-full sm:w-40 shrink-0">
                                        @if(!empty($it['coverPath']))
                                            <img src="{{ str_starts_with($it['coverPath'], 'http') ? $it['coverPath'] : asset('storage/'.$it['coverPath']) }}"
                                                 alt="{{ $it['title'] }}"
                                                 class="w-full h-40 sm:h-28 object-cover rounded-xl border border-gray-100" />
                                        @else
                                            <div class="w-full h-40 sm:h-28 rounded-xl bg-gradient-to-br from-red-900 via-red-700 to-black flex items-center justify-center border border-gray-100">
                                                <div class="text-center px-3">
                                                    <div class="text-white font-extrabold text-sm">Dimz Store</div>
                                                    <div class="text-white/60 text-[11px] mt-1">No cover</div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Info --}}
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <div class="text-lg font-extrabold text-gray-900 leading-snug">
                                                    {{ $it['title'] }}
                                                </div>

                                                <div class="mt-1 text-sm text-gray-600">
                                                    Harga: <span class="font-bold text-red-800">{{ $formatRupiah($it['price']) }}</span>
                                                </div>

                                                {{-- Qty fixed badge --}}
                                                <div class="mt-3 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 text-gray-700 text-xs font-bold">
                                                    Qty: 1 (fixed)
                                                </div>
                                            </div>

                                            {{-- Remove --}}
                                            <div class="shrink-0">
                                                @if(\Illuminate\Support\Facades\Route::has('cart.remove'))
                                                    <form method="POST" action="{{ route('cart.remove', $it['id']) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5h12M9 7.5V6a1.5 1.5 0 0 1 1.5-1.5h3A1.5 1.5 0 0 1 15 6v1.5m-7.5 0 1 13.5A1.5 1.5 0 0 0 10 22.5h4a1.5 1.5 0 0 0 1.5-1.5L16.5 7.5" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-xs text-gray-400">Route cart.remove belum ada</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Total --}}
                                        <div class="mt-5 flex items-center justify-between">
                                            <div class="text-sm text-gray-600 font-semibold">Subtotal item</div>
                                            <div class="text-lg font-extrabold text-gray-900">
                                                {{ $formatRupiah($lineTotal) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- subtle hover glow --}}
                                <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-300">
                                    <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-orange-600 rounded-2xl blur opacity-10"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- RIGHT: SUMMARY --}}
                    <div class="lg:col-span-1">
                        <div class="sticky top-24 rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
                            <div class="p-6 bg-gradient-to-br from-red-900 via-red-800 to-black text-white">
                                <div class="text-sm font-semibold text-white/80">Ringkasan</div>
                                <div class="text-2xl font-extrabold mt-1">Total Pesanan</div>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600 font-semibold">Subtotal</span>
                                    <span class="text-sm font-extrabold text-gray-900">{{ $formatRupiah($subtotal) }}</span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600 font-semibold">Biaya layanan</span>
                                    <span class="text-sm font-extrabold text-gray-900">{{ $formatRupiah(0) }}</span>
                                </div>

                                <div class="border-t pt-4 flex items-center justify-between">
                                    <span class="text-sm text-gray-600 font-semibold">Total</span>
                                    <span class="text-lg font-extrabold text-red-800">{{ $formatRupiah($subtotal) }}</span>
                                </div>

                                <div class="pt-4">
                                    @if(\Illuminate\Support\Facades\Route::has('checkout.index'))
                                        <a href="{{ route('checkout.index') }}"
                                           class="block w-full text-center px-6 py-4 rounded-xl bg-red-800 text-white font-extrabold hover:bg-red-700 transition shadow-[0_0_18px_rgba(185,28,28,0.25)]">
                                            Lanjut Checkout
                                        </a>
                                    @else
                                        <button type="button" disabled
                                                class="w-full px-6 py-4 rounded-xl bg-red-800/60 text-white font-extrabold cursor-not-allowed">
                                            Checkout
                                        </button>
                                    @endif

                                    <a href="{{ route('catalog.index') }}"
                                       class="block w-full text-center mt-3 px-6 py-4 rounded-xl border border-red-200 text-red-800 font-extrabold hover:bg-red-50 transition">
                                        Belanja Lagi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Footer component --}}
    <x-footer />
</x-app-layout>
