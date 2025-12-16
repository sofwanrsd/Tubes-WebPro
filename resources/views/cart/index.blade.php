<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Cart</h2>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow rounded p-6">
                @if(empty($items))
                    <p>Keranjang masih kosong.</p>
                @else
                    <div class="space-y-3">
                        @foreach($items as $it)
                            <div class="flex justify-between border-b pb-2">
                                <div>
                                    <div class="font-semibold">{{ $it['title'] }}</div>
                                    <div class="text-sm text-gray-600">Rp {{ number_format($it['price'], 0, ',', '.') }}</div>
                                </div>
                                <form method="POST" action="{{ route('cart.remove', $it['book_id']) }}">
                                    @csrf
                                    <button class="text-red-600 text-sm">Hapus</button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 font-bold">
                        Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('checkout.index') }}" class="px-4 py-2 bg-black text-white rounded">Checkout</a>

                        <form method="POST" action="{{ route('cart.clear') }}">
                            @csrf
                            <button class="px-4 py-2 border rounded">Clear</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
