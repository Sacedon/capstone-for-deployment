<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <div class="flex justify-left">
                <a href="{{ route('users.index') }}" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    Back
                </a>
            </div>
            <div class="p-6 mt-3 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <form method="post" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="grid grid-cols-2 gap-8 sm:grid-cols-2">
                        <div>
                            <h3 class="mb-2 text-lg font-medium text-gray-700">PERSONAL INFORMATION</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Surname -->
                                <div>
                                    <label for="surname" class="form-label">Surname:</label>
                                    <input type="text" id="surname" name="surname" value="{{ old('surname', $user->surname) }}" required class="form-input">
                                </div>
                                <!-- First Name -->
                                <div>
                                    <label for="first_name" class="form-label">First Name:</label>
                                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required class="form-input">
                                </div>
                                <!-- Middle Name -->
                                <div>
                                    <label for="middle_name" class="form-label">Middle Name:</label>
                                    <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}" required class="form-input">
                                </div>
                                {{-- <!-- Email -->
                                <div>
                                    <label for="email" class="form-label">Email Address:</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input">
                                </div> --}}
                                <!-- Role -->
                                <div>
                                    <label for="role" class="form-label">Role:</label>
                                    <select id="role" name="role" class="form-select">
                                        <option value="employee" {{ old('role', $user->role) === 'employee' ? 'selected' : '' }}>Employee</option>
                                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="supervisor" {{ old('role', $user->role) === 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                                    </select>
                                </div>
                                <!-- Gender -->
                                <div>
                                    <label for="gender" class="form-label">Gender:</label>
                                    <select id="gender" name="gender" class="form-select">
                                        <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <!-- Date of Birth -->
                                <div>
                                    <label for="date_of_birth" class="form-label">Date of Birth:</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" class="form-input">
                                </div>
                                <!-- Department -->
                                <div>
                                    <label for="department" class="form-label">Department:</label>
                                    <select id="department" name="department" class="form-select">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->name }}" {{ optional($user->department)->name === $department->name ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Civil Status -->
                                <div>
                                    <label for="civil_status" class="form-label">Civil Status:</label>
                                    <select id="civil_status" name="civil_status" class="form-select">
                                        <option value="single" {{ old('civil_status', $user->civil_status) === 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="married" {{ old('civil_status', $user->civil_status) === 'married' ? 'selected' : '' }}>Married</option>
                                        <option value="separated" {{ old('civil_status', $user->civil_status) === 'separated' ? 'selected' : '' }}>Separated</option>
                                        <option value="widowed" {{ old('civil_status', $user->civil_status) === 'widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <h3 class="mb-2 text-lg font-medium text-gray-700">CONTACT INFORMATION</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Height -->
                                <div>
                                    <label for="height" class="form-label">Height (m):</label>
                                    <input type="number" id="height" name="height" step="0.01" value="{{ old('height', $user->height) }}" class="form-input">
                                </div>
                                <!-- Weight -->
                                <div>
                                    <label for="weight" class="form-label">Weight (kg):</label>
                                    <input type="number" id="weight" name="weight" value="{{ old('weight', $user->weight) }}" class="form-input">
                                </div>
                                <!-- Blood Type -->
                                <div>
                                    <label for="blood_type" class="form-label">Blood Type:</label>
                                    <input type="text" id="blood_type" name="blood_type" value="{{ old('blood_type', $user->blood_type) }}" class="form-input">
                                </div>
                                <!-- SSS ID NO -->
                                <div>
                                    <label for="sss_id_no" class="form-label">SSS ID NO:</label>
                                    <input type="text" id="sss_id_no" name="sss_id_no" value="{{ old('sss_id_no', $user->sss_id_no) }}" class="form-input">
                                </div>
                                <!-- PAG-IBIG ID NO -->
                                <div>
                                    <label for="pag_ibig_id_no" class="form-label">PAG-IBIG ID NO:</label>
                                    <input type="text" id="pag_ibig_id_no" name="pag_ibig_id_no" value="{{ old('pag_ibig_id_no', $user->pag_ibig_id_no) }}" class="form-input">
                                </div>
                                <!-- PHILHEALTH NO -->
                                <div>
                                    <label for="philhealth_no" class="form-label">PHILHEALTH NO:</label>
                                    <input type="text" id="philhealth_no" name="philhealth_no" value="{{ old('philhealth_no', $user->philhealth_no) }}" class="form-input">
                                </div>
                                <!-- TIN NO -->
                                <div>
                                    <label for="tin_no" class="form-label">TIN NO:</label>
                                    <input type="text" id="tin_no" name="tin_no" value="{{ old('tin_no', $user->tin_no) }}" class="form-input">
                                </div>
                                <!-- MDC-ID No -->
                                <div>
                                    <label for="mdc_id" class="form-label">MDC-ID No:</label>
                                    <input type="text" id="mdc_id" name="mdc_id" value="{{ old('mdc_id', $user->mdc_id) }}" class="form-input">
                                </div>
                                <!-- Place of Birth -->
                                <div>
                                    <label for="place_of_birth" class="form-label">Place of Birth:</label>
                                    <input type="text" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $user->place_of_birth) }}" class="form-input">
                                </div>
                                <!-- Profile Picture -->
                                <div>
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="form-input">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Residential Address -->
                    <div class="mb-6">
                        <h3 class="mb-2 text-lg font-medium text-gray-700">RESIDENTIAL ADDRESS</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- House/Block/Lot No. -->
                            <div>
                                <label for="residential_house_no" class="form-label">House/Block/Lot No.:</label>
                                <input type="text" id="residential_house_no" name="residential_house_no" value="{{ old('residential_house_no', $user->residential_house_no) }}" class="form-input">
                            </div>
                            <!-- Street -->
                            <div>
                                <label for="residential_street" class="form-label">Street:</label>
                                <input type="text" id="residential_street" name="residential_street" value="{{ old('residential_street', $user->residential_street) }}" class="form-input">
                            </div>
                            <!-- Subdivision/Village -->
                            <div>
                                <label for="residential_subdivision" class="form-label">Subdivision/Village:</label>
                                <input type="text" id="residential_subdivision" name="residential_subdivision" value="{{ old('residential_subdivision', $user->residential_subdivision) }}" class="form-input">
                            </div>
                            <!-- Barangay -->
                            <div>
                                <label for="residential_barangay" class="form-label">Barangay:</label>
                                <input type="text" id="residential_barangay" name="residential_barangay" value="{{ old('residential_barangay', $user->residential_barangay) }}" class="form-input">
                            </div>
                            <!-- City/Municipality -->
                            <div>
                                <label for="residential_city" class="form-label">City/Municipality:</label>
                                <input type="text" id="residential_city" name="residential_city" value="{{ old('residential_city', $user->residential_city) }}" class="form-input">
                            </div>
                            <!-- Province -->
                            <div>
                                <label for="residential_province" class="form-label">Province:</label>
                                <input type="text" id="residential_province" name="residential_province" value="{{ old('residential_province', $user->residential_province) }}" class="form-input">
                            </div>
                            <!-- ZIP CODE -->
                            <div>
                                <label for="residential_zip_code" class="form-label">ZIP CODE:</label>
                                <input type="text" id="residential_zip_code" name="residential_zip_code" value="{{ old('residential_zip_code', $user->residential_zip_code) }}" class="form-input">
                            </div>
                        </div>
                    </div>

                    <!-- Permanent Address -->
                    <div class="mb-6">
                        <h3 class="mb-2 text-lg font-medium text-gray-700">PERMANENT ADDRESS</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- House/Block/Lot No. -->
                            <div>
                                <label for="permanent_house_no" class="form-label">House/Block/Lot No.:</label>
                                <input type="text" id="permanent_house_no" name="permanent_house_no" value="{{ old('permanent_house_no', $user->permanent_house_no) }}" class="form-input">
                            </div>
                            <!-- Street -->
                            <div>
                                <label for="permanent_street" class="form-label">Street:</label>
                                <input type="text" id="permanent_street" name="permanent_street" value="{{ old('permanent_street', $user->permanent_street) }}" class="form-input">
                            </div>
                            <!-- Subdivision/Village -->
                            <div>
                                <label for="permanent_subdivision" class="form-label">Subdivision/Village:</label>
                                <input type="text" id="permanent_subdivision" name="permanent_subdivision" value="{{ old('permanent_subdivision', $user->permanent_subdivision) }}" class="form-input">
                            </div>
                            <!-- Barangay -->
                            <div>
                                <label for="permanent_barangay" class="form-label">Barangay:</label>
                                <input type="text" id="permanent_barangay" name="permanent_barangay" value="{{ old('permanent_barangay', $user->permanent_barangay) }}" class="form-input">
                            </div>
                            <!-- City/Municipality -->
                            <div>
                                <label for="permanent_city" class="form-label">City/Municipality:</label>
                                <input type="text" id="permanent_city" name="permanent_city" value="{{ old('permanent_city', $user->permanent_city) }}" class="form-input">
                            </div>
                            <!-- Province -->
                            <div>
                                <label for="permanent_province" class="form-label">Province:</label>
                                <input type="text" id="permanent_province" name="permanent_province" value="{{ old('permanent_province', $user->permanent_province) }}" class="form-input">
                            </div>
                            <!-- ZIP CODE -->
                            <div>
                                <label for="permanent_zip_code" class="form-label">ZIP CODE:</label>
                                <input type="text" id="permanent_zip_code" name="permanent_zip_code" value="{{ old('permanent_zip_code', $user->permanent_zip_code) }}" class="form-input">
                            </div>

                            <!-- Telephone Number -->
                    <div class="mb-6">
                        <h3 class="mb-2 text-lg font-medium text-gray-700">TELEPHONE NO.</h3>
                        <input type="text" id="telephone_number" name="telephone_number" value="{{ old('telephone_number', $user->telephone_number) }}" class="form-input">
                    </div>

                    <!-- Mobile Number -->
                    <div class="mb-6">
                        <h3 class="mb-2 text-lg font-medium text-gray-700">MOBILE NO.</h3>
                        <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" class="form-input">
                    </div>

                    <!-- Messenger Account -->
                    <div class="mb-6">
                        <h3 class="mb-2 text-lg font-medium text-gray-700">MESSENGER ACCT.</h3>
                        <input type="text" id="messenger_account" name="messenger_account" value="{{ old('messenger_account', $user->messenger_account) }}" class="form-input">
                    </div>

                    <!-- Spouse Information -->
                    <div>
                        <h3 class="mb-2 text-lg font-medium text-gray-700">SPOUSE INFORMATION</h3>
                        <!-- Spouse Surname -->
                        <div>
                            <label for="spouse_surname" class="form-label">Spouse Surname:</label>
                            <input type="text" id="spouse_surname" name="spouse_surname" value="{{ old('spouse_surname', $user->spouse_surname) }}" class="form-input">
                        </div>
                        <!-- Spouse First Name -->
                        <div>
                            <label for="spouse_first_name" class="form-label">Spouse First Name:</label>
                            <input type="text" id="spouse_first_name" name="spouse_first_name" value="{{ old('spouse_first_name', $user->spouse_first_name) }}" class="form-input">
                        </div>
                        <!-- Spouse Name Extension -->
                        <div>
                            <label for="spouse_name_extension" class="form-label">Spouse Name Extension:</label>
                            <input type="text" id="spouse_name_extension" name="spouse_name_extension" value="{{ old('spouse_name_extension', $user->spouse_name_extension) }}" class="form-input">
                        </div>
                        <!-- Spouse Middle Name -->
                        <div>
                            <label for="spouse_middle_name" class="form-label">Spouse Middle Name:</label>
                            <input type="text" id="spouse_middle_name" name="spouse_middle_name" value="{{ old('spouse_middle_name', $user->spouse_middle_name) }}" class="form-input">
                        </div>
                        <!-- Spouse Occupation -->
                        <div>
                            <label for="spouse_occupation" class="form-label">Spouse Occupation:</label>
                            <input type="text" id="spouse_occupation" name="spouse_occupation" value="{{ old('spouse_occupation', $user->spouse_occupation) }}" class="form-input">
                        </div>
                        <!-- Spouse Employer -->
                        <div>
                            <label for="spouse_employer" class="form-label">Spouse Employer:</label>
                            <input type="text" id="spouse_employer" name="spouse_employer" value="{{ old('spouse_employer', $user->spouse_employer) }}" class="form-input">
                        </div>
                        <!-- Spouse Business Address -->
                        <div>
                            <label for="spouse_business_address" class="form-label">Spouse Business Address:</label>
                            <input type="text" id="spouse_business_address" name="spouse_business_address" value="{{ old('spouse_business_address', $user->spouse_business_address) }}" class="form-input">
                        </div>
                        <!-- Spouse Telephone -->
                        <div>
                            <label for="spouse_telephone" class="form-label">Spouse Telephone:</label>
                            <input type="text" id="spouse_telephone" name="spouse_telephone" value="{{ old('spouse_telephone', $user->spouse_telephone) }}" class="form-input">
                        </div>
                    </div>

                    <!-- Parents Information -->
                    <div>
                        <h3 class="mb-2 text-lg font-medium text-gray-700">PARENTS INFORMATION</h3>
                        <!-- Father Information -->
                        <div>
                            <h4 class="mb-1 font-medium text-gray-700 text-md">Father's Information</h4>
                            <!-- Father Surname -->
                            <div>
                                <label for="father_surname" class="form-label">Father Surname:</label>
                                <input type="text" id="father_surname" name="father_surname" value="{{ old('father_surname', $user->father_surname) }}" class="form-input">
                            </div>
                            <!-- Father First Name -->
                            <div>
                                <label for="father_first_name" class="form-label">Father First Name:</label>
                                <input type="text" id="father_first_name" name="father_first_name" value="{{ old('father_first_name', $user->father_first_name) }}" class="form-input">
                            </div>
                            <!-- Father Name Extension -->
                            <div>
                                <label for="father_name_extension" class="form-label">Father Name Extension:</label>
                                <input type="text" id="father_name_extension" name="father_name_extension" value="{{ old('father_name_extension', $user->father_name_extension) }}" class="form-input">
                            </div>
                            <!-- Father Middle Name -->
                            <div>
                                <label for="father_middle_name" class="form-label">Father Middle Name:</label>
                                <input type="text" id="father_middle_name" name="father_middle_name" value="{{ old('father_middle_name', $user->father_middle_name) }}" class="form-input">
                            </div>
                        </div>
                        <!-- Mother Information -->
                        <div>
                            <h4 class="mb-1 font-medium text-gray-700 text-md">Mother's Information</h4>

                            <!-- Mother Surname -->
                            <div>
                                <label for="mother_maiden_surname" class="form-label">Mother Surname:</label>
                                <input type="text" id="mother_maiden_surname" name="mother_maiden_surname" value="{{ old('mother_maiden_surname', $user->mother_maiden_surname) }}" class="form-input">
                            </div>
                            <!-- Mother First Name -->
                            <div>
                                <label for="mother_first_name" class="form-label">Mother First Name:</label>
                                <input type="text" id="mother_first_name" name="mother_first_name" value="{{ old('mother_first_name', $user->mother_first_name) }}" class="form-input">
                            </div>

                            <!-- Mother Middle Name -->
                            <div>
                                <label for="mother_middle_name" class="form-label">Mother Middle Name:</label>
                                <input type="text" id="mother_middle_name" name="mother_middle_name" value="{{ old('mother_middle_name', $user->mother_middle_name) }}" class="form-input">
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>

                    <table class="w-full text-sm text-gray-500 border border-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 border-b">LEVEL</th>
                                <th scope="col" class="px-6 py-3 border-b">NAME OF SCHOOL (Write in full)</th>
                                <th scope="col" class="px-6 py-3 border-b">BASIC EDUCATION/DEGREE/COURSE (Write in full)</th>
                                <th scope="col" class="px-6 py-3 border-b">PERIOD OF ATTENDANCE</th>
                                <th scope="col" class="px-6 py-3 border-b">HIGHEST LEVEL/UNITS EARNED (if not graduated)</th>
                                <th scope="col" class="px-6 py-3 border-b">YEAR GRADUATED</th>
                                <th scope="col" class="px-6 py-3 border-b">SCHOLARSHIP/ACADEMIC HONORS RECEIVED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(['elementary', 'secondary', 'vocational', 'college', 'graduate'] as $level)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ strtoupper($level) }}</th>
                                    <td class="px-2 py-4">
                                        <input type="text" name="{{ $level }}_school" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm form-input" value="{{ old($level . '_school', $user->{$level . '_school'}) }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" name="{{ $level }}_degree" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm form-input" value="{{ old($level . '_degree', $user->{$level . '_degree'}) }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex">
                                            <input type="date" name="{{ $level }}_attendance_from" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm form-input" placeholder="from" value="{{ old($level . '_attendance_from', $user->{$level . '_attendance_from'}) }}">
                                            <span class="mx-2">-</span>
                                            <input type="date" name="{{ $level }}_attendance_to" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm form-input" placeholder="to" value="{{ old($level . '_attendance_to', $user->{$level . '_attendance_to'}) }}">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" name="{{ $level }}_highest_level" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm form-input" value="{{ old($level . '_highest_level', $user->{$level . '_highest_level'}) }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="date" name="{{ $level }}_year_graduated" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm form-input" value="{{ old($level . '_year_graduated', $user->{$level . '_year_graduated'}) }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" name="{{ $level }}_honors" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm form-input" value="{{ old($level . '_honors', $user->{$level . '_honors'}) }}">
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-white">
                                <td colspan="7" class="px-6 py-4 italic text-right border-t">
                                    <div class="flex items-center justify-between mt-4">
                                        <div>
                                            <label for="date" class="block text-sm font-medium text-gray-600">Date</label>
                                            <input type="date" name="date" id="date" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm form-input" value="{{ old('date', $user->date) }}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style scoped>
    /* public/css/styles.css */

/* Style for form container */
.form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Style for form headings */
.form-heading {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

/* Style for form labels */
.form-label {
    font-weight: bold;
    color: #333;
}

/* Style for form inputs */
.form-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

/* Style for form select elements */
.form-select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

/* Style for submit button */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

/* Style for submit button on hover */
.btn-primary:hover {
    background-color: #0056b3;
}

/* Add more custom styles as needed */

</style>
