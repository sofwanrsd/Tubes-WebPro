<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Tambah Buku</h2>

            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('publisher.books.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm">Title</label>
                        <input name="title" class="w-full border rounded p-2" value="{{ old('title') }}">
                        @error('title') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm">Description</label>
                        <textarea name="description" class="w-full border rounded p-2" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm">Price</label>
                        <input name="price" type="number" class="w-full border rounded p-2" value="{{ old('price', 0) }}">
                        @error('price') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm">Status</label>
                        <select name="status" class="w-full border rounded p-2">
                            <option value="draft">draft</option>
                            <option value="published">published</option>
                            <option value="unpublished">unpublished</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm">Cover (jpg/png)</label>
                        <input type="file" name="cover">
                    </div>

                    <div>
                        <label class="block text-sm">E-book (PDF)</label>
                        <input type="file" name="ebook">
                    </div>

                    <button class="px-4 py-2 bg-black text-white rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
