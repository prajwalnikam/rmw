<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\JobRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->with('jobRequirements')->get();
        return view('frontend.user.client.project.project-requirement', compact('projects'));
    }

    public function create()
    {
        return view('frontend.client.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date|after_or_equal:today',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'job_titles.*' => 'required|string|max:255',
            'job_descriptions.*' => 'nullable|string',
            'vacancies.*' => 'required|integer|min:1',
            'salaries.*' => 'nullable|numeric|min:0',
        ]);

        $project = new Project([
            'title' => $request->title,
            'description' => $request->description,
            'budget' => $request->budget,
            'deadline' => $request->deadline,
            'user_id' => Auth::id(),
        ]);
        $project->save();

        if ($request->has('job_titles')) {
            foreach ($request->job_titles as $index => $jobTitle) {
                JobRequirement::create([
                    'project_id' => $project->id,
                    'job_title' => $jobTitle,
                    'job_description' => $request->job_descriptions[$index] ?? null,
                    'vacancies' => $request->vacancies[$index],
                    'salary' => $request->salaries[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('frontend.user.client.job.my-job.all-jobs')->with('success', 'Project and job requirements created successfully!');
    }
}
