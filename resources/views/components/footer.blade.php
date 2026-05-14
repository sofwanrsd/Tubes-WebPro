<footer class="text-white border-t border-white/10 bg-gradient-to-br from-red-950 via-red-900 to-black">
    @php $isHome = request()->routeIs('home'); @endphp
    <div class="px-6 py-12 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-4">

            {{-- Brand --}}
            <div class="md:col-span-1">
                <a href="{{ route('home') }}" class="text-xl font-extrabold transition hover:opacity-90">
                    Dimz Store
                </a>
                <p class="mt-3 text-sm leading-relaxed text-white/70">
                    Digital Knowledge Hub untuk mahasiswa. Bayar QRIS, auto-verifikasi, langsung download.
                </p>

                <div class="inline-flex items-center gap-2 px-3 py-1 mt-5 text-xs font-semibold border rounded-full bg-white/10 border-white/15 text-white/80">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Auto-Delivery Aktif
                </div>
            </div>

            {{-- Menu --}}
            <div>
                <h3 class="text-sm font-extrabold tracking-wide uppercase text-white/90">Menu</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="transition text-white/70 hover:text-white">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('catalog.index') }}" class="transition text-white/70 hover:text-white">Catalog</a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}" class="transition text-white/70 hover:text-white">Cart</a>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="transition text-white/70 hover:text-white">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="transition text-white/70 hover:text-white">Register</a>
                        </li>
                    @endguest
                    @auth
                        <li>
                            <a href="{{ route('dashboard') }}" class="transition text-white/70 hover:text-white">Dashboard</a>
                        </li>
                    @endauth
                </ul>
            </div>

            {{-- Informasi --}}
            <div>
                <h3 class="text-sm font-extrabold tracking-wide uppercase text-white/90">Informasi</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ $isHome ? '#' : route('home') }}" class="transition text-white/70 hover:text-white">About</a></li>
                    <li><a href="{{ route('terms') }}" class="transition text-white/70 hover:text-white">Syarat & Ketentuan</a></li>
                    <li><a href="{{ route('privacy') }}" class="transition text-white/70 hover:text-white">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('home').'#faq' }}" class="transition text-white/70 hover:text-white">FAQ / Bantuan</a></li>
                </ul>
            </div>

            {{-- CTA / Contact --}}
            <div>
                <h3 class="text-sm font-extrabold tracking-wide uppercase text-white/90">Hubungi</h3>
                <div class="mt-4 space-y-3 text-sm text-white/70">
                    <p>
                        Email: <span class="font-semibold text-white/90">support@dimzstore.test</span>
                    </p>
                    <p>
                        WA: <span class="font-semibold text-white/90">0812-3456-7890</span>
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
        <div class="flex flex-col items-center justify-between gap-3 pt-6 mt-10 border-t border-white/10 sm:flex-row">
            <p class="text-xs text-white/50">
                © 2025 Dimz Store - Fakultas Informatika Universitas Telkom.
            </p>
            <div class="flex items-center gap-4 text-xs">
                <a href="{{ route('privacy') }}" class="transition text-white/50 hover:text-white">Privacy</a>
                <span class="text-white/20">•</span>
                <a href="{{ route('terms') }}" class="transition text-white/50 hover:text-white">Terms</a>
                <span class="text-white/20">•</span>
                <a href="{{ $isHome ? '#faq' : route('home').'#faq' }}" class="transition text-white/50 hover:text-white">Support</a>
            </div>
        </div>
    </div>
</footer>
