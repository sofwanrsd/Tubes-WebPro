<x-app-layout>
    @php
        $booksTotal      = (int)($booksTotal ?? 0);
        $booksPublished  = (int)($booksPublished ?? 0);
        $salesCount      = (int)($salesCount ?? 0);
        $revenue         = (int)($revenue ?? 0);

        $pctPublished = $booksTotal > 0 ? round(($booksPublished / $booksTotal) * 100) : 0;

        $fmt = fn($n) => 'Rp ' . number_format((int)$n, 0, ',', '.');
    @endphp

    <div class="min-h-[calc(100vh-4rem)] bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-800 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Publisher Studio
                </div>

                <div class="mt-4 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                            Dashboard Publisher
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Kelola buku, pantau penjualan, dan lihat saldo pendapatan.
                        </p>
                    </div>

                    {{-- Quick actions --}}
                    <div class="flex flex-wrap gap-3">

                        @if(\Illuminate\Support\Facades\Route::has('publisher.sales.index'))
                            <a href="{{ route('publisher.sales.index') }}"
                               class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold
                                      hover:bg-gray-50 transition">
                                Lihat Penjualan
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Total books --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="text-xs font-semibold text-gray-500">Total Buku</div>
                    <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ $booksTotal }}</div>
                    <div class="mt-3 text-xs text-gray-500">Jumlah semua buku yang kamu upload</div>
                </div>

                {{-- Published --}}
                <div class="rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold text-red-700">Published</div>
                        <span class="text-xs font-extrabold px-2 py-1 rounded-full bg-white border border-red-200 text-red-700">
                            {{ $pctPublished }}%
                        </span>
                    </div>
                    <div class="mt-2 text-3xl font-extrabold text-red-800">{{ $booksPublished }}</div>
                    <div class="mt-3 h-2 rounded-full bg-white/70 overflow-hidden border border-red-200">
                        <div class="h-full bg-red-300" style="width: {{ $pctPublished }}%"></div>
                    </div>
                    <div class="mt-2 text-xs text-red-900/60">Persentase buku yang tampil di katalog</div>
                </div>

                {{-- Sales --}}
                <div class="rounded-2xl border border-green-200 bg-green-50 p-5 shadow-sm">
                    <div class="text-xs font-semibold text-green-700">Penjualan (Paid Items)</div>
                    <div class="mt-2 text-3xl font-extrabold text-green-800">{{ $salesCount }}</div>
                    <div class="mt-3 text-xs text-green-900/60">Jumlah item yang sudah dibayar</div>
                </div>

                {{-- Revenue --}}
                <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-5 shadow-sm">
                    <div class="text-xs font-semibold text-yellow-700">Saldo</div>
                    <div class="mt-2 text-2xl font-extrabold text-yellow-900">{{ $fmt($revenue) }}</div>
                    <div class="mt-3 text-xs text-yellow-900/60">Pendapatan terkumpul dari penjualan</div>
                </div>
            </div>

            {{-- Panels --}}
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-12 gap-4 items-start">
                {{-- Left: Summary --}}
                <div class="lg:col-span-7">
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="text-lg font-extrabold text-gray-900">Ringkasan</div>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                            Kamu bisa kelola buku yang sudah diupload, update cover, harga, dan status publikasi.
                            Penjualan dihitung dari item yang berstatus <span class="font-bold text-gray-900">paid</span>.
                        </p>

                        <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                                <div class="text-xs font-semibold text-gray-500">Langkah 1</div>
                                <div class="mt-1 text-sm font-extrabold text-gray-900">Upload Buku</div>
                                <div class="mt-1 text-xs text-gray-600">Isi judul, harga, dan file</div>
                            </div>
                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                                <div class="text-xs font-semibold text-gray-500">Langkah 2</div>
                                <div class="mt-1 text-sm font-extrabold text-gray-900">Publish</div>
                                <div class="mt-1 text-xs text-gray-600">Aktifkan agar muncul di katalog</div>
                            </div>
                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                                <div class="text-xs font-semibold text-gray-500">Langkah 3</div>
                                <div class="mt-1 text-sm font-extrabold text-gray-900">Pantau Penjualan</div>
                                <div class="mt-1 text-xs text-gray-600">Lihat order yang sudah paid</div>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('publisher.books.index') }}"
                               class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-red-800 text-white font-extrabold hover:bg-red-700 transition">
                                Kelola Buku
                            </a>

                            @if(\Illuminate\Support\Facades\Route::has('publisher.books.create'))
                                <a href="{{ route('publisher.books.create') }}"
                                   class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold hover:bg-gray-50 transition">
                                    + Tambah Buku
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Right: Payout (seimbang, tanpa tombol) --}}
                <div class="lg:col-span-5">
                    <div class="rounded-2xl border border-red-200 bg-gradient-to-br from-red-50 to-white p-6 shadow-sm sticky top-24">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-lg font-extrabold text-red-900">Pencairan Saldo</div>
                                <p class="mt-2 text-sm text-red-900/70 leading-relaxed">
                                    Untuk pencairan saldo, saat ini masih manual. Silakan hubungi admin untuk proses payout.
                                </p>
                            </div>

                            <span class="inline-flex items-center px-3 py-1 rounded-full border border-red-200 bg-white text-red-700 text-xs font-extrabold">
                                Manual
                            </span>
                        </div>

                        <div class="mt-5 rounded-xl border border-red-200 bg-white px-5 py-4">
                            <div class="text-xs font-semibold text-red-700">Saldo saat ini</div>
                            <div class="mt-1 text-3xl font-extrabold text-red-900">
                                {{ $fmt($revenue) }}
                            </div>
                            <div class="mt-2 text-[11px] text-red-900/60">
                                *Nominal dapat berubah mengikuti transaksi yang baru masuk.
                            </div>
                        </div>

                        <div class="mt-4 rounded-xl border border-red-200/70 bg-white/70 px-4 py-3 text-xs text-red-900/70">
                            Info: Pembayaran yang sudah <span class="font-extrabold">paid</span> akan menambah saldo publisher.
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer full lebar --}}
        <x-footer />
    </div>
</x-app-layout>
