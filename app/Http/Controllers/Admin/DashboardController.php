<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ClientContact;
use App\Models\CustomerContact;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct()
    {
        $activeTime = Carbon::now()->subMinutes(5);
        view()->share('active_users', User::where('last_seen', '>=', $activeTime)->get());
        view()->share('active_admins', Admin::where('last_seen', '>=', $activeTime)->get());
        view()->share('fresh_invoices', Invoice::where('type', 0)->get());
        view()->share('upsale_invoices', Invoice::where('type', 1)->get());
//        view()->share('total_customers', CustomerContact::where('status', 1)->get());
//        view()->share('total_clients', ClientContact::where('status', 1)->get());
    }

    public function index_1()
    {

        return view('admin.dashboard.index-1');
    }

    public function index_2()
    {
        return view('admin.dashboard.index-2');
    }

    public function index_2_update_stats()
    {
        try {
            $totalSales = Invoice::where('status', Invoice::STATUS_PAID)->sum('total_amount');
            $refunded = Invoice::where('status', Invoice::STATUS_REFUNDED)->sum('total_amount');
            $chargeBack = Invoice::where('status', Invoice::STATUS_CHARGEBACK)->sum('total_amount');
            $totalSalesFormatted = '$' . number_format($totalSales);
            $refundedFormatted = '$' . number_format($refunded);
            $chargeBackFormatted = '$' . number_format($chargeBack);
            $netSales = $totalSales - ($refunded + $chargeBack);
            $netSalesFormatted = '$' . number_format($netSales, 2);
            if ($totalSales > 0) {
                $chargeBackRatio = (($chargeBack / $totalSales) * 100) . ' %';
            } else {
                $chargeBackRatio = '0 %';
            }
            return response()->json(['success' => true, 'message' => 'Fetched total sales successfully.', 'total_sales' => $totalSalesFormatted, 'net_sales' => $netSalesFormatted, 'refunded' => $refundedFormatted, 'charge_back' => $chargeBackFormatted, 'charge_back_ratio' => $chargeBackRatio]);
        } catch (\Exception $e) {
            Log::error("Error fetching total sales: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while fetching total sales.', 'error' => $e->getMessage()], 500);
        }
    }
}
