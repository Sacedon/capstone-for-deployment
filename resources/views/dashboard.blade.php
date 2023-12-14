<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    @if(session('success'))
    <div id="successMessage" class="p-4 mb-4 text-green-700 bg-green-100 border-l-4 border-green-500">
        <div class="flex">
            <div class="py-1">
                <svg class="w-6 h-6 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="errorMessage" class="relative px-4 py-2 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
        <strong class="font-bold">Access Denied:</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="w-6 h-6 text-red-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M6.293 6.293a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12 6.293 9.707a1 1 0 010-1.414z"></path>
            </svg>
        </span>
    </div>
    @endif

    <script>
        function hideMessages() {
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 3000);
            }

            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000);
            }
        }
        window.addEventListener('load', hideMessages);
    </script>

    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->check() && auth()->user()->role === 'supervisor')
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            <div class="flex items-center justify-center p-6 transition-transform transform bg-white rounded-lg shadow-md dark:bg-dark-eval-1 hover:scale-105">
                <div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-800">Total Users</h3>
                    <p class="text-3xl font-bold text-center text-indigo-500">{{ $totalUsers }}</p>
                </div>
            </div>

            <div class="flex items-center justify-center p-6 transition-transform transform bg-white rounded-lg shadow-md dark:bg-dark-eval-1 hover:scale-105">
                <div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-800">Total Accepted Requests</h3>
                    <p class="text-3xl font-bold text-center text-green-500">{{ $totalAcceptedRequests }}</p>
                </div>
            </div>

            <div class="flex items-center justify-center p-6 transition-transform transform bg-white rounded-lg shadow-md dark:bg-dark-eval-1 hover:scale-105">
                <div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-800">Total Pending Requests</h3>
                    <p class="text-3xl font-bold text-center text-yellow-500">{{ $totalPendingRequests }}</p>
                </div>
            </div>

            <div class="flex items-center justify-center p-6 transition-transform transform bg-white rounded-lg shadow-md dark:bg-dark-eval-1 hover:scale-105">
                <div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-800">Total Rejected Requests</h3>
                    <p class="text-3xl font-bold text-center text-red-500">{{ $totalRejectedRequests }}</p>
                </div>
            </div>
        </div>
    @endif

   @if (auth()->check() && auth()->user()->role === 'employee')
    <div class="flex justify-center gap-40 p-6">
        <div class="flex items-center justify-center p-6 mb-8 transition-transform transform bg-white rounded-lg shadow-md w-96 dark:bg-dark-eval-1 hover:scale-105">
            <div>
                <h3 class="mb-4 text-xl font-semibold text-gray-800">Total Accepted Requests</h3>
                <p class="text-4xl font-bold text-center text-green-500">{{ $totalAcceptedRequests }}</p>
            </div>
        </div>

        <div class="flex items-center justify-center p-6 mb-8 transition-transform transform bg-white rounded-lg shadow-md w-96 dark:bg-dark-eval-1 hover:scale-105">
            <div>
                <h3 class="mb-4 text-xl font-semibold text-gray-800">Total Pending Requests</h3>
                <p class="text-4xl font-bold text-center text-yellow-500">{{ $totalPendingRequests }}</p>
            </div>
        </div>

        <div class="flex items-center justify-center p-6 mb-8 transition-transform transform bg-white rounded-lg shadow-md w-96 dark:bg-dark-eval-1 hover:scale-105">
            <div>
                <h3 class="mb-4 text-xl font-semibold text-gray-800">Total Rejected Requests</h3>
                <p class="text-4xl font-bold text-center text-red-500">{{ $totalRejectedRequests }}</p>
            </div>
        </div>
    </div>
   @endif


    @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="p-6 mt-5 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
            <h3 class="mb-4 text-2xl font-semibold">Department Heads</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-5 py-3 font-medium tracking-wider text-center text-gray-500 uppercase text-md">Profile Image</th>
                        <th scope="col" class="px-5 py-3 font-medium tracking-wider text-center text-gray-500 uppercase text-md">Name</th>
                        <th scope="col" class="px-5 py-3 font-medium tracking-wider text-center text-gray-500 uppercase text-md">Department</th>
                        <th scope="col" class="px-5 py-3 font-medium tracking-wider text-center text-gray-500 uppercase text-md">Total Employees</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($supervisors as $supervisor)
                        <tr>
                            <td class="flex justify-center px-5 py-3">
                                @if ($supervisor->profile_picture)
                                    <img class="object-cover w-8 h-8 rounded-full" src="{{ Storage::url($supervisor->profile_picture) }}" alt="{{ $supervisor->full_name }} Profile Picture">
                                @else
                                    <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('images/default-profile.jpeg') }}" alt="{{ $supervisor->full_name }} Profile Picture">
                                @endif
                            </td>
                            <td class="px-5 py-3 text-center text-md">{{ $supervisor->first_name }} {{ $supervisor->middle_name}} {{ $supervisor->surname}}</td>
                            @foreach ($departments as $department)
                                @if ($supervisor->department->id === $department->id)
                                    <td class="px-5 py-3 text-center text-md">{{ $department->name }}</td>
                                    <td class="px-5 py-3 text-center text-md">{{ $department->users_count }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-app-layout>
