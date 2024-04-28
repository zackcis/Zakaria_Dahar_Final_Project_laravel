<?php

namespace App\Providers;

use App\Models\project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $users = User::all();
        $projects = Project::all();
        $user = Auth::id();
        $ownProjects = Project::where('created_by', $user)->get();
        $tasks = Task::all();
        // Define an array to hold tasks related to each project
        $tasksByProject = [];

        // Retrieve tasks related to each project and store them in the $tasksByProject array
        foreach ($projects as $project) {
            $tasks = Task::where('project_id', $project->id)->get();
            $tasksByProject[$project->id] = $tasks;
        }

        // Share the data with views
        view()->share([
            'projects' => $projects,
            'users' => $users,
            'ownProjects' => $ownProjects,
            'tasksByProject' => $tasksByProject,
            'tasks' => $tasks
        ]);
    }
}
