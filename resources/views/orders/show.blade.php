<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Detail Order #{{ $order->id }}</h2>

            <div class="bg-white shadow rounded p-6">
                <div>Status: <span class="font-semibold">{{ $order->status }}</span></div>
                <div>Total: <span class="font-semibold">Rp {{ number_format($order->total_amount,0,',','.') }}</span></div>

                <hr class="my-4">

                <div class="space-y-2">
                    @foreach($order->items as $it)
                        <div class="flex justify-between border-b pb-2">
                            <div>{{ $it->book->title ?? '-' }}</div>
                            <div>Rp {{ number_format($it->price,0,',','.') }}</div>
                        </div>

                        @if($order->status === 'paid' && $it->book)
                            <div class="mt-2">
                                <a class="text-green-700 underline" href="{{ route('orders.download', [$order->id, $it->book->id]) }}">
                                    Download: {{ $it->book->title }}
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="mt-6 flex gap-3">
                    @if($order->status === 'pending')
                        <a class="px-4 py-2 bg-black text-white rounded" href="{{ route('payment.show', $order->id) }}">Lanjut Bayar</a>
                    @endif

                    <a class="px-4 py-2 border rounded" href="{{ route('orders.index') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
