<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Incident Details') }}: {{ $incident->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('incidents.edit', $incident) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('incidents.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 border-b pb-2">Information</h3>
                            
                            <div class="mb-4">
                                <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Title</span>
                                <p class="text-lg">{{ $incident->title }}</p>
                            </div>

                            <div class="mb-4">
                                <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Location</span>
                                <p class="text-lg">{{ $incident->location ?? 'No location provided' }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Priority</span>
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full mt-1
                                        @if($incident->priority == 'High') bg-red-100 text-red-800 
                                        @elseif($incident->priority == 'Med') bg-yellow-100 text-yellow-800 
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $incident->priority }}
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Status</span>
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full mt-1
                                        @if($incident->status == 'Open') bg-blue-100 text-blue-800 
                                        @elseif($incident->status == 'Ongoing') bg-orange-100 text-orange-800 
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $incident->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Reported At</span>
                                <p class="text-lg">{{ $incident->reported_at->format('F d, Y - H:i') }}</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 border-b pb-2">Description</h3>
                            <div class="prose dark:prose-invert max-w-none">
                                <p class="whitespace-pre-line text-gray-700 dark:text-gray-300">
                                    {{ $incident->description ?? 'No description provided.' }}
                                </p>
                            </div>

                            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Assigned Personnel</h3>
                                <p class="text-gray-500 dark:text-gray-400 italic">No personnel assigned yet. (Feature coming in Phase 3)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
