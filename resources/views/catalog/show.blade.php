<x-main-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <div class="mb-4">
                <a
                    href="{{ route('catalog.index') }}"
                    class="inline-flex items-center text-sm text-gray-600 hover:text-[#FF4B2B] transition"
                >
                    <svg
                        class="w-4 h-4 mr-2"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Catalog
                </a>
            </div>

            {{-- Product Card --}}
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12">

                    {{-- Cover (Less Width: 4/12 columns) --}}
                    <div class="md:col-span-4 lg:col-span-4">
                        <div class="aspect-[3/4] bg-gray-100 rounded-2xl shadow-lg border border-gray-200 overflow-hidden relative group">
                            @if($book->cover_path)
                                <img
                                    src="{{ asset('storage/'.$book->cover_path) }}"
                                    alt="{{ $book->title }}"
                                    class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                                >
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-800 to-black flex items-center justify-center text-white/50 text-sm font-medium">
                                    No Cover
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Detail (More Width: 8/12 columns) --}}
                    <div class="md:col-span-8 lg:col-span-8 flex flex-col justify-center">
                        {{-- Badge Genre --}}
                        <div class="flex items-center gap-2 mb-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-[#5C0F14]/10 text-[#5C0F14] ring-1 ring-[#5C0F14]/20">
                                {{ $book->genre ?? 'Digital Book' }}
                            </span>
                            <span class="text-xs text-gray-500 font-medium">
                                Penulis: <span class="font-bold text-gray-800">{{ $book->publisher->name ?? 'Admin' }}</span>
                            </span>
                        </div>

                        {{-- Title --}}
                        <h1 class="text-3xl md:text-5xl font-black mb-5 text-gray-900 tracking-tight leading-tight">
                            {{ $book->title }}
                        </h1>

                        {{-- Description Card --}}
                        <div class="bg-gray-50 rounded-2xl p-6 sm:p-8 border border-gray-100 mb-8">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#5C0F14]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                Sinopsis
                            </h3>
                            <div class="text-gray-600 leading-relaxed prose prose-lg max-w-none">
                                {!! nl2br(e($book->description)) !!}
                            </div>
                        </div>

                        {{-- Action Area --}}
                        <div class="border-t border-gray-100 pt-8 mt-auto">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                                <div>
                                    <div class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Harga Spesial</div>
                                    <div class="text-4xl font-black text-[#5C0F14]">
                                        Rp {{ number_format($book->price, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="flex gap-3 w-full sm:w-auto">
                                    @if(isset($isPurchased) && $isPurchased)
                                        <button disabled class="w-full sm:w-auto px-10 h-14 bg-gray-200 text-gray-500 font-bold text-lg rounded-2xl cursor-not-allowed">
                                            Sudah Dimiliki
                                        </button>
                                        <a href="{{ route('library.index') }}" class="w-full sm:w-auto px-6 h-14 flex items-center justify-center bg-[#E6B65C] text-[#5C0F14] font-bold text-lg rounded-2xl hover:bg-[#d4a040] transition">
                                            Baca
                                        </a>
                                    @else
                                        {{-- Keranjang (Icon) AJAX --}}
                                        <button type="button"
                                                onclick="addToCartAjax(event, '{{ route('cart.add', $book->id) }}', this)"
                                                class="h-14 w-14 flex items-center justify-center rounded-2xl border-2 border-[#5C0F14]/20 text-[#5C0F14] hover:bg-[#5C0F14] hover:text-[#E6B65C] transition group" 
                                                title="Tambah ke Keranjang">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </button>
                                        
                                        {{-- Beli (Primary) --}}
                                        <form method="POST" action="{{ route('cart.add', $book->id) }}" class="flex-1 sm:flex-none">
                                            @csrf
                                            <button class="w-full sm:w-auto px-10 h-14 bg-[#5C0F14] text-[#E6B65C] font-bold text-lg rounded-2xl hover:bg-[#4a0c10] shadow-xl shadow-[#5C0F14]/20 transition transform hover:-translate-y-1">
                                                Beli Sekarang
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-main-layout>

<script>
    // AJAX Add to Cart (Shared Logic - could be moved to main layout but fine here for specific use)
    async function addToCartAjax(event, url, btn) {
        event.preventDefault();
        
        // Visual Feedback Parsing
        const originalContent = btn.innerHTML;
        const originalClasses = btn.className;
        
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-6 w-6 text-[#5C0F14]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                `;
            } else {
                console.error('Failed to add to cart');
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            // Reset after 1.5s
            setTimeout(() => {
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }, 1500);
        }
    }
</script>
