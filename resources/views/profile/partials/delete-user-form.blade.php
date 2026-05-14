<section class="space-y-4">
    <header>
        <h2 class="text-xl font-black text-red-600 flex items-center gap-3">
            <div class="p-2 rounded-lg bg-red-50 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            </div>
            Hapus Akun
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
        </p>
    </header>

    <button
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-red-50 border border-red-200 text-red-700 font-bold rounded-xl hover:bg-red-100 transition"
    >
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-gray-900 mb-2">
                Konfirmasi Hapus Akun
            </h2>

            <p class="text-sm text-gray-600 mb-4">
                Masukkan password untuk mengkonfirmasi penghapusan akun.
            </p>

            <input
                name="password"
                type="password"
                class="block w-full rounded-xl border-gray-200 focus:border-red-400 focus:ring focus:ring-red-200/50 transition"
                placeholder="Password"
            />

            @error('password', 'userDeletion') <div class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</div> @enderror

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-2 border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition">
                    Batal
                </button>

                <button type="submit" class="px-6 py-2 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
