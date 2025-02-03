<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function index()
    {
        $all_leads = Lead::whereIn('brand_key', Auth::user()->teams()->with('brands')->get()->pluck('brands.*.brand_key')->flatten())->with(['brand', 'customer_contact', 'leadStatus'])->get();
        //$leads = Lead::all();
        $lead_statuses = LeadStatus::where('status', 1)->get();
        return view('user.leads.index', compact('all_leads', 'lead_statuses'));
    }
    /**
     * Change the specified resource status from storage.
     */
    public function change_lead_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leadStatusId' => 'required|integer|exists:lead_statuses,id',
            'id' => 'required|integer|exists:leads,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            $lead = Lead::findOrFail($request->input('id'));
            $lead->update([
                'lead_status_id' => $request->input('leadStatusId')  // Update the lead's status
            ]);
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }

}

