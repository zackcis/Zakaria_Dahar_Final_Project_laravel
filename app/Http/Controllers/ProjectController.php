<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectInvitation;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'created_by' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'deadline' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $project = new Project();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->created_by = $request->created_by;
        $project->start_date = $request->start_date;
        $project->deadline = $request->deadline;

        $project->user_id = Auth::id();

        $project->save();

        return redirect()->back()->with('success', 'Project created successfully.');
    }

    public function sendInvitations(Request $request, $projectId)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $project = Project::findOrFail($projectId);

        Mail::to($validatedData['email'])->send(new ProjectInvitation($project));

        return redirect()->back();
    }
    public function joinProject($projectId)
{
    $project = Project::findOrFail($projectId);

    $userId = Auth::id();

    $project->members()->attach($userId, ['role' => 'member']);

    $project->save();

    return redirect()->route('dashboard', $projectId)->with('success', 'You have successfully joined the project.');
}

}
