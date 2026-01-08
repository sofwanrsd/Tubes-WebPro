<x-main-layout>
    {{-- Hero Section --}}
    <div class="relative py-20 overflow-hidden bg-gradient-to-br from-red-900 via-red-800 to-black sm:py-24">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="relative px-6 mx-auto max-w-7xl lg:px-8 text-center text-white">
            <h2 class="text-sm font-bold tracking-wide text-red-300 uppercase animate-fade-in-up">Legal Information</h2>
            <h1 class="mt-2 text-4xl font-extrabold tracking-tight sm:text-5xl animate-fade-in-up delay-100">Syarat & Ketentuan</h1>
            <p class="mt-4 text-lg text-red-100/80 max-w-2xl mx-auto animate-fade-in-up delay-200">
                Harap baca dengan seksama sebelum menggunakan layanan Dimz Store.
            </p>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="relative -mt-16 pb-24 px-6 mx-auto max-w-5xl lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            {{-- Last Updated --}}
            <div class="px-8 py-4 bg-gray-50 border-b border-gray-100 flex items-center gap-2 text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Terakhir diperbarui: 8 Januari 2026
            </div>

            <div class="p-8 md:p-12 prose prose-lg prose-red max-w-none text-gray-600">
                <h3>1. Penggunaan Layanan</h3>
                <p>
                    Selamat datang di Dimz Store. Dengan mengakses dan menggunakan platform ini, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini. 
                    Layanan kami ditujukan untuk mahasiswa dan akademisi untuk keperluan pendidikan dan referensi.
                </p>

                <h3>2. Hak Cipta & Lisensi</h3>
                <p>
                    Seluruh konten buku digital (e-book) yang tersedia di platform ini dilindungi oleh hak cipta penerbit masing-masing.
                </p>
                <ul>
                    <li>Anda diperbolehkan untuk mengunduh dan menyimpan file untuk penggunaan pribadi.</li>
                    <li><strong>Dilarang keras</strong> menyebarluaskan, menjual kembali, atau membagikan akses file kepada pihak lain tanpa izin tertulis.</li>
                </ul>

                <h3>3. Pembelian & Pembayaran</h3>
                <p>
                    Transaksi menggunakan sistem QRIS otomatis. Pastikan nominal pembayaran sesuai hingga digit terakhir.
                </p>
                <ul>
                    <li>Pembelian yang statusnya sudah "Paid" bersifat final dan tidak dapat dibatalkan (non-refundable).</li>
                    <li>Jika terjadi kendala teknis (link download error), silakan hubungi admin dalam waktu 1x24 jam.</li>
                </ul>

                <h3>4. Akun Pengguna</h3>
                <p>
                    Anda bertanggung jawab penuh atas keamanan akun Anda. Jangan memberitahukan password kepada siapapun.
                    Kami berhak menonaktifkan akun yang terindikasi melakukan pelanggaran atau aktivitas mencurigakan.
                </p>

                <h3>5. Perubahan Ketentuan</h3>
                <p>
                    Dimz Store berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan berlaku efektif segera setelah dipublikasikan di halaman ini.
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
