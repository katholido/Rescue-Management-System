<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('incidents.index') }}" class="p-2 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-400 hover:text-red-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Incident Intel') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8 sm:p-12">
                            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                                <h1 class="text-3xl font-black text-slate-900 dark:text-white">{{ $incident->title }}</h1>
                                <div class="flex gap-2">
                                    <span class="px-4 py-1.5 text-xs font-black uppercase tracking-widest rounded-full bg-red-100 text-red-700">
                                        {{ $incident->priority }}
                                    </span>
                                    <span class="px-4 py-1.5 text-xs font-black uppercase tracking-widest rounded-full bg-blue-100 text-blue-700">
                                        {{ $incident->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="prose dark:prose-invert max-w-none">
                                <h3 class="text-slate-400 uppercase text-xs font-black tracking-widest mb-4">Situation Report</h3>
                                <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">
                                    {{ $incident->description ?? 'No detailed description available for this incident.' }}
                                </p>
                            </div>

                            <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-800 grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div>
                                    <h3 class="text-slate-400 uppercase text-xs font-black tracking-widest mb-2">Location</h3>
                                    <div class="flex items-center gap-2 text-slate-700 dark:text-slate-200 font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        {{ $incident->location }}
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-slate-400 uppercase text-xs font-black tracking-widest mb-2">Timestamp</h3>
                                    <div class="flex items-center gap-2 text-slate-700 dark:text-slate-200 font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $incident->reported_at->format('M d, Y - H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assignments (Phase 3 functionality) -->
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8 sm:p-12">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-8">Deployed Personnel</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                                @forelse($incident->teamMembers as $member)
                                    <div class="flex items-center justify-between bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center font-bold text-white shadow-sm">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $member->name }}</p>
                                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $member->role }}</p>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full bg-green-100 text-green-700">Active</span>
                                    </div>
                                @empty
                                    <div class="col-span-full py-8 text-center border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-3xl">
                                        <p class="text-slate-400 italic">No personnel currently assigned to this mission.</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Deployment Manager -->
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-[2rem] border border-slate-100 dark:border-slate-700">
                                <h4 class="text-lg font-bold mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    Manage Deployment
                                </h4>
                                <form action="{{ route('incidents.assign-members', $incident) }}" method="POST">
                                    @csrf
                                    <div class="mb-6">
                                        <select name="members[]" multiple class="block w-full mt-1 bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:border-red-500 focus:ring-red-500 rounded-2xl shadow-sm h-40 p-4">
                                            @foreach($allMembers as $member)
                                                <option value="{{ $member->id }}" @selected($incident->teamMembers->contains($member->id)) class="py-2">
                                                    {{ $member->name }} — {{ $member->role }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-slate-400 mt-3 ml-2">Hold Ctrl (Cmd) to select multiple force members for this mission.</p>
                                    </div>
                                    <x-primary-button class="w-full justify-center py-4 text-sm">
                                        {{ __('Update Deployment Orders') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Sidebar -->
                <div class="space-y-8">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl">
                        <h3 class="text-lg font-bold mb-6">Operational Actions</h3>
                        <div class="space-y-4">
                            <a href="{{ route('incidents.edit', $incident) }}" class="flex items-center justify-center gap-2 w-full py-4 bg-white/10 hover:bg-white/20 rounded-2xl font-bold transition-all border border-white/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                Edit Incident
                            </a>
                            <form action="{{ route('incidents.destroy', $incident) }}" method="POST" onsubmit="return confirm('Archive this incident record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center gap-2 w-full py-4 bg-red-600/20 hover:bg-red-600/40 text-red-400 rounded-2xl font-bold transition-all border border-red-600/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Archive Incident
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800">
                        <h3 class="text-lg font-bold mb-4 text-slate-900 dark:text-white">Status Timeline</h3>
                        <div class="relative space-y-6 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-300 group-[.is-active]:bg-red-600 text-slate-500 group-[.is-active]:text-red-50 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="12" height="10">
                                        <path fill-rule="nonzero" d="M10.422 1.257 4.655 7.025 1.578 3.948 0 5.527l4.655 4.655 7.345-7.345z" />
                                    </svg>
                                </div>
                                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow">
                                    <time class="font-bold text-red-500 text-xs">Reported</time>
                                    <div class="text-slate-500 text-xs">Initial report filed.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
