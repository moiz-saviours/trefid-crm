<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class LeadStatusController extends Controller
{
    public function index()
    {
        return view('user.lead-status.index');
    }
}
