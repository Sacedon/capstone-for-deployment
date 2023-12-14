<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Login and Logout Details') }}
        </h2>
    </x-slot>

    <div class="container px-4 py-6 mx-auto">
        <form method="GET" class="grid grid-cols-2 gap-4 mb-4">
            <div class="flex items-center">
                <label for="date" class="mr-2 text-sm font-bold text-gray-700">Filter by Date:</label>
                <input type="date" name="date" id="date" class="rounded-md shadow-sm form-input">
                <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-700">Search</button>
            </div>

            <div class="flex items-center">
                <label for="first_name" class="mr-2 text-sm font-bold text-gray-700">Search Employee:</label>
                <input type="text" name="first_name" id="first_name" class="rounded-md shadow-sm form-input">
                <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-700">Search</button>
            </div>
        </form>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Employee
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Login Time
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Logout Time
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($logs as $log)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $log->user->first_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $log->login_time ? $log->login_time->setTimezone('Asia/Manila')->format('Y-m-d H:i:s') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $log->logout_time ? $log->logout_time->setTimezone('Asia/Manila')->format('Y-m-d H:i:s') : 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No login/logout records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
