<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-2xl font-bold">{{ $book->title }}</h2>

                @if($book->cover_path)
                    <img class="w-full h-64 object-cover rounded mt-4" src="{{ asset('storage/'.$book->cover_path) }}" alt="{{ $book->title }}">
                @endif

                <div class="mt-4 text-gray-700">
                    {!! nl2br(e($book->description)) !!}
                </div>

                <div class="mt-4 font-semibold">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </div>

                <div class="mt-6">
                    <form method="POST" action="{{ route('cart.add', $book->id) }}">
                        @csrf
                        <button class="px-4 py-2 bg-black text-white rounded">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
