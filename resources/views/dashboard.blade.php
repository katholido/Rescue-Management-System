<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Operational Overview') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistics Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Incidents -->
                <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="absolute -right-4 -top-4 text-slate-100 dark:text-slate-800 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-1">Total Incidents</p>
                    <h3 class="text-4xl font-bold">{{ $totalIncidents }}</h3>
                </div>

                <!-- Active Incidents -->
                <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="absolute -right-4 -top-4 text-red-50 dark:text-red-900/10 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M13 14h-2V9h2v5zm0 4h-2v-2h2v2zM1 21h22L12 2 1 21z"/></svg>
                    </div>
                    <p class="text-sm font-medium text-red-600 dark:text-red-400 uppercase tracking-wider mb-1">Active Alerts</p>
                    <h3 class="text-4xl font-bold text-red-600 dark:text-red-500">{{ $activeIncidents }}</h3>
                </div>

                <!-- Available Members -->
                <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="absolute -right-4 -top-4 text-green-50 dark:text-green-900/10 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                    </div>
                    <p class="text-sm font-medium text-green-600 dark:text-green-400 uppercase tracking-wider mb-1">Available Force</p>
                    <h3 class="text-4xl font-bold text-green-600 dark:text-green-500">{{ $availableMembers }}</h3>
                </div>

                <!-- Total Personnel -->
                <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="absolute -right-4 -top-4 text-slate-100 dark:text-slate-800 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-1">Total Force</p>
                    <h3 class="text-4xl font-bold">{{ $totalMembers }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Global Activity Feed (NEW) -->
                <div class="lg:col-span-1 bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col h-full">
                    <div class="p-8 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="text-xl font-bold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-red-600 animate-ping"></span>
                            Recent Activity
                        </h3>
                    </div>
                    <div class="p-8 flex-1 overflow-y-auto max-h-[600px] custom-scrollbar">
                        <div class="space-y-8 relative before:absolute before:inset-0 before:ml-4 before:-translate-x-px before:h-full before:w-0.5 before:bg-slate-100 dark:before:bg-slate-800">
                            @forelse($recentUpdates as $update)
                                <div class="relative pl-10 group">
                                    <div class="absolute left-0 w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 border-4 border-white dark:border-slate-900 flex items-center justify-center z-10 group-hover:bg-red-600 group-hover:scale-110 transition-all">
                                        @if($update->type == 'status_change')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">{{ $update->created_at->diffForHumans() }}</p>
                                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200 line-clamp-1">{{ $update->incident->title }}</p>
                                        <p class="text-xs text-slate-500 mt-1 italic">"{{ $update->message }}"</p>
                                        <p class="text-[10px] font-black text-red-600 mt-2 uppercase">— {{ $update->user->name }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-slate-400 italic text-sm">No recent activity logged.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Incidents -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                            <h3 class="text-xl font-bold">Latest Emergencies</h3>
                            <a href="{{ route('incidents.index') }}" class="text-xs font-black uppercase tracking-widest text-red-600 hover:text-red-700">View All</a>
                        </div>
                        <div class="p-0">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50 dark:bg-slate-800/30">
                                            <th class="px-8 py-5">Incident Name</th>
                                            <th class="px-8 py-5">Status</th>
                                            <th class="px-8 py-5">Priority</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                        @foreach($recentIncidents as $incident)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all cursor-pointer group" onclick="window.location='{{ route('incidents.show', $incident) }}'">
                                            <td class="px-8 py-6">
                                                <div class="flex flex-col">
                                                    <span class="font-bold text-slate-900 dark:text-white group-hover:text-red-600 transition-colors">{{ $incident->title }}</span>
                                                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">{{ $incident->location }}</span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-tighter rounded-lg 
                                                    @if($incident->status == 'Open') bg-red-100 text-red-700 
                                                    @elseif($incident->status == 'Ongoing') bg-blue-100 text-blue-700 
                                                    @else bg-green-100 text-green-700 @endif">
                                                    {{ $incident->status }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-2">
                                                    <span class="w-1.5 h-1.5 rounded-full {{ $incident->priority == 'Critical' ? 'bg-red-600' : ($incident->priority == 'High' ? 'bg-orange-500' : 'bg-slate-400') }}"></span>
                                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-600 dark:text-slate-400">{{ $incident->priority }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Compact Personnel List -->
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 p-8">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-xl font-bold">New Staff Members</h3>
                            <a href="{{ route('team-members.index') }}" class="text-xs font-black uppercase tracking-widest text-blue-600">View All Staff</a>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            @foreach($recentMembers as $member)
                            <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/50 pr-6 p-2 rounded-2xl border border-slate-100 dark:border-slate-700 group hover:border-red-500/50 transition-all">
                                <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center font-bold text-slate-400 group-hover:bg-red-600 group-hover:text-white transition-all shadow-sm">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-200">{{ $member->name }}</p>
                                    <p class="text-[9px] font-bold text-slate-500 uppercase">{{ $member->role }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
