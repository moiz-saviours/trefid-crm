<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AssignTeamMember;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamMemberController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $assign_teams = $user->teams()->with('users')->get();
        $teams = Team::with('users')->whereIn('team_key', $assign_teams->pluck('team_key'))->get();
        return view('team-members.index', compact('teams'));

    }
}
