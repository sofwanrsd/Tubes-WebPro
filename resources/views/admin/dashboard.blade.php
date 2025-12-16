<x-app-layout>
    @php
        $pending = (int)($pending ?? 0);
        $paid    = (int)($paid ?? 0);
        $expired = (int)($expired ?? 0);

        $total = max(0, $pending + $paid + $expired);
        $pct = fn($n) => $total > 0 ? round(($n / $total) * 100) : 0;

        $pendingPct = $pct($pending);
        $paidPct    = $pct($paid);
        $expiredPct = $pct($expired);

        // Button style (white -> red on hover)
        $btnWhite = 'inline-flex items-center justify-center px-5 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold
                     hover:bg-red-800 hover:text-white hover:border-red-800 transition
                     focus:outline-none focus:ring-2 focus:ring-red-200';
    @endphp

    <div class="min-h-[calc(100vh-4rem)] bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-800 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Admin Panel
                </div>

                <div class="mt-4 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                            Admin Dashboard
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Monitor order, kelola user, dan kontrol katalog.
                        </p>
                    </div>

                    {{-- Top buttons (white -> red when hover) --}}
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.orders.index') }}" class="{{ $btnWhite }}">
                            Monitoring Orders
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="{{ $btnWhite }}">
                            Manage Users
                        </a>
                        <a href="{{ route('admin.books.index') }}" class="{{ $btnWhite }}">
                            Manage Books
                        </a>
                    </div>
                </div>
            </div>

            {{-- Overview cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                    <div class="mt-2 text-xs text-yellow-900/60">
                        Order belum dibayar / menunggu verifikasi.
                    </div>
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
                    <div class="mt-2 text-xs text-green-900/60">
                        Order sukses dan sudah terbayar.
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
                    <div class="mt-2 text-xs text-red-900/60">
                        Order melewati batas waktu pembayaran.
                    </div>
                </div>
            </div>

            {{-- Panels --}}
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-12 gap-4 items-stretch">
                {{-- Left: Quick Actions (dibikin setara tinggi & “berisi”) --}}
                <div class="lg:col-span-7">
                    <div class="h-full rounded-2xl border border-gray-200 bg-white p-6 shadow-sm flex flex-col">
                        <div>
                            <div class="text-lg font-extrabold text-gray-900">Quick Actions</div>
                            <p class="mt-2 text-sm text-gray-600">
                                Akses cepat modul admin. Paling sering dipakai: monitoring order.
                            </p>
                        </div>

                        <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3 flex-1">
                            <a href="{{ route('admin.orders.index') }}"
                               class="rounded-xl border border-gray-200 bg-gray-50 p-4 hover:bg-gray-100 transition flex flex-col justify-between min-h-[120px]">
                                <div>
                                    <div class="text-xs font-semibold text-gray-500">Module</div>
                                    <div class="mt-1 text-sm font-extrabold text-gray-900">Orders</div>
                                    <div class="mt-1 text-xs text-gray-600">Cek status, detail, pembayaran</div>
                                </div>
                                <div class="mt-3 text-xs font-extrabold text-red-800">Buka →</div>
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                               class="rounded-xl border border-gray-200 bg-gray-50 p-4 hover:bg-gray-100 transition flex flex-col justify-between min-h-[120px]">
                                <div>
                                    <div class="text-xs font-semibold text-gray-500">Module</div>
                                    <div class="mt-1 text-sm font-extrabold text-gray-900">Users</div>
                                    <div class="mt-1 text-xs text-gray-600">Role, publisher, akses akun</div>
                                </div>
                                <div class="mt-3 text-xs font-extrabold text-red-800">Buka →</div>
                            </a>

                            <a href="{{ route('admin.books.index') }}"
                               class="rounded-xl border border-gray-200 bg-gray-50 p-4 hover:bg-gray-100 transition flex flex-col justify-between min-h-[120px]">
                                <div>
                                    <div class="text-xs font-semibold text-gray-500">Module</div>
                                    <div class="mt-1 text-sm font-extrabold text-gray-900">Books</div>
                                    <div class="mt-1 text-xs text-gray-600">Moderasi, publish, harga</div>
                                </div>
                                <div class="mt-3 text-xs font-extrabold text-red-800">Buka →</div>
                            </a>
                        </div>

                        <div class="mt-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-900/70">
                            Tip: fokus pantau <span class="font-extrabold">pending</span> — biasanya ini butuh tindakan paling cepat.
                        </div>
                    </div>
                </div>

                {{-- Right: Monitoring Snapshot (HAPUS tombol Monitoring Orders) --}}
                <div class="lg:col-span-5">
                    <div class="h-full rounded-2xl border border-red-200 bg-gradient-to-br from-red-50 to-white p-6 shadow-sm flex flex-col">
                        <div>
                            <div class="text-lg font-extrabold text-red-900">Monitoring Snapshot</div>
                            <p class="mt-2 text-sm text-red-900/70">
                                Ringkasan cepat hari ini. Untuk detail lengkap, buka halaman Orders.
                            </p>
                        </div>

                        <div class="mt-5 rounded-xl border border-red-200 bg-white px-5 py-4">
                            <div class="text-xs font-semibold text-red-700">Total Order (ringkas)</div>
                            <div class="mt-1 text-3xl font-extrabold text-red-900">{{ $total }}</div>
                            <div class="mt-2 text-[11px] text-red-900/60">
                                *Ini cuma agregat pending/paid/expired dari data yang dikirim controller.
                            </div>
                        </div>

                        <div class="mt-5 flex-1">
                            <div class="text-xs font-semibold text-red-700 mb-2">Cari cepat (UI)</div>
                            <div class="flex gap-2">
                                <input id="adminQuickSearch" type="text"
                                       placeholder="Contoh: order #12 / pending..."
                                       class="w-full rounded-xl border border-red-200 bg-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                                <button id="adminQuickClear" type="button"
                                        class="rounded-xl px-4 py-3 border border-red-200 bg-white text-red-900 font-extrabold text-sm hover:bg-red-50 transition">
                                    Reset
                                </button>
                            </div>
                            <div id="adminQuickMsg" class="mt-2 text-xs text-red-900/70"></div>

                            <div class="mt-5 rounded-xl border border-red-200/70 bg-white/70 px-4 py-3 text-xs text-red-900/70">
                                Catatan: fitur ini cuma bantu “catat keyword”. Search beneran ada di halaman Orders.
                            </div>
                        </div>

                        {{-- tombol dihapus sesuai request --}}
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer full lebar --}}
        <x-footer />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('adminQuickSearch');
            const clear = document.getElementById('adminQuickClear');
            const msg   = document.getElementById('adminQuickMsg');

            if (!input || !clear || !msg) return;

            const apply = () => {
                const q = (input.value || '').trim();
                msg.textContent = q
                    ? `Kata kunci: "${q}". (UI saja, tidak query backend)`
                    : 'Ketik sesuatu untuk catatan cepat. (UI saja, tidak query backend)';
            };

            input.addEventListener('input', apply);
            clear.addEventListener('click', () => { input.value = ''; apply(); });
            apply();
        });
    </script>
</x-app-layout>
