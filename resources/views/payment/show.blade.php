<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Pembayaran</h2>

            <div class="bg-white shadow rounded p-6">
                <div class="flex justify-between">
                    <div>
                        <div class="text-sm text-gray-600">Order #{{ $order->id }}</div>
                        <div class="font-bold text-lg">
                            Total Bayar: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-600 mt-1">
                            Expire: <span id="expire-at">{{ $order->expires_at }}</span>
                        </div>
                        <div class="text-sm mt-2">
                            Status: <span id="status-text" class="font-semibold">{{ $order->status }}</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-600">Countdown</div>
                        <div id="countdown" class="text-2xl font-bold">--:--</div>
                    </div>
                </div>

                <hr class="my-6">

                @if($order->payment && $order->payment->qris_dynamic_image)
                    <div class="flex justify-center">
                        <img class="w-72 h-72" src="{{ $order->payment->qris_dynamic_image }}" alt="QRIS">
                    </div>
                @else
                    <div class="text-center text-gray-600">
                        QR belum tersedia (cek konfigurasi QRIS_STATIC_RAW).
                    </div>
                @endif

                <div class="mt-6 flex gap-3 justify-center">
                    <button id="btn-check" class="px-4 py-2 bg-black text-white rounded">
                        Cek Pembayaran
                    </button>

                    <a href="{{ route('orders.show', $order->id) }}" class="px-4 py-2 border rounded">
                        Lihat Detail Order
                    </a>
                </div>

                <div id="msg" class="mt-4 text-center text-sm"></div>
            </div>
        </div>
    </div>

    <script>
        const expiresAt = new Date("{{ optional($order->expires_at)->toIso8601String() }}").getTime();
        const countdownEl = document.getElementById('countdown');
        const statusText = document.getElementById('status-text');
        const msg = document.getElementById('msg');

        function pad(n){ return String(n).padStart(2,'0'); }

        function tick(){
            const now = Date.now();
            let diff = Math.max(0, expiresAt - now);

            const m = Math.floor(diff/60000);
            const s = Math.floor((diff%60000)/1000);
            countdownEl.textContent = pad(m) + ":" + pad(s);

            if (diff <= 0 && statusText.textContent === 'pending') {
                msg.textContent = 'Order expired. Silakan buat order baru.';
            }
        }
        setInterval(tick, 1000); tick();

        async function checkPayment() {
            msg.textContent = 'Mengecek pembayaran...';
            const res = await fetch("{{ route('payment.check', $order->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({})
            });
            const json = await res.json();
            statusText.textContent = json.status;

            if (json.status === 'paid') {
                msg.textContent = 'Pembayaran berhasil! Mengarahkan...';
                window.location.href = "{{ route('orders.show', $order->id) }}";
            } else if (json.status === 'expired') {
                msg.textContent = 'Order expired. Silakan buat order baru.';
            } else {
                msg.textContent = 'Belum terdeteksi. Coba lagi beberapa saat.';
            }
        }

        document.getElementById('btn-check').addEventListener('click', checkPayment);
    </script>
</x-app-layout>
