<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Dashboard Publisher</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 shadow rounded">Total Buku: <b>{{ $booksTotal }}</b></div>
                <div class="bg-white p-4 shadow rounded">Published: <b>{{ $booksPublished }}</b></div>
                <div class="bg-white p-4 shadow rounded">Penjualan (Paid Items): <b>{{ $salesCount }}</b></div>
                <div class="bg-white p-4 shadow rounded">Saldo: <b>Rp {{ number_format($revenue,0,',','.') }}</b></div>
            </div>

            <div class="bg-white p-6 shadow rounded mt-6">
                <p class="text-gray-700">
                    Untuk pencairan saldo, silakan hubungi admin.
                </p>
                <div class="mt-4">
                    <a href="{{ route('publisher.books.index') }}" class="px-4 py-2 bg-black text-white rounded">Kelola Buku</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
