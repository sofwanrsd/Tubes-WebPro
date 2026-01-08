@php
    // Extract unique genres and authors from the visible books for the filter dropdowns
    $genres = $books->pluck('genre')->unique()->filter()->values();
    $authors = $books->pluck('publisher.name')->unique()->filter()->values();
@endphp

<x-main-layout>
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
                        </div>
                    </div>
                </div>

                {{-- RIGHT: SEARCH + SORT + FILTER --}}
                <div class="w-full">
                    <div class="rounded-2xl border border-white/10 bg-black/20 backdrop-blur p-5">
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <div class="text-sm font-extrabold text-white">Filter Katalog</div>
                            <div class="text-[11px] text-white/55">
                                client-side
                            </div>
                        </div>

                        {{-- Search --}}
                        <div class="text-xs font-semibold text-white/80 mb-2">Cari judul</div>
                        <div class="flex flex-col sm:flex-row gap-2 mb-4">
                            <input id="catalogSearch"
                                   type="text"
                                   placeholder="Contoh: Algoritma..."
                                   class="w-full rounded-xl bg-black/30 border border-white/15 text-white placeholder-white/40 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-white/20">
                            <button id="catalogClear"
                                    type="button"
                                    class="sm:w-auto w-full rounded-xl px-4 py-3 border border-white/15 text-white/90 bg-black/20 hover:bg-black/30 transition">
                                Reset
                            </button>
                        </div>

                        {{-- Filters Grid --}}
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div>
                                <div class="text-xs font-semibold text-white/80 mb-2">Genre</div>
                                <select id="catalogGenre" class="w-full rounded-xl bg-black/30 border border-white/15 text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-white/20">
                                    <option value="">Semua Genre</option>
                                    @foreach($genres as $g)
                                        <option value="{{ strtolower($g) }}">{{ $g }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-white/80 mb-2">Penulis</div>
                                <select id="catalogAuthor" class="w-full rounded-xl bg-black/30 border border-white/15 text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-white/20">
                                    <option value="">Semua Penulis</option>
                                    @foreach($authors as $a)
                                        <option value="{{ strtolower($a) }}">{{ $a }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Sort --}}
                        <div class="text-xs font-semibold text-white/80 mb-2">Urutkan</div>
                        <select id="catalogSort"
                                class="w-full rounded-xl bg-black/30 border border-white/15 text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-white/20">
                            <option value="az">Judul (A–Z)</option>
                            <option value="za">Judul (Z–A)</option>
                            <option value="price_asc">Harga (Termurah)</option>
                            <option value="price_desc">Harga (Termahal)</option>
                        </select>
                    </div>
                </div>
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
                        data-genre="{{ strtolower($book->genre ?? '') }}"
                        data-author="{{ strtolower($book->publisher->name ?? '') }}"
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
                        <div class="p-6 relative">
                            {{-- Clickable Area for Detail (Covering Card) --}} 
                            <a href="{{ route('catalog.show', $book->slug) }}" class="absolute inset-0 z-10"></a>

                            <div class="mb-3">
                                <div class="text-xs font-semibold text-[#5C0F14] bg-[#5C0F14]/10 inline-block px-2 py-1 rounded-md mb-1">
                                    {{ $book->genre ?? 'Umum' }}
                                </div>
                                <h3 class="text-lg font-extrabold text-gray-900 leading-snug line-clamp-2">
                                    {{ $book->title }}
                                </h3>
                                <div class="text-xs text-gray-500 mt-1">
                                    Oleh: <span class="font-bold text-gray-700">{{ $book->publisher->name ?? 'Admin' }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <div class="text-sm text-gray-500">Harga</div>
                                <div class="text-base font-extrabold text-[#5C0F14]">
                                    Rp {{ number_format($book->price ?? 0, 0, ',', '.') }}
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="flex gap-2 relative z-20">
                                {{-- 1. Detail --}}
                                <a href="{{ route('catalog.show', $book->slug) }}"
                                   class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-gray-700 font-bold text-sm text-center hover:bg-gray-50 transition">
                                    Detail
                                </a>

                                @php
                                    $isOwned = in_array($book->id, $purchasedBookIds ?? []);
                                @endphp

                                @if($isOwned)
                                    <button disabled
                                            class="w-full px-3 py-2.5 rounded-xl bg-gray-100 text-gray-400 font-extrabold text-sm cursor-not-allowed border border-gray-200">
                                        Dimiliki
                                    </button>
                                @else
                                    {{-- 2. Beli --}}
                                    <form method="POST" action="{{ route('cart.add', $book->id) }}" class="flex-1">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-3 py-2.5 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-extrabold text-sm hover:bg-[#4a0c10] transition shadow-md">
                                            Beli
                                        </button>
                                    </form>

                                    {{-- 3. Cart Icon (AJAX) --}}
                                    <button type="button"
                                            onclick="addToCartAjax(event, '{{ route('cart.add', $book->id) }}', this)"
                                            class="px-3 py-2.5 rounded-xl border border-[#5C0F14] text-[#5C0F14] hover:bg-[#5C0F14] hover:text-[#E6B65C] transition group/cart"
                                            title="Tambah ke Keranjang">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-active/cart:scale-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>
                                @endif
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

    {{-- Client-side search + sort + filter --}}
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('catalogSearch');
        const clear = document.getElementById('catalogClear');
        const sort  = document.getElementById('catalogSort');
        const genre = document.getElementById('catalogGenre');
        const author= document.getElementById('catalogAuthor');

        const grid  = document.getElementById('catalogGrid');
        const count = document.getElementById('catalogCount');

        if (!grid) return;

        const getCards = () => Array.from(grid.querySelectorAll('.catalog-card'));

        const updateCount = (n) => { if (count) count.textContent = String(n); };

        const applyAll = () => {
          const q = (input?.value || '').trim().toLowerCase();
          const s = (sort?.value || 'az');
          const g = (genre?.value || '').toLowerCase();
          const a = (author?.value || '').toLowerCase();

          const cards = getCards();
          let visibleCount = 0;

          // 1. FILTER
          cards.forEach(c => {
             const title = (c.getAttribute('data-title') || '');
             const cGenre = (c.getAttribute('data-genre') || '');
             const cAuthor = (c.getAttribute('data-author') || '');

             const matchText = (q === '' || title.includes(q));
             const matchGenre = (g === '' || cGenre.includes(g) || cGenre === g);
             const matchAuthor = (a === '' || cAuthor.includes(a) || cAuthor === a);

             if (matchText && matchGenre && matchAuthor) {
                 c.style.display = '';
                 visibleCount++;
             } else {
                 c.style.display = 'none';
             }
          });

          updateCount(visibleCount);

          // 2. SORT
          // Only sort visible cards? Actually we can sort all and display updates handles visibility.
          // But appending reorders DOM.
          
          const visibleCards = cards.filter(c => c.style.display !== 'none');
          const hiddenCards  = cards.filter(c => c.style.display === 'none');

          const titleOf = (c) => (c.getAttribute('data-title') || '');
          const priceOf = (c) => parseInt(c.getAttribute('data-price') || '0', 10);

          visibleCards.sort((x, y) => {
            if (s === 'az') return titleOf(x).localeCompare(titleOf(y));
            if (s === 'za') return titleOf(y).localeCompare(titleOf(x));
            if (s === 'price_asc') return priceOf(x) - priceOf(y);
            if (s === 'price_desc') return priceOf(y) - priceOf(x);
            return 0;
          });

          // Re-append to grid
          [...visibleCards, ...hiddenCards].forEach(c => grid.appendChild(c));
        };

        // Events
        input?.addEventListener('input', applyAll);
        sort?.addEventListener('change', applyAll);
        genre?.addEventListener('change', applyAll);
        author?.addEventListener('change', applyAll);

        clear?.addEventListener('click', () => { 
            if (input) input.value = ''; 
            // Let's just clear text as the button is near text input.
            // If user wants full reset, they manually reset selects.
            // But let's act as "Reset All" since it says "Reset".
            if (genre) genre.value = '';
            if (author) author.value = '';
            applyAll(); 
        });

        // Initial run
        applyAll();
      });
    </script>
    <script>
        // AJAX Add to Cart (Shared Logic)
        async function addToCartAjax(event, url, btn) {
            event.preventDefault();
            
            // Visual Feedback Parsing
            const originalContent = btn.innerHTML;
            btn.disabled = true;
            // Keep button size consistent
            btn.style.width = getComputedStyle(btn).width;
            btn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mx-auto text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto text-green-600" viewBox="0 0 20 20" fill="currentColor">
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
                    btn.style.width = '';
                }, 1000);
            }
        }
    </script>
</x-main-layout>
