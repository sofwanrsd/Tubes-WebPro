<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">My Books</h2>
                <a href="{{ route('publisher.books.create') }}" class="px-4 py-2 bg-black text-white rounded">Tambah Buku</a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="py-2">Title</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $b)
                            <tr class="border-b">
                                <td class="py-2">{{ $b->title }}</td>
                                <td>{{ $b->status }}</td>
                                <td>Rp {{ number_format($b->price,0,',','.') }}</td>
                                <td class="text-right">
                                    <a class="text-blue-600" href="{{ route('publisher.books.edit', $b) }}">Edit</a>
                                    <form class="inline" method="POST" action="{{ route('publisher.books.destroy', $b) }}" onsubmit="return confirm('Hapus buku?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 ml-2">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
