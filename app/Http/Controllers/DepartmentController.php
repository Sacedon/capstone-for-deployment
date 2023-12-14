<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Events\UserLog;
use App\Listeners\LogListener;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|unique:departments|max:255',
        ]);

        $department = Department::create([
            'name' => $request->input('name'),
        ]);

        $log_entry = Auth::user()->name . $user->role . " added a department " . $department->name;
        event(new UserLog($log_entry));

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments')->ignore($department->id),
            ],
        ]);

        $department->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
{
    $user = Auth::user();

    if ($department->users()->exists()) {
        return redirect()->route('departments.index')->with('error', 'Cannot delete the department because it is associated with employees.');
    }

    $log_entry = $user->name . $user->role . " deleted a department " . $department->name;
    event(new UserLog($log_entry));

    $department->delete();

    return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
}

}
