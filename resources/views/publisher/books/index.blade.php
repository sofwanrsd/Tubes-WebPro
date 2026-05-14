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
                Publisher Studio
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-2">
                        Buku <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Saya</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Daftar karya yang telah Anda tulis. Kelola status publikasi, edit detail, atau tambahkan buku baru.
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('publisher.books.create') }}"
                       class="px-6 py-3 rounded-xl bg-[#E6B65C] text-[#5C0F14] font-bold hover:bg-[#d4a040] transition shadow-lg shadow-orange-900/20 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Buku
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Content --}}
    <div class="rounded-2xl border border-gray-100 bg-white shadow-xl overflow-hidden">
        {{-- Desktop Table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 font-bold uppercase tracking-wider text-xs">
                    <tr>
                        <th class="py-4 px-6">Buku</th>
                        <th class="py-4 px-6">Harga</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($books as $b)
                        <tr class="group hover:bg-orange-50/30 transition">
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-16 bg-gray-200 rounded-lg overflow-hidden shadow-sm flex-shrink-0 relative">
                                        @if($b->cover_path)
                                            <img src="{{ asset('storage/' . $b->cover_path) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400 font-bold text-center p-1">No Cover</div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 text-base mb-1 group-hover:text-[#5C0F14] transition">{{ $b->title }}</div>
                                        <div class="text-xs text-gray-400">
                                            {{ $b->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-6 font-bold text-gray-700">
                                {{ $fmt($b->price) }}
                            </td>
                            <td class="py-5 px-6">
                                @if($b->status === 'published')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wide border border-green-200">
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gray-100 text-gray-500 text-xs font-bold uppercase tracking-wide border border-gray-200">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-5 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('publisher.books.edit', $b) }}" 
                                       class="px-3 py-2 rounded-lg bg-[#E6B65C]/10 text-[#5C0F14] font-bold text-xs hover:bg-[#E6B65C] hover:text-[#5C0F14] transition border border-[#E6B65C]/20">
                                        Edit
                                    </a>
                                    <form class="inline" method="POST" action="{{ route('publisher.books.destroy', $b) }}" onsubmit="return confirm('Yakin ingin menghapus buku ini? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-2 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600 font-bold text-xs transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if($books->isEmpty())
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Belum ada buku</h3>
                                    <p class="text-gray-500 text-sm mt-1">Mulai tulis karya pertamamu sekarang!</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Mobile Cards --}}
        <div class="md:hidden p-4 space-y-4">
            @forelse($books as $b)
                <div class="rounded-xl border border-gray-200 p-4 bg-white shadow-sm">
                    <div class="flex gap-4">
                        <div class="w-20 h-28 bg-gray-200 rounded-lg overflow-hidden shadow-sm flex-shrink-0 relative">
                            @if($b->cover_path)
                                <img src="{{ asset('storage/' . $b->cover_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400 font-bold text-center p-1">No Cover</div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h4 class="font-bold text-gray-900 text-lg leading-tight truncate pr-2">{{ $b->title }}</h4>
                                @if($b->status === 'published')
                                    <span class="flex-shrink-0 inline-block w-2 h-2 rounded-full bg-green-500" title="Published"></span>
                                @else
                                    <span class="flex-shrink-0 inline-block w-2 h-2 rounded-full bg-gray-300" title="Draft"></span>
                                @endif
                            </div>
                            <div class="text-sm text-[#5C0F14] font-bold mt-1">{{ $fmt($b->price) }}</div>
                            <div class="text-xs text-gray-400 mt-2">Added {{ $b->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex gap-3">
                        <a href="{{ route('publisher.books.edit', $b) }}" class="flex-1 py-2 rounded-lg bg-gray-50 text-gray-700 font-bold text-xs text-center border border-gray-200 hover:bg-gray-100">
                            Edit
                        </a>
                        <form class="flex-1" method="POST" action="{{ route('publisher.books.destroy', $b) }}" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="w-full py-2 rounded-lg bg-red-50 text-red-600 font-bold text-xs border border-red-100 hover:bg-red-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <p class="text-gray-500 font-medium">Belum ada buku saat ini.</p>
                </div>
            @endforelse
        </div>

        <div class="p-5 border-t border-gray-100 bg-gray-50">
            {{ $books->links() }}
        </div>
    </div>
</x-dashboard-layout>
