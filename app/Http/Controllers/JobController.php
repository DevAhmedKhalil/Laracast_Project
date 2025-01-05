<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(5);

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // Create job
        Job::create([
            'title' => $validatedData['title'],
            'salary' => $validatedData['salary'],
            'employer_id' => 1,  // Assuming employer_id is fixed for now
        ]);

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        // 1- To edit job -> you need to sign in first
        if (Auth::guest()) {
            return redirect('/login');
        }

        // 2- You must be responsible for this job
        if ($job->employer->user->isNot(Auth::user())) {
            abort(403); // forbidden
        }

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        // Validation
        $validatedData = $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // Update job
        $job->update([
            'title' => $validatedData['title'],
            'salary' => $validatedData['salary'],
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // Delete the job
        $job->delete();

        return redirect('/jobs');
    }
}
