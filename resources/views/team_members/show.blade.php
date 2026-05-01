<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Member Details') }}: {{ $teamMember->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('team-members.edit', $teamMember) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('team-members.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 border-b pb-2">Personal Information</h3>
                            
                            <div class="mb-4">
                                <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Full Name</span>
                                <p class="text-lg font-semibold">{{ $teamMember->name }}</p>
                            </div>

                            <div class="mb-4">
                                <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Operational Role</span>
                                <p class="text-lg">{{ $teamMember->role }}</p>
                            </div>

                            <div class="mb-4">
                                <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Phone Number</span>
                                <p class="text-lg">{{ $teamMember->phone ?? 'Not registered' }}</p>
                            </div>

                            <div class="mb-4">
                                <span class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Availability Status</span>
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full mt-1
                                    @if($teamMember->availability_status == 'Available') bg-green-100 text-green-800 
                                    @elseif($teamMember->availability_status == 'On Mission') bg-blue-100 text-blue-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $teamMember->availability_status }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 border-b pb-2">Mission History</h3>
                            <div class="mt-4">
                                <p class="text-gray-500 dark:text-gray-400 italic">No missions assigned yet. (Feature coming in Phase 3)</p>
                            </div>

                            <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <h4 class="font-bold mb-2">Member Statistics</h4>
                                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                    <li>• Total Incidents Responded: 0</li>
                                    <li>• Performance Rating: N/A</li>
                                    <li>• Last Active: {{ $teamMember->updated_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
