<?php

// app/Http/Controllers/ChildController.php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Assuming you're using authentication
        $children = $user->children;

        return view('additional_fields', compact('children', 'user'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'user_id' => 'required|exists:users,id', // Ensure the user exists
        ]);

        $child = Child::create($data);

        return response()->json(['success' => true, 'message' => 'Child added successfully', 'child' => $child]);
    }

    public function edit(Child $child)
    {
        return view('children.edit', compact('child'));
    }

    public function update(Request $request, Child $child)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $child->update($data);

        return redirect()->route('additional_fields');
    }

    public function destroy($id)
{
    // Find and delete the child
    $child = Child::find($id);
    if ($child) {
        $child->delete();
        return redirect()->back()->with('success', 'Child deleted successfully.');
    }
    return redirect()->back()->with('error', 'Child not found.');
}

}
