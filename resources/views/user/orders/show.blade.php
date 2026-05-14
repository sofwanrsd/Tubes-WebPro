<x-dashboard-layout>
    @php
        $fmt = fn($n) => 'Rp ' . number_format((int)$n, 0, ',', '.');
        $status = strtolower($order->status);
        $badge = match($status) {
            'paid', 'success' => 'bg-green-100 text-green-700 border-green-200',
            'pending' => 'bg-orange-100 text-orange-700 border-orange-200',
            'expired', 'failed', 'cancelled' => 'bg-red-100 text-red-700 border-red-200',
            default => 'bg-gray-100 text-gray-700 border-gray-200'
        };

        $label = match($status) {
            'paid', 'success' => 'Lunas',
            'pending' => 'Menunggu Pembayaran',
            'expired' => 'Kedaluwarsa',
            'failed' => 'Gagal',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($status)
        };
    @endphp

    {{-- HEADER --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                 <a href="{{ route('orders.index') }}" class="p-2 rounded-xl bg-gray-100 text-gray-500 hover:bg-[#5C0F14] hover:text-[#E6B65C] transition-colors">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                 </a>
                 <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#d4a040] text-xs font-bold uppercase tracking-widest">
                    Detail Transaksi
                </div>
            </div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">
                Order <span class="text-[#5C0F14]">#{{ $order->id }}</span>
            </h2>
             <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
                <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                <span>&bull;</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg border text-[10px] font-black uppercase tracking-wide {{ $badge }}">
                    {{ $label }}
                </span>
            </div>
        </div>

        @if($status === 'pending')
             <a href="{{ route('payment.show', $order->id) }}" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-bold shadow-lg shadow-red-900/20 hover:bg-[#4a0b10] transition-colors animate-pulse">
                Lanjut Pembayaran
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Item List --}}
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Item Pembelian</h3>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $order->items->count() }} Items</span>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($order->items as $it)
                        <div class="p-6 flex gap-4">
                            {{-- Cover --}}
                             <div class="w-16 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden shadow-sm">
                                @if($it->book && $it->book->cover_path)
                                    <img src="{{ asset('storage/' . $it->book->cover_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-400 font-bold">No Cover</div>
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-lg leading-tight">{{ $it->book->title ?? 'Item tidak tersedia' }}</h4>
                                <div class="text-sm text-gray-500 mt-1 mb-3">
                                    {{ $status === 'paid' ? 'Siap diunduh' : 'Menunggu pembayaran' }}
                                </div>

                                @if($status === 'paid' && $it->book)
                                    <a href="{{ route('orders.download', [$order->id, $it->book->id]) }}" 
                                       class="inline-flex items-center px-4 py-2 rounded-lg bg-green-50 text-green-700 font-bold text-xs border border-green-200 hover:bg-green-100 transition">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                        Download PDF
                                    </a>
                                @endif
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-gray-900">{{ $fmt($it->price) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar Summary --}}
        <div class="lg:col-span-1">
             <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6 sticky top-24">
                <h3 class="font-bold text-gray-800 mb-4">Ringkasan Pembayaran</h3>
                
                <div class="space-y-3 text-sm text-gray-600 mb-6">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>{{ $fmt($order->subtotal ?? $order->total_amount) }}</span>
                    </div>
                     {{-- If existing logic has unique code or fee, display here. Assuming basic subtotal for now based on available fields --}}
                    @if(isset($order->unique_code) && $order->unique_code > 0)
                        <div class="flex justify-between text-orange-600">
                             <span>Kode Unik</span>
                             <span>+{{ $order->unique_code }}</span>
                        </div>
                    @endif
                     <div class="border-t border-gray-100 pt-3 flex justify-between font-black text-gray-900 text-lg">
                        <span>Total</span>
                        <span>{{ $fmt($order->total_amount) }}</span>
                    </div>
                </div>

                @if($status === 'paid')
                     <div class="w-full py-3 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-center text-sm flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Lunas
                    </div>
                @else
                    <div class="text-xs text-gray-500 text-center leading-relaxed">
                        Pesanan ini akan kedaluwarsa secara otomatis jika tidak dibayar dalam waktu yang ditentukan.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>
