<x-dashboard-layout>
    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                Digital Library
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-2">
                        Koleksi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Buku Saya</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Semua buku yang sudah kamu beli tersimpan di sini. Download dan baca kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if($myBooks->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($myBooks as $item)
                @php $book = $item->book; @endphp
                @if(!$book) @continue @endif
                <div class="group relative rounded-2xl bg-white border border-gray-100 shadow-lg overflow-hidden flex flex-col h-full hover:-translate-y-1 transition-all duration-300">
                    {{-- Cover --}}
                    <div class="relative w-full aspect-[3/4] overflow-hidden bg-gray-100">
                        @if($book->cover_path)
                            <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-gray-400">No Cover</div>
                        @endif
                        
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60"></div>
                        
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                             <div class="text-[10px] font-bold uppercase tracking-wider text-[#E6B65C] mb-1">{{ $book->genre }}</div>
                             <h3 class="font-bold leading-tight line-clamp-2">{{ $book->title }}</h3>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="p-4 mt-auto">
                        <div class="text-xs text-gray-500 mb-4">
                            Oleh: <span class="font-bold text-gray-800">{{ $book->publisher->name ?? 'Unknown' }}</span>
                        </div>
                        
                        {{-- Download Button --}}
                        <a href="{{ route('orders.download', ['orderId' => $item->order_id, 'bookId' => $book->id]) }}" 
                           class="flex items-center justify-center w-full px-4 py-2.5 rounded-xl bg-[#5C0F14] text-white text-sm font-bold hover:bg-[#4a0b10] hover:shadow-lg hover:shadow-red-900/30 transition-all group/btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="rounded-3xl border border-dashed border-gray-300 bg-gray-50 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <h3 class="text-xl font-bold text-gray-900">Belum ada koleksi buku</h3>
            <p class="text-gray-500 mt-2 mb-6">Kamu belum membeli buku apapun. Yuk cari buku favoritmu!</p>
            <a href="{{ route('catalog.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-[#E6B65C] text-[#5C0F14] font-bold hover:bg-[#d4a040] transition">
                Buka Katalog
            </a>
        </div>
    @endif
</x-dashboard-layout>
