<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-white">Reset Password</h2>
        <p class="mb-4 text-sm text-slate-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-300" />
            <x-text-input id="email" class="block mt-1 w-full bg-slate-800 border-slate-700 text-white focus:border-red-500 focus:ring-red-500" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="bg-red-600 hover:bg-red-700 active:bg-red-800 border-none px-6 py-2.5 rounded-xl w-full justify-center">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
