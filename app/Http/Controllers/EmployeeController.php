<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

class EmployeeController extends Controller
{
    public function showEmployeeDepartmentUsers(Request $request)
{
    $departments = Department::all();
    $selectedDepartment = null;
    $selectedDepartmentId = $request->input('department_id');
    $selectedGender = $request->input('gender');


    // Check if the logged-in user is an admin
    if (auth()->user()->role === 'admin') {
        $query = User::with('department')->where('role', 'employee');
    } else {
        // If not an admin, check if the user is a supervisor
        if (auth()->user()->role === 'supervisor') {
            $departmentId = auth()->user()->department_id;
            $selectedDepartment = Department::find($departmentId);

            $query = User::with('department')
                ->where('department_id', $departmentId)
                ->where('role', 'employee');
        } else {
            // For other roles, return an error or redirect as needed
            abort(403, 'Unauthorized action.');
        }
    }

    // Filter by department if selected
    if ($selectedDepartmentId) {
        $query->where('department_id', $selectedDepartmentId);
        $selectedDepartment = Department::find($selectedDepartmentId); // Retrieve the selected department
    }

    // Filter by gender if selected
    if ($selectedGender) {
        $query->where('gender', $selectedGender);
    }

    $users = $query->paginate(10); // You can adjust the number of items per page

    // Append additional query parameters to pagination links
    $users->appends([
        'department_id' => $selectedDepartmentId,
        'gender' => $selectedGender,
    ]);

    return view('employee-users.index', compact('users', 'departments', 'selectedDepartment'));
}




    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Check if the logged-in user is either an admin or a supervisor
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'supervisor') {
            // If the user is an admin or supervisor, delete the user
            $user->delete();
            return redirect()->route('employee-users.index')->with('success', 'User deleted successfully');
        }

        // If not an admin or supervisor, redirect with an error message
        return redirect()->route('employee-users.index')->with('error', 'Permission denied. You cannot delete this user.');
    }



}
