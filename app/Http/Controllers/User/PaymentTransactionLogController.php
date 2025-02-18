<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentTransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentTransactionLogController extends Controller
{
    public function getLogs(Request $request)
    {
        try {

            $invoiceKey = $request->input('invoice_key');
            $invoice = Invoice::where('invoice_key', $invoiceKey)
                ->whereIn('brand_key', Auth::user()->teams()->with(['brands' => function ($query) {
                    $query->where('status', 1);
                }])->get()->pluck('brands.*.brand_key')->flatten()->unique())
                ->whereIn('team_key', Auth::user()->teams()->pluck('teams.team_key')->flatten()->unique())
                ->first();
            if (!$invoice) {
                return response()->json(['status' => 'error', 'message' => 'Invoice not found'], 404);
            }
            $userBrandKeys = Auth::user()->teams()->with('brands')->get()
                ->pluck('brands.*.brand_key')
                ->flatten()
                ->unique()
                ->toArray();
            if (!in_array($invoice->brand_key, $userBrandKeys)) {
                return response()->json(['status' => 'error', 'message' => 'Unauthorized access'], 403);
            }
            $logs = PaymentTransactionLog::where('invoice_key', $invoiceKey)
                ->orderBy('created_at', 'desc')
                ->get(['gateway', 'transaction_id', 'last_4', 'amount', 'status', 'response_message', 'error_message', 'created_at']);
            return response()->json(['status' => 'success', 'logs' => $logs]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
