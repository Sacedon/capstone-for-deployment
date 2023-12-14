<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Request Leave') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <!-- Card Container -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-2xl font-semibold">Create Leave Request</h2>

            @if(session('error'))
    <div id="errorMessage" class="relative px-4 py-2 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
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
                }, 8000);
            }
        }
        window.addEventListener('load', hideMessages);
    </script>

            <form method="POST" action="{{ route('leave-requests.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="leave_type" class="block text-sm font-medium text-gray-700">Leave Type:</label>
                    <select name="leave_type" id="leave_type" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" onchange="showAdditionalOptions(); toggleOtherInput();">
                        <option value="" selected disabled>Select Leave Type</option>
                        <option value="vacation">Vacation Leave</option>
                        <option value="sick">Sick Leave</option>
                        <option value="personal">Personal Leave</option>
                        <option value="fiesta">Fiesta Leave</option>
                        <option value="birthday">Birthday Leave</option>
                        <option value="maternity">Maternity Leave</option>
                        <option value="paternity">Paternity Leave</option>
                        <option value="educational">Educational Leave</option>
                        <option value="other">If Others Please Specify</option>
                    </select>
                </div>

                <div id="otherInput" class="hidden mb-4">
                    <label for="other_leave_type" class="block text-sm font-medium text-gray-700">Other Leave Type:</label>
                    <input type="text" id="other_leave_type" name="other_leave_type"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <script>
                    function toggleOtherInput() {
                        var leaveTypeSelect = document.getElementById('leave_type');
                        var otherInput = document.getElementById('otherInput');

                        if (leaveTypeSelect.value === 'other') {
                            otherInput.classList.remove('hidden');
                        } else {
                            otherInput.classList.add('hidden');
                        }
                    }
                </script>



                <div id="additionalOptions" style="display: none;">
                    <!-- Add your additional choices here -->
                    <label for="educational_reason" class="block text-sm font-medium text-gray-700">Educational Reason:</label>
                    <select name="educational_reason" id="educational_reason"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" onchange="showAdditionalOptions()">
                        <option value="Completion of Doctor's Degree">Completion of Doctor's Degree</option>
                        <option value="Completion of Master's Degree">Completion of Master's Degree</option>
                        <option value="Board Examination Review">Board Examination Review</option>
                        <option value="other">Others Please Specify</option> <!-- Added "Other" option -->
                    </select>

                    <!-- Additional input field for "Other" option -->
                    <div id="otherEducationalReason" style="display: none;">
                        <label for="other_educational_reason" class="block text-sm font-medium text-gray-700">Specify Other Reason:</label>
                        <input type="text" id="other_educational_reason" name="other_educational_reason"
                               class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <script>
                    function showAdditionalOptions() {
                        var leaveType = document.getElementById('leave_type').value;
                        var additionalOptions = document.getElementById('additionalOptions');
                        var otherEducationalReason = document.getElementById('otherEducationalReason');

                        if (leaveType === 'educational') {
                            additionalOptions.style.display = 'block';
                        } else {
                            additionalOptions.style.display = 'none';
                        }

                        var educationalReason = document.getElementById('educational_reason');
                        if (leaveType === 'educational' && educationalReason.value === 'other') {
                            otherEducationalReason.style.display = 'block';
                        } else {
                            otherEducationalReason.style.display = 'none';
                        }
                    }
                </script>

                <div class="mb-4" id="reason-container" style="display: none;">
                    <!-- Initially hidden, will be shown only when "Sick" is selected -->
                    <label for="reason" class="block text-sm font-medium text-gray-700">Specific Type of Sick:</label>
                    <div class="mt-1">
                        <input type="checkbox" name="reason[]" id="flu" value="Flu" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="flu" class="ml-2 text-sm text-gray-700">Flu</label>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="reason[]" id="cough" value="Cough" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="cough" class="ml-2 text-sm text-gray-700">Cough</label>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="reason[]" id="diarrhea" value="Diarrhea" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="diarrhea" class="ml-2 text-sm text-gray-700">Diarrhea</label>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="reason[]" id="headache" value="Headache" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="headache" class="ml-2 text-sm text-gray-700">Headache</label>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="reason" id="other" value="other" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="other" class="ml-2 text-sm text-gray-700">Others Please Specify</label>
                    </div>
                    <div class="mt-1" id="custom-reason-container" style="display: none;">
                        <label for="custom_reason" class="block text-sm font-medium text-gray-700">Other type of sick:</label>
                        <input type="text" name="reason[]" id="custom_reason" class="block w-full mt-1 rounded-md shadow-sm form-input" />
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Get the leave type dropdown element and reason container
                        const leaveTypeDropdown = document.getElementById("leave_type");
                        const reasonContainer = document.getElementById("reason-container");
                        const customReasonContainer = document.getElementById("custom-reason-container");

                        // Event listener for leave type dropdown change
                        leaveTypeDropdown.addEventListener("change", function () {
                            const selectedLeaveType = this.value;

                            // Toggle visibility of reason container based on the selected leave type
                            if (selectedLeaveType === "sick") {
                                reasonContainer.style.display = "block";
                                customReasonContainer.style.display = "none"; // Hide custom reason field
                            } else {
                                reasonContainer.style.display = "none";
                                customReasonContainer.style.display = "block"; // Show custom reason field
                            }
                        });

                        // Event listener for the "Other" checkbox
                        const otherCheckbox = document.getElementById("other");
                        otherCheckbox.addEventListener("change", function () {
                            customReasonContainer.style.display = this.checked ? "block" : "none";
                            if (!this.checked) {
                                document.getElementById("custom_reason").value = ""; // Clear custom reason input
                            }
                        });

                        // Trigger change event to set the initial state
                        leaveTypeDropdown.dispatchEvent(new Event("change"));
                        otherCheckbox.dispatchEvent(new Event("change"));
                    });
                </script>



                <div class="mb-4">
                    <label for="other_reason" class="block text-sm font-medium text-gray-700">Reason for Leave:</label>
                    <input type="text" name="other_reason" id="other_reason"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                        <input type="date" name="start_date" id="start_date"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"  min="{{ now()->format('Y-m-d') }}" required>
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                        <input type="date" name="end_date" id="end_date"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"  min="{{ now()->format('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="number_of_days" class="block text-sm font-medium text-gray-700">Number of Days:</label>
                    <input type="text" id="number_of_days" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Your existing JavaScript code...

                        // Event listener for start date and end date change
                        const startDateInput = document.getElementById("start_date");
                        const endDateInput = document.getElementById("end_date");
                        const numberOfDaysInput = document.getElementById("number_of_days");
                        const leaveTypeDropdown = document.getElementById("leave_type");

                        function updateNumberOfDays() {
                            const startDate = new Date(startDateInput.value);
                            const endDate = new Date(endDateInput.value);

                            // Check if the end date is not before the start date
                            if (endDate >= startDate) {
                                // Calculate the difference in days
                                const timeDifference = endDate - startDate;
                                const daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

                                // Display the number of days
                                numberOfDaysInput.value = daysDifference;
                            } else {
                                // If end date is before start date, set number of days to 0
                                numberOfDaysInput.value = 0;
                            }
                        }

                        // Function to update minimum date based on leave type
                        function updateMinimumDate() {
                            const today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format

                            if (leaveTypeDropdown.value === 'sick') {
                                startDateInput.min = '1900-01-01'; // Set a past date as the minimum for sick leave
                            } else {
                                const minDate = new Date();
                                minDate.setDate(minDate.getDate() + 10); // Add 10 days to the current date
                                const minDateString = minDate.toISOString().split('T')[0];
                                startDateInput.min = minDateString; // Set the minimum date for other leave types
                            }

                            endDateInput.min = startDateInput.value; // Ensure end date cannot be earlier than the start date
                            updateNumberOfDays();
                        }

                        // Event listeners for date inputs and leave type dropdown
                        startDateInput.addEventListener("change", updateMinimumDate);
                        endDateInput.addEventListener("change", updateNumberOfDays);
                        leaveTypeDropdown.addEventListener("change", updateMinimumDate);

                        // Trigger change event to set the initial state
                        leaveTypeDropdown.dispatchEvent(new Event("change"));
                        startDateInput.dispatchEvent(new Event("change"));
                        endDateInput.dispatchEvent(new Event("change"));
                    });
                </script>

                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit Leave Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
