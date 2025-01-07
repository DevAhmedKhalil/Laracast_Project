<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function create()
    {
        return view('employer.create');
    }

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => ['required', 'min:3'],
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create the employer profile
        Employer::create([
            'user_id' => $user->id,
            'name' => $validatedData['name'],
        ]);

        // Redirect to the job creation page
        return redirect()->route('jobs.create')->with('success', 'Employer profile created successfully. You can now create a job.');
    }
}
