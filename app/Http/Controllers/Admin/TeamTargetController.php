<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Team;
use App\Models\TeamTarget;
use Illuminate\Http\Request;

class TeamTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();
        return view('admin.team-targets.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamTarget $teamTarget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamTarget $teamTarget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $team_key, $month, $year)
    {
        $target = TeamTarget::updateOrCreate(
            ['team_key' => $team_key, 'month' => $month, 'year' => $year],
            ['target_amount' => $request->target_amount]
        );

        return response()->json(['success' => true,'target' => $target]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamTarget $teamTarget)
    {
        //
    }

    /**
     * Display a listing of the resource logs.
     */
    public function log_index()
    {
        $logs = ActivityLog::forModel(TeamTarget::class)->latest()->paginate(10);
        return view('admin.team-targets.logs-index', compact('logs'));
    }
}
