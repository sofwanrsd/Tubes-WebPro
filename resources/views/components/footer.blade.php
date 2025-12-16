<footer class="border-t border-white/10 bg-gradient-to-br from-red-950 via-red-900 to-black text-white">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- Brand --}}
            <div class="md:col-span-1">
                <a href="{{ route('home') }}" class="text-xl font-extrabold hover:opacity-90 transition">
                    Dimz Store
                </a>
                <p class="mt-3 text-sm text-white/70 leading-relaxed">
                    Digital Knowledge Hub untuk mahasiswa. Bayar QRIS, auto-verifikasi, langsung download.
                </p>

                <div class="mt-5 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-white/80 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    Auto-Delivery Aktif
                </div>
            </div>

            {{-- Menu --}}
            <div>
                <h3 class="text-sm font-extrabold tracking-wide uppercase text-white/90">Menu</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-white/70 hover:text-white transition">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('catalog.index') }}" class="text-white/70 hover:text-white transition">Catalog</a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}" class="text-white/70 hover:text-white transition">Cart</a>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="text-white/70 hover:text-white transition">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-white/70 hover:text-white transition">Register</a>
                        </li>
                    @endguest
                    @auth
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-white/70 hover:text-white transition">Dashboard</a>
                        </li>
                    @endauth
                </ul>
            </div>

            {{-- Informasi --}}
            <div>
                <h3 class="text-sm font-extrabold tracking-wide uppercase text-white/90">Informasi</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    {{-- ini link placeholder, ganti route kalau nanti udah ada --}}
                    <li><a href="#" class="text-white/70 hover:text-white transition">About</a></li>
                    <li><a href="#" class="text-white/70 hover:text-white transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="text-white/70 hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-white/70 hover:text-white transition">FAQ / Bantuan</a></li>
                </ul>
            </div>

            {{-- CTA / Contact --}}
            <div>
                <h3 class="text-sm font-extrabold tracking-wide uppercase text-white/90">Hubungi</h3>
                <div class="mt-4 space-y-3 text-sm text-white/70">
                    <p>
                        Email: <span class="text-white/90 font-semibold">support@dimzstore.test</span>
                    </p>
                    <p>
                        WA: <span class="text-white/90 font-semibold">08xx-xxxx-xxxx</span>
                    </p>
                    <p class="text-xs text-white/50">
                        *Silakan ganti kontak ini sesuai data kamu.
                    </p>
                </div>

                <div class="mt-5">
                    <a href="{{ route('catalog.index') }}"
                       class="inline-flex items-center justify-center w-full px-6 py-3 rounded-xl bg-white text-red-900 font-extrabold
                              shadow-[0_0_20px_rgba(255,255,255,0.25)] hover:shadow-[0_0_30px_rgba(255,255,255,0.45)]
                              hover:scale-[1.01] transition-all duration-300">
                        Buka Katalog
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="mt-10 pt-6 border-t border-white/10 flex flex-col sm:flex-row gap-3 items-center justify-between">
            <p class="text-xs text-white/50">
                © 2025 Dimz Store - Fakultas Informatika Universitas Telkom.
            </p>
            <div class="flex items-center gap-4 text-xs">
                <a href="#" class="text-white/50 hover:text-white transition">Privacy</a>
                <span class="text-white/20">•</span>
                <a href="#" class="text-white/50 hover:text-white transition">Terms</a>
                <span class="text-white/20">•</span>
                <a href="#" class="text-white/50 hover:text-white transition">Support</a>
            </div>
        </div>
    </div>
</footer>
