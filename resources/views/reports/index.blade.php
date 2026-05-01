<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Operational Analytics & Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Incident Statistics -->
                <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 p-8">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Incident Distribution
                    </h3>
                    <div class="space-y-4">
                        @foreach($incidentStats as $stat)
                            <div>
                                <div class="flex justify-between text-sm font-bold mb-1">
                                    <span class="text-slate-600 dark:text-slate-400">{{ $stat->status }}</span>
                                    <span>{{ $stat->count }}</span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
                                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ ($stat->count / max($incidentStats->sum('count'), 1)) * 100 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Personnel Statistics -->
                <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 p-8">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Force Availability
                    </h3>
                    <div class="space-y-4">
                        @foreach($memberStats as $stat)
                            <div>
                                <div class="flex justify-between text-sm font-bold mb-1">
                                    <span class="text-slate-600 dark:text-slate-400">{{ $stat->availability_status }}</span>
                                    <span>{{ $stat->count }}</span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($stat->count / max($memberStats->sum('count'), 1)) * 100 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Export Actions -->
            <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14h-4v-4H8l4-4 4 4h-2v4z"/></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-black mb-4">Export Incident Data</h3>
                    <p class="text-slate-400 max-w-2xl mb-8 text-lg">Generate comprehensive reports for auditing and operational review. Choose your preferred format below.</p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('reports.incidents.csv') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-white text-slate-950 rounded-2xl font-bold hover:bg-slate-100 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Download CSV
                        </a>
                        <a href="{{ route('reports.incidents.pdf') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
