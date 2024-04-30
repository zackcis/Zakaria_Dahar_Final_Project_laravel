<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $projectsCalendar = $user->projects;
        return view('calendar',compact('projectsCalendar'));
    }
}
