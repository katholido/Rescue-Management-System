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
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 uppercase tracking-widest text-sm font-bold text-gray-500">Assigned Personnel</h3>
                                
                                @if($incident->teamMembers->count() > 0)
                                    <div class="space-y-2 mb-6">
                                        @foreach($incident->teamMembers as $member)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold mr-3">
                                                        {{ substr($member->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium">{{ $member->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $member->role }}</p>
                                                    </div>
                                                </div>
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 dark:text-gray-400 italic mb-6">No personnel assigned to this incident yet.</p>
                                @endif

                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-dashed border-gray-300 dark:border-gray-600">
                                    <h4 class="text-sm font-bold mb-3">Manage Deployment</h4>
                                    <form action="{{ route('incidents.assign-members', $incident) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <select name="members[]" multiple class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm h-32">
                                                @foreach($allMembers as $member)
                                                    <option value="{{ $member->id }}" @selected($incident->teamMembers->contains($member->id))>
                                                        {{ $member->name }} ({{ $member->role }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple members.</p>
                                        </div>
                                        <x-primary-button class="w-full justify-center">
                                            {{ __('Update Assignments') }}
                                        </x-primary-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
