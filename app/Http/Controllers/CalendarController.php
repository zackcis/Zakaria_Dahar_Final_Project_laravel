<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    //
    public function index()
    {        
        $independentTasks = Task::all();
        $user = Auth::user();
        $projectsCalendar = $user->projects;
        return view('calendar',compact('projectsCalendar','independentTasks'));
    }
}
