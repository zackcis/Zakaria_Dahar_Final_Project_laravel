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
        $projects = project::all();
        $independentTasks = Task::all();
        return view('tasks', compact('projects', 'independentTasks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'start_date' => [
                'required', 'date', 'after_or_equal:today',

                function ($attribute, $value, $fail) use ($request) {

                    $today = now()->format('Y-m-d');
                    if ($value < $today) {
                        $request->session()->flash('error', 'Start date must be today or later.');
                    }
                },
            ],
            'deadline' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) use ($request) {

                    $startDate = $request->input('start_date');
                    $maxDeadline = date('Y-m-d', strtotime($startDate . ' +1 year'));
                    if ($value > $maxDeadline) {
                        return redirect()->back()->with('error', 'Failed to create Task. Please try again.');
                    }
                    if ($value < $startDate) {
                        return redirect()->back()->with('error', 'the deadline date should be after the start');
                    }
                },
            ],
            'project_id' => ['nullable', 'exists:projects,id'],
        ]);
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
        return redirect()->back()->with('success', 'Task created successfully.');;
    }
}
