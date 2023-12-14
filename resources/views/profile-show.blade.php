<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile Information') }}
        </h2>
    </x-slot>



    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <form method="post" action="{{ route('profile-show', $user) }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @csrf
                    @method('put')

                    <div class="mb-4">
                        <label for="surname" class="block text-sm font-medium text-gray-700">Surname:</label>
                        <input type="text" id="surname" name="surname" value="{{ old('surname', $user->surname) }}" required
                            class="input-field">

                    </div>

                    <!-- Middle Name -->
                    <div class="mb-4">
                        <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                        <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}" required
                            class="input-field">
                    </div>

                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                            class="input-field">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address:</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="input-field">
                    </div>


                    <!-- Gender -->
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                        <select id="gender" name="gender" class="select-field" >
                            <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-4">
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" required
                            class="input-field">
                    </div>

                    @if ($user && $user->role === 'admin')
                        <!-- Department -->
                        <div class="col-span-2 mb-4">
                            <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                            <select id="department" name="department" class="select-field">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->name }}" {{ optional($user->department)->name === $department->name ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status:</label>
                        <select id="civil_status" name="civil_status" class="select-field" >
                            <option value="single" {{ old('civil_status', $user->civil_status) === 'single' ? 'selected' : '' }}>Single</option>
                            <option value="married" {{ old('civil_status', $user->civil_status) === 'married' ? 'selected' : '' }}>Married</option>
                            <option value="separated" {{ old('civil_status', $user->civil_status) === 'separated' ? 'selected' : '' }}>Separated</option>
                            <option value="widowed" {{ old('civil_status', $user->civil_status) === 'widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>

                    <!-- Height (m) -->
                    <div class="mb-4">
                        <label for="height" class="block text-sm font-medium text-gray-700">Height (m):</label>
                        <input type="number" id="height" name="height" step="0.01" value="{{ old('height', $user->height) }}" required
                            class="input-field">
                    </div>

                    <!-- Weight (kg) -->
                    <div class="mb-4">
                        <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg):</label>
                        <input type="number" id="weight" name="weight" value="{{ old('weight', $user->weight) }}" required
                            class="input-field">
                    </div>

                    <!-- Blood Type -->
                    <div class="mb-4">
                        <label for="blood_type" class="block text-sm font-medium text-gray-700">Blood Type:</label>
                        <input type="text" id="blood_type" name="blood_type" value="{{ old('blood_type', $user->blood_type) }}"
                            class="input-field">
                    </div>

                    <!-- SSS ID NO -->
                    <div class="mb-4">
                        <label for="sss_id_no" class="block text-sm font-medium text-gray-700">SSS ID NO:</label>
                        <input type="text" id="sss_id_no" name="sss_id_no" value="{{ old('sss_id_no', $user->sss_id_no) }}" required
                            class="input-field">
                    </div>

                    <!-- PAG-IBIG ID NO -->
                    <div class="mb-4">
                        <label for="pag_ibig_id_no" class="block text-sm font-medium text-gray-700">PAG-IBIG ID NO:</label>
                        <input type="text" id="pag_ibig_id_no" name="pag_ibig_id_no" value="{{ old('pag_ibig_id_no', $user->pag_ibig_id_no) }}" required
                            class="input-field">
                    </div>

                    <!-- PHILHEALTH NO -->
                    <div class="mb-4">
                        <label for="philhealth_no" class="block text-sm font-medium text-gray-700">PHILHEALTH NO:</label>
                        <input type="text" id="philhealth_no" name="philhealth_no" value="{{ old('philhealth_no', $user->philhealth_no) }}" required
                            class="input-field">
                    </div>

                    <!-- TIN NO -->
                    <div class="mb-4">
                        <label for="tin_no" class="block text-sm font-medium text-gray-700">TIN NO:</label>
                        <input type="text" id="tin_no" name="tin_no" value="{{ old('tin_no', $user->tin_no) }}" required
                            class="input-field">
                    </div>

                    <!-- MDC-ID No -->
                    <div class="mb-4">
                        <label for="mdc_id" class="block text-sm font-medium text-gray-700">MDC-ID No:</label>
                        <input type="text" id="mdc_id" name="mdc_id" value="{{ old('mdc_id', $user->mdc_id) }}" required
                            class="input-field">
                    </div>

                    <!-- Place of Birth -->
                    <div class="mb-4">
                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth:</label>
                        <input type="text" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $user->place_of_birth) }}" required
                            class="input-field">
                    </div>

                    <!-- Profile Picture -->
                    <div class="mb-4">
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>

                    <!-- Button -->
                    <div class="flex items-center justify-end col-span-2">
                        <button type="submit" class="btn-save">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>



<style scoped>
    .input-field {
        /* Your input field styles here */
        /* Example: */
        border: 1px solid #ccc;
        padding: 0.5rem;
        border-radius: 0.25rem;
        width: 100%;
    }

    .select-field {
        /* Your select field styles here */
        /* Example: */
        border: 1px solid #ccc;
        padding: 0.5rem;
        border-radius: 0.25rem;
        width: 100%;
    }

    .btn-save {
        /* Your button styles here */
        /* Example: */
        background-color: #4a90e2;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;

    }

</style>
