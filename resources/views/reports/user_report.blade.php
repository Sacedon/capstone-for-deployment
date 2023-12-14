<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased bg-gray-100">
    <header class="mb-10 text-center">
        <img src="https://pbs.twimg.com/profile_images/378800000379420717/51d573c25ea3bc95169b2ea37ee25e16_400x400.png" alt="School Logo" class="mx-auto logo">
        <h2 class="mt-2 text-2xl font-bold">Human Resource Information System</h2>
        <h4>Mater Dei College</h4>
        <p>Cabulijan, Tubigon, Bohol</p>
    </header>

    <div class="container p-4 mx-auto mb-8 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-center">User Information</h2>
        <div class="flex mb-4 items-left">
            <div class="max-w-md mx-auto text-left">
                <p class="mb-2 text-gray-700">Full Name: {{ $user->surname }}, {{ $user->middle_name }} {{ $user->first_name }}</p>
                <p class="mb-2 text-gray-700">Email: {{ $user->email }}</p>
                <p class="mb-2 text-gray-700">Address: {{ $user->residential_street }}, {{$user->residential_barangay}}, {{$user->residential_city}}, {{$user->residential_province}}</p>
                <p class="mb-2 text-gray-700">Department: {{ $user->department->name }}</p>
                <p class="text-gray-700">Role: {{ $user->role }}</p>
            </div>
        </div>
    </div>

    <h1 class="pb-2 text-3xl text-center border-b-2 border-gray-300">User Report</h1>

    <div class="container mx-auto mt-8">
        <div class="text-2xl text-center">Leave Requests for {{ date('F Y') }}</div>
        @if($leaveRequests && $leaveRequests->count() > 0)
            <table class="w-full mt-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-center border">Leave Type</th>
                        <th class="px-4 py-2 text-center border">Start Date</th>
                        <th class="px-4 py-2 text-center border">End Date</th>
                        <th class="px-4 py-2 text-center border">Number of Days</th>
                        <th class="px-4 py-2 text-center border">Reason</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaveRequests as $leaveRequest)
                        <tr class="border">
                            <td class="px-4 py-2 text-center border">{{ $leaveRequest->leave_type }}</td>
                            <td class="px-4 py-2 text-center border">{{ $leaveRequest->start_date }}</td>
                            <td class="px-4 py-2 text-center border">{{ $leaveRequest->end_date }}</td>
                            <td class="px-4 py-2 text-center border">{{ $leaveRequest->number_of_days }}</td>
                            <td class="px-4 py-2 text-center border">
                                @if($leaveRequest->leave_type === 'sick')
                                    @if(is_array($leaveRequest->reason))
                                        {{ implode(', ',  $leaveRequest->reason) }}
                                    @else
                                        {{ $leaveRequest->reason }}
                                    @endif
                                @else
                                    {{ $leaveRequest->other_reason }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-4 text-center text-gray-500">No leave requests found for this user.</p>
        @endif
    </div>

    <style>
        /* Add this style in the head or in an external CSS file */
        .logo {
            max-width: 20%; /* Ensure the logo doesn't exceed its natural size */
        }
    </style>
</body>

</html>
