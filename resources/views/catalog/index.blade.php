<x-app-layout>
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
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
