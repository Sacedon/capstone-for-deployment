<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('History') }}
            </h2>
        </div>
    </x-slot>


    <div class="container mx-auto mt-4">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="mb-4 text-2xl font-semibold">Recent History</h1>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase border-b">ID</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase border-b">Log Entry</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase border-b">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activityLogs as $activityLog)
                                <tr>
                                    <td class="px-6 py-4 text-center border-b whitespace-nowrap">{{ $activityLog->id }}</td>
                                    <td class="px-6 py-4 text-center border-b whitespace-nowrap">{{ $activityLog->log_entry }}</td>
                                    <td class="px-6 py-4 text-center border-b whitespace-nowrap">{{ $activityLog->created_at instanceof \Carbon\Carbon ? $activityLog->created_at->format('Y-m-d H:i:s') : $activityLog->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $activityLogs->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
