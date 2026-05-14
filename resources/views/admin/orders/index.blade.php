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
                Admin Panel
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-2">
                        Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Pesanan</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Pantau transaksi, verifikasi pembayaran, dan kelola status pesanan pengguna.
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('admin.dashboard') }}"
                       class="px-6 py-3 rounded-xl border border-[#E6B65C]/30 bg-[#E6B65C]/10 text-[#E6B65C] font-bold hover:bg-[#E6B65C] hover:text-[#5C0F14] transition backdrop-blur-sm">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.orders.index') }}" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-lg mb-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            {{-- Search --}}
            <div class="md:col-span-5">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Pencarian</label>
                <div class="relative group">
                    <input name="search"
                           type="text"
                           value="{{ request('search') }}"
                           placeholder="Cari Order ID atau Nama User..."
                           class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] focus:bg-white transition pl-10">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400 group-focus-within:text-[#E6B65C] transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="md:col-span-3">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Filter Status</label>
                <div class="relative">
                    <select name="status"
                            class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] focus:bg-white transition cursor-pointer">
                        <option value="all" @selected(request('status')=='all')>Semua Status</option>
                        <option value="pending" @selected(request('status')=='pending')>Pending (Menunggu)</option>
                        <option value="paid" @selected(request('status')=='paid')>Paid (Lunas)</option>
                        <option value="expired" @selected(request('status')=='expired')>Expired (Kadaluwarsa)</option>
                        <option value="failed" @selected(request('status')=='failed')>Failed (Gagal)</option>
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
                        <option value="20" @selected(request('per_page')==20)>20</option>
                        <option value="50" @selected(request('per_page')==50)>50</option>
                        <option value="100" @selected(request('per_page')==100)>100</option>
                    </select>
                     <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                 <button type="submit" class="w-full rounded-xl px-5 py-3 bg-[#5C0F14] text-[#E6B65C] font-bold text-sm hover:bg-[#4a0b10] transition shadow-md flex justify-center items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                    Filter
                </button>
             </div>
        </div>
    </form>

    {{-- Result Table --}}
    <div class="rounded-2xl border border-gray-100 bg-white shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#5C0F14] text-white">
                    <tr class="text-left">
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Order ID</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">User</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Status</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Total</th>
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
                                'pending' => 'Pending',
                                'expired' => 'Expired',
                                'failed' => 'Gagal',
                                'cancelled' => 'Batal',
                                default => ucfirst($s)
                            };
                        @endphp
                        <tr class="group hover:bg-orange-50/30 transition-colors duration-200">
                            <td class="py-5 px-6 font-black text-[#5C0F14]">#{{ $o->id }}</td>
                            <td class="py-5 px-6">
                                <div class="font-bold text-gray-900">{{ $o->user->name ?? 'Guest' }}</div>
                                <div class="text-xs text-gray-500">{{ $o->user->email ?? '-' }}</div>
                            </td>
                            <td class="py-5 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full border text-[10px] font-black uppercase tracking-wide {{ $badge }}">
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="py-5 px-6 font-bold text-gray-900">
                                {{ $fmt($o->total_amount) }}
                            </td>
                            <td class="py-5 px-6 text-gray-500 font-medium">
                                {{ $o->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-5 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $o->id) }}"
                                    class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 font-bold text-sm hover:bg-[#5C0F14] hover:text-[#E6B65C] transition-all">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                         <tr>
                            <td colspan="6" class="py-12 px-6 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Tidak ada pesanan ditemukan</h3>
                                    <p class="text-gray-500 text-sm mt-1">Coba sesuaikan filter pencarian.</p>
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
</x-dashboard-layout>
