<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Catalog</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($books as $book)
                    <div class="bg-white shadow rounded p-4">
                        @if($book->cover_path)
                            <img class="w-full h-48 object-cover rounded" src="{{ asset('storage/'.$book->cover_path) }}" alt="{{ $book->title }}">
                        @endif

                        <div class="mt-3">
                            <div class="font-semibold">{{ $book->title }}</div>
                            <div class="text-sm text-gray-600">Rp {{ number_format($book->price, 0, ',', '.') }}</div>

                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('catalog.show', $book->slug) }}" class="px-3 py-2 border rounded text-sm">Detail</a>

                                <form method="POST" action="{{ route('cart.add', $book->id) }}">
                                    @csrf
                                    <button class="px-3 py-2 bg-black text-white rounded text-sm">Tambah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
