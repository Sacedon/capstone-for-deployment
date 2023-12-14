<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Models\Department;

class LeaveBalanceController extends Controller
{
    public function showForm()
{
    $users = User::all();
    $departments = Department::all(); // Replace Department with your actual department model
    return view('leave_balance.add', compact('users', 'departments'));
}

    public function addDays(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'days_to_add' => 'required|integer|min:1',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $user->update([
            'total_leave_days' => $user->total_leave_days + $request->input('days_to_add'),
        ]);

        return redirect()->back()->with('success', 'Leave days added successfully.');
    }

    public function addLeaveDays(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'leave_type' => 'required|string|max:255',
            'days_to_add' => 'required|integer|min:1',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $leaveType = $request->input('leave_type');

        // Validate leave type or perform specific logic if needed

        // Ensure the attribute is fillable in the User model
        $fillableAttribute = 'total_' . $leaveType . '_leave_days';
        if (!in_array($fillableAttribute, $user->getFillable())) {
            return redirect()->back()->with('error', 'Invalid leave type.');
        }

        $user->update([
            $fillableAttribute => $user->{$fillableAttribute} + $request->input('days_to_add'),
        ]);

        return redirect()->back()->with('success', 'Leave days added successfully.');
    }
}
