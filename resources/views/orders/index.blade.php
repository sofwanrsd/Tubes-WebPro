<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Riwayat Transaksi</h2>

            <div class="bg-white shadow rounded p-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">Order</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $o)
                            <tr class="border-b">
                                <td class="py-2">#{{ $o->id }}</td>
                                <td>{{ $o->status }}</td>
                                <td>Rp {{ number_format($o->total_amount, 0, ',', '.') }}</td>
                                <td>{{ $o->created_at }}</td>
                                <td>
                                    <a class="text-blue-600" href="{{ route('orders.show', $o->id) }}">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
