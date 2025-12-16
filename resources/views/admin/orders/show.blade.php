<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Order #{{ $order->id }}</h2>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <p>User: {{ $order->user->email ?? '-' }}</p>
                <p>Status: <b>{{ $order->status }}</b></p>
                <p>Total: Rp {{ number_format($order->total_amount,0,',','.') }}</p>

                <hr class="my-4">

                <h3 class="font-semibold mb-2">Items</h3>
                @foreach($order->items as $it)
                    <div class="border-b pb-2 flex justify-between">
                        <span>{{ $it->book->title ?? '-' }}</span>
                        <span>Rp {{ number_format($it->price,0,',','.') }}</span>
                    </div>
                @endforeach

                <div class="mt-6">
                    @if($order->status === 'pending')
                        <form method="POST" action="{{ route('admin.orders.manual_confirm', $order->id) }}">
                            @csrf
                            <button class="px-4 py-2 bg-black text-white rounded">Manual Confirm PAID</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
