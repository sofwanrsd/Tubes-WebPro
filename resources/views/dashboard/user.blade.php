<x-app-layout>
    @php
        $total   = (int)($total ?? 0);
        $paid    = (int)($paid ?? 0);
        $pending = (int)($pending ?? 0);
        $expired = (int)($expired ?? 0);

        $pct = fn($n) => $total > 0 ? round(($n / $total) * 100) : 0;
        $paidPct = $pct($paid);
        $pendingPct = $pct($pending);
        $expiredPct = $pct($expired);
    @endphp

    {{-- Page background putih --}}
    <div class="min-h-[calc(100vh-4rem)] bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-800 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Dashboard
                </div>

                <div class="mt-4 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                            Dashboard User
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Ringkasan transaksi dan akses cepat ke fitur utama.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Stats cards (merah cuma aksen) --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Total --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="text-xs font-semibold text-gray-500">Total Transaksi</div>
                    <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ $total }}</div>
                    <div class="mt-3 text-xs text-gray-500">Semua order yang pernah dibuat</div>
                </div>

                {{-- Paid --}}
                <div class="rounded-2xl border border-green-200 bg-green-50 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold text-green-700">Paid</div>
                        <span class="text-xs font-extrabold px-2 py-1 rounded-full bg-white border border-green-200 text-green-700">
                            {{ $paidPct }}%
                        </span>
                    </div>
                    <div class="mt-2 text-3xl font-extrabold text-green-800">{{ $paid }}</div>
                    <div class="mt-3 h-2 rounded-full bg-white/70 overflow-hidden border border-green-200">
                        <div class="h-full bg-green-300" style="width: {{ $paidPct }}%"></div>
                    </div>
                </div>

                {{-- Pending --}}
                <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold text-yellow-700">Pending</div>
                        <span class="text-xs font-extrabold px-2 py-1 rounded-full bg-white border border-yellow-200 text-yellow-700">
                            {{ $pendingPct }}%
                        </span>
                    </div>
                    <div class="mt-2 text-3xl font-extrabold text-yellow-800">{{ $pending }}</div>
                    <div class="mt-3 h-2 rounded-full bg-white/70 overflow-hidden border border-yellow-200">
                        <div class="h-full bg-yellow-300" style="width: {{ $pendingPct }}%"></div>
                    </div>
                </div>

                {{-- Expired --}}
                <div class="rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold text-red-700">Expired</div>
                        <span class="text-xs font-extrabold px-2 py-1 rounded-full bg-white border border-red-200 text-red-700">
                            {{ $expiredPct }}%
                        </span>
                    </div>
                    <div class="mt-2 text-3xl font-extrabold text-red-800">{{ $expired }}</div>
                    <div class="mt-3 h-2 rounded-full bg-white/70 overflow-hidden border border-red-200">
                        <div class="h-full bg-red-300" style="width: {{ $expiredPct }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Feature section (merah cuma buat fitur/highlight) --}}
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="rounded-2xl border border-red-200 bg-gradient-to-br from-red-50 to-white p-6 shadow-sm">
                    <div class="text-sm font-extrabold text-red-900">Auto-Delivery</div>
                    <div class="mt-2 text-sm text-red-900/70">
                        Setelah pembayaran terverifikasi, file digital langsung tersedia di akun kamu.
                    </div>
                </div>

                <div class="rounded-2xl border border-red-200 bg-gradient-to-br from-red-50 to-white p-6 shadow-sm">
                    <div class="text-sm font-extrabold text-red-900">QRIS Dynamic</div>
                    <div class="mt-2 text-sm text-red-900/70">
                        Pembayaran gampang. Scan QR, status update otomatis tanpa konfirmasi manual.
                    </div>
                </div>

                <div class="rounded-2xl border border-red-200 bg-gradient-to-br from-red-50 to-white p-6 shadow-sm">
                    <div class="text-sm font-extrabold text-red-900">Riwayat Transaksi</div>
                    <div class="mt-2 text-sm text-red-900/70">
                        Semua order tersimpan rapi. Tinggal klik tombol “Lihat Semua Transaksi”.
                    </div>
                </div>
            </div>

            {{-- CTA row --}}
            <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="text-lg font-extrabold text-gray-900">Mau lanjut belanja?</div>
                        <div class="text-sm text-gray-600 mt-1">
                            Cari buku baru di katalog atau cek transaksi kamu.
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('catalog.index') }}"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-red-800 text-white font-extrabold hover:bg-red-700 transition">
                            Buka Katalog
                        </a>
                        <a href="{{ route('orders.index') }}"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold hover:bg-gray-50 transition">
                            Lihat Transaksi
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer FULL LEBAR: taro di luar container max-w --}}
        <x-footer />
    </div>
</x-app-layout>
