<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(5);
        return view('jobs.index', compact('jobs'));
    }

    public function createJob()
    {
        // Ensure the user is an employer before allowing them to create a job
        if (!Auth::user()->employer) {
            return redirect('/employer/register')->with('error', 'You need to create an employer profile first.');
        }

        // Show the job creation form
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

        // Ensure the authenticated user has an employer profile
        if (!auth()->user()->employer) {
            return redirect('/jobs')->with('error', 'You must be an employer to create a job.');
        }

        // Create job
        $job = Job::create([
            'title' => $validatedData['title'],
            'salary' => $validatedData['salary'],
            'employer_id' => auth()->user()->employer->id,
        ]);

        // Send email notification (optional)
        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect('/jobs')->with('success', 'Job created successfully.');
    }

    public function edit(Job $job)
    {
        // Authorize the edit action
        $this->authorize('update', $job);

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        // Authorize the update action
        $this->authorize('update', $job);

        // Validation
        $validatedData = $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // Update job
        $job->update($validatedData);

        return redirect()->route('jobs.show', $job)->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        // Authorize the delete action
        $this->authorize('delete', $job);

        // Delete the job
        $job->delete();

        return redirect('/jobs')->with('success', 'Job deleted successfully.');
    }
}
