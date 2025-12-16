<x-app-layout>
<<<<<<< HEAD
    {{-- HERO --}}
    <div class="relative bg-gradient-to-br from-red-900 via-red-800 to-black py-14 sm:py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            {{-- BIKIN SEIMBANG: grid 2 kolom + items-center (vertical align) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                {{-- LEFT --}}
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-950/50 border border-red-500/30 text-red-200 text-xs font-semibold mb-5">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        Katalog Buku Digital
                    </div>

                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        Temukan Buku
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-300">Favoritmu</span>
                    </h1>

                    <p class="mt-4 text-base sm:text-lg text-gray-300 leading-relaxed">
                        Pilih e-book, bayar QRIS, dan file langsung tersedia otomatis di akun kamu.
                    </p>

                    {{-- Small highlight biar kiri ga kosong --}}
                    <div class="mt-6 grid grid-cols-3 gap-3 max-w-lg">
                        <div class="rounded-xl border border-white/10 bg-black/20 backdrop-blur px-4 py-3">
                            <div class="text-xs text-white/60 font-semibold">Pembayaran</div>
                            <div class="text-sm text-white font-extrabold mt-1">QRIS</div>
                        </div>
                        <div class="rounded-xl border border-white/10 bg-black/20 backdrop-blur px-4 py-3">
                            <div class="text-xs text-white/60 font-semibold">Akses</div>
                            <div class="text-sm text-white font-extrabold mt-1">24/7</div>
                        </div>
                        <div class="rounded-xl border border-white/10 bg-black/20 backdrop-blur px-4 py-3">
                            <div class="text-xs text-white/60 font-semibold">Delivery</div>
                            <div class="text-sm text-white font-extrabold mt-1">Auto</div>
=======
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Catalog</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($books as $book)
                    <div
                        class="bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 overflow-hidden group"
                    >
                        {{-- Cover --}}
                        <div class="h-52 bg-gray-100 overflow-hidden">
                            @if($book->cover_path)
                                <img
                                    src="{{ asset('storage/'.$book->cover_path) }}"
                                    alt="{{ $book->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                                    No Image
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-5">
                            <h3 class="font-semibold text-lg line-clamp-2">
                                {{ $book->title }}
                            </h3>

                            <p class="mt-2 text-[#FF4B2B] font-bold text-lg">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </p>

                            <div class="mt-4 flex items-center justify-between">
                                <a
                                    href="{{ route('catalog.show', $book->slug) }}"
                                    class="text-sm text-gray-600 hover:text-[#FF4B2B] transition"
                                >
                                    Detail
                                </a>

                                <form method="POST" action="{{ route('cart.add', $book->id) }}">
                                    @csrf
                                    <button
                                        class="px-4 py-2 text-sm font-medium text-white bg-[#FF4B2B] rounded-lg hover:bg-[#e64326] transition"
                                    >
                                        Tambah
                                    </button>
                                </form>
                            </div>
>>>>>>> 627639f4d33a3f7438a09914e7701c92fd66a1db
                        </div>
                    </div>
                </div>

<<<<<<< HEAD
                {{-- RIGHT: SEARCH + SORT --}}
                <div class="w-full">
                    <div class="rounded-2xl border border-white/10 bg-black/20 backdrop-blur p-5">
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <div class="text-sm font-extrabold text-white">Filter Katalog</div>
                            <div class="text-[11px] text-white/55">
                                client-side
                            </div>
                        </div>

                        <div class="text-xs font-semibold text-white/80 mb-2">Cari judul buku</div>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input id="catalogSearch"
                                   type="text"
                                   placeholder="Contoh: Algoritma, Basis Data..."
                                   class="w-full rounded-xl bg-black/30 border border-white/15 text-white placeholder-white/40 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-white/20">
                            <button id="catalogClear"
                                    type="button"
                                    class="sm:w-auto w-full rounded-xl px-4 py-3 border border-white/15 text-white/90 bg-black/20 hover:bg-black/30 transition">
                                Reset
                            </button>
                        </div>

                        <div class="mt-4 text-xs font-semibold text-white/80 mb-2">Urutkan</div>
                        <select id="catalogSort"
                                class="w-full rounded-xl bg-black/30 border border-white/15 text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-white/20">
                            <option value="az">Judul (A–Z)</option>
                            <option value="za">Judul (Z–A)</option>
                            <option value="price_asc">Harga (Termurah)</option>
                            <option value="price_desc">Harga (Termahal)</option>
                        </select>

                        <div class="mt-4 rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-xs text-white/70">
                            Tips: pakai <span class="text-white font-semibold">A–Z</span> buat cari cepat, atau urutkan harga buat nemu yang termurah.
                        </div>
                    </div>
                </div>
=======
            {{-- Pagination --}}
            <div class="mt-8">
                {{ $books->links() }}
>>>>>>> 627639f4d33a3f7438a09914e7701c92fd66a1db
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            {{-- INFO BAR --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-xl font-extrabold text-gray-900">Daftar Buku</h2>
                    <p class="text-sm text-gray-600">Klik detail atau langsung tambah ke keranjang.</p>
                </div>

                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 bg-white shadow-sm">
                    <span class="text-xs font-semibold text-gray-500">Total tampil:</span>
                    <span id="catalogCount" class="text-sm font-extrabold text-gray-900">
                        {{ isset($books) ? (method_exists($books, 'total') ? $books->total() : $books->count()) : 0 }}
                    </span>
                </div>
            </div>

            {{-- GRID --}}
            <div id="catalogGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse($books as $book)
                    <div
                        class="catalog-card group rounded-2xl bg-white shadow-lg border border-gray-100 overflow-hidden hover:-translate-y-1 transition-all duration-300 relative"
                        data-title="{{ strtolower($book->title ?? '') }}"
                        data-price="{{ (int)($book->price ?? 0) }}"
                    >
                        {{-- Cover --}}
                        <div class="relative">
                            @if(!empty($book->cover_path))
                                <img
                                    src="{{ asset('storage/'.$book->cover_path) }}"
                                    alt="{{ $book->title }}"
                                    class="w-full h-52 object-cover"
                                />
                            @else
                                <div class="w-full h-52 bg-gradient-to-br from-red-900 via-red-700 to-black flex items-center justify-center">
                                    <div class="text-center px-6">
                                        <div class="text-white font-extrabold text-lg">Dimz Store</div>
                                        <div class="text-white/60 text-xs mt-1">No cover</div>
                                    </div>
                                </div>
                            @endif

                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-300"
                                 style="background: linear-gradient(to top, rgba(0,0,0,.55), rgba(0,0,0,0));"></div>

                            <div class="absolute top-3 left-3">
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-white text-xs font-semibold backdrop-blur">
                                    <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                    Ready
                                </div>
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="p-6">
                            <h3 class="text-lg font-extrabold text-gray-900 leading-snug line-clamp-2">
                                {{ $book->title }}
                            </h3>

                            <div class="mt-2 flex items-center justify-between">
                                <div class="text-sm text-gray-500">Harga</div>
                                <div class="text-base font-extrabold text-red-800">
                                    Rp {{ number_format($book->price ?? 0, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="mt-5 flex gap-3">
                                <a href="{{ route('catalog.show', $book->slug) }}"
                                   class="flex-1 px-4 py-3 rounded-xl border border-red-200 text-red-800 font-bold text-sm text-center hover:bg-red-50 transition">
                                    Detail
                                </a>

                                <form method="POST" action="{{ route('cart.add', $book->id) }}" class="flex-1">
                                    @csrf
                                    <button type="submit"
                                            class="w-full px-4 py-3 rounded-xl bg-red-800 text-white font-extrabold text-sm hover:bg-red-700 transition shadow-[0_0_18px_rgba(185,28,28,0.25)]">
                                        + Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Glow hover --}}
                        <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-orange-600 rounded-2xl blur opacity-10"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="rounded-2xl border border-gray-200 bg-white p-10 text-center shadow-sm">
                            <div class="text-2xl font-extrabold text-gray-900">Belum ada buku</div>
                            <p class="text-gray-600 mt-2">Coba lagi nanti ya.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if(isset($books) && method_exists($books, 'links'))
                <div class="mt-10">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Universal Footer --}}
    <x-footer />

    {{-- Client-side search + sort (no backend change) --}}
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('catalogSearch');
        const clear = document.getElementById('catalogClear');
        const sort  = document.getElementById('catalogSort');
        const grid  = document.getElementById('catalogGrid');
        const count = document.getElementById('catalogCount');

        if (!grid) return;

        const getCards = () => Array.from(grid.querySelectorAll('.catalog-card'));

        const updateCount = (n) => { if (count) count.textContent = String(n); };

        const applySearch = () => {
          const q = (input?.value || '').trim().toLowerCase();
          let visible = 0;

          getCards().forEach((c) => {
            const t = (c.getAttribute('data-title') || '');
            const ok = q === '' || t.includes(q);
            c.style.display = ok ? '' : 'none';
            if (ok) visible++;
          });

          updateCount(visible);
        };

        const applySort = () => {
          const mode = (sort?.value || 'az');
          const cards = getCards();

          const visibleCards = cards.filter(c => c.style.display !== 'none');
          const hiddenCards  = cards.filter(c => c.style.display === 'none');

          const titleOf = (c) => (c.getAttribute('data-title') || '');
          const priceOf = (c) => parseInt(c.getAttribute('data-price') || '0', 10);

          visibleCards.sort((a, b) => {
            if (mode === 'az') return titleOf(a).localeCompare(titleOf(b));
            if (mode === 'za') return titleOf(b).localeCompare(titleOf(a));
            if (mode === 'price_asc') return priceOf(a) - priceOf(b);
            if (mode === 'price_desc') return priceOf(b) - priceOf(a);
            return 0;
          });

          [...visibleCards, ...hiddenCards].forEach(c => grid.appendChild(c));
        };

        const applyAll = () => {
          applySearch();
          applySort();
        };

        input?.addEventListener('input', applyAll);
        clear?.addEventListener('click', () => { if (input) input.value = ''; applyAll(); });
        sort?.addEventListener('change', applyAll);

        applyAll();
      });
    </script>
</x-app-layout>
