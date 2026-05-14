<x-main-layout>
    <div class="min-h-[calc(100vh-4rem)] flex flex-col bg-gradient-to-b from-[#5C0F14] via-[#2E0508] to-gray-50 pb-24">
        {{-- HERO HEADER --}}
        <div class="relative pt-12 pb-16 overflow-hidden text-center">
            <div class="absolute inset-0 opacity-20 z-0" 
                 style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
            
            <div class="relative z-10 px-6">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                    Menunggu Pembayaran
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-[#F8F8F8] tracking-tight mb-4">
                    Selesaikan <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Pembayaran</span>
                </h1>
                <p class="text-[#F8F8F8]/70 max-w-2xl mx-auto text-lg leading-relaxed">
                    Scan QRIS di bawah ini untuk menyelesaikan pesananmu.
                </p>
            </div>
        </div>

        <div class="flex-1 px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
            <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- LEFT: QR CARD --}}
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                        {{-- Header --}}
                        <div class="px-8 py-6 bg-gradient-to-r from-[#5C0F14] via-[#4a0b10] to-[#5C0F14] text-white flex items-center justify-between">
                            <div>
                                <div class="text-xs text-[#E6B65C] font-bold uppercase tracking-wider mb-1">Order ID</div>
                                <div class="text-xl font-black tracking-tight">#{{ $order->id }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-[#E6B65C] font-bold uppercase tracking-wider mb-1">Total Tagihan</div>
                                <div class="text-xl font-black tracking-tight">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <div class="p-8 flex flex-col items-center">
                            {{-- QR Display --}}
                            @if($order->payment && $order->payment->qris_dynamic_image)
                                <div class="relative w-full max-w-[320px] bg-white p-4 rounded-2xl border-2 border-dashed border-gray-200 shadow-sm group hover:border-[#5C0F14]/30 transition-colors duration-300">
                                    <div class="aspect-square bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center">
                                         <img class="w-full h-full object-contain mix-blend-multiply"
                                              src="{{ $order->payment->qris_dynamic_image }}"
                                              alt="QRIS Code">
                                    </div>
                                    <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 px-4 py-1 bg-white border border-gray-100 rounded-full text-[10px] font-bold text-gray-400 shadow-sm whitespace-nowrap">
                                        Scan via GoPay / OVO / Dana / BCA
                                    </div>
                                </div>
                            @else
                                <div class="w-full max-w-[300px] aspect-square rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-center p-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <p class="font-bold text-gray-500">QR Code Belum Tersedia</p>
                                    <p class="text-xs text-gray-400 mt-1">Mohon hubungi admin jika masalah berlanjut.</p>
                                </div>
                            @endif

                            {{-- Instructions --}}
                            <div class="mt-8 w-full bg-blue-50/50 border border-blue-100 rounded-xl p-5">
                                <h3 class="text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                                    <span class="flex items-center justify-center w-5 h-5 rounded-full bg-blue-100 text-blue-600 text-xs">i</span>
                                    Cara Pembayaran
                                </h3>
                                <ol class="text-sm text-blue-800/80 space-y-2 pl-2">
                                    <li class="flex gap-3">
                                        <span class="font-bold text-blue-300">1.</span>
                                        <span>Buka aplikasi E-Wallet atau Mobile Banking kamu.</span>
                                    </li>
                                    <li class="flex gap-3">
                                        <span class="font-bold text-blue-300">2.</span>
                                        <span>Scan QRIS di atas.</span>
                                    </li>
                                    <li class="flex gap-3">
                                        <span class="font-bold text-blue-300">3.</span>
                                        <span>Pastikan nominal bayar sesuai total tagihan: <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></span>
                                    </li>
                                    <li class="flex gap-3">
                                        <span class="font-bold text-blue-300">4.</span>
                                        <span>Setelah berhasil, klik tombol <strong>"Cek Pembayaran"</strong> di bawah.</span>
                                    </li>
                                </ol>
                            </div>
                            
                            {{-- Manual Check Action --}}
                            <div class="mt-8 w-full flex flex-col gap-3">
                                <button id="btn-check"
                                   class="group relative flex items-center justify-center w-full px-6 py-4 rounded-xl bg-[#5C0F14] text-[#E6B65C] font-black text-lg shadow-lg shadow-red-900/40 hover:bg-[#4a0b10] hover:scale-[1.02] hover:shadow-red-900/60 transition-all duration-300 overflow-hidden">
                                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
                                    <span class="relative flex items-center gap-3" id="btn-content">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Cek Status Pembayaran
                                    </span>
                                </button>
                                
                                {{-- Cancel Button (Secondary) --}}
                                <form id="form-cancel" action="{{ route('payment.cancel', $order->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full px-6 py-4 rounded-xl border-2 border-red-100 text-red-600 font-bold hover:bg-red-50 hover:border-red-200 hover:shadow-sm transition-all duration-300"
                                            onclick="confirmCancel(event)">
                                        Batalkan Order
                                    </button>
                                </form>

                                <div id="msg" class="mt-2 text-center text-sm font-bold min-h-[20px]"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: SUMMARY --}}
                <div class="lg:col-span-5 space-y-6">
                    {{-- Status Card --}}
                    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-3xl p-6 text-white overflow-hidden relative">
                         <div class="absolute top-0 right-0 p-32 bg-[#E6B65C] opacity-5 filter blur-3xl rounded-full translate-x-1/2 -translate-y-1/2"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <div class="text-xs font-bold text-white/60 uppercase tracking-wider mb-1">Status Order</div>
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-orange-500/20 border border-orange-500/30 text-orange-200 font-bold text-sm" id="status-badge">
                                        <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></span>
                                        <span id="status-text">{{ strtoupper($order->status) }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs font-bold text-white/60 uppercase tracking-wider mb-1">Batas Waktu</div>
                                    <div id="countdown" class="text-2xl font-black tabular-nums tracking-tight">--:--</div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="p-4 rounded-xl bg-black/20 border border-white/5 space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-white/70">Subtotal Produk</span>
                                        <span class="font-bold text-white">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm items-center">
                                        <span class="text-white/70">Kode Unik</span>
                                        <span class="font-bold text-[#E6B65C] bg-[#E6B65C]/10 px-2 py-0.5 rounded text-xs border border-[#E6B65C]/20">
                                            + Rp {{ number_format($order->unique_code ?? 0, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="h-px bg-white/10 my-2"></div>
                                    <div class="flex justify-between items-end">
                                        <span class="text-white/90 font-bold">Total Transfer</span>
                                        <span class="text-xl font-black text-[#E6B65C]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Help --}}
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-gray-100">
                        <h4 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Butuh Bantuan?
                        </h4>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">
                            Jika status belum berubah setelah transfer, mohon tunggu 1-5 menit. Klik tombol cek secara berkala.
                        </p>
                        <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center justify-center w-full px-4 py-3 rounded-xl border-2 border-dashed border-gray-300 text-gray-500 font-bold hover:border-green-500 hover:text-green-600 hover:bg-green-50 transition-all duration-300">
                            Hubungi Admin via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const expiresAt = new Date("{{ optional($order->expires_at)->toIso8601String() }}").getTime();
        const countdownEl = document.getElementById('countdown');
        const btnCheck = document.getElementById('btn-check');
        const btnContent = document.getElementById('btn-content');
        const msgEl = document.getElementById('msg'); // Keep for inline simple errors if needed
        let isChecking = false;

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiresAt - now;

            if (distance < 0) {
                countdownEl.innerHTML = "EXPIRED";
                countdownEl.classList.add('text-red-400');
                btnCheck.disabled = true;
                btnCheck.classList.add('opacity-50', 'cursor-not-allowed');
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.innerHTML = minutes + "m " + seconds + "s";
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();

        async function checkPaymentManual() {
            if(isChecking) return;
            isChecking = true;

            // Loading state
            btnCheck.disabled = true;
            btnCheck.classList.add('opacity-80', 'cursor-wait');
            const originalContent = btnContent.innerHTML;
            btnContent.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-[#E6B65C]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mengecek...
            `;
            // Clear inline msg in case previously shown
            if(msgEl) msgEl.textContent = '';

            try {
                const res = await fetch("{{ route('payment.check', $order->id) }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({})
                });

                const data = await res.json();
                const status = (data.status || '').toLowerCase();

                if (status === 'paid' || status === 'success') {
                    // SUCCESS POPUP
                    Swal.fire({
                        title: 'Pembayaran Berhasil! 🎉',
                        text: 'Terima kasih, order kamu sudah terverifikasi otomatis.',
                        icon: 'success',
                        iconColor: '#E6B65C', // Gold Check
                        confirmButtonText: 'Lanjut ke Dashboard',
                        confirmButtonColor: '#5C0F14', // Wine Button
                        color: '#5C0F14',
                        background: '#fff',
                        timer: 3000,
                        timerProgressBar: true
                    }).then(() => {
                        window.location.reload();
                    });
                } else if (status === 'expired') {
                    Swal.fire({
                        title: 'Expired!',
                        text: 'Maaf, waktu pembayaran telah habis.',
                        icon: 'error',
                        confirmButtonColor: '#d33'
                    });
                } else {
                    // Not found yet
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'info',
                        iconColor: '#E6B65C',
                        title: 'Pembayaran belum masuk. Coba lagi dalam 1 menit.'
                    });
                }

            } catch (error) {
                console.error(error);
                Swal.fire({
                    title: 'Error',
                    text: 'Gagal mengecek status. Periksa koneksi internet.',
                    icon: 'error'
                });
            } finally {
                // Restore logic unless success
                if (!document.querySelector('.swal2-success-ring')) { 
                     isChecking = false;
                     btnCheck.disabled = false;
                     btnCheck.classList.remove('opacity-80', 'cursor-wait');
                     btnContent.innerHTML = originalContent;
                }
            }
        }

        btnCheck.addEventListener('click', checkPaymentManual);

        // Cancel Confirmation Logic
        function confirmCancel(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Batalkan Order?',
                text: "Order ini akan dibatalkan dan kuantitas item tidak akan kembali.",
                icon: 'warning',
                iconColor: '#E6B65C', // Gold Warning
                showCancelButton: true,
                confirmButtonColor: '#5C0F14', // Wine for 'Yes'
                cancelButtonColor: '#d1d5db',  // Gray for 'No' to be subtle
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Kembali',
                color: '#5C0F14'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-cancel').submit();
                }
            })
        }
    </script>
</x-main-layout>
