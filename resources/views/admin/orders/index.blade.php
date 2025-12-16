<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Monitoring Orders</h2>

            <div class="bg-white shadow rounded p-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="py-2">Order</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $o)
                            <tr class="border-b">
                                <td class="py-2">#{{ $o->id }}</td>
                                <td>{{ $o->user->email ?? '-' }}</td>
                                <td>{{ $o->status }}</td>
                                <td>Rp {{ number_format($o->total_amount,0,',','.') }}</td>
                                <td class="text-right">
                                    <a class="text-blue-600" href="{{ route('admin.orders.show', $o->id) }}">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
