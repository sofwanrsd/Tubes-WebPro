<section class="space-y-4">
    <header>
        <h2 class="text-lg font-semibold text-red-600">
            Delete Account
        </h2>
        <p class="text-sm text-gray-600">
            This action is permanent and cannot be undone.
        </p>
    </header>

    <x-danger-button
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Delete Account
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 mb-2">
                Confirm Account Deletion
            </h2>

            <p class="text-sm text-gray-600 mb-4">
                Please enter your password to confirm.
            </p>

            <x-text-input
                name="password"
                type="password"
                class="block w-full"
                placeholder="Password"
            />

            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-danger-button>
                    Delete Account
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
