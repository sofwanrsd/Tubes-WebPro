<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Admin Dashboard</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 shadow rounded">Pending: <b>{{ $pending }}</b></div>
                <div class="bg-white p-4 shadow rounded">Paid: <b>{{ $paid }}</b></div>
                <div class="bg-white p-4 shadow rounded">Expired: <b>{{ $expired }}</b></div>
            </div>

            <div class="mt-6 flex gap-3">
                <a class="px-4 py-2 border rounded" href="{{ route('admin.users.index') }}">Manage Users</a>
                <a class="px-4 py-2 border rounded" href="{{ route('admin.books.index') }}">Manage Books</a>
                <a class="px-4 py-2 border rounded" href="{{ route('admin.orders.index') }}">Monitoring Orders</a>
            </div>
        </div>
    </div>
</x-app-layout>
