<x-dashboard-layout>
    @php
        $pending = (int)($pending ?? 0);
        $paid    = (int)($paid ?? 0);
        $expired = (int)($expired ?? 0);

        $total = max(0, $pending + $paid + $expired);
        $pct = fn($n) => $total > 0 ? round(($n / $total) * 100) : 0;

        $pendingPct = $pct($pending);
        $paidPct    = $pct($paid);
        $expiredPct = $pct($expired);
    @endphp

    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                Administrator Access
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-2">
                        Dashboard <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Admin</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Pusat kontrol untuk memantau pesanan, mengelola pengguna, dan mengatur katalog buku.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Overview Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Pending --}}
        <div class="relative rounded-2xl bg-white p-6 shadow-xl border border-gray-100 overflow-hidden group hover:-translate-y-1 transition duration-300">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 text-orange-600 border border-orange-100 text-xs font-bold uppercase">
                    Menunggu
                </div>
                <span class="text-xs font-bold text-gray-400">{{ $pendingPct }}% dari total</span>
            </div>
            
            <div class="text-4xl font-black text-gray-900 mb-2">{{ $pending }}</div>
            <div class="text-sm font-medium text-gray-500 mb-4">Pesanan perlu diproses</div>
            
            <div class="w-full bg-orange-100 rounded-full h-1.5 mb-4">
                <div class="bg-orange-500 h-1.5 rounded-full" style="width: {{ $pendingPct }}%"></div>
            </div>
             <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="text-sm font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1">
                Lihat Detail <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        {{-- Paid --}}
        <div class="relative rounded-2xl bg-white p-6 shadow-xl border border-gray-100 overflow-hidden group hover:-translate-y-1 transition duration-300">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-50 text-green-600 border border-green-100 text-xs font-bold uppercase">
                    Lunas
                </div>
                <span class="text-xs font-bold text-gray-400">{{ $paidPct }}% dari total</span>
            </div>
            
            <div class="text-4xl font-black text-gray-900 mb-2">{{ $paid }}</div>
            <div class="text-sm font-medium text-gray-500 mb-4">Transaksi berhasil</div>
            
            <div class="w-full bg-green-100 rounded-full h-1.5 mb-4">
                <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $paidPct }}%"></div>
            </div>
            <a href="{{ route('admin.orders.index', ['status' => 'paid']) }}" class="text-sm font-bold text-green-600 hover:text-green-700 flex items-center gap-1">
                Lihat Detail <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        {{-- Expired --}}
        <div class="relative rounded-2xl bg-white p-6 shadow-xl border border-gray-100 overflow-hidden group hover:-translate-y-1 transition duration-300">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 text-red-600 border border-red-100 text-xs font-bold uppercase">
                    Gagal / Expired
                </div>
                <span class="text-xs font-bold text-gray-400">{{ $expiredPct }}% dari total</span>
            </div>
            
            <div class="text-4xl font-black text-gray-900 mb-2">{{ $expired }}</div>
            <div class="text-sm font-medium text-gray-500 mb-4">Pesanan kedaluwarsa</div>
            
            <div class="w-full bg-red-100 rounded-full h-1.5 mb-4">
                <div class="bg-red-500 h-1.5 rounded-full" style="width: {{ $expiredPct }}%"></div>
            </div>
             <a href="{{ route('admin.orders.index', ['status' => 'expired']) }}" class="text-sm font-bold text-red-600 hover:text-red-700 flex items-center gap-1">
                Lihat Detail <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    {{-- Panels Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Left: Quick Actions --}}
        <div class="lg:col-span-8 flex flex-col h-full">
            <div class="rounded-2xl border border-gray-100 bg-white shadow-lg p-6 flex-1">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-black text-gray-900">Akses Cepat Modul</h3>
                        <p class="text-sm text-gray-500">Kelola sistem administrasi dengan mudah.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    {{-- Orders --}}
                    <a href="{{ route('admin.orders.index') }}" class="group relative rounded-xl border border-gray-200 bg-white p-6 hover:border-[#5C0F14] hover:shadow-lg transition duration-300">
                        <div class="p-3 rounded-lg bg-[#5C0F14]/10 text-[#5C0F14] w-fit mb-4 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">Daftar Order</h4>
                        <p class="text-xs text-gray-500 mb-4">Cek pembayaran & riwayat.</p>
                        <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition duration-300 text-[#5C0F14]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </a>

                    {{-- Users --}}
                    <a href="{{ route('admin.users.index') }}" class="group relative rounded-xl border border-gray-200 bg-white p-6 hover:border-[#5C0F14] hover:shadow-lg transition duration-300">
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600 w-fit mb-4 group-hover:scale-110 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">Data User</h4>
                        <p class="text-xs text-gray-500 mb-4">Atur role & publisher.</p>
                        <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition duration-300 text-blue-600">
                           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </a>

                    {{-- Books --}}
                    <a href="{{ route('admin.books.index') }}" class="group relative rounded-xl border border-gray-200 bg-white p-6 hover:border-[#5C0F14] hover:shadow-lg transition duration-300">
                        <div class="p-3 rounded-lg bg-purple-50 text-purple-600 w-fit mb-4 group-hover:scale-110 transition">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">Katalog Buku</h4>
                        <p class="text-xs text-gray-500 mb-4">Moderasi & kelola konten.</p>
                         <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition duration-300 text-purple-600">
                           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </a>
                </div>

                <div class="mt-6 p-4 rounded-xl bg-orange-50 border border-orange-100 text-orange-800 text-sm flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                         <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <span class="font-bold">Tips Admin:</span> Prioritaskan memproses pesanan dengan status <span class="font-bold underline">Menunggu</span> agar pelanggan tidak menunggu lama.
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Snapshot Tool --}}
        <div class="lg:col-span-4 flex flex-col h-full">
            <div class="rounded-2xl border border-[#5C0F14]/20 bg-gradient-to-br from-[#5C0F14]/5 to-transparent p-6 shadow-sm flex flex-col h-full">
                <div class="mb-4">
                    <h3 class="text-lg font-black text-[#5C0F14]">Monitoring Snapshot</h3>
                    <p class="text-xs text-gray-500 mt-1">Ringkasan aktivitas hari ini.</p>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm mb-6">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Transaksi</div>
                    <div class="text-4xl font-black text-[#5C0F14]">{{ $total }}</div>
                    <div class="text-[10px] text-gray-400 mt-2 line-clamp-2">
                        Akumulasi dari pending, lunas, dan expired.
                    </div>
                </div>

                 <div class="flex-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Catatan Cepat (UI)</label>
                    <div class="relative">
                        <input id="adminQuickSearch" type="text"
                               placeholder="Tulis note sementara..."
                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#5C0F14] transition shadow-sm">
                        <button id="adminQuickClear" type="button" class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 text-gray-400 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div id="adminQuickMsg" class="mt-3 p-3 rounded-lg bg-[#5C0F14]/5 border border-[#5C0F14]/10 text-xs text-[#5C0F14] italic min-h-[60px]">
                        // Area ini untuk coret-coret cepat admin, tidak tersimpan di database.
                    </div>
                </div>
            </div>
        </div>
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
                    ? `Note: "${q}"`
                    : '// Area ini untuk coret-coret cepat admin, tidak tersimpan di database.';
                
                 if(q) {
                    msg.classList.add('bg-yellow-50', 'text-yellow-800', 'border-yellow-200');
                    msg.classList.remove('bg-[#5C0F14]/5', 'text-[#5C0F14]');
                } else {
                     msg.classList.remove('bg-yellow-50', 'text-yellow-800', 'border-yellow-200');
                    msg.classList.add('bg-[#5C0F14]/5', 'text-[#5C0F14]');
                }
            };

            input.addEventListener('input', apply);
            clear.addEventListener('click', () => { input.value = ''; apply(); });
            apply();
        });
    </script>
</x-dashboard-layout>
