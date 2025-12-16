<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Profile
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Profile Information --}}
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Update Password --}}
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Delete Account --}}
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8 border border-red-100">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
