<x-app-layout>
    @php
        $fmt = fn($n) => 'Rp ' . number_format((int)$n, 0, ',', '.');

        $statusBadge = function ($s) {
            $s = strtolower((string)$s);

            return match ($s) {
                'paid', 'success', 'settled' =>
                    'bg-green-50 text-green-800 border-green-200',
                'pending', 'unpaid' =>
                    'bg-yellow-50 text-yellow-800 border-yellow-200',
                'expired', 'failed', 'cancelled', 'canceled' =>
                    'bg-red-50 text-red-800 border-red-200',
                default =>
                    'bg-gray-50 text-gray-800 border-gray-200',
            };
        };
    @endphp

    <div class="min-h-[calc(100vh-4rem)] bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-800 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Admin • Orders
                </div>

                <div class="mt-4 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                            Monitoring Orders
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Pantau status pembayaran dan detail order user.
                        </p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold
                              hover:bg-red-800 hover:text-white hover:border-red-800 transition">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

            {{-- Tools (client-side) --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm mb-5">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                    <div class="md:col-span-7">
                        <label class="block text-xs font-semibold text-gray-600 mb-2">Cari cepat</label>
                        <input id="orderSearch"
                               type="text"
                               placeholder="Cari: order #12 / email user / status..."
                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-red-200" />
                        <div class="mt-2 text-[11px] text-gray-500">
                            *Search ini client-side (nggak ubah backend). Untuk query server-side, buat di controller nanti.
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-xs font-semibold text-gray-600 mb-2">Filter status</label>
                        <select id="statusFilter"
                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm
                                       focus:outline-none focus:ring-2 focus:ring-red-200">
                            <option value="">Semua</option>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 flex gap-2">
                        <button id="resetFilter" type="button"
                                class="w-full inline-flex items-center justify-center px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold
                                       hover:bg-gray-50 transition">
                            Reset
                        </button>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between gap-3">
                    <div class="text-sm text-gray-600">
                        Total data halaman ini:
                        <span id="visibleCount" class="font-extrabold text-gray-900">0</span>
                    </div>
                    <div class="text-xs text-gray-500">
                        Tip: klik “Detail” untuk lihat breakdown item & payment.
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr class="text-left border-b">
                                <th class="py-3 px-4 font-extrabold text-gray-700">Order</th>
                                <th class="py-3 px-4 font-extrabold text-gray-700">User</th>
                                <th class="py-3 px-4 font-extrabold text-gray-700">Status</th>
                                <th class="py-3 px-4 font-extrabold text-gray-700">Total</th>
                                <th class="py-3 px-4 font-extrabold text-gray-700 text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="ordersTbody" class="divide-y">
                            @foreach($orders as $o)
                                @php
                                    $email  = $o->user->email ?? '-';
                                    $status = (string)($o->status ?? '-');
                                @endphp

                                <tr class="hover:bg-gray-50 transition"
                                    data-order="#{{ $o->id }}"
                                    data-email="{{ strtolower($email) }}"
                                    data-status="{{ strtolower($status) }}">
                                    <td class="py-3 px-4 font-extrabold text-gray-900">
                                        #{{ $o->id }}
                                    </td>
                                    <td class="py-3 px-4 text-gray-700">
                                        <div class="font-semibold">{{ $email }}</div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full border text-xs font-extrabold {{ $statusBadge($status) }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 font-extrabold text-gray-900">
                                        {{ $fmt($o->total_amount ?? 0) }}
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <a class="inline-flex items-center justify-center px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold
                                                  hover:bg-red-800 hover:text-white hover:border-red-800 transition"
                                           href="{{ route('admin.orders.show', $o->id) }}">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-4 py-4 border-t bg-white">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>

        <x-footer />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchEl = document.getElementById('orderSearch');
            const statusEl = document.getElementById('statusFilter');
            const resetBtn = document.getElementById('resetFilter');
            const tbody    = document.getElementById('ordersTbody');
            const countEl  = document.getElementById('visibleCount');

            if (!tbody) return;

            const rows = Array.from(tbody.querySelectorAll('tr'));

            const apply = () => {
                const q = (searchEl?.value || '').trim().toLowerCase();
                const st = (statusEl?.value || '').trim().toLowerCase();

                let visible = 0;

                rows.forEach(r => {
                    const order  = (r.dataset.order || '').toLowerCase();
                    const email  = (r.dataset.email || '').toLowerCase();
                    const status = (r.dataset.status || '').toLowerCase();

                    const okQ  = !q || order.includes(q) || email.includes(q) || status.includes(q);
                    const okSt = !st || status === st;

                    const show = okQ && okSt;
                    r.style.display = show ? '' : 'none';
                    if (show) visible++;
                });

                if (countEl) countEl.textContent = String(visible);
            };

            searchEl?.addEventListener('input', apply);
            statusEl?.addEventListener('change', apply);
            resetBtn?.addEventListener('click', () => {
                if (searchEl) searchEl.value = '';
                if (statusEl) statusEl.value = '';
                apply();
            });

            apply();
        });
    </script>
</x-app-layout>
