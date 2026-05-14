<x-dashboard-layout>
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
                        Tambah <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Buku</span>
                    </h2>
                    <p class="text-gray-300 text-lg max-w-xl">
                        Publikasikan karya terbarumu dan jangkau lebih banyak pembaca.
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('publisher.books.index') }}"
                       class="px-6 py-3 rounded-xl border border-[#E6B65C]/30 bg-[#E6B65C]/10 text-[#E6B65C] font-bold hover:bg-[#E6B65C] hover:text-[#5C0F14] transition backdrop-blur-sm">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="max-w-4xl mx-auto">
        <div class="rounded-2xl border border-gray-100 bg-white shadow-xl p-8">
            <h3 class="font-black text-gray-900 text-xl mb-6 flex items-center gap-3">
                <div class="p-2 rounded-lg bg-[#5C0F14]/10 text-[#5C0F14]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                Informasi Buku
            </h3>

            <form method="POST" action="{{ route('publisher.books.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Buku</label>
                    <input name="title" class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition" value="{{ old('title') }}" placeholder="Masukkan judul buku yang menarik...">
                    @error('title') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Genre</label>
                        <input name="genre" class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition" value="{{ old('genre') }}" placeholder="Contoh: Fiksi, Teknologi, Bisnis">
                        @error('genre') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Harga (IDR)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">Rp</span>
                            <input name="price" type="number" class="w-full pl-12 rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition" value="{{ old('price', 0) }}">
                        </div>
                        @error('price') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sinopsis / Deskripsi</label>
                    <textarea name="description" class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition" rows="5" placeholder="Ceritakan ringkasan isi buku ini...">{{ old('description') }}</textarea>
                    @error('description') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Status Publikasi</label>
                    <div class="relative">
                         <select name="status" class="w-full appearance-none rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition px-4 py-3 bg-white">
                            <option value="draft" @selected(old('status')=='draft')>Draft (Disimpan dulu)</option>
                            <option value="published" @selected(old('status')=='published')>Published (Langsung tayang)</option>
                            <option value="unpublished" @selected(old('status')=='unpublished')>Unpublished (Tarik dari katalog)</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    @error('status') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                </div>

                <div class="border-t border-gray-100 my-6"></div>
                
                <h3 class="font-black text-gray-900 text-xl mb-6 flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-[#5C0F14]/10 text-[#5C0F14]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                    </div>
                    File Buku
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Cover Buku (JPG/PNG)</label>
                        <div class="relative group">
                            <input type="file" name="cover" accept="image/png,image/jpeg" 
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-3 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#5C0F14]/5 file:text-[#5C0F14]
                                          hover:file:bg-[#5C0F14]/10 transition cursor-pointer">
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Disarankan rasio potrait (3:4).</p>
                        @error('cover') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">File E-Book (PDF)</label>
                         <div class="relative group">
                            <input type="file" name="ebook" accept="application/pdf" 
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-3 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#5C0F14]/5 file:text-[#5C0F14]
                                          hover:file:bg-[#5C0F14]/10 transition cursor-pointer">
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Pastikan format PDF valid.</p>
                        @error('ebook') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-6 mt-6 border-t border-gray-100">
                    <button class="px-8 py-4 bg-[#5C0F14] text-[#E6B65C] font-black text-lg rounded-2xl hover:bg-[#4a0b10] shadow-xl shadow-red-900/20 transition transform hover:-translate-y-1">
                        Simpan & Publish
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
