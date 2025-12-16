<x-app-layout>
    @php
        $fmt = fn($n) => 'Rp ' . number_format((int)$n, 0, ',', '.');
    @endphp

    <div class="min-h-[calc(100vh-4rem)] bg-white py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 px-4">

            {{-- Header --}}
            <div class="mb-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-800 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Orders
                </div>

                <div class="mt-4 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                            Riwayat Transaksi
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Lihat status order kamu, cek detail, dan lanjut pembayaran jika masih pending.
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('catalog.index') }}"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-red-800 text-white font-extrabold
                                  hover:bg-red-700 transition shadow-[0_0_16px_rgba(185,28,28,0.18)]">
                            Buka Katalog
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold
                                  hover:bg-gray-50 transition">
                            Dashboard
                        </a>
                    </div>
                </div>
            </div>

            {{-- Filters --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm mb-5">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                    <div class="md:col-span-6">
                        <div class="text-xs font-semibold text-gray-500 mb-2">Cari order</div>
                        <div class="flex gap-2">
                            <input id="orderSearch"
                                   type="text"
                                   placeholder="Cari: ID order, status..."
                                   class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                            <button id="orderClear"
                                    type="button"
                                    class="rounded-xl px-4 py-3 border border-gray-200 bg-white text-gray-900 font-extrabold text-sm hover:bg-gray-50 transition">
                                Reset
                            </button>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <div class="text-xs font-semibold text-gray-500 mb-2">Filter status</div>
                        <select id="statusFilter"
                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                            <option value="all">Semua</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="expired">Expired</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>

                    <div class="md:col-span-3">
                        <div class="text-xs font-semibold text-gray-500 mb-2">Tampil</div>
                        <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm">
                            <span class="text-gray-600">Total halaman ini:</span>
                            <span id="visibleCount" class="font-extrabold text-gray-900">
                                {{ is_countable($orders) ? count($orders) : 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table (Desktop) --}}
            <div class="hidden md:block rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b">
                            <tr class="text-left text-gray-600">
                                <th class="py-3 px-6 font-bold">Order</th>
                                <th class="py-3 px-6 font-bold">Status</th>
                                <th class="py-3 px-6 font-bold">Total</th>
                                <th class="py-3 px-6 font-bold">Tanggal</th>
                                <th class="py-3 px-6 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTableBody">
                            @forelse($orders as $o)
                                @php
                                    $s = strtolower($o->status ?? 'pending');

                                    $badge =
                                        $s === 'paid' ? 'bg-green-50 text-green-800 border-green-200' :
                                        ($s === 'expired' || $s === 'failed' ? 'bg-red-50 text-red-800 border-red-200' :
                                        'bg-yellow-50 text-yellow-800 border-yellow-200');

                                    $rowKey = strtolower('#'.$o->id.' '.$s);
                                @endphp

                                <tr class="order-row border-b last:border-b-0 hover:bg-gray-50 transition"
                                    data-status="{{ $s }}"
                                    data-key="{{ $rowKey }}">
                                    <td class="py-4 px-6 font-extrabold text-gray-900">#{{ $o->id }}</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full border text-xs font-extrabold {{ $badge }}">
                                            {{ ucfirst($s) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 font-extrabold text-gray-900">
                                        {{ $fmt($o->total_amount) }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">
                                        {{ $o->created_at }}
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="{{ route('orders.show', $o->id) }}"
                                           class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-red-800 text-white font-extrabold text-sm hover:bg-red-700 transition">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 px-6 text-center text-gray-600">
                                        Belum ada transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t bg-white">
                    {{ $orders->links() }}
                </div>
            </div>

            {{-- Mobile cards --}}
            <div class="md:hidden space-y-3" id="ordersMobile">
                @forelse($orders as $o)
                    @php
                        $s = strtolower($o->status ?? 'pending');

                        $badge =
                            $s === 'paid' ? 'bg-green-50 text-green-800 border-green-200' :
                            ($s === 'expired' || $s === 'failed' ? 'bg-red-50 text-red-800 border-red-200' :
                            'bg-yellow-50 text-yellow-800 border-yellow-200');

                        $rowKey = strtolower('#'.$o->id.' '.$s);
                    @endphp

                    <div class="order-row rounded-2xl border border-gray-200 bg-white p-4 shadow-sm"
                         data-status="{{ $s }}"
                         data-key="{{ $rowKey }}">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-lg font-extrabold text-gray-900">Order #{{ $o->id }}</div>
                                <div class="mt-1 text-xs text-gray-500">{{ $o->created_at }}</div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full border text-xs font-extrabold {{ $badge }}">
                                {{ ucfirst($s) }}
                            </span>
                        </div>

                        <div class="mt-3 flex items-center justify-between">
                            <div class="text-sm text-gray-600">Total</div>
                            <div class="text-sm font-extrabold text-gray-900">{{ $fmt($o->total_amount) }}</div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('orders.show', $o->id) }}"
                               class="block w-full text-center px-4 py-3 rounded-xl bg-red-800 text-white font-extrabold text-sm hover:bg-red-700 transition">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-gray-200 bg-white p-10 text-center text-gray-600">
                        Belum ada transaksi.
                    </div>
                @endforelse

                <div class="pt-3">
                    {{ $orders->links() }}
                </div>
            </div>

            {{-- Empty result (filter/search) --}}
            <div id="emptyFilter" class="hidden mt-5 rounded-2xl border border-gray-200 bg-white p-10 text-center shadow-sm">
                <div class="text-xl font-extrabold text-gray-900">Tidak ada hasil</div>
                <p class="text-gray-600 mt-2">Coba ganti filter atau kata kunci.</p>
            </div>
        </div>

        {{-- Footer full lebar --}}
        <x-footer />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rows = Array.from(document.querySelectorAll('.order-row'));
            const search = document.getElementById('orderSearch');
            const clear = document.getElementById('orderClear');
            const status = document.getElementById('statusFilter');
            const empty = document.getElementById('emptyFilter');
            const visibleCount = document.getElementById('visibleCount');

            const updateCount = (n) => { if (visibleCount) visibleCount.textContent = String(n); };

            const apply = () => {
                const q = (search?.value || '').trim().toLowerCase();
                const st = (status?.value || 'all').toLowerCase();

                let visible = 0;
                rows.forEach(r => {
                    const rStatus = (r.dataset.status || 'pending').toLowerCase();
                    const key = (r.dataset.key || '');

                    const okStatus = (st === 'all') || (rStatus === st);
                    const okSearch = (q === '') || key.includes(q);

                    const ok = okStatus && okSearch;
                    r.style.display = ok ? '' : 'none';
                    if (ok) visible++;
                });

                updateCount(visible);
                if (empty) empty.classList.toggle('hidden', visible !== 0);
            };

            search?.addEventListener('input', apply);
            status?.addEventListener('change', apply);
            clear?.addEventListener('click', () => {
                if (search) search.value = '';
                if (status) status.value = 'all';
                apply();
            });

            apply();
        });
    </script>
</x-app-layout>
