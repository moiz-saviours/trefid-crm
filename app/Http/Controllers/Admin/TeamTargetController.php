<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamTarget $teamTarget)
    {
        //
    }
}
