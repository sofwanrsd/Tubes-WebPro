<x-app-layout>
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Cover --}}
                    <div class="w-full">
                        <div class="aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden">
                            @if($book->cover_path)
                                <img
                                    src="{{ asset('storage/'.$book->cover_path) }}"
                                    alt="{{ $book->title }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                                    No Image
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Detail --}}
                    <div class="flex flex-col">
                        {{-- Badge --}}
                        <span class="inline-block mb-2 text-xs font-semibold text-[#FF4B2B] uppercase tracking-wide">
                            E-Book
                        </span>

                        {{-- Title --}}
                        <h1 class="text-2xl md:text-3xl font-bold mb-4">
                            {{ $book->title }}
                        </h1>

                        {{-- Description --}}
                        <div class="text-gray-600 leading-relaxed mb-6">
                            {!! nl2br(e($book->description)) !!}
                        </div>

                        {{-- Action Area --}}
                        <div class="border-t pt-6 mt-auto">
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <div class="text-2xl font-bold text-[#FF4B2B]">
                                    Rp {{ number_format($book->price, 0, ',', '.') }}
                                </div>

                                <form method="POST" action="{{ route('cart.add', $book->id) }}">
                                    @csrf
                                    <button
                                        class="px-6 py-3 bg-[#FF4B2B] text-white font-semibold rounded-lg hover:bg-[#e64326] transition"
                                    >
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
