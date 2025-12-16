<x-app-layout>
    <div class="min-h-[calc(100vh-4rem)] bg-gradient-to-b from-red-950 via-red-900 to-black py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 px-4">

            {{-- Header --}}
            <div class="mb-7">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-white/90 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    Pembayaran QRIS
                </div>

                <h2 class="mt-4 text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Selesaikan Pembayaran
                </h2>
                <p class="mt-2 text-white/70 max-w-2xl">
                    Scan QRIS di bawah ini lewat aplikasi e-wallet / m-banking kamu. Setelah bayar, klik “Cek Pembayaran” atau tunggu auto-check.
                </p>
            </div>

            {{-- Main Card --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                {{-- LEFT: QR --}}
                <div class="lg:col-span-7">
                    <div class="rounded-2xl border border-white/10 bg-white/95 backdrop-blur shadow-2xl overflow-hidden">
                        <div class="px-6 py-5 bg-gradient-to-r from-red-800 via-red-700 to-red-800 text-white">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-xs text-white/80 font-semibold">Order</div>
                                    <div class="text-lg font-extrabold">#{{ $order->id }}</div>
                                </div>

                                <div class="text-right">
                                    <div class="text-xs text-white/80 font-semibold">Total Bayar</div>
                                    <div class="text-lg font-extrabold">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            {{-- QR Area --}}
                            @if($order->payment && $order->payment->qris_dynamic_image)
                                <div class="flex flex-col items-center">
                                    <div class="w-full max-w-sm rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                                        <img class="w-full aspect-square object-contain"
                                             src="{{ $order->payment->qris_dynamic_image }}"
                                             alt="QRIS">
                                    </div>

                                    <div class="mt-4 w-full max-w-sm">
                                        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                                            <div class="text-xs font-bold text-red-700 uppercase tracking-wide">
                                                Cara bayar cepat
                                            </div>
                                            <ol class="mt-2 text-sm text-red-900/80 list-decimal pl-5 space-y-1">
                                                <li>Buka e-wallet / m-banking</li>
                                                <li>Pilih menu QRIS / Scan</li>
                                                <li>Scan QR ini lalu bayar</li>
                                                <li>Kembali ke sini untuk cek status</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="rounded-2xl border border-gray-200 bg-white p-10 text-center">
                                    <div class="text-xl font-extrabold text-gray-900">QR belum tersedia</div>
                                    <p class="text-gray-600 mt-2">
                                        QR belum tersedia (cek konfigurasi QRIS_STATIC_RAW / QRIS Dynamic).
                                    </p>
                                </div>
                            @endif

                            {{-- Actions --}}
                            <div class="mt-6 flex flex-col sm:flex-row gap-3">
                                <button id="btn-check"
                                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-red-800 text-white font-extrabold
                                               hover:bg-red-700 transition shadow-[0_0_18px_rgba(185,28,28,0.25)]
                                               focus:outline-none focus:ring-2 focus:ring-red-300">
                                    <span id="btn-icon" class="inline-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.992 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M2.985 14.652l3.181-3.182a8.25 8.25 0 0 1 13.803 3.7" />
                                        </svg>
                                    </span>
                                    <span id="btn-text">Cek Pembayaran</span>
                                </button>

                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 font-extrabold
                                          hover:bg-gray-50 transition">
                                    Lihat Detail Order
                                </a>
                            </div>

                            <div id="msg" class="mt-4 text-center text-sm font-semibold"></div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: STATUS + COUNTDOWN --}}
                <div class="lg:col-span-5 space-y-6">
                    <div class="rounded-2xl border border-white/10 bg-black/20 backdrop-blur p-6 text-white">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-xs font-semibold text-white/70">Status</div>
                                <div class="mt-1">
                                    <span id="status-badge"
                                          class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-white text-sm font-extrabold">
                                        <span class="w-2 h-2 rounded-full bg-yellow-300" id="status-dot"></span>
                                        <span id="status-text">{{ $order->status }}</span>
                                    </span>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-xs font-semibold text-white/70">Expire</div>
                                <div class="text-sm font-extrabold text-white/90" id="expire-at">
                                    {{ $order->expires_at }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="flex items-end justify-between">
                                <div>
                                    <div class="text-xs font-semibold text-white/70">Countdown</div>
                                    <div id="countdown" class="text-3xl font-extrabold tracking-tight">--:--</div>
                                </div>
                                <div class="text-right text-xs text-white/60">
                                    Auto-check: <span class="font-bold text-white/80" id="autocheck-label">ON</span>
                                </div>
                            </div>

                            {{-- progress bar --}}
                            <div class="mt-4 h-3 rounded-full bg-white/10 overflow-hidden border border-white/10">
                                <div id="timebar" class="h-full w-0 bg-white/60"></div>
                            </div>

                            <div id="warning" class="hidden mt-3 rounded-xl border border-yellow-300/30 bg-yellow-300/10 px-4 py-3 text-sm text-yellow-100">
                                Waktu hampir habis. Kalau gagal, buat order baru ya.
                            </div>
                        </div>

                        <div class="mt-6 rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-sm text-white/70">
                            <div class="font-extrabold text-white mb-1">Catatan</div>
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Pastikan nominal sesuai.</li>
                                <li>Setelah bayar, status bisa update beberapa detik.</li>
                                <li>Kalau sudah “paid”, kamu akan diarahkan otomatis.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- small help --}}
                    <div class="rounded-2xl border border-white/10 bg-black/20 backdrop-blur p-6 text-white">
                        <div class="text-sm font-extrabold">Troubleshoot cepat</div>
                        <div class="mt-2 text-sm text-white/70 space-y-2">
                            <p>• QR blur? Zoom / screenshot lalu scan dari galeri.</p>
                            <p>• Sudah bayar tapi belum update? Tunggu 10–20 detik, lalu klik “Cek Pembayaran”.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const expiresAt = new Date("{{ optional($order->expires_at)->toIso8601String() }}").getTime();
        const createdAt = new Date("{{ optional($order->created_at)->toIso8601String() }}").getTime();

        const countdownEl  = document.getElementById('countdown');
        const statusTextEl = document.getElementById('status-text');
        const statusBadge  = document.getElementById('status-badge');
        const statusDot    = document.getElementById('status-dot');
        const msg          = document.getElementById('msg');
        const warning      = document.getElementById('warning');
        const timebar      = document.getElementById('timebar');

        const btnCheck = document.getElementById('btn-check');
        const btnText  = document.getElementById('btn-text');
        const btnIcon  = document.getElementById('btn-icon');

        let isChecking = false;
        let autoTimer = null;

        function pad(n){ return String(n).padStart(2,'0'); }

        function setMsg(text, type='info'){
            msg.textContent = text || '';
            msg.className = 'mt-4 text-center text-sm font-semibold';

            if (!text) return;

            if (type === 'ok') msg.classList.add('text-green-700');
            else if (type === 'warn') msg.classList.add('text-yellow-700');
            else if (type === 'bad') msg.classList.add('text-red-700');
            else msg.classList.add('text-gray-600');
        }

        function setStatusUI(status){
            const s = (status || '').toLowerCase();
            statusTextEl.textContent = status;

            // reset
            statusBadge.className = 'inline-flex items-center gap-2 px-3 py-1 rounded-full border text-white text-sm font-extrabold';
            statusDot.className   = 'w-2 h-2 rounded-full';

            if (s === 'paid' || s === 'success') {
                statusBadge.classList.add('bg-green-500/20','border-green-400/30');
                statusDot.classList.add('bg-green-300');
            } else if (s === 'expired' || s === 'failed') {
                statusBadge.classList.add('bg-red-500/20','border-red-400/30');
                statusDot.classList.add('bg-red-300');
            } else {
                statusBadge.classList.add('bg-white/10','border-white/15');
                statusDot.classList.add('bg-yellow-300');
            }
        }

        function tick(){
            const now = Date.now();
            let diff = Math.max(0, expiresAt - now);

            const m = Math.floor(diff/60000);
            const s = Math.floor((diff%60000)/1000);
            countdownEl.textContent = pad(m) + ":" + pad(s);

            // progress bar (elapsed)
            const total = Math.max(1, expiresAt - createdAt);
            const elapsed = Math.min(total, Math.max(0, now - createdAt));
            const pct = Math.min(100, Math.max(0, (elapsed / total) * 100));
            timebar.style.width = pct + '%';

            // warning if <= 2 minutes left
            if (diff > 0 && diff <= 120000) warning.classList.remove('hidden');
            else warning.classList.add('hidden');

            // expired msg
            const cur = (statusTextEl.textContent || '').toLowerCase();
            if (diff <= 0 && cur === 'pending') {
                setMsg('Order expired. Silakan buat order baru.', 'bad');
                setStatusUI('expired');
                stopAutoCheck();
            }
        }

        setInterval(tick, 1000); tick();
        setStatusUI("{{ $order->status }}");

        function setLoading(on){
            isChecking = on;
            btnCheck.disabled = on;
            btnCheck.classList.toggle('opacity-60', on);
            btnCheck.classList.toggle('cursor-not-allowed', on);

            btnText.textContent = on ? 'Mengecek...' : 'Cek Pembayaran';
            btnIcon.innerHTML = on
              ? `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 animate-spin">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m6.364 1.636-2.121 2.121M21 12h-3M18.364 18.364l-2.121-2.121M12 21v-3M5.636 18.364l2.121-2.121M3 12h3M5.636 5.636l2.121 2.121"/>
                 </svg>`
              : `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.992 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M2.985 14.652l3.181-3.182a8.25 8.25 0 0 1 13.803 3.7" />
                 </svg>`;
        }

        async function checkPayment(source='manual') {
            if (isChecking) return;

            setLoading(true);
            setMsg(source === 'auto' ? 'Auto-check: mengecek status...' : 'Mengecek pembayaran...', 'info');

            try {
                const res = await fetch("{{ route('payment.check', $order->id) }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({})
                });

                const json = await res.json();
                const status = (json.status || '').toLowerCase();

                setStatusUI(json.status);

                if (status === 'paid' || status === 'success') {
                    setMsg('Pembayaran berhasil! Mengarahkan...', 'ok');
                    stopAutoCheck();
                    window.location.href = "{{ route('orders.show', $order->id) }}";
                } else if (status === 'expired' || status === 'failed') {
                    setMsg('Order expired/gagal. Silakan buat order baru.', 'bad');
                    stopAutoCheck();
                } else {
                    setMsg('Belum terdeteksi. Coba lagi beberapa saat.', 'warn');
                }
            } catch (e) {
                setMsg('Gagal cek pembayaran. Coba lagi.', 'bad');
            } finally {
                setLoading(false);
            }
        }

        function startAutoCheck(){
            stopAutoCheck();
            autoTimer = setInterval(() => {
                const cur = (statusTextEl.textContent || '').toLowerCase();
                const now = Date.now();
                if (now >= expiresAt) return;
                if (cur === 'paid' || cur === 'success' || cur === 'expired' || cur === 'failed') return;
                checkPayment('auto');
            }, 8000); // tiap 8 detik biar ga spam server
        }

        function stopAutoCheck(){
            if (autoTimer) clearInterval(autoTimer);
            autoTimer = null;
            const label = document.getElementById('autocheck-label');
            if (label) label.textContent = 'OFF';
        }

        document.getElementById('btn-check').addEventListener('click', () => checkPayment('manual'));

        // auto-check default ON selama belum expired & belum paid
        startAutoCheck();
    </script>
</x-app-layout>
