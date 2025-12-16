<x-app-layout>
    @php
        $statusBadge = function ($st) {
            $st = strtolower((string)$st);

            return match ($st) {
                'published'   => 'bg-green-50 text-green-800 border-green-200',
                'draft'       => 'bg-yellow-50 text-yellow-800 border-yellow-200',
                'unpublished' => 'bg-red-50 text-red-800 border-red-200',
                default       => 'bg-gray-50 text-gray-800 border-gray-200',
            };
        };

        $btnWhite = 'inline-flex items-center justify-center px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold
                     hover:bg-red-800 hover:text-white hover:border-red-800 transition
                     focus:outline-none focus:ring-2 focus:ring-red-200';
    @endphp

    <div class="min-h-[calc(100vh-4rem)] bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-800 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Admin • Books
                </div>

                <div class="mt-4 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                            Manage Books
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Moderasi status buku (draft/published/unpublished) dan pantau publisher.
                        </p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ $btnWhite }}">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

            {{-- Alert --}}
            @if(session('success'))
                <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-900 shadow-sm">
                    <div class="font-extrabold">Berhasil</div>
                    <div class="text-sm text-green-900/80 mt-1">{{ session('success') }}</div>
                </div>
            @endif

            {{-- Tools (client-side search) --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm mb-5">
                <div class="flex flex-col md:flex-row md:items-end gap-3">
                    <div class="flex-1">
                        <label class="block text-xs font-semibold text-gray-600 mb-2">Cari buku</label>
                        <input id="bookSearch"
                               type="text"
                               placeholder="Cari: judul / email publisher / status..."
                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-red-200" />
                        <div class="mt-2 text-[11px] text-gray-500">
                            *Search ini client-side (nggak ubah backend).
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button id="bookReset" type="button" class="{{ $btnWhite }}">
                            Reset
                        </button>

                        <div class="inline-flex items-center gap-2 px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm">
                            <span class="text-xs font-semibold text-gray-500">Tampil:</span>
                            <span id="bookCount" class="font-extrabold text-gray-900">0</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr class="border-b text-left">
                                <th class="py-3 px-4 font-extrabold text-gray-700">Title</th>
                                <th class="py-3 px-4 font-extrabold text-gray-700">Publisher</th>
                                <th class="py-3 px-4 font-extrabold text-gray-700">Status</th>
                                <th class="py-3 px-4 font-extrabold text-gray-700 text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody id="booksTbody" class="divide-y">
                            @foreach($books as $b)
                                @php
                                    $publisherEmail = $b->publisher->email ?? '-';
                                    $status = (string)($b->status ?? 'draft');
                                @endphp

                                <tr class="hover:bg-gray-50 transition"
                                    data-title="{{ strtolower($b->title ?? '') }}"
                                    data-publisher="{{ strtolower($publisherEmail) }}"
                                    data-status="{{ strtolower($status) }}">
                                    <td class="py-3 px-4">
                                        <div class="font-extrabold text-gray-900">
                                            {{ $b->title }}
                                        </div>
                                    </td>

                                    <td class="py-3 px-4 text-gray-700">
                                        {{ $publisherEmail }}
                                    </td>

                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full border text-xs font-extrabold {{ $statusBadge($status) }}">
                                            {{ $status }}
                                        </span>
                                    </td>

                                    <td class="py-3 px-4 text-right">
                                        <form method="POST"
                                              action="{{ route('admin.books.status', $b->id) }}"
                                              class="inline-flex flex-wrap items-center justify-end gap-2">
                                            @csrf

                                            <select name="status"
                                                    class="rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm font-bold
                                                           focus:outline-none focus:ring-2 focus:ring-red-200">
                                                @foreach(['draft','published','unpublished'] as $st)
                                                    <option value="{{ $st }}" @selected($status === $st)>{{ $st }}</option>
                                                @endforeach
                                            </select>

                                            <button class="{{ $btnWhite }}">
                                                Set
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-4 py-4 border-t bg-white">
                    {{ $books->links() }}
                </div>
            </div>
        </div>

        <x-footer />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('bookSearch');
            const reset = document.getElementById('bookReset');
            const tbody = document.getElementById('booksTbody');
            const count = document.getElementById('bookCount');

            if (!tbody) return;

            const rows = Array.from(tbody.querySelectorAll('tr'));

            const apply = () => {
                const q = (input?.value || '').trim().toLowerCase();
                let visible = 0;

                rows.forEach(r => {
                    const title     = (r.dataset.title || '');
                    const publisher = (r.dataset.publisher || '');
                    const status    = (r.dataset.status || '');

                    const ok = !q || title.includes(q) || publisher.includes(q) || status.includes(q);
                    r.style.display = ok ? '' : 'none';
                    if (ok) visible++;
                });

                if (count) count.textContent = String(visible);
            };

            input?.addEventListener('input', apply);
            reset?.addEventListener('click', () => {
                if (input) input.value = '';
                apply();
            });

            apply();
        });
    </script>
</x-app-layout>
