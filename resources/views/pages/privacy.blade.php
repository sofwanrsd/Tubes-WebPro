<x-main-layout>
    {{-- Hero Section --}}
    <div class="relative py-20 overflow-hidden bg-gradient-to-br from-red-900 via-red-800 to-black sm:py-24">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="relative px-6 mx-auto max-w-7xl lg:px-8 text-center text-white">
            <h2 class="text-sm font-bold tracking-wide text-red-300 uppercase animate-fade-in-up">Data Protection</h2>
            <h1 class="mt-2 text-4xl font-extrabold tracking-tight sm:text-5xl animate-fade-in-up delay-100">Kebijakan Privasi</h1>
            <p class="mt-4 text-lg text-red-100/80 max-w-2xl mx-auto animate-fade-in-up delay-200">
                Komitmen kami untuk melindungi data dan informasi pribadi Anda.
            </p>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="relative -mt-16 pb-24 px-6 mx-auto max-w-5xl lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            {{-- Last Updated --}}
            <div class="px-8 py-4 bg-gray-50 border-b border-gray-100 flex items-center gap-2 text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Status: Berlaku Efektif
            </div>

            <div class="p-8 md:p-12 prose prose-lg prose-red max-w-none text-gray-600">
                <h3>1. Data yang Kami Kumpulkan</h3>
                <p>
                    Untuk memproses transaksi dan menyediakan layanan, kami mengumpulkan beberapa informasi dasar:
                </p>
                <ul>
                    <li>Nama Lengkap (untuk profil)</li>
                    <li>Alamat Email (untuk pengiriman akses buku)</li>
                    <li>Riwayat Pesanan (untuk dashboard pengguna)</li>
                </ul>

                <h3>2. Penggunaan Data</h3>
                <p>
                    Data Anda hanya digunakan untuk kepentingan internal Dimz Store:
                </p>
                <ul>
                    <li>Memverifikasi pembayaran otomatis via QRIS.</li>
                    <li>Mengirimkan notifikasi status pesanan.</li>
                    <li>Meningkatkan kualitas rekomendasi buku.</li>
                </ul>
                <div class="bg-red-50 p-4 rounded-xl border border-red-100 text-sm italic text-red-800">
                    <strong>PENTING:</strong> Kami tidak pernah menjual, menyewakan, atau membagikan data pribadi Anda kepada pihak ketiga untuk tujuan pemasaran.
                </div>

                <h3>3. Keamanan Informasi</h3>
                <p>
                    Kami menerapkan standar keamanan industri untuk melindungi akses tidak sah. 
                    Semua password dienkripsi, dan koneksi website menggunakan SSL (Secure Socket Layer).
                </p>

                <h3>4. Cookies</h3>
                <p>
                    Website ini menggunakan "cookies" sesi untuk menyimpan status login Anda dan isi keranjang belanja sementara. 
                    Anda dapat menonaktifkannya di pengaturan browser, namun beberapa fitur mungkin tidak berjalan optimal.
                </p>

                <h3>5. Kontak Kami</h3>
                <p>
                    Jika Anda memiliki pertanyaan mengenai penggunaan data Anda, silakan hubungi tim support kami melalui menu Bantuan.
                </p>
            </div>
        </div>

        <div class="mt-12 text-center pb-12">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-white text-gray-700 font-bold shadow-lg shadow-gray-200/50 border border-gray-100 hover:bg-gray-50 hover:text-[#5C0F14] hover:border-red-100 hover:-translate-y-1 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-main-layout>
