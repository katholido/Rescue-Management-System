<section>
    <header class="mb-8">
        <h2 class="text-xl font-black text-slate-900 dark:text-white">
            {{ __('Account Details') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __("Update your name and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-orange-50 dark:bg-orange-900/20 rounded-2xl border border-orange-100 dark:border-orange-800">
                        <p class="text-xs font-bold text-orange-700 dark:text-orange-400">
                            {{ __('Your email address is currently unverified.') }}

                            <button form="send-verification" class="ml-2 underline hover:text-orange-900 transition-colors">
                                {{ __('Re-send Link') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-black text-[10px] text-green-600 uppercase tracking-widest">
                                {{ __('Verification link dispatched.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="px-10">{{ __('Update Profile') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600"
                >{{ __('Credentials saved.') }}</p>
            @endif
        </div>
    </form>
</section>
