    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Leave Management') }}
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

        <div class="container flex justify-end grid-cols-3 gap-4 mx-auto mt-6">
            <div class="flex items-center">
                <label for="filterDropdown" class="mr-2 text-sm font-bold text-gray-700">Filter by Status:</label>
                <form id="filterForm" action="" method="GET" class="flex items-center">
                    <select id="filterDropdown" class="rounded-md dropdown">
                        <option disabled selected value="">Select Status</option>
                        <option value="{{ route('leave-requests.index') }}">All Requests</option>
                        <option value="{{ route('leave-requests.filtered', 'approved') }}">Approved</option>
                        <option value="{{ route('leave-requests.filtered', 'rejected') }}">Rejected</option>
                        <option value="{{ route('leave-requests.filtered', 'pending') }}">Pending</option>
                        <option value="{{ route('leave-requests.filtered', 'ended') }}">Ended</option>
                    </select>
                    <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Submit</button>
                </form>
            </div>

            <div class="flex items-center">
                <label for="filterMonthDropdown" class="mr-2 text-sm font-bold text-gray-700">Filter by Month:</label>
                <form id="filterMonthForm" action="" method="GET" class="flex items-center">
                    <select id="filterMonthDropdown" class="rounded-md dropdown">
                        <option disabled selected value="">Select Month</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '01']) }}">January</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '02']) }}">February</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '03']) }}">March</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '04']) }}">April</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '05']) }}">May</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '06']) }}">June</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '07']) }}">July</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '08']) }}">August</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '09']) }}">September</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '10']) }}">October</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '11']) }}">November</option>
                        <option value="{{ route('leave-requests.filter-by-month', ['month' => '12']) }}">December</option>
                    </select>
                    <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Submit</button>
                </form>
            </div>
        </div>


        <script>
            document.getElementById("filterForm").addEventListener("submit", function (event) {
                event.preventDefault();
                var selectedRoute = document.getElementById("filterDropdown").value;
                window.location.href = selectedRoute;
            });

            document.getElementById('filterMonthForm').addEventListener('submit', function (event) {
                event.preventDefault();
                var selectedOption = document.getElementById('filterMonthDropdown').value;
                window.location.href = selectedOption;
            });
        </script>


        <div class="container mx-auto mt-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold">Leave Requests</h1>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">Start Date</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">End Date</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">Leave Type</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">Department</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leaveRequests as $leaveRequest)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->id }}</td>
                                        <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->user->first_name }} {{ $leaveRequest->user->surname }}</td>
                                        <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->start_date }}</td>
                                        <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->end_date }}</td>
                                        <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->leave_type }}</td>
                                        <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                            <span class="px-2 py-1 text-xs font-semibold leading-5 text-white text-center
                                                @if ($leaveRequest->status === 'pending')
                                                    bg-yellow-500
                                                @elseif ($leaveRequest->status === 'rejected')
                                                    bg-red-500 text-white
                                                @else
                                                    bg-green-500
                                                @endif
                                                rounded-full">
                                                {{ $leaveRequest->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                            @if ($leaveRequest->user && $leaveRequest->user->department)
                                                {{ $leaveRequest->user->department->name }}
                                            @else
                                                Department not found
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                            <a href="{{ route('leave-requests.show', $leaveRequest->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                            @if (auth()->user()->role === 'admin')
                                            <form method="POST" action="{{ route('leave-requests.destroy', $leaveRequest) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="openDeleteModal('{{ $leaveRequest->id }}')" class="ml-2 text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex items-center justify-center mt-4">
                            <nav>
                                <ul class="pagination">
                                   {{ $leaveRequests->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="deleteLeaveRequestModal" class="fixed inset-0 z-10 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true"></div>
                <div class="inline-block w-full max-w-lg overflow-hidden text-left align-bottom transition-all transform bg-gray-100 rounded-lg shadow-xl" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="px-6 py-4">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-headline">Confirm Deletion</h3>
                        <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete this leave request?</p>
                    </div>
                    <div class="flex items-center justify-end px-6 py-3 space-x-4 bg-gray-100">
                        <form method="POST" id="deleteLeaveRequestForm" action="" class="flex-shrink-0">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="deleteLeaveRequestId" name="leave_request_id" value="">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Delete
                            </button>
                        </form>
                        <button type="button" onclick="closeDeleteModal()" class="inline-flex items-center px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openDeleteModal(leaveRequestId) {
                const deleteLeaveRequestModal = document.getElementById('deleteLeaveRequestModal');
                const deleteLeaveRequestId = document.getElementById('deleteLeaveRequestId');
                const deleteLeaveRequestForm = document.getElementById('deleteLeaveRequestForm');

                deleteLeaveRequestId.value = leaveRequestId;
                deleteLeaveRequestForm.action = `{{ route('leave-requests.destroy', '') }}/${leaveRequestId}`;
                deleteLeaveRequestModal.classList.remove('hidden');
            }

            function closeDeleteModal() {
                const deleteLeaveRequestModal = document.getElementById('deleteLeaveRequestModal');
                deleteLeaveRequestModal.classList.add('hidden');
            }

            window.addEventListener('DOMContentLoaded', () => {
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
