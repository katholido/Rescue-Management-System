<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Incident Reports') }}
            </h2>
            <a href="{{ route('incidents.create') }}" class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-2xl font-bold text-sm text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 transition ease-in-out duration-150 shadow-lg shadow-red-500/20">
                {{ __('Report Incident') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="p-8">
                    <!-- Search and Filter -->
                    <div class="mb-8 bg-slate-50 dark:bg-slate-800/50 p-6 rounded-3xl border border-slate-100 dark:border-slate-700">
                        <form action="{{ route('incidents.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <x-text-input name="search" placeholder="Search incidents..." class="w-full bg-white dark:bg-slate-900 rounded-xl" :value="request('search')" />
                            </div>
                            <div class="w-full md:w-48">
                                <select name="status" class="w-full border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-600 dark:text-slate-400 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm font-medium">
                                    <option value="">All Statuses</option>
                                    <option value="Open" @selected(request('status') == 'Open')>Open</option>
                                    <option value="Ongoing" @selected(request('status') == 'Ongoing')>Ongoing</option>
                                    <option value="Closed" @selected(request('status') == 'Closed')>Closed</option>
                                </select>
                            </div>
                            <x-primary-button type="submit" class="bg-slate-900 dark:bg-white dark:text-slate-900 rounded-xl px-8">
                                {{ __('Filter') }}
                            </x-primary-button>
                            @if(request()->anyFilled(['search', 'status']))
                                <a href="{{ route('incidents.index') }}" class="inline-flex items-center px-6 py-2.5 bg-slate-200 dark:bg-slate-700 border border-transparent rounded-xl font-bold text-xs text-slate-700 dark:text-slate-300 uppercase tracking-widest hover:bg-slate-300 active:bg-slate-400 transition ease-in-out duration-150">
                                    {{ __('Clear') }}
                                </a>
                            @endif
                        </form>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-xl" role="alert">
                            <p class="font-bold">Success</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-3xl border border-slate-100 dark:border-slate-800">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs font-bold text-slate-400 uppercase tracking-widest bg-slate-50 dark:bg-slate-800/30">
                                    <th class="px-8 py-5">Incident Intelligence</th>
                                    <th class="px-8 py-5">Status</th>
                                    <th class="px-8 py-5">Priority</th>
                                    <th class="px-8 py-5 text-right">Operations</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($incidents as $incident)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                        <td class="px-8 py-6">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-lg text-slate-800 dark:text-slate-200">{{ $incident->title }}</span>
                                                <span class="text-sm text-slate-500 flex items-center gap-1 mt-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                    {{ $incident->location }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="px-4 py-1.5 text-xs font-bold rounded-full 
                                                @if($incident->status == 'Open') bg-red-100 text-red-700 
                                                @elseif($incident->status == 'Ongoing') bg-blue-100 text-blue-700 
                                                @else bg-green-100 text-green-700 @endif">
                                                {{ $incident->status }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-2">
                                                <span class="w-2 h-2 rounded-full {{ $incident->priority == 'Critical' ? 'bg-red-600 animate-pulse' : ($incident->priority == 'High' ? 'bg-orange-500' : 'bg-slate-400') }}"></span>
                                                <span class="text-sm font-bold text-slate-600 dark:text-slate-400">{{ $incident->priority }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <div class="flex justify-end gap-2 transition-opacity">
                                                <a href="{{ route('incidents.show', $incident) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="View Details">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                </a>
                                                <a href="{{ route('incidents.edit', $incident) }}" class="p-2 text-slate-400 hover:text-orange-600 transition-colors" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-12 text-center text-slate-500 italic">
                                            No incidents found matching your criteria.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8">
                        {{ $incidents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
