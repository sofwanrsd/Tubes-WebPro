<x-app-layout>
    @php
        // Biar fleksibel kalau nama relasinya beda-beda di project kamu
        $items = $order->items ?? ($order->orderItems ?? collect());

        // Total aman (kalau field total beda, ganti di bawah)
        $grandTotal = $order->grand_total ?? $order->total_amount ?? $order->total ?? 0;

        $status = strtoupper((string)($order->status ?? ''));
        $paymentStatus = strtoupper((string)($order->payment_status ?? ''));
        $orderCode = $order->code ?? $order->invoice ?? $order->reference ?? $order->id;
        $createdAt = optional($order->created_at)->format('d M Y, H:i');
    @endphp

    <div class="py-10">
        <div class="container-app">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">
                        Detail Order #{{ $orderCode }}
                    </h1>
                    <p class="mt-1 text-sm text-slate-600">
                        Dibuat: {{ $createdAt ?? '-' }}
                    </p>
                </div>

                <a href="{{ route('orders.index') }}"
                   class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    ← Kembali
                </a>
            </div>

            {{-- Summary --}}
            <div class="mt-6 grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="text-xs font-semibold text-slate-500">Status Order</div>
                    <div class="mt-2 inline-flex items-center rounded-full bg-slate-900 px-3 py-1 text-xs font-bold text-white">
                        {{ $status ?: '-' }}
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="text-xs font-semibold text-slate-500">Status Pembayaran</div>
                    <div class="mt-2 inline-flex items-center rounded-full bg-amber-500/90 px-3 py-1 text-xs font-bold text-white">
                        {{ $paymentStatus ?: ($status ?: '-') }}
                    </div>
                    @if(!empty($order->paid_at))
                        <div class="mt-2 text-xs text-slate-600">
                            Paid at: {{ optional($order->paid_at)->format('d M Y, H:i') }}
                        </div>
                    @endif
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="text-xs font-semibold text-slate-500">Total</div>
                    <div class="mt-2 text-lg font-extrabold text-slate-900">
                        Rp {{ number_format((int)$grandTotal, 0, ',', '.') }}
                    </div>

                    {{-- Kalau kamu punya tombol bayar/cek status, bisa nyalain ini --}}
                    {{--
                    @if(($order->status ?? '') === 'pending')
                        <a href="{{ route('payment.show', $order->id) }}"
                           class="mt-3 inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-bold text-white hover:bg-slate-800">
                            Bayar Sekarang
                        </a>
                    @endif
                    --}}
                </div>
            </div>

            {{-- Items --}}
            <div class="mt-6 rounded-2xl border border-slate-200 bg-white">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                    <div class="font-extrabold text-slate-900">Item</div>
                    <div class="text-sm text-slate-600">{{ $items->count() }} produk</div>
                </div>

                <div class="divide-y divide-slate-200">
                    @forelse($items as $item)
                        @php
                            $title = $item->title
                                ?? optional($item->book)->title
                                ?? optional($item->product)->title
                                ?? 'Item';

                            $qty = $item->qty ?? $item->quantity ?? 1;
                            $price = $item->price ?? $item->unit_price ?? 0;
                            $subtotal = ($item->subtotal ?? ($qty * $price));
                        @endphp

                        <div class="p-5 flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <div class="font-bold text-slate-900 truncate">{{ $title }}</div>
                                <div class="mt-1 text-sm text-slate-600">
                                    Qty: {{ $qty }} • Harga: Rp {{ number_format((int)$price, 0, ',', '.') }}
                                </div>

                                {{-- Kalau kamu punya file download per item (misal paid), bisa taruh di sini --}}
                                {{--
                                @if(($order->status ?? '') === 'paid' && $item->download_url)
                                    <a href="{{ $item->download_url }}"
                                       class="mt-2 inline-flex text-sm font-semibold text-slate-900 hover:underline underline-offset-4">
                                        Download →
                                    </a>
                                @endif
                                --}}
                            </div>

                            <div class="text-right">
                                <div class="text-sm text-slate-500">Subtotal</div>
                                <div class="mt-1 font-extrabold text-slate-900">
                                    Rp {{ number_format((int)$subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-sm text-slate-600">
                            Tidak ada item di order ini.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Extra info --}}
            <div class="mt-6 grid gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="text-sm font-extrabold text-slate-900">Info Pembayaran</div>
                    <div class="mt-3 space-y-2 text-sm text-slate-600">
                        <div><span class="font-semibold text-slate-900">Metode:</span> {{ $order->payment_method ?? '-' }}</div>
                        <div><span class="font-semibold text-slate-900">Reference:</span> {{ $order->payment_ref ?? $order->reference ?? '-' }}</div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="text-sm font-extrabold text-slate-900">Catatan</div>
                    <div class="mt-3 text-sm text-slate-600">
                        {{ $order->notes ?? '—' }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
