<x-dashboard-layout>
    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                Panel Admin
            </div>
            
            <div class="max-w-2xl">
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-4">
                    Konfirmasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Upgrade Publisher</span>
                </h2>
                <p class="text-gray-300 text-lg leading-relaxed">
                    Tinjau permintaan pengguna untuk menjadi Publisher.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="rounded-2xl border border-gray-100 bg-white shadow-xl p-8">
            {{-- User Info --}}
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100">
                <div class="w-16 h-16 rounded-full bg-[#5C0F14] text-[#E6B65C] flex items-center justify-center text-2xl font-black">
                    {{ strtoupper(substr($upgradeRequest->user->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-xl font-black text-gray-900">{{ $upgradeRequest->user->name ?? 'Unknown' }}</h3>
                    <p class="text-sm text-gray-500">{{ $upgradeRequest->user->email ?? '-' }}</p>
                </div>
            </div>

            {{-- Request Details --}}
            <div class="space-y-4 mb-8">
                <div>
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Tanggal Permintaan</div>
                    <div class="font-bold text-gray-900">{{ $upgradeRequest->created_at->format('d M Y, H:i') }}</div>
                </div>

                @if($upgradeRequest->note)
                <div>
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Alasan Bergabung</div>
                    <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 text-gray-700 leading-relaxed">
                        {{ $upgradeRequest->note }}
                    </div>
                </div>
                @endif

                <div>
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Status</div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-50 border border-yellow-200 text-yellow-800 text-xs font-bold uppercase">
                        {{ ucfirst($upgradeRequest->status) }}
                    </span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4">
                <form method="POST" action="{{ route('admin.upgrade_requests.approve', $upgradeRequest) }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full px-6 py-4 bg-green-600 text-white font-black text-lg rounded-2xl hover:bg-green-700 shadow-lg transition transform hover:-translate-y-1">
                        ✓ Setujui sebagai Publisher
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.upgrade_requests.reject', $upgradeRequest) }}" class="flex-1" onsubmit="return confirm('Yakin ingin menolak permintaan ini?')">
                    @csrf
                    <button type="submit" class="w-full px-6 py-4 bg-red-50 border border-red-200 text-red-700 font-bold text-lg rounded-2xl hover:bg-red-100 transition">
                        ✗ Tolak Permintaan
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-[#5C0F14] font-medium">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-dashboard-layout>
