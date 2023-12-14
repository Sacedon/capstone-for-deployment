<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EducationalBackgroundController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('educational_background', compact('user'));
    }

    public function submit(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
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

            'signature' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        if ($request->has('signature')) {
            $signatureData = $validatedData['signature'];
            $signatureFile = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));

            // Save the signature image
            $signatureFileName = 'signature_' . Str::random(10) . '.png';
            Storage::disk('public')->put('signatures/' . $signatureFileName, $signatureFile);

            // Update the user model with the signature file name
            $validatedData['signature'] = $signatureFileName;
        }

        $user->update($validatedData);

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('dashboard')->with('success', 'Personal Information updated successfully!');
    }
}
