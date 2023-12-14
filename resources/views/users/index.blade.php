<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div id="errorMessage" class="p-4 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500">
            <div class="flex">
                <div>
                    {{ $errors->first() }}
                </div>
            </div>
        </div>
    @endif

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
        <div id="errorMessage" class="p-4 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500">
            <div class="flex">
                <div class="py-1">
                    <svg class="w-6 h-6 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    <div class="container px-4 py-6 mx-auto">
        <form action="{{ route('users.index') }}" method="GET" class="grid grid-cols-3 gap-4">
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

            <div class="flex items-center">
                <label for="gender" class="mr-2 text-sm font-bold text-gray-700">Filter by Gender:</label>
                <div class="relative">
                    <select name="gender" id="gender" class="rounded-md dropdown">
                        <option value="">All Genders</option>
                        <option value="male" @if(request('gender') == 'male') selected @endif>Male</option>
                        <option value="female" @if(request('gender') == 'female') selected @endif>Female</option>
                    </select>
                </div>
                <button type="submit" name="filter_by_gender" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Filter</button>
            </div>

            <div class="flex items-center">
                <label for="search" class="mr-2 text-sm font-bold text-gray-700">Search Users:</label>
                <div class="relative">
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search users..." class="rounded-md input-field">
                </div>
                <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Search</button>
            </div>
        </form>
    </div>


        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800">Users</h3>
                    <div class="m-2 space-x-4">
                        <a href="#" id="openCreateUserModal"
                        class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Create User</a>
                    </div>
                </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Profile Pic
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Full Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Department
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center">
                                            @if ($user->profile_picture)
                                                <a href="{{ route('users.show', $user) }}">
                                                    <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }} Profile Picture" class="object-cover w-12 h-12 rounded-full">
                                                </a>
                                            @else
                                                <a href="{{ route('users.show', $user) }}">
                                                    <img src="{{ asset('images/default-profile.jpeg') }}" alt="{{ $user->name }} Profile Picture" class="object-cover w-12 h-12 rounded-full">
                                                </a>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $user->surname }}, {{ $user->middle_name }} {{ $user->first_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $user->role }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if ($user->department)
                                            {{ $user->department->name }}
                                        @else
                                            No Department
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('users.records', $user) }}" class="text-green-600 hover:text-green-900">Records</a>
                                            <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <button type="button" class="text-red-600 hover:text-red-900 open-delete-modal" data-user-id="{{ $user->id }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex items-center justify-center mt-4">
                        <nav>
                            <ul class="pagination">
                                {{ $users->links() }}
                            </ul>
                        </nav>
                    </div>

                    <style>
                        .pagination {
                            display: flex;
                            list-style: none;
                        }

                        .pagination li {
                            margin: 0 1px;
                        }

                        .pagination a {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            min-width: 30px;
                            min-height: 30px;
                            text-decoration: none;
                            color: #3490dc;
                            background-color: #0d120f;
                            border: 1px solid #c6d6e1;
                            border-radius: 0.25rem;
                            transition: background-color 0.3s;
                        }

                        .pagination a:hover {
                            background-color: #4299e1 !important;
                            color: #fff !important;
                        }

                        .pagination .active a {
                            background-color: #4299e1 !important;
                            color: #fff !important;
                        }

                        .pagination .active span {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            min-width: 30px;
                            min-height: 30px;
                            background-color: #4299e1;
                            color: #fff;
                            border: 1px solid #4299e1;
                            border-radius: 0.25rem;
                        }
                    </style>



                </div>
        </div>



        <!-- Create User Modal -->
        <div id="createUserModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50">
            <div class="flex items-center justify-center h-full">
                <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                    <!-- Modal Header -->
                    <div class="px-6 py-3 bg-gray-200 rounded-t-lg">
                        <h2 class="text-xl font-semibold text-gray-800">Create User</h2>
                    </div>
                    <!-- Modal Body -->
                    <div class="p-6">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label for="username" class="block mb-1 text-sm font-medium text-gray-700">Username:</label>
                                    <input type="text" id="username" name="username" value="{{ old('username') }}" required
                                        class="w-full px-3 py-2 text-sm border rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="first_name" class="block mb-1 text-sm font-medium text-gray-700">First Name:</label>
                                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
                                        class="w-full px-3 py-2 text-sm border rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="surname" class="block mb-1 text-sm font-medium text-gray-700">Surname:</label>
                                    <input type="text" id="surname" name="surname" value="{{ old('surname') }}" required
                                        class="w-full px-3 py-2 text-sm border rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password:</label>
                                    <input type="password" id="password" name="password" required
                                        class="w-full px-3 py-2 text-sm border rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="role" class="block mb-1 text-sm font-medium text-gray-700">Role:</label>
                                    <select id="role" name="role"
                                        class="w-full px-3 py-2 text-sm border rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="employee">Employee</option>
                                        <option value="admin">Admin</option>
                                        <option value="supervisor">Supervisor</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-700">Confirm Password:</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required
                                        class="w-full px-3 py-2 text-sm border rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <div>
                                    <label for="department" class="block mb-1 text-sm font-medium text-gray-700">Department:</label>
                                    <select id="department" name="department"
                                        class="w-full px-3 py-2 text-sm border rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="" selected disabled>Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->name }}" {{ optional($user->department)->name === $department->name ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label for="profile_picture" class="block mb-1 text-sm font-medium text-gray-700">Profile Picture:</label>
                                    <input type="file" id="profile_picture" name="profile_picture"
                                        class="w-full px-3 py-2 text-sm border rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="button" id="closeCreateUserModal"
                                    class="px-4 py-2 mr-3 text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const createUserModal = document.getElementById('createUserModal');
            const openCreateUserModalButton = document.querySelector('#openCreateUserModal');
            const closeCreateUserModalButton = document.getElementById('closeCreateUserModal');

            openCreateUserModalButton.addEventListener('click', function () {
                createUserModal.classList.remove('hidden');
            });

            closeCreateUserModalButton.addEventListener('click', function () {
                createUserModal.classList.add('hidden');
            });
        });
    </script>


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
                    deleteUserForm.action = `{{ route('users.destroy', '') }}/${userId}`;
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
