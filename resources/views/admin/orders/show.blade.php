<x-dashboard-layout>
    {{-- Back Button --}}
    <div class="max-w-7xl mx-auto mb-6 px-4 md:px-0">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#5C0F14] font-bold transition">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Daftar Order
        </a>
    </div>

    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                    Detail Pesanan
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                    Order <span class="text-[#E6B65C]">#{{ $order->id }}</span>
                </h2>
                <div class="mt-2 text-gray-300 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    {{ $order->user->name ?? 'Guest User' }}
                    <span class="text-gray-600">•</span>
                    <span class="text-gray-400 text-sm">{{ $order->user->email ?? '-' }}</span>
                </div>
            </div>

            <div class="flex flex-col items-end gap-2">
                 @php
                    $s = strtolower($order->status);
                    $badgeClass = match($s) {
                        'paid', 'success' => 'bg-green-500 text-white shadow-lg shadow-green-900/50',
                        'pending' => 'bg-orange-500 text-white shadow-lg shadow-orange-900/50',
                        'expired', 'failed' => 'bg-red-500 text-white shadow-lg shadow-red-900/50',
                        default => 'bg-gray-500 text-white'
                    };
                    $label = match($s) {
                        'paid' => 'LUNAS',
                        'pending' => 'MENUNGGU PEMBAYARAN',
                        'expired' => 'KEDALUWARSA',
                        default => strtoupper($s)
                    };
                @endphp
                <div class="px-6 py-2 rounded-xl font-black tracking-widest text-sm {{ $badgeClass }}">
                    {{ $label }}
                </div>
                <div class="text-gray-400 text-xs font-mono">
                    {{ $order->created_at->format('d M Y, H:i:s') }}
                </div>
            </div>
        </div>
    </div>

     <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Items --}}
        <div class="lg:col-span-2 space-y-8">
             <div class="rounded-2xl border border-gray-100 bg-white shadow-xl overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-black text-gray-900 text-lg flex items-center gap-2">
                         <svg class="w-5 h-5 text-[#5C0F14]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        Item Pesanan
                    </h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <div class="p-6 flex gap-4 items-start hover:bg-gray-50 transition">
                            <div class="h-20 w-16 bg-gray-200 rounded-lg shrink-0 overflow-hidden shadow-sm">
                                @if($item->book && $item->book->cover_path)
                                    <img src="{{ asset('storage/'.$item->book->cover_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs text-center p-1">No Cover</div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-lg">{{ $item->book->title ?? 'Buku dihapus' }}</h4>
                                <div class="text-sm text-gray-500 mt-1">{{ $item->book?->publisher?->name ?? 'Publisher' }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-gray-900 text-lg">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                 <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <span class="font-bold text-gray-500">Total Tagihan</span>
                    <span class="font-black text-2xl text-[#5C0F14]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Right Column: Actions & Payment --}}
        <div class="space-y-8">
            {{-- Admin Actions --}}
            @if($order->status === 'pending')
                <div class="rounded-2xl border border-orange-100 bg-orange-50 shadow-xl p-6">
                    <h3 class="font-black text-orange-900 text-lg mb-4 flex items-center gap-2">
                         <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        Tindakan Diperlukan
                    </h3>
                    <p class="text-sm text-orange-800 mb-6">
                        Pesanan ini statusnya masih <b>Pending</b>. Jika user sudah transfer manual, Anda bisa konfirmasi secara manual di sini.
                    </p>
                    
                    <form method="POST" action="{{ route('admin.orders.manual_confirm', $order->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menandai pesanan ini sebagai LUNAS? Tindakan ini tidak dapat dibatalkan.');">
                        @csrf
                        <button class="w-full py-4 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 text-white font-black hover:shadow-lg hover:scale-[1.02] transition transform flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Konfirmasi Lunas Manual
                        </button>
                    </form>
                </div>
            @endif

            {{-- User Info --}}
             <div class="rounded-2xl border border-gray-100 bg-white shadow-xl p-6">
                <h3 class="font-black text-gray-900 text-lg mb-4">Informasi Pembeli</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                         <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold">
                            {{ substr($order->user->name ?? 'G', 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">{{ $order->user->name ?? 'Guest' }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $order->user->id ?? '-' }}</div>
                        </div>
                    </div>
                     <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Email</label>
                        <div class="font-medium text-gray-800">{{ $order->user->email ?? '-' }}</div>
                    </div>
                     <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Bergabung Sejak</label>
                        <div class="font-medium text-gray-800">{{ $order->user->created_at ? $order->user->created_at->format('d M Y') : '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
     </div>

</x-dashboard-layout>
