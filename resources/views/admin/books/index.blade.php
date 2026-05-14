<x-dashboard-layout>
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
                        Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Buku</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Moderasi katalog buku, update status publikasi, dan kelola karya publisher.
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

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-900 shadow-sm flex items-center gap-3">
             <div class="p-2 bg-green-200 rounded-full text-green-800">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </div>
            <div>
                <div class="font-bold">Berhasil!</div>
                <div class="text-sm text-green-800">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.books.index') }}" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-lg mb-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            {{-- Search --}}
            <div class="md:col-span-5">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Pencarian</label>
                <div class="relative group">
                    <input name="search"
                           type="text"
                           value="{{ request('search') }}"
                           placeholder="Cari Judul atau Publisher..."
                           class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] focus:bg-white transition pl-10">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400 group-focus-within:text-[#E6B65C] transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Status Filter --}}
            <div class="md:col-span-3">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Status Publikasi</label>
                <div class="relative">
                    <select name="status"
                            class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] focus:bg-white transition cursor-pointer">
                        <option value="all" @selected(request('status')=='all')>Semua Status</option>
                        <option value="published" @selected(request('status')=='published')>Published (Terbit)</option>
                        <option value="draft" @selected(request('status')=='draft')>Draft</option>
                        <option value="unpublished" @selected(request('status')=='unpublished')>Unpublished</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </div>
            </div>
            
             {{-- Per Page --}}
             <div class="md:col-span-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Tampilan</label>
                 <div class="relative">
                    <select name="per_page" class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] focus:bg-white transition cursor-pointer">
                        <option value="10" @selected(request('per_page') == 10)>10</option>
                        <option value="20" @selected(request('per_page') == 20)>20</option>
                        <option value="50" @selected(request('per_page') == 50)>50</option>
                    </select>
                     <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </div>
            </div>


             {{-- Button Filter --}}
            <div class="md:col-span-2">
                 <button type="submit" class="w-full rounded-xl px-4 py-3 bg-[#5C0F14] text-[#E6B65C] font-bold text-sm hover:bg-[#4a0b10] transition shadow-md flex justify-center items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                    Filter
                </button>
             </div>
        </div>
    </form>

    {{-- Books Table --}}
    <div class="rounded-2xl border border-gray-100 bg-white shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#5C0F14] text-white">
                    <tr class="text-left">
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Informasi Buku</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Publisher</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs">Status</th>
                        <th class="py-4 px-6 font-bold uppercase tracking-wider text-xs text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($books as $b)
                        @php
                            $status = strtolower($b->status ?? 'draft');
                            $badge = match($status) {
                                'published'   => 'bg-green-100 text-green-800 border-green-200',
                                'draft'       => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'unpublished' => 'bg-red-100 text-red-800 border-red-200',
                                default       => 'bg-gray-100 text-gray-800 border-gray-200',
                            };
                        @endphp
                        <tr class="group hover:bg-orange-50/30 transition-colors duration-200">
                            {{-- Title & Cover --}}
                            <td class="py-4 px-6">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-12 h-16 bg-gray-200 rounded-md overflow-hidden shadow-sm border border-gray-200">
                                        @if($b->cover_path)
                                            <img src="{{ asset('storage/' . $b->cover_path) }}" alt="{{ $b->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 line-clamp-1 group-hover:text-[#5C0F14] transition">{{ $b->title }}</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            Rp {{ number_format($b->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Publisher --}}
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-gray-700">
                                    {{ $b->publisher->name ?? 'Unknown' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $b->publisher->email ?? '-' }}
                                </div>
                            </td>

                            {{-- Status Badge --}}
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full border text-[10px] font-black uppercase tracking-wide {{ $badge }}">
                                    {{ $status }}
                                </span>
                            </td>

                            {{-- Action --}}
                            <td class="py-4 px-6 text-right">
                                <form method="POST" action="{{ route('admin.books.status', $b->id) }}" class="inline-flex items-center justify-end gap-2">
                                    @csrf
                                    <div class="relative">
                                         <select name="status" class="appearance-none rounded-lg border border-gray-200 bg-white pl-3 pr-8 py-2 text-xs font-bold focus:outline-none focus:ring-2 focus:ring-[#E6B65C] cursor-pointer hover:border-[#E6B65C] transition">
                                            @foreach(['draft'=>'Draft', 'published'=>'Published', 'unpublished'=>'Unpublished'] as $val => $label)
                                                <option value="{{ $val }}" @selected($status === $val)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                         <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-400">
                                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                        </div>
                                    </div>
                                   
                                    <button type="submit" class="p-2 rounded-lg bg-gray-900 text-white hover:bg-[#5C0F14] transition shadow-sm" title="Simpan Perubahan">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                         <tr>
                            <td colspan="4" class="py-12 px-6 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Tidak ada buku ditemukan</h3>
                                    <p class="text-gray-500 text-sm mt-1">Coba sesuaikan kata kunci pencarian atau filter.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $books->links() }}
        </div>
    </div>
</x-dashboard-layout>
