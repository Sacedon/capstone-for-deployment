<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <style scoped>
        .user-details-container {
            background-color: #f9fafb;
            padding: 20px;
        }

        .user-details-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        .user-details-table th,
        .user-details-table td {
            border: 1px solid #e5e7eb;
            padding: 12px;
            text-align: left;
        }

        .user-details-table th {
            background-color: #f3f4f6;
            font-weight: 600;
            width: 30%;
        }

        .user-details-table img {
            max-width: 150px;
            max-height: 150px;
            display: block;
            margin: 0 auto;
            border-radius: 50%;
        }

        .children-list {
            list-style: none;
            padding: 0;
        }

        .children-list li {
            margin-bottom: 10px;
        }

        .children-list li strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>

    <div class="py-6 user-details-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="user-details-table">
                <tbody>
                    <tr>
                        <th colspan="2">Profile Picture</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if ($user->profile_picture)
                                <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }} Profile Picture" class="w-32 h-32 object-cover rounded-full mx-auto">
                            @else
                                <div class="text-gray-400">No Profile Picture</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Surname</th>
                        <td>{{ $user->surname }}</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>{{ $user->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Middle Name</th>
                        <td>{{ $user->middle_name }}</td>
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td>{{ $user->role }}</td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $user->gender }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $user->date_of_birth }}</td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td>{{ $user->department ? $user->department->name : 'N/A' }}</td>
                    </tr>

                    <tr>
                        <th>Civil Status</th>
                        <td>{{ $user->civil_status }}</td>
                    </tr>
                    <tr>
                        <th>Height</th>
                        <td>{{ $user->height }}</td>
                    </tr>
                    <tr>
                        <th>Weight</th>
                        <td>{{ $user->weight }}</td>
                    </tr>
                    <tr>
                        <th>Blood Type</th>
                        <td>{{ $user->blood_type }}</td>
                    </tr>
                    <tr>
                        <th>SSS ID No</th>
                        <td>{{ $user->sss_id_no }}</td>
                    </tr>
                    <tr>
                        <th>Pag-IBIG ID No</th>
                        <td>{{ $user->pag_ibig_id_no }}</td>
                    </tr>
                    <tr>
                        <th>PhilHealth No</th>
                        <td>{{ $user->philhealth_no }}</td>
                    </tr>
                    <tr>
                        <th>TIN No</th>
                        <td>{{ $user->tin_no }}</td>
                    </tr>
                    <tr>
                        <th>MDC ID</th>
                        <td>{{ $user->mdc_id }}</td>
                    </tr>
                    <tr>
                        <th>Place of Birth</th>
                        <td>{{ $user->place_of_birth }}</td>
                    </tr>
                    <tr>
                        <th>Residential Address</th>
                        <td>
                            {{ $user->residential_house_no }},
                            {{ $user->residential_street }},
                            {{ $user->residential_subdivision }},
                            {{ $user->residential_barangay }},
                            {{ $user->residential_city }},
                            {{ $user->residential_province }},
                            {{ $user->residential_zip_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <td>
                            {{ $user->permanent_house_no }},
                            {{ $user->permanent_street }},
                            {{ $user->permanent_subdivision }},
                            {{ $user->permanent_barangay }},
                            {{ $user->permanent_city }},
                            {{ $user->permanent_province }},
                            {{ $user->permanent_zip_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>Telephone Number</th>
                        <td>{{ $user->telephone_number }}</td>
                    </tr>
                    <tr>
                        <th>Mobile Number</th>
                        <td>{{ $user->mobile_number }}</td>
                    </tr>
                    <tr>
                        <th>Messenger Account</th>
                        <td>{{ $user->messenger_account }}</td>
                    </tr>

                    <tr>
                        <th>Spouse Surname</th>
                        <td>{{ $user->spouse_surname }}</td>
                    </tr>
                    <tr>
                        <th>Spouse First Name</th>
                        <td>{{ $user->spouse_first_name }}</td>
                    </tr>
                    <tr>
                        <th>Spouse Name Extension</th>
                        <td>{{ $user->spouse_name_extension }}</td>
                    </tr>
                    <tr>
                        <th>Spouse Middle Name</th>
                        <td>{{ $user->spouse_middle_name }}</td>
                    </tr>
                    <tr>
                        <th>Spouse Occupation</th>
                        <td>{{ $user->spouse_occupation }}</td>
                    </tr>
                    <tr>
                        <th>Spouse Employer</th>
                        <td>{{ $user->spouse_employer }}</td>
                    </tr>
                    <tr>
                        <th>Spouse Business Address</th>
                        <td>{{ $user->spouse_business_address }}</td>
                    </tr>
                    <tr>
                        <th>Spouse Telephone</th>
                        <td>{{ $user->spouse_telephone }}</td>
                    </tr>
                    <tr>
                        <th>Father Surname</th>
                        <td>{{ $user->father_surname }}</td>
                    </tr>
                    <tr>
                        <th>Father First Name</th>
                        <td>{{ $user->father_first_name }}</td>
                    </tr>
                    <tr>
                        <th>Father Name Extension</th>
                        <td>{{ $user->father_name_extension }}</td>
                    </tr>

                    <tr>
                        <th>Mother Maiden Surname</th>
                        <td>{{ $user->mother_maiden_surname }}</td>
                    </tr>
                    <tr>
                        <th>Mother First Name</th>
                        <td>{{ $user->mother_first_name }}</td>
                    </tr>
                    <tr>
                        <th>Mother Middle Name</th>
                        <td>{{ $user->mother_middle_name }}</td>
                    </tr>
                    <tr>
                        <th>Children</th>
                        <td>
                            @if ($user->children->isNotEmpty())
                                <ul class="children-list">
                                    @foreach ($user->children as $child)
                                        <li>
                                            <strong>Name:</strong> {{ $child->name }},
                                            <strong>Birthdate:</strong> {{ $child->birthdate }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                No Children
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="py-6 user-details-container">
                <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                    <table class="w-full text-sm text-gray-500 border border-gray-300 user-details-table">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 border-b">LEVEL</th>
                                <th scope="col" class="py-3 px-6 border-b">NAME OF SCHOOL (Write in full)</th>
                                <th scope="col" class="py-3 px-6 border-b">BASIC EDUCATION/DEGREE/COURSE (Write in full)</th>
                                <th scope="col" class="py-3 px-6 border-b">PERIOD OF ATTENDANCE</th>
                                <th scope="col" class="py-3 px-6 border-b">HIGHEST LEVEL/UNITS EARNED (if not graduated)</th>
                                <th scope="col" class="py-3 px-6 border-b">YEAR GRADUATED</th>
                                <th scope="col" class="py-3 px-6 border-b">SCHOLARSHIP/ACADEMIC HONORS RECEIVED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(['elementary', 'secondary', 'vocational', 'college', 'graduate'] as $level)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{ strtoupper($level) }}</th>
                                    <td class="py-4 px-2">{{ $user->{$level . '_school'} }}</td>
                                    <td class="py-4 px-6">{{ $user->{$level . '_degree'} }}</td>
                                    <td class="py-4 px-6">
                                        <div class="flex">
                                            {{ $user->{$level . '_attendance_from'} }} - {{ $user->{$level . '_attendance_to'} }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">{{ $user->{$level . '_highest_level'} }}</td>
                                    <td class="py-4 px-6">{{ $user->{$level . '_year_graduated'} }}</td>
                                    <td class="py-4 px-6">{{ $user->{$level . '_honors'} }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-white">
                                <td colspan="7" class="text-right italic py-4 px-6 border-t">
                                    <div class="mt-4 flex justify-between items-center">
                                        <div>
                                            <label for="date" class="block text-sm font-medium text-gray-600">Date</label>
                                            {{ $user->date }}
                                        </div>
                                        <div>
                                            <label for="signature" class="block text-sm font-medium text-gray-600">Signature</label>
                                            @if ($user->signature)
                                                <img src="{{ asset('storage/signatures/' . $user->signature) }}" alt="Signature">
                                            @else
                                                {{ $user->signature }}
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
