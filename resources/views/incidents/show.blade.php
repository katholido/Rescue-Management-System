<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('incidents.index') }}" class="p-2 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-400 hover:text-red-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Emergency Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8 sm:p-12">
                            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                                <h1 class="text-3xl font-black text-slate-900 dark:text-white">{{ $incident->title }}</h1>
                                <div class="flex gap-2">
                                    <span class="px-4 py-1.5 text-xs font-black uppercase tracking-widest rounded-full 
                                        @if($incident->priority == 'Critical') bg-red-600 text-white 
                                        @elseif($incident->priority == 'High') bg-orange-100 text-orange-700 
                                        @else bg-slate-100 text-slate-700 @endif">
                                        {{ $incident->priority }}
                                    </span>
                                    <span class="px-4 py-1.5 text-xs font-black uppercase tracking-widest rounded-full 
                                        @if($incident->status == 'Open') bg-red-100 text-red-700 
                                        @elseif($incident->status == 'Ongoing') bg-blue-100 text-blue-700 
                                        @else bg-green-100 text-green-700 @endif">
                                        {{ $incident->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="prose dark:prose-invert max-w-none">
                                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Initial Description</h3>
                                <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line bg-slate-50 dark:bg-slate-800/30 p-6 rounded-2xl border border-slate-100 dark:border-slate-800">
                                    {{ $incident->description ?? 'No detailed description available for this incident.' }}
                                </p>
                            </div>

                            <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-800 grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div>
                                    <h3 class="text-slate-400 uppercase text-[10px] font-black tracking-widest mb-2">Primary Location</h3>
                                    <div class="flex items-center gap-2 text-slate-700 dark:text-slate-200 font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        {{ $incident->location }}
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-slate-400 uppercase text-[10px] font-black tracking-widest mb-2">Reported Timestamp</h3>
                                    <div class="flex items-center gap-2 text-slate-700 dark:text-slate-200 font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $incident->reported_at->format('M d, Y - H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Operational Intelligence (Live Timeline) -->
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8 sm:p-12">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-8 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-600 animate-ping"></span>
                                Mission Activity Log
                            </h3>
                            
                            <!-- Add Note Form -->
                            <form action="{{ route('incidents.updates.store', $incident) }}" method="POST" class="mb-12">
                                @csrf
                                <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-700 shadow-inner">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Post Operational Note</p>
                                    <div class="relative">
                                        <textarea name="message" rows="2" class="block w-full bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:border-red-500 focus:ring-red-500 rounded-2xl shadow-sm p-4 text-sm" placeholder="Brief sit-rep or status update..."></textarea>
                                        <div class="absolute bottom-2 right-2">
                                            <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-red-600 text-white rounded-xl font-bold text-xs hover:bg-red-700 transition-all shadow-lg shadow-red-500/20">
                                                <span>Log Intelligence</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Timeline Feed -->
                            <div class="space-y-0 relative before:absolute before:inset-0 before:ml-[1.125rem] before:-translate-x-px before:h-full before:w-0.5 before:bg-slate-100 dark:before:bg-slate-800">
                                @forelse($updates as $update)
                                    <div class="relative pl-12 pb-10 group">
                                        <!-- Point -->
                                        <div class="absolute left-0 w-9 h-9 rounded-xl bg-white dark:bg-slate-900 border-4 border-slate-50 dark:border-slate-950 flex items-center justify-center z-10 group-hover:bg-slate-900 dark:group-hover:bg-red-600 transition-all">
                                            @if($update->type == 'status_change')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                            @elseif($update->type == 'personnel_assigned')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                            @endif
                                        </div>
                                        
                                        <!-- Content -->
                                        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 p-6 rounded-[2rem] shadow-sm group-hover:shadow-md transition-all">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-bold text-sm text-slate-900 dark:text-white">{{ $update->user->name }}</span>
                                                    @if($update->type == 'status_change')
                                                        <span class="text-[9px] font-black uppercase px-2 py-0.5 bg-red-100 text-red-700 rounded-md">Status Change</span>
                                                    @elseif($update->type == 'personnel_assigned')
                                                        <span class="text-[9px] font-black uppercase px-2 py-0.5 bg-blue-100 text-blue-700 rounded-md">Deployment</span>
                                                    @endif
                                                </div>
                                                <span class="text-[10px] font-bold text-slate-400 uppercase">{{ $update->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                                                {{ $update->message }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12 text-slate-400 italic bg-slate-50 dark:bg-slate-800/30 rounded-[2rem] border border-dashed border-slate-200 dark:border-slate-800">
                                        No updates have been added to this mission yet.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Sidebar -->
                <div class="space-y-8">
                    <!-- Deployed Personnel Section -->
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                Assigned Staff
                            </h3>
                            <div class="space-y-3 mb-8">
                                @forelse($incident->teamMembers as $member)
                                    <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/50 p-3 rounded-2xl border border-slate-100 dark:border-slate-700">
                                        <div class="w-8 h-8 rounded-lg bg-red-600 flex items-center justify-center font-bold text-white text-xs">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $member->name }}</p>
                                            <p class="text-[9px] font-bold text-slate-500 uppercase tracking-tighter">{{ $member->role }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-6 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">No personnel deployed</p>
                                    </div>
                                @endforelse
                            </div>
                            
                            <button x-data="" @click="$dispatch('open-modal', 'manage-deployment')" class="w-full py-4 bg-slate-900 dark:bg-white dark:text-slate-900 text-white rounded-2xl font-bold text-xs hover:bg-slate-800 dark:hover:bg-slate-100 transition-all shadow-lg">
                                Assign People
                            </button>
                        </div>
                    </div>

                    <!-- Operational Actions -->
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-red-600/10 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold mb-6">Staff Actions</h3>
                            <div class="space-y-4">
                                <a href="{{ route('incidents.edit', $incident) }}" class="flex items-center justify-center gap-2 w-full py-4 bg-white/10 hover:bg-white/20 rounded-2xl font-bold transition-all border border-white/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    Edit Incident
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deployment Modal -->
    <x-modal name="manage-deployment" :show="$errors->isNotEmpty()" focusable>
        <div class="p-8">
            <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Assign Team Members</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">Select the people you want to work on this mission.</p>
            
            <form action="{{ route('incidents.assign-members', $incident) }}" method="POST">
                @csrf
                <div class="mb-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($allMembers as $member)
                            <label class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-800/80 rounded-2xl border-2 border-slate-100 dark:border-slate-700 has-[:checked]:border-red-500 has-[:checked]:bg-red-50/50 dark:has-[:checked]:bg-red-900/20 cursor-pointer transition-all">
                                <input type="checkbox" name="members[]" value="{{ $member->id }}" @checked($incident->teamMembers->contains($member->id)) class="w-5 h-5 rounded border-slate-300 dark:border-slate-600 text-red-600 focus:ring-red-500 bg-white dark:bg-slate-900">
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">{{ $member->name }}</p>
                                    <p class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ $member->role }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex justify-end gap-4 mt-8">
                    <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                    <x-primary-button type="submit">Confirm Assignment</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
