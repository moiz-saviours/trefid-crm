<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $assign_teams = $user->teams()->with('brands')->get();
        $teams = Team::with('brands')->whereIn('team_key', $assign_teams->pluck('team_key'))->get();
        return view('user.brands.index', compact('teams'));
    }
}
