<section>
    <header class="mb-6">
        <h2 class="text-xl font-black text-gray-900 flex items-center gap-3">
            <div class="p-2 rounded-lg bg-[#5C0F14]/10 text-[#5C0F14]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
            </div>
            Ubah Password
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Gunakan password yang kuat untuk menjaga keamanan akunmu.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
            <input
                id="current_password"
                name="current_password"
                type="password"
                class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition"
            />
            @error('current_password', 'updatePassword') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
            <input
                id="password"
                name="password"
                type="password"
                class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition"
            />
            @error('password', 'updatePassword') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition"
            />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button
                class="px-8 py-3 bg-[#5C0F14] text-[#E6B65C] font-bold rounded-xl hover:bg-[#4a0b10] shadow-lg transition transform hover:-translate-y-0.5"
            >
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600 font-bold">Password berhasil diubah!</p>
            @endif
        </div>
    </form>
</section>
