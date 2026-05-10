<section class="space-y-6">
    <header>
        <h2 class="text-xl font-black text-red-600 dark:text-red-500">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __('Once your account is deleted, everything will be permanently removed.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 bg-red-600/10 border border-red-600/20 rounded-xl font-bold text-xs text-red-600 uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all"
    >{{ __('Delete Account') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-2">
                {{ __('Are you sure?') }}
            </h2>

            <p class="text-sm text-slate-500 mb-8">
                {{ __('Please enter your password to confirm you want to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full p-4"
                    placeholder="{{ __('Verify current password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <button type="submit" class="inline-flex items-center px-8 py-3 bg-red-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 transition-all shadow-lg shadow-red-500/20">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
