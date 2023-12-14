<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('All Department Users') }}
        </h2>
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

    <div class="container px-4 py-6 mx-auto">
        <div class="flex items-center justify-end mb-6">
            <form action="{{ route('employee-users.index') }}" method="GET" class="flex items-center">
                @csrf
                @if (auth()->user()->role === 'admin')
                    <div class="flex items-center">
                        <label for="department_id" class="mr-2 text-sm font-bold text-gray-700">Filter by Department:</label>
                        <div class="relative">
                            <select name="department_id" id="department_id" class="rounded-md dropdown">
                                <option value="">All Departments</option>
                                @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" @if($selectedDepartment && $selectedDepartment->id == $dept->id) selected @endif>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="filter_by_department" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Filter</button>
                    </div>
                @endif
                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'supervisor')
                        <div class="flex items-center ml-4">
                            <label for="gender" class="mr-2 text-sm font-bold text-gray-700">Filter by Gender:</label>
                            <div class="relative">
                                <select name="gender" id="gender" class="rounded-md dropdown">
                                    <option value="">All Genders</option>
                                    <option value="male" @if(request('gender') == 'male') selected @endif>Male</option>
                                    <option value="female" @if(request('gender') == 'female') selected @endif>Female</option>
                                </select>
                            </div>
                            <button type="submit" name="filter_by_department" class="px-4 py-2 ml-4 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Filter</button>
                        </div>
                    @endif
                </form>
        </div>

        <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <h1 class="text-2xl font-semibold">List of Department Employees</h1>
            @if ($users->isEmpty())
            <p class="text-gray-500">No users found in the department.</p>
            @else
            <div class="mt-3 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Profile Image</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Department</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Role</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if ($user->profile_picture)
                                    <a href="{{ route('users.show', $user) }}" class="flex justify-center">
                                        <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->first_name }} Profile Picture" class="object-cover w-12 h-12 rounded-full">
                                    </a>
                                @else
                                    <a href="{{ route('users.show', $user) }}" class="flex justify-center">
                                        <img src="{{ asset('images/default-profile.jpeg') }}" alt="{{ $user->first_name }} Profile Picture" class="object-cover w-12 h-12 rounded-full">
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">{{ $user->first_name }} {{ $user->middle_name}} {{ $user->surname }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if ($user->department)
                                {{ $user->department->name }}
                                @else
                                No Department
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                {{ $user->role }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if (auth()->user()->role !== 'supervisor')
                                    <form method="POST" id="deleteUserForm" action="" class="flex-shrink-0">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" id="deleteUserId" name="user_id" value="">
                                        <button type="button" class="text-center text-red-600 hover:text-red-900 open-delete-modal" data-user-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteConfirmationModal">Delete</button>
                                    </form>
                                @else
                                    <a href="{{ route('users.records', $user) }}" class="text-green-600 hover:text-green-900">Records</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Delete User Confirmation Modal -->
    <div id="deleteUserModal" class="fixed inset-0 z-10 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true"></div>
            <div class="inline-block w-full max-w-lg overflow-hidden text-left align-bottom transition-all transform bg-gray-100 rounded-lg shadow-xl" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="px-6 py-4">
                    <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-headline">Confirm Deletion</h3>
                    <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete this user?</p>
                </div>
                <div class="flex items-center justify-end px-6 py-3 space-x-4 bg-gray-100">
                    <form method="POST" id="deleteUserForm" action="" class="flex-shrink-0">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteUserId" name="user_id" value="">
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>
                    </form>
                    <button type="button" x-on:click="closeModal" id="closeModalButton" class="inline-flex items-center px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const deleteUserModal = document.getElementById('deleteUserModal');
        const openModalButtons = document.querySelectorAll('.open-delete-modal');
        const deleteUserId = document.getElementById('deleteUserId');
        const deleteUserForm = document.getElementById('deleteUserForm');

        openModalButtons.forEach((button) => {
            button.addEventListener('click', (event) => {
                const userId = event.target.getAttribute('data-user-id');
                deleteUserId.value = userId;
                deleteUserForm.action = `{{ route('employee-users.delete', '') }}/${userId}`;
                deleteUserModal.classList.remove('hidden');
            });
        });

        const closeModalButton = document.getElementById('closeModalButton');
        closeModalButton.addEventListener('click', () => {
            deleteUserModal.classList.add('hidden');
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
