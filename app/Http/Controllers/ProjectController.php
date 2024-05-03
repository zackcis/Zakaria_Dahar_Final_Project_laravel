<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectInvitation;
use App\Models\ProjectFile;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.projects');
    }
    public function show($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('projects.project_details', compact('project'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'created_by' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'deadline' => ['required', 'date', 'after_or_equal:start_date'],
            'project_picture' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Max file size: 2MB

        ]);

        $project = new Project();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->created_by = $request->created_by;
        $project->start_date = $request->start_date;
        $project->deadline = $request->deadline;
        if ($request->hasFile('project_picture')) {
            $projectPicturePath = $request->file('project_picture')->store('project_pictures', 'public');
            $project->project_picture = $projectPicturePath;
        }
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

public function storeFile(Request $request, $projectId)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:jpeg,png,jpg,pdf,doc,docx'],
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('project_files');

        ProjectFile::create([
            'project_id' => $projectId,
            'user_id' => Auth::id(),
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_type' => $file->getClientOriginalExtension(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

}
