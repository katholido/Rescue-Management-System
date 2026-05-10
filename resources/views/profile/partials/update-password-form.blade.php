<section>
    <header class="mb-8">
        <h2 class="text-xl font-black text-slate-900 dark:text-white">
            {{ __('Access Protocols') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __('Update your encryption key to ensure unauthorized access is prevented.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="space-y-6">
            <div class="max-w-md">
                <x-input-label for="update_password_current_password" :value="__('Current Protocol')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="update_password_password" :value="__('New Protocol')" />
                    <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="Min. 8 characters" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="update_password_password_confirmation" :value="__('Verify Protocol')" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="Repeat new password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="px-10">{{ __('Rotate Protocol') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600"
                >{{ __('Protocol updated.') }}</p>
            @endif
        </div>
    </form>
</section>
