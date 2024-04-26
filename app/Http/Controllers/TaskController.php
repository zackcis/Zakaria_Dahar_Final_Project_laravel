<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //
    public function index()
    {
        $projects = project::all(); // Retrieve all projects for the project dropdown
        return view('tasks', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'start_date' => ['required', 'date'], // Ensure start_date is provided and is a valid date
            'deadline' => ['required', 'date', 'after_or_equal:start_date'], // Ensure deadline is provided, is a valid date, and is after or equal to start_date
            'project_id' => ['nullable', 'exists:projects,id'], // Ensure project_id exists in the projects table (if provided)
        ]);
        // dd('ff');
        
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->start_date = $request->start_date;
        $task->deadline = $request->deadline;

        
        if ($request->has('project_id')) {
            $task->project_id = $request->project_id;
        }

        $task->user_id = Auth::id();
        $task->save();

        return redirect()->back();
    }
}
