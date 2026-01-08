<x-dashboard-layout>
    {{-- HERO HEADER --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#5C0F14] via-[#2E0508] to-black mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#E6B65C 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 p-8 sm:p-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E6B65C]/10 border border-[#E6B65C]/20 text-[#E6B65C] text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-[#E6B65C] animate-pulse"></span>
                Pengaturan
            </div>
            
            <div class="max-w-2xl">
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-4">
                    Edit <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E6B65C] to-[#CCA050]">Profil</span>
                </h2>
                <p class="text-gray-300 text-lg leading-relaxed">
                    Kelola informasi akun dan keamanan akunmu.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-3xl mx-auto space-y-8">
        {{-- Profile Photo & Info --}}
        <div class="rounded-2xl border border-gray-100 bg-white shadow-xl p-8">
            <h3 class="font-black text-gray-900 text-xl mb-6 flex items-center gap-3">
                <div class="p-2 rounded-lg bg-[#5C0F14]/10 text-[#5C0F14]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                Informasi Profil
            </h3>

            @if(session('status') === 'profile-updated')
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 text-green-700 text-sm font-bold flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Profil berhasil diperbarui!
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                {{-- Profile Photo --}}
                <div class="flex items-center gap-6">
                    <div class="relative group">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-24 h-24 rounded-full object-cover border-4 border-[#E6B65C]/30">
                        @else
                            <div class="w-24 h-24 rounded-full bg-[#5C0F14] text-[#E6B65C] flex items-center justify-center text-3xl font-black border-4 border-[#E6B65C]/30">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <label for="profile_photo" class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                        <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="hidden">
                    </div>
                    <div>
                        <label for="profile_photo" class="text-sm font-bold text-[#5C0F14] hover:underline cursor-pointer">Ganti Foto Profil</label>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF. Maks 2MB.</p>
                        @error('profile_photo') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input name="name" type="text" class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition" value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input name="email" type="email" class="w-full rounded-xl border-gray-200 focus:border-[#E6B65C] focus:ring focus:ring-[#E6B65C]/20 transition" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</div> @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button class="px-8 py-3 bg-[#5C0F14] text-[#E6B65C] font-bold rounded-xl hover:bg-[#4a0b10] shadow-lg transition transform hover:-translate-y-0.5">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Update Password --}}
        <div class="rounded-2xl border border-gray-100 bg-white shadow-xl p-8">
            @include('profile.partials.update-password-form')
        </div>

        {{-- Delete Account --}}
        <div class="rounded-2xl border border-red-100 bg-white shadow-xl p-8">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-dashboard-layout>
