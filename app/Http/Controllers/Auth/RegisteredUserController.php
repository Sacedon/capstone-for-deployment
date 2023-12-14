<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Log;
use App\Models\Department;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{

    public function showLogs(Request $request)
{
    $date = $request->input('date');
    $firstName = $request->input('first_name');

    $query = Log::query();

    if ($date) {
        $query->where(function ($query) use ($date) {
            $query->whereDate('login_time', $date)
                  ->orWhereDate('logout_time', $date);
        });
    }

    if ($firstName) {
        $query->whereHas('user', function ($query) use ($firstName) {
            $query->where('first_name', 'like', '%' . $firstName . '%');
        });
    }

    $logs = $query->orderBy('created_at', 'desc')->paginate(5);

    // Append the filter parameters to the pagination links
    $logs->appends(['date' => $date, 'first_name' => $firstName]);

    return view('logs.index', compact('logs'));
}


    /**
     * Display the registration view.
     */
    public function create(): View
    {

        $departments = Department::all();
        $user = new User();
        return view('users.create', compact('departments', 'user'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['nullable', 'string', 'max:255', 'unique:users'],
            'surname' => ['nullable', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|string|in:admin,supervisor,employee',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'department' => ['nullable', 'string', 'max:255'],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'civil_status' => ['nullable', 'string', 'in:single,married,separated,widowed'],
            'height' => ['nullable', 'numeric', 'min:0'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'blood_type' => ['nullable', 'string', 'max:255'],
            'sss_id_no' => ['nullable', 'string', 'max:255'],
            'pag_ibig_id_no' => ['nullable', 'string', 'max:255'],
            'philhealth_no' => ['nullable', 'string', 'max:255'],
            'tin_no' => ['nullable', 'string', 'max:255'],
            'mdc_id' => ['nullable', 'string', 'max:255'],
            'place_of_birth' => ['nullable', 'string', 'max:255'],

        ]);


        $imagePath = $request->hasFile('profile_picture')
            ? $request->file('profile_picture')->store('profile_pictures', 'public')
            : null;

        $user = User::create([
            'username' => $request->username,
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'department_id' => $request->input('department')
            ? Department::where('name', $request->input('department'))->first()->id
            : null,
            'profile_picture' => $imagePath,
            'civil_status' => $request->civil_status,
            'height' => $request->height,
            'weight' => $request->weight,
            'blood_type' => $request->blood_type,
            'sss_id_no' => $request->sss_id_no,
            'pag_ibig_id_no' => $request->pag_ibig_id_no,
            'philhealth_no' => $request->philhealth_no,
            'tin_no' => $request->tin_no,
            'mdc_id' => $request->mdc_id,
            'place_of_birth' => $request->place_of_birth,
        ]);

        event(new Registered($user));



        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function index(Request $request)
{
    $departments = Department::all();
    $search = $request->input('search');
    $selectedDepartmentId = $request->input('department_id');
    $selectedGender = $request->input('gender');

    $users = User::query();

    if ($search) {
        $users->where(function ($query) use ($search) {
            $query->where('surname', 'like', '%' . $search . '%')
                ->orWhere('first_name', 'like', '%' . $search . '%');
        });
    }

    if ($selectedDepartmentId) {
        $users->where('department_id', $selectedDepartmentId);
    }

    if ($selectedGender) {
        $users->where('gender', $selectedGender);
    }

    $users = $users->paginate(5);

    $header = 'Users';

    // Check if no users were found
    if ($users->isEmpty()) {
        return redirect()->route('users.index')->withErrors('No users found for the given search criteria.');
    }

    // Retrieve the selected department (if it exists)
    $selectedDepartment = Department::find($selectedDepartmentId);

    // Pass additional data to the view for pagination links
    $users->appends([
        'search' => $search,
        'department_id' => $selectedDepartmentId,
        'gender' => $selectedGender,
    ]);

    return view('users.index', compact('users', 'header', 'departments', 'selectedDepartment', 'selectedGender'));
}




    public function show(User $user)
        {

            return view('users.show', compact('user'));
        }

    public function edit(User $user)
    {

        $departments = Department::all();
        return view('users.edit', compact('user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        // Validate form data, including profile_picture field.
        $request->validate([
            'surname' => ['nullable', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            // 'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => 'nullable|string|in:admin,employee,supervisor',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'department' => ['nullable', 'string', 'max:255'],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed.
            'civil_status' => ['nullable', 'string', 'in:single,married,separated,widowed'],
            'height' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
            'weight' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
            'blood_type' => ['nullable', 'string', 'max:255'],
            'sss_id_no' => ['nullable', 'string', 'max:255'],
            'pag_ibig_id_no' => ['nullable', 'string', 'max:255'],
            'philhealth_no' => ['nullable', 'string', 'max:255'],
            'tin_no' => ['nullable', 'string', 'max:255'],
            'mdc_id' => ['nullable', 'string', 'max:255'],
            'place_of_birth' => ['nullable', 'string', 'max:255'],
            'residential_house_no' => 'nullable|string|max:255',
            'residential_street' => 'nullable|string|max:255',
            'residential_subdivision' => 'nullable|string|max:255',
            'residential_barangay' => 'nullable|string|max:255',
            'residential_city' => 'nullable|string|max:255',
            'residential_province' => 'nullable|string|max:255',
            'residential_zip_code' => 'nullable|string|max:10',
            'permanent_house_no' => 'nullable|string|max:255',
            'permanent_street' => 'nullable|string|max:255',
            'permanent_subdivision' => 'nullable|string|max:255',
            'permanent_barangay' => 'nullable|string|max:255',
            'permanent_city' => 'nullable|string|max:255',
            'permanent_province' => 'nullable|string|max:255',
            'permanent_zip_code' => 'nullable|string|max:10',
            'telephone_number' => 'nullable|string|max:20',
            'mobile_number' => 'nullable|string|max:20',
            'messenger_account' => 'nullable|string|max:255',
            'elementary_school' => 'nullable|string|max:255',
            'elementary_degree' => 'nullable|string|max:255',
            'elementary_attendance_from' => 'nullable|date',
            'elementary_attendance_to' => 'nullable|date|after:elementary_attendance_from',
            'elementary_highest_level' => 'nullable|string|max:255',
            'elementary_year_graduated' => 'nullable|date',
            'elementary_honors' => 'nullable|string|max:255',

            'secondary_school' => 'nullable|string|max:255',
            'secondary_degree' => 'nullable|string|max:255',
            'secondary_attendance_from' => 'nullable|date',
            'secondary_attendance_to' => 'nullable|date|after:secondary_attendance_from',
            'secondary_highest_level' => 'nullable|string|max:255',
            'secondary_year_graduated' => 'nullable|date',
            'secondary_honors' => 'nullable|string|max:255',

            'vocational_school' => 'nullable|string|max:255',
            'vocational_degree' => 'nullable|string|max:255',
            'vocational_attendance_from' => 'nullable|date',
            'vocational_attendance_to' => 'nullable|date|after:vocational_attendance_from',
            'vocational_highest_level' => 'nullable|string|max:255',
            'vocational_year_graduated' => 'nullable|date',
            'vocational_honors' => 'nullable|string|max:255',

            'college_school' => 'nullable|string|max:255',
            'college_degree' => 'nullable|string|max:255',
            'college_attendance_from' => 'nullable|date',
            'college_attendance_to' => 'nullable|date|after:college_attendance_from',
            'college_highest_level' => 'nullable|string|max:255',
            'college_year_graduated' => 'nullable|date',
            'college_honors' => 'nullable|string|max:255',

            'graduate_school' => 'nullable|string|max:255',
            'graduate_degree' => 'nullable|string|max:255',
            'graduate_attendance_from' => 'nullable|date',
            'graduate_attendance_to' => 'nullable|date|after:graduate_attendance_from',
            'graduate_highest_level' => 'nullable|string|max:255',
            'graduate_year_graduated' => 'nullable|date',
            'graduate_honors' => 'nullable|string|max:255',
            'date' => 'nullable|date',
    ]);

        // Handle profile picture upload.
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
        $user->update(array_merge(
            $request->except('profile_picture', 'department'),
            ['department_id' => Department::where('name', $request->input('department'))->first()->id]
        ));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }



    public function destroy($user_id)
    {


        $user = User::findOrFail($user_id);

        $user->logs()->delete();
        $user->delete();
        return redirect()->route('users.index')->with('error', 'User deleted successfully.');
    }


}
