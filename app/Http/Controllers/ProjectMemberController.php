<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectMemberController extends Controller
{
    public function joinProjectByToken($token)
    {
        // Find the invitation by the token
        $invitation = Invitation::where('token', $token)->first();

        // Check if invitation exists
        if (!$invitation) {
            abort(404); // Or handle the case where the token is not valid
        }

        // Associate the user with the project
        $invitation->project->users()->attach(Auth::id());

        // Delete the invitation to prevent multiple uses
        $invitation->delete();

        // Redirect the user to a success page or any other route
        return redirect()->route('home')->with('success', 'You have successfully joined the project.');
    }
}

