<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Dashboard User</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 shadow rounded">Total: <b>{{ $total }}</b></div>
                <div class="bg-white p-4 shadow rounded">Paid: <b>{{ $paid }}</b></div>
                <div class="bg-white p-4 shadow rounded">Pending: <b>{{ $pending }}</b></div>
                <div class="bg-white p-4 shadow rounded">Expired: <b>{{ $expired }}</b></div>
            </div>

            <div class="bg-white p-6 shadow rounded mt-6">
                <h3 class="font-semibold mb-3">Transaksi Terbaru</h3>
                <ul class="space-y-2">
                    @foreach($recent as $o)
                        <li class="border-b pb-2 flex justify-between">
                            <span>#{{ $o->id }} - {{ $o->status }}</span>
                            <a class="text-blue-600" href="{{ route('orders.show', $o->id) }}">Detail</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
