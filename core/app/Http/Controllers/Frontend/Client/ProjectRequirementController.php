<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ProjectRequirement;

class ProjectRequirementController extends Controller
{
    /**
     * Store a newly created project requirement in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'deadline' => 'required|date|after_or_equal:today',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        // Store the project requirement
        $projectRequirement = new ProjectRequirement();
        $projectRequirement->title = $request->title;
        $projectRequirement->description = $request->description;
        $projectRequirement->budget = $request->budget;
        $projectRequirement->deadline = $request->deadline;

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            $attachments = [];
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('project-requirements', 'public');
            }
            $projectRequirement->attachments = json_encode($attachments);
        }

        $projectRequirement->save();

        return redirect()->back()->with('success', 'Project requirement posted successfully!');
    }
}