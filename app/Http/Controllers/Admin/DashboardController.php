<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index_1()
    {
        return view('admin.dashboard.index-1');
    }
    public function index_2()
    {
        return view('admin.dashboard.index-2');
    }
}
