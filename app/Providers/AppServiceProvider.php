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
        $tasksByProject = [];
        foreach ($projects as $project) {
            $tasks = Task::where('project_id', $project->id)->get();
            $tasksByProject[$project->id] = $tasks;
        }
        view()->share([
            'projects' => $projects,
            'users' => $users,
            'ownProjects' => $ownProjects,
            'tasksByProject' => $tasksByProject,
            'tasks' => $tasks
        ]);
    }
}
