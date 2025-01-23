<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teams = Team::where('lead_id', $user->id)->with('users')->get();
        return view('teams.index',compact('teams'));
    }
}
