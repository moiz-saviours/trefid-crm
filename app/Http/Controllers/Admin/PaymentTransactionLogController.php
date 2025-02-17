<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransactionLog;
use Illuminate\Http\Request;

class PaymentTransactionLogController extends Controller
{
    public function getLogs(Request $request)
    {
        try {
            $logs = PaymentTransactionLog::where('invoice_key', $request->input('invoice_key'))
                ->orderBy('created_at', 'desc')
                ->get(['gateway', 'transaction_id','last_4', 'amount', 'status', 'response_message', 'error_message', 'created_at']);
            return response()->json(['status' => 'success', 'logs' => $logs]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
