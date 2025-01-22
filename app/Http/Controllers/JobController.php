<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $title = 'Available Jobs';
        $jobs = Job::paginate(9);
        return view('jobs.index', compact('title', 'jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'prefecture' => 'required|string',
            'postal_code' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        //Assign user id
        $validatedData['user_id'] = auth()->user()->id;

        //check for image
        if ($request->hasFile('company_logo')) {
            //store file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            //add path to validated data
            $validatedData['company_logo'] = $path;
        }

        //submit to database
        Job::create($validatedData);

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        //
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): View
    {
        // Check if the user is authorized
        $this->authorize('update', $job);

        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        // Check if the user is authorized
        $this->authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'prefecture' => 'required|string',
            'postal_code' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        //check for image
        if ($request->hasFile('company_logo')) {
            //delete old logo
            Storage::delete('public/logos/' . basename($job->company_logo));
            //store file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            //add path to validated data
            $validatedData['company_logo'] = $path;
        }

        //submit to database
        $job->update($validatedData);

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job listing created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job): RedirectResponse
    {
        // Check if the user is authorized
        $this->authorize('delete', $job);

        // If there is a company logo, delete it from storage
        if ($job->company_logo) {
            Storage::delete('public/logos/' . $job->company_logo);
        }
        // Delete the job
        $job->delete();

        if (request()->query('from') === 'dashboard') {
            return redirect()
                ->route('dashboard.index')
                ->with('success', 'Job listing deleted successfully!');
        }
        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job listing deleted successfully!');
    }
}
