<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Illuminate\Support\Facades\Session;
use App\Notifications\LeaveRequestAccepted;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LeaveRequestRejected;
use App\Notifications\LeaveRequestCreated;
use App\Notifications\SupervisorApprovedLeaveRequest;
use App\Notifications\LeaveRequestEndedNotification;
use PDF; // Add this import for PDF generation
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function show()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Load any additional user-related data if needed
        // Example: $user->load('profile');

        // Pass user data to the dashboard view
        $departments = Department::all();
        return view('profile-show', compact('user', 'departments'));
    }

    public function updateProfilePicture(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new profile picture
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }



        $user->save(); // Save the user model

        return redirect()->route('profile.show')->with('success', 'Profile picture updated successfully.');
    }

    public function update(Request $request, User $user)
    {
        // Validate the form data
        $request->validate([
            'surname' => ['nullable', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'department' => ['nullable', 'string', 'max:255'],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Get the authenticated user
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists.
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new profile picture.
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath; // Update the user's profile_picture field.
        }

        if ($request->has('department')) {
            $department = Department::where('name', $request->input('department'))->first();
            $user->department()->associate($department);
        }

        // Update other user information.
        $user->update($request->except('profile_picture'));

        return redirect()->route('additional_fields')->with('success', 'Profile information updated successfully.');
    }

    public function showAdditionalFields()
    {
        $user = auth()->user(); // Get the authenticated user.
        return view('additional_fields', compact('user'));
    }

    public function updateAdditionalFields(Request $request)
    {
    $user = auth()->user();

    $validatedData = $request->validate([
        'residential_house_no' => 'nullable|string|max:255',
        'residential_street' => 'nullable|string|max:255',
        'residential_subdivision' => 'nullable|string|max:255',
        'residential_barangay' => 'nullable|string|max:255',
        'residential_city' => 'nullable|string|max:255',
        'residential_province' => 'nullable|string|max:255',
        'residential_zip_code' => 'nullable|string|max:255',
        'permanent_house_no' => 'nullable|string|max:255',
        'permanent_street' => 'nullable|string|max:255',
        'permanent_subdivision' => 'nullable|string|max:255',
        'permanent_barangay' => 'nullable|string|max:255',
        'permanent_city' => 'nullable|string|max:255',
        'permanent_province' => 'nullable|string|max:255',
        'permanent_zip_code' => 'nullable|string|max:255',
        'telephone_number' => 'nullable|string|max:255',
        'mobile_number' => 'nullable|string|max:255',
        'messenger_account' => 'nullable|string|max:255',
        'spouse_surname' => 'nullable|string|max:255',
        'spouse_first_name' => 'nullable|string|max:255',
        'spouse_name_extension' => 'nullable|string|max:10',
        'spouse_middle_name' => 'nullable|string|max:255',
        'spouse_occupation' => 'nullable|string|max:255',
        'spouse_employer' => 'nullable|string|max:255',
        'spouse_business_address' => 'nullable|string|max:255',
        'spouse_telephone' => 'nullable|string|max:20',
        'father_surname' => 'nullable|string|max:255',
        'father_first_name' => 'nullable|string|max:255',
        'father_name_extension' => 'nullable|string|max:10',
        'father_middle_name' => 'nullable|string|max:255',
        'mother_maiden_surname' => 'nullable|string|max:255',
        'mother_first_name' => 'nullable|string|max:255',
        'mother_middle_name' => 'nullable|string|max:255',
    ]);

    $user->update($validatedData);

    return redirect()->route('educational_background')->with('success', 'Additional fields updated successfully');
}

public function generateReport(User $user)
{
    // Fetch leave requests for the selected user using the relationship
    $leaveRequests = $user->leaveRequests;

    // Generate the report content using Laravel PDF
    $pdf = PDF::loadView('reports.user_report', compact('user', 'leaveRequests'));

    // Save the generated PDF to storage
    $pdfPath = "reports/user_report_{$user->id}.pdf";
    Storage::disk('public')->put($pdfPath, $pdf->output());

    // Provide a link to download the generated report
    return response()->download(storage_path("app/public/{$pdfPath}"))->deleteFileAfterSend(true);
}



}
