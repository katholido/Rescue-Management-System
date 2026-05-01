<x-guest-layout>
    <div class="mb-8 text-center sm:text-left">
        <h2 class="text-2xl font-bold text-white">Join the Force</h2>
        <p class="text-slate-400 text-sm">Create an account to start managing rescue operations.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-slate-300" />
            <x-text-input id="name" class="block mt-1 w-full bg-slate-800 border-slate-700 text-white focus:border-red-500 focus:ring-red-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-slate-300" />
            <x-text-input id="email" class="block mt-1 w-full bg-slate-800 border-slate-700 text-white focus:border-red-500 focus:ring-red-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-slate-300" />

            <x-text-input id="password" class="block mt-1 w-full bg-slate-800 border-slate-700 text-white focus:border-red-500 focus:ring-red-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-300" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-slate-800 border-slate-700 text-white focus:border-red-500 focus:ring-red-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 active:bg-red-800 border-none px-6 py-3 rounded-xl text-lg">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-800 text-center">
            <p class="text-sm text-slate-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-red-500 font-bold hover:underline ml-1">Log in here</a>
            </p>
        </div>
    </form>
</x-guest-layout>
