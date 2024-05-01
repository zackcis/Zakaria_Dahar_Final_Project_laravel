<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectMemberController extends Controller
{
    public function joinProjectByToken($token)
    {
        $invitation = Invitation::where('token', $token)->first();
        if (!$invitation) {
            abort(404); 
        }
        $invitation->project->users()->attach(Auth::id());
        $invitation->delete();
        return redirect()->route('home')->with('success', 'You have successfully joined the project.');
    }
}
