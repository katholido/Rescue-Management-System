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

                    <!-- Operational Notes & Comments -->
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8 sm:p-12">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                Operational Intelligence
                            </h3>
                            
                            <form action="{{ route('incidents.updates.store', $incident) }}" method="POST" class="mb-10">
                                @csrf
                                <div class="relative">
                                    <textarea name="message" rows="3" class="block w-full bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:border-red-500 focus:ring-red-500 rounded-2xl shadow-sm p-6" placeholder="Add an operational note or status update..."></textarea>
                                    <div class="absolute bottom-4 right-4">
                                        <button type="submit" class="p-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all shadow-lg shadow-red-500/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="space-y-6">
                                @forelse($updates as $update)
                                    <div class="flex gap-4 group">
                                        <div class="flex flex-col items-center">
                                            <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center font-bold text-slate-400 text-xs">
                                                {{ substr($update->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex-1 w-px bg-slate-100 dark:bg-slate-800 my-2"></div>
                                        </div>
                                        <div class="flex-1 pb-6">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-bold text-sm text-slate-900 dark:text-white">{{ $update->user->name }}</span>
                                                <span class="text-[10px] font-bold text-slate-400 uppercase">{{ $update->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                                                @if($update->type == 'status_change')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black uppercase bg-indigo-100 text-indigo-700 mr-2">Status Update</span>
                                                @elseif($update->type == 'personnel_assigned')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black uppercase bg-blue-100 text-blue-700 mr-2">Personnel Orders</span>
                                                @endif
                                                {{ $update->message }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-slate-400 italic">No operational notes filed yet.</div>
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
                                Active Team
                            </h3>
                            <div class="space-y-3 mb-6">
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
                                    <p class="text-xs text-slate-400 italic">No personnel deployed.</p>
                                @endforelse
                            </div>
                            
                            <button x-data="" @click="$dispatch('open-modal', 'manage-deployment')" class="w-full py-3 bg-slate-900 dark:bg-white dark:text-slate-900 text-white rounded-xl font-bold text-xs hover:bg-slate-800 transition-all">
                                Deploy Force
                            </button>
                        </div>
                    </div>

                    <!-- Operational Actions -->
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl">
                        <h3 class="text-lg font-bold mb-6">System Operations</h3>
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

    <!-- Deployment Modal -->
    <x-modal name="manage-deployment" :show="$errors->isNotEmpty()" focusable>
        <div class="p-8">
            <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Deploy Response Force</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-8">Select personnel to assign to this incident mission.</p>
            
            <form action="{{ route('incidents.assign-members', $incident) }}" method="POST">
                @csrf
                <div class="mb-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($allMembers as $member)
                            <label class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl border-2 border-transparent has-[:checked]:border-red-500 has-[:checked]:bg-red-50/50 dark:has-[:checked]:bg-red-900/10 cursor-pointer transition-all">
                                <input type="checkbox" name="members[]" value="{{ $member->id }}" @checked($incident->teamMembers->contains($member->id)) class="w-5 h-5 rounded border-slate-300 text-red-600 focus:ring-red-500">
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $member->name }}</p>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase">{{ $member->role }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex justify-end gap-4 mt-8">
                    <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                    <x-primary-button type="submit">Issue Deployment Orders</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
