<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        return view('teams.index');
    }
}
