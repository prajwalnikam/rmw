<?php
namespace App\Http\Controllers;

use App\Models\JobRequirement;
use App\Models\Project;
use Illuminate\Http\Request;

class JobpostRequirementController extends Controller
{
    public function create(Project $project)
    {
        return view('frontend.client.job-requirements.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        $project->jobRequirements()->create($request->all());

        return redirect()->route('client.projects.index')->with('success', 'Job requirement added successfully!');
    }
}