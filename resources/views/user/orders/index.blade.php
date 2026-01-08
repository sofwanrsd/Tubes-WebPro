<x-dashboard-layout>
    @php
        $fmt = fn($n) => 'Rp ' . number_format((int)$n, 0, ',', '.');
    @endphp

    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                Transaction History
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-2">
                        Riwayat <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Transaksi</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Pantau status pesananmu dan akses detail pembelian buku digital.
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('catalog.index') }}"
                       class="px-6 py-3 rounded-xl bg-[#E6B65C] text-[#5C0F14] font-bold hover:bg-[#d4a040] transition shadow-lg shadow-orange-900/20">
                        Beli Buku Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters (Server Side) --}}
    <form method="GET" action="{{ route('orders.index') }}" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-lg mb-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            {{-- Search --}}
            <div class="md:col-span-5 relative">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Cari Order</label>
                <div class="flex gap-2">
                    <input name="search"
                           type="text"
                           value="{{ request('search') }}"
                           placeholder="Cari ID Order..."
                           class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] focus:bg-white transition">
                </div>
            </div>

            {{-- Status --}}
            <div class="md:col-span-3">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Filter Status</label>
                <div class="relative">
                    <select name="status"
                            class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] focus:bg-white transition cursor-pointer">
                        <option value="all" @selected(request('status')=='all')>Semua Status</option>
                        <option value="paid" @selected(request('status')=='paid')>Lunas (Paid)</option>
                        <option value="pending" @selected(request('status')=='pending')>Menunggu Pembayaran</option>
                        <option value="expired" @selected(request('status')=='expired')>Kedaluwarsa</option>
                        <option value="failed" @selected(request('status')=='failed')>Gagal</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </div>
            </div>

            {{-- Per Page --}}
            <div class="md:col-span-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Tampilkan</label>
                <div class="relative">
                     <select name="per_page" onchange="this.form.submit()"
                            class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] focus:bg-white transition cursor-pointer">
                        <option value="10" @selected(request('per_page')==10)>10</option>
                        <option value="25" @selected(request('per_page')==25)>25</option>
                        <option value="50" @selected(request('per_page')==50)>50</option>
                        <option value="100" @selected(request('per_page')==100)>100</option>
                    </select>
                     <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </div>
            </div>

             <div class="md:col-span-2">
                 <button type="submit" class="w-full rounded-xl px-5 py-3 bg-[#5C0F14] text-[#E6B65C] font-bold text-sm hover:bg-[#4a0b10] transition shadow-md">
                    Terapkan
                </button>
             </div>
        </div>
    </form>

    {{-- Table (Desktop) --}}
    <div class="hidden md:block rounded-2xl border border-gray-100 bg-white shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#5C0F14] text-white">
                    <tr class="text-left">
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">ID Order</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Status</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Total Pembayaran</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Tanggal</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $o)
                        @php
                            $s = strtolower($o->status ?? 'pending');
                            
                            $badge = match($s) {
                                'paid', 'success' => 'bg-green-100 text-green-700 border-green-200',
                                'pending' => 'bg-orange-100 text-orange-700 border-orange-200',
                                'expired', 'failed', 'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                default => 'bg-gray-100 text-gray-700 border-gray-200'
                            };

                            $label = match($s) {
                                'paid', 'success' => 'Lunas',
                                'pending' => 'Menunggu Pembayaran',
                                'expired' => 'Kedaluwarsa',
                                'failed' => 'Gagal',
                                'cancelled' => 'Dibatalkan',
                                default => ucfirst($s)
                            };
                        @endphp

                        <tr class="group hover:bg-orange-50/30 transition-colors duration-200">
                            <td class="py-5 px-6 font-black text-[#5C0F14]">#{{ $o->id }}</td>
                            <td class="py-5 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full border text-[10px] font-black uppercase tracking-wide {{ $badge }}">
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="py-5 px-6 font-bold text-gray-900">
                                {{ $fmt($o->total_amount) }}
                            </td>
                            <td class="py-5 px-6 text-gray-500 font-medium">
                                {{ $o->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-5 px-6 text-right">
                                <a href="{{ route('orders.show', $o->id) }}"
                                   class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 font-bold text-sm hover:bg-[#5C0F14] hover:text-[#E6B65C] transition-all">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-6 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Belum ada transaksi</h3>
                                    <p class="text-gray-500 text-sm mt-1">Coba ubah filter atau buat pesanan baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t border-gray-100 bg-gray-50">
            {{ $orders->links() }}
        </div>
    </div>

    {{-- Mobile cards --}}
    <div class="md:hidden space-y-4">
        @forelse($orders as $o)
            @php
                $s = strtolower($o->status ?? 'pending');
                 $badge = match($s) {
                    'paid', 'success' => 'bg-green-100 text-green-700 border-green-200',
                    'pending' => 'bg-orange-100 text-orange-700 border-orange-200',
                    'expired', 'failed', 'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                    default => 'bg-gray-100 text-gray-700 border-gray-200'
                };
                
                $label = match($s) {
                    'paid', 'success' => 'Lunas',
                    'pending' => 'Menunggu Pembayaran',
                    'expired' => 'Kedaluwarsa',
                    'failed' => 'Gagal',
                    'cancelled' => 'Dibatalkan',
                    default => ucfirst($s)
                };
            @endphp

            <div class="relative rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div>
                        <div class="text-lg font-black text-[#5C0F14]">Order #{{ $o->id }}</div>
                        <div class="text-xs font-medium text-gray-400">{{ $o->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg border text-[10px] font-black uppercase tracking-wide {{ $badge }}">
                        {{ $label }}
                    </span>
                </div>

                <div class="flex items-center justify-between py-3 border-t border-b border-gray-50">
                    <div class="text-sm text-gray-500 font-medium">Total Tagihan</div>
                    <div class="text-lg font-bold text-gray-900">{{ $fmt($o->total_amount) }}</div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('orders.show', $o->id) }}"
                       class="block w-full text-center px-4 py-3 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-bold text-sm hover:bg-[#4a0b10] transition shadow-lg shadow-red-900/20">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
             <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-10 text-center">
                <div class="text-gray-400 mb-2">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="font-bold text-gray-600">Belum ada transaksi</div>
            </div>
        @endforelse

        <div class="pt-2">
            {{ $orders->links() }}
        </div>
    </div>
</x-dashboard-layout>
