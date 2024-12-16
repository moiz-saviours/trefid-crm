<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class LeadsController extends Controller
{
    public function index()
    {
        return view('leads.index');
    }
}
