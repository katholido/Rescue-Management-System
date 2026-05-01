<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Rescue Personnel') }}
            </h2>
            <a href="{{ route('team-members.create') }}" class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-2xl font-bold text-sm text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 transition ease-in-out duration-150 shadow-lg shadow-red-500/20">
                {{ __('Add Member') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="p-8">
                    @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-xl" role="alert">
                            <p class="font-bold">Success</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($teamMembers as $member)
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all group relative">
                                <div class="flex items-start justify-between mb-6">
                                    <div class="w-16 h-16 rounded-2xl bg-white dark:bg-slate-800 flex items-center justify-center text-2xl font-bold text-slate-400 group-hover:bg-red-600 group-hover:text-white transition-all shadow-sm">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                    <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full 
                                        @if($member->availability_status == 'Available') bg-green-100 text-green-700 
                                        @elseif($member->availability_status == 'On Mission') bg-blue-100 text-blue-700 
                                        @else bg-slate-200 text-slate-700 @endif">
                                        {{ $member->availability_status }}
                                    </span>
                                </div>
                                
                                <div>
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">{{ $member->name }}</h3>
                                    <p class="text-sm font-bold text-red-600 dark:text-red-500 mb-4">{{ $member->role }}</p>
                                    
                                    <div class="space-y-2 text-sm text-slate-500">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                            {{ $member->phone ?? 'No contact info' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-2">
                                    <a href="{{ route('team-members.edit', $member) }}" class="p-2 text-slate-400 hover:text-orange-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <form action="{{ route('team-members.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center text-slate-500 italic">
                                No personnel registered yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
