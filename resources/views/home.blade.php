<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow rounded">
                <h1 class="text-2xl font-bold">Selamat datang di Dimz Store</h1>
                <p class="mt-2 text-gray-600">Beli e-book, bayar QRIS, verifikasi otomatis, lalu download.</p>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('catalog.index') }}" class="px-4 py-2 bg-black text-white rounded">Lihat Catalog</a>
                    <a href="{{ route('cart.index') }}" class="px-4 py-2 border rounded">Cart</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
