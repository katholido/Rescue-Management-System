<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('team-members.index') }}" class="p-2 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-400 hover:text-red-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('New Force Member') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="p-8 sm:p-12">
                    <div class="mb-10 text-center sm:text-left">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Personnel Registration</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Onboard a new member to the rescue response team.</p>
                    </div>

                    <form action="{{ route('team-members.store') }}" method="POST">
                        @csrf

                        <div class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <x-input-label for="name" :value="__('Full Name')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="e.g. John Doe" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="role" :value="__('Operational Role')" />
                                    <x-text-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" placeholder="e.g. K9 Search, Paramedic" required />
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <x-input-label for="phone" :value="__('Contact Number')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" placeholder="+63 9xx xxxx xxx" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="availability_status" :value="__('Initial Status')" />
                                    <select id="availability_status" name="availability_status" class="block mt-1 w-full bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm font-medium">
                                        <option value="Available" @selected(old('availability_status') == 'Available')>Available</option>
                                        <option value="On Mission" @selected(old('availability_status') == 'On Mission')>On Mission</option>
                                        <option value="Off Duty" @selected(old('availability_status') == 'Off Duty')>Off Duty</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('availability_status')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-12 pt-8 border-t border-slate-100 dark:border-slate-800">
                            <a href="{{ route('team-members.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">
                                {{ __('Discard Changes') }}
                            </a>
                            <x-primary-button class="px-10">
                                {{ __('Register Member') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
