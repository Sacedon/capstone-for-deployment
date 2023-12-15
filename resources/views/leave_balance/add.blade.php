<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add Leave Days') }}
        </h2>
    </x-slot>
    <div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Employee table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Employee Name</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Department</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Gender</th>
                        <!-- Add more table headers as needed -->
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-100 employee-row" data-target="#addLeaveModal" data-employee-id="{{ $user->id }}" data-employee-first-name="{{ $user->first_name }}" data-employee-surname="{{ $user->surname }}" data-employee-department="{{ $user->department ? $user->department->name : 'N/A' }}">
                            <td class="text-left py-3 px-4">{{ $user->first_name }} {{ $user->surname }}</td>
                            <td class="text-left py-3 px-4">{{ $user->department ? $user->department->name : 'N/A' }}</td>
                            <td class="text-left py-3 px-4">{{ $user->gender }}</td>
                            <!-- Add more table data as needed -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for adding leave days -->
    <div class="modal fade" id="addLeaveModal" tabindex="-1" role="dialog" aria-labelledby="addLeaveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('leave-balance.add-leave-days') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLeaveModalLabel">Add Leave Days</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Selected Employee: <span id="selectedEmployeeName"></span></p>
                        <p><span id="selectedEmployeeDepartment"></span></p>
                        <div class="form-group">
                            <label for="leave_type_modal">Leave Type:</label>
                            <select name="leave_type" id="leave_type_modal" class="form-control" required>
                                <option value="" selected disabled>Select Leave Type</option>
                                <option value="vacation">Vacation Leave</option>
                                <option value="sick">Sick Leave</option>
                                <option value="personal">Personal Leave</option>
                                <option value="fiesta">Fiesta Leave</option>
                                <option value="birthday">Birthday Leave</option>
                                <option value="educational">Educational Leave</option>
                                <!-- Add more leave types as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="days_to_add_modal">Days to Add:</label>
                            <input type="number" name="days_to_add" id="days_to_add_modal" class="form-control" required>
                        </div>
                        <input type="hidden" name="user_id" id="employee_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Leave Days</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- JavaScript to handle employee row click -->
    <script>
        $(document).ready(function () {
            $('.employee-row').click(function () {
                var employeeId = $(this).data('employee-id');
                var employeeFirstName = $(this).data('employee-first-name');
                var employeeSurname = $(this).data('employee-surname');
                var employeeDepartment = $(this).data('employee-department');
                var employeeGender = $(this).data('employee-gender');
                $('#employee_id').val(employeeId);
                $('#selectedEmployeeName').text(employeeFirstName + ' ' + employeeSurname);
                $('#selectedEmployeeDepartment').text('Department: ' + employeeDepartment);
                $('#selectedEmployeeGender').text('Gender: ' + employeeGender);
                $('#addLeaveModal').modal('show'); // Show the modal
                $('#addLeaveModal').modal('show'); // Show the modal
            });
        });
    </script>
</x-app-layout>
