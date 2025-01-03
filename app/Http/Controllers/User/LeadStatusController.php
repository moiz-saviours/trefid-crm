<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LeadStatus;

class LeadStatusController extends Controller
{
    public function index()
    {
        $leadStatuses = LeadStatus::where('status', 1)->get();
        return view('user.lead-status.index', compact('leadStatuses'));
    }
}
