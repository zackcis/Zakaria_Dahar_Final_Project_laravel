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
        //
        // $myProjects = Project::whereHas('members', function ($query) {
        //     $query->where('users.id', auth()->id());
        // })->get();
        
        $ownprojects = Project::where('created_by', Auth::id())->get();
        $projects = project::all();
        $users = User::all();
        $tasks = Task::all();
        
        view()->share([
            'projects'=> $projects,
            'users'=> $users,
            'tasks'=> $tasks,
            'ownprojects'=> $ownprojects,
            // 'myProjects'=> $myProjects,
        ]);
    }
}
