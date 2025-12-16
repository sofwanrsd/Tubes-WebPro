<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Manage Users</h2>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="py-2">Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr class="border-b">
                                <td class="py-2">{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->getRoleNames()->first() ?? 'user' }}</td>
                                <td class="text-right">
                                    <form method="POST" action="{{ route('admin.users.role', $u->id) }}" class="inline-flex gap-2">
                                        @csrf
                                        <select name="role" class="border rounded px-2 py-1">
                                            @foreach(['user','publisher','admin'] as $r)
                                                <option value="{{ $r }}" @selected(($u->getRoleNames()->first() ?? 'user')===$r)>{{ $r }}</option>
                                            @endforeach
                                        </select>
                                        <button class="px-3 py-1 bg-black text-white rounded">Set</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
