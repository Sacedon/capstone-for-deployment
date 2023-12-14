<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manage Departments') }}
        </h2>
    </x-slot>

    <!-- Flash messages container -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
        @if(session('success'))
            <div id="successMessage" class="p-4 mb-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-md shadow-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div id="errorMessage" class="p-4 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500 rounded-md shadow-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-4 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Main content grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Container for creating a department -->
        <div class="col-span-1">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="mb-4 text-2xl font-semibold">Create Department</h2>
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Department Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Container for the table of departments -->
        <div class="col-span-1">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h1 class="mb-4 text-2xl font-semibold">List of Departments</h1>
                @if ($departments->isEmpty())
                    <p class="text-gray-500">No departments found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Department Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($departments as $department)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $department->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button type="button" onclick="openDeleteModal('{{ $department->id }}')" class="ml-2 text-red-600 hover:text-red-900">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="deleteDepartmentModal" class="fixed inset-0 z-10 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true"></div>
            <div class="inline-block w-full max-w-lg overflow-hidden text-left align-bottom transition-all transform bg-gray-100 rounded-lg shadow-xl" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="px-6 py-4">
                    <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-headline">Confirm Deletion</h3>
                    <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete this department?</p>
                </div>
                <div class="flex items-center justify-end px-6 py-3 space-x-4 bg-gray-100">
                    <form method="POST" id="deleteDepartmentForm" action="" class="flex-shrink-0">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteDepartmentId" name="department_id" value="">
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>
                    </form>
                    <button type="button" x-on:click="closeModal" id="closeDepartmentModalButton" class="inline-flex items-center px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(departmentId) {
            const deleteDepartmentModal = document.getElementById('deleteDepartmentModal');
            const deleteDepartmentId = document.getElementById('deleteDepartmentId');
            const deleteDepartmentForm = document.getElementById('deleteDepartmentForm');

            deleteDepartmentId.value = departmentId;
            deleteDepartmentForm.action = `{{ route('departments.destroy', '') }}/${departmentId}`;
            deleteDepartmentModal.classList.remove('hidden');
        }

        window.addEventListener('DOMContentLoaded', () => {
            const deleteDepartmentModal = document.getElementById('deleteDepartmentModal');
            const closeDepartmentModalButton = document.getElementById('closeDepartmentModalButton');

            closeDepartmentModalButton.addEventListener('click', () => {
                deleteDepartmentModal.classList.add('hidden');
            });

            function hideMessages() {
                const successMessage = document.getElementById('successMessage');
                const errorMessage = document.getElementById('errorMessage');

                if (successMessage) {
                    setTimeout(function() {
                        successMessage.style.display = 'none';
                    }, 3000); // 3 seconds
                }

                if (errorMessage) {
                    setTimeout(function() {
                        errorMessage.style.display = 'none';
                    }, 3000); // 3 seconds
                }
            }

            // Call the hideMessages function when the page loads
            window.addEventListener('load', hideMessages);
        });
    </script>
</x-app-layout>
