<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Operational Overview') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 dark:bg-slate-950">
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
                    <p class="text-xs text-slate-400 mt-2">All time reports registered</p>
                </div>

                <!-- Active Incidents -->
                <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="absolute -right-4 -top-4 text-red-50 dark:text-red-900/10 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M13 14h-2V9h2v5zm0 4h-2v-2h2v2zM1 21h22L12 2 1 21z"/></svg>
                    </div>
                    <p class="text-sm font-medium text-red-600 dark:text-red-400 uppercase tracking-wider mb-1">Active Alerts</p>
                    <h3 class="text-4xl font-bold text-red-600 dark:text-red-500">{{ $activeIncidents }}</h3>
                    <p class="text-xs text-slate-400 mt-2">Open or Ongoing missions</p>
                </div>

                <!-- Available Members -->
                <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="absolute -right-4 -top-4 text-green-50 dark:text-green-900/10 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                    </div>
                    <p class="text-sm font-medium text-green-600 dark:text-green-400 uppercase tracking-wider mb-1">Available Personnel</p>
                    <h3 class="text-4xl font-bold text-green-600 dark:text-green-500">{{ $availableMembers }}</h3>
                    <p class="text-xs text-slate-400 mt-2">Ready for deployment</p>
                </div>

                <!-- Total Personnel -->
                <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="absolute -right-4 -top-4 text-slate-100 dark:text-slate-800 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-1">Force Strength</p>
                    <h3 class="text-4xl font-bold">{{ $totalMembers }}</h3>
                    <p class="text-xs text-slate-400 mt-2">Total registered members</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Incidents -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                        <h3 class="text-xl font-bold">Recent Incident Reports</h3>
                        <a href="{{ route('incidents.index') }}" class="text-sm text-red-600 font-bold hover:underline">View All</a>
                    </div>
                    <div class="p-0">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-xs font-bold text-slate-400 uppercase tracking-widest bg-slate-50/50 dark:bg-slate-800/30">
                                        <th class="px-8 py-4">Incident</th>
                                        <th class="px-8 py-4">Status</th>
                                        <th class="px-8 py-4">Priority</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    @foreach($recentIncidents as $incident)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer" onclick="window.location='{{ route('incidents.show', $incident) }}'">
                                        <td class="px-8 py-5">
                                            <p class="font-bold text-slate-800 dark:text-slate-200">{{ $incident->title }}</p>
                                            <p class="text-xs text-slate-500">{{ $incident->location }}</p>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full 
                                                @if($incident->status == 'Open') bg-red-100 text-red-700 
                                                @elseif($incident->status == 'Ongoing') bg-blue-100 text-blue-700 
                                                @else bg-slate-100 text-slate-700 @endif">
                                                {{ $incident->status }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="text-xs font-bold {{ $incident->priority == 'Critical' ? 'text-red-600' : ($incident->priority == 'High' ? 'text-orange-500' : 'text-slate-500') }}">
                                                {{ $incident->priority }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Personnel -->
                <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                        <h3 class="text-xl font-bold">New Personnel</h3>
                        <a href="{{ route('team-members.index') }}" class="text-sm text-blue-600 font-bold hover:underline">View All</a>
                    </div>
                    <div class="p-8 space-y-6">
                        @foreach($recentMembers as $member)
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-xl font-bold text-slate-400 group-hover:bg-red-600 group-hover:text-white transition-all">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 dark:text-slate-200">{{ $member->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $member->role }}</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full {{ $member->availability_status == 'Available' ? 'bg-green-500' : ($member->availability_status == 'On Mission' ? 'bg-blue-500' : 'bg-slate-300') }}" title="{{ $member->availability_status }}"></span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
