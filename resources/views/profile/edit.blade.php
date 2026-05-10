<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('My Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Profile Summary Sidebar -->
                <div class="space-y-8">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl overflow-hidden relative">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-red-600/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div class="w-24 h-24 rounded-3xl bg-white/10 flex items-center justify-center text-4xl font-black mb-4 border border-white/10">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <h3 class="text-xl font-bold">{{ $user->name }}</h3>
                            <p class="text-slate-400 text-sm mb-6">{{ $user->email }}</p>
                            
                            <div class="grid grid-cols-2 gap-4 w-full">
                                <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Status</p>
                                    <p class="text-sm font-bold text-green-400">Active</p>
                                </div>
                                <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">Joined</p>
                                    <p class="text-sm font-bold">{{ $user->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800">
                        <h3 class="text-lg font-bold mb-4 text-slate-900 dark:text-white">Security Checklist</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="text-sm text-slate-600 dark:text-slate-400">Email Verified</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="text-sm text-slate-600 dark:text-slate-400">Strong Encryption</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Management Forms -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8 sm:p-12">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8 sm:p-12">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="bg-red-50/30 dark:bg-red-900/10 rounded-[2.5rem] border border-red-100 dark:border-red-900/30 overflow-hidden">
                        <div class="p-8 sm:p-12">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
