<x-dashboard-layout>
    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                Partner Program
            </div>
            
            <div class="max-w-2xl">
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-4">
                    Gabung Menjadi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Publisher</span>
                </h2>
                <p class="text-gray-300 text-lg leading-relaxed">
                    Mulai perjalanan menulismu, publikasikan karyamu ke ribuan pembaca, dan dapatkan penghasilan dari setiap buku yang terjual.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Benefit Cards --}}
        <div class="space-y-6">
            <div class="p-6 rounded-2xl bg-white border border-gray-100 shadow-lg hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-[#5C0F14]/10 flex items-center justify-center mb-4 text-[#5C0F14]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Monetisasi Karyamu</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Dapatkan royalti kompetitif dari setiap penjualan buku. Atur harga bukumu sendiri.</p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-gray-100 shadow-lg hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-[#5C0F14]/10 flex items-center justify-center mb-4 text-[#5C0F14]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Kontrol Penuh</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Kelola katalog bukumu, edit deskripsi, cover, dan tarik buku dari peredaran kapan saja.</p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-gray-100 shadow-lg hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-[#5C0F14]/10 flex items-center justify-center mb-4 text-[#5C0F14]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" /></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Analitik Penjualan</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Pantau siapa yang membeli bukumu dengan dashboard analitik yang lengkap dan real-time.</p>
            </div>
        </div>

        {{-- Request Form --}}
        <div>
            <div class="rounded-2xl border border-gray-100 bg-white shadow-xl p-8 sticky top-24">
                <h3 class="font-black text-gray-900 text-2xl mb-2">Ajukan Permintaan</h3>
                <p class="text-sm text-gray-500 mb-6">Ceritakan sedikit tentang dirimu dan rencanamu sebagai penulis.</p>

                {{-- SweetAlert Logic using Alpine --}}
                @if(session('success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="mb-6 px-4 py-3 rounded-xl bg-green-50 border border-green-100 text-green-700 text-sm font-bold flex items-center gap-3 animate-pulse">
                        <div class="p-1 bg-green-200 rounded-full text-green-700">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                             <span class="block text-green-800 font-black">Berhasil Terkirim!</span>
                             <span class="text-xs font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                     <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 text-sm font-bold flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if($hasPendingRequest)
                    {{-- Pending State --}}
                    <div class="p-6 rounded-2xl bg-yellow-50 border border-yellow-100 text-center">
                        <div class="w-16 h-16 mx-auto bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-4 animate-bounce">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-black text-yellow-800 mb-2">Permintaan Sedang Diproses</h4>
                        <p class="text-sm text-yellow-700 leading-relaxed mb-4">
                            Tim kami sedang meninjau aplikasi Anda. Proses ini biasanya memakan waktu <strong>1x24 Jam</strong>. Mohon tunggu notifikasi selanjutnya via email.
                        </p>
                        <button disabled class="w-full px-6 py-3 bg-gray-200 text-gray-400 font-bold rounded-xl cursor-not-allowed">
                            Menunggu Persetujuan...
                        </button>
                    </div>
                @else
                    {{-- Active Form --}}
                    <form method="POST" action="{{ route('upgrade.publisher.request') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alasan Bergabung</label>
                            <textarea name="note" rows="5" class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition" placeholder="Contoh: Saya adalah penulis novel fiksi ilmiah dan ingin mempublikasikan karya saya..." required>{{ old('note') }}</textarea>
                            @error('note') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                        </div>

                        <div class="pt-2">
                             <button class="w-full px-8 py-4 bg-[#5C0F14] text-[#E6B65C] font-black text-lg rounded-2xl hover:bg-[#4a0b10] shadow-xl shadow-red-900/20 transition transform hover:-translate-y-1">
                                Kirim Permintaan
                            </button>
                        </div>
                        
                        <p class="text-xs text-center text-gray-400">
                            Dengan mengirim permintaan, Anda menyetujui <a href="{{ route('terms') }}" class="text-[#E6B65C] hover:underline">Syarat & Ketentuan</a> kami.
                        </p>
                    </form>
                 @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>
