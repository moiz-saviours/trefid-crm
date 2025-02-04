<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ClientContact;
use App\Models\CustomerContact;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\LeadStatus;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct()
    {
        $activeTime = Carbon::now()->subMinutes(5);
        $totalAdmins = Admin::count();
        $activeAdmins = Admin::where('last_seen', '>=', $activeTime)->count();
        $totalUsers = User::count();
        $activeUsers = User::where('last_seen', '>=', $activeTime)->count();
        $freshInvoices = Invoice::where('type', 0)->count();
        $upsaleInvoices = Invoice::where('type', 1)->count();
        $adminProgress = $totalAdmins > 0 ? ($activeAdmins / $totalAdmins) * 100 : 0;
        $userProgress = $totalAdmins > 0 ? ($activeUsers / $totalUsers) * 100 : 0;
        $invoiceProgress = ($freshInvoices + $upsaleInvoices) > 0 ? ($freshInvoices / ($freshInvoices + $upsaleInvoices)) * 100 : 0;
        $upsaleProgress = ($freshInvoices + $upsaleInvoices) > 0 ? ($upsaleInvoices / ($freshInvoices + $upsaleInvoices)) * 100 : 0;
        view()->share(compact('activeUsers', 'totalUsers', 'userProgress', 'activeAdmins', 'totalAdmins', 'adminProgress', 'freshInvoices', 'upsaleInvoices', 'invoiceProgress', 'upsaleProgress'));
    }

    public function index_1()
    {
        $totalInvoices = Invoice::count();
        $invoiceCounts = Invoice::selectRaw("
        COUNT(CASE WHEN status = 0 THEN 1 END) as due_invoices,
        COUNT(CASE WHEN status = 1 THEN 1 END) as paid_invoices,
        COUNT(CASE WHEN status = 2 THEN 1 END) as refund_invoices,
        COUNT(CASE WHEN status = 3 THEN 1 END) as chargeback_invoices
    ")->first();
        $invoicesProgress = $totalInvoices > 0 ? [
            'due' => ($invoiceCounts->due_invoices / $totalInvoices) * 100,
            'paid' => ($invoiceCounts->paid_invoices / $totalInvoices) * 100,
            'refund' => ($invoiceCounts->refund_invoices / $totalInvoices) * 100,
            'chargeback' => ($invoiceCounts->chargeback_invoices / $totalInvoices) * 100
        ] : ['due' => 0, 'paid' => 0, 'refund' => 0, 'chargeback' => 0];
        $recentPayments = Payment::latest()->limit(5)->get();
        $leadStatuses = LeadStatus::all();
        $leadCounts = [];
        foreach ($leadStatuses as $status) {
            $leadCounts[$status->name] = Lead::where('lead_status_id', $status->id)->count();
        }


        $dailyPayments = [];
        $dailyLabels = [];
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        for ($day = 1; $day <= Carbon::now()->daysInMonth; $day++) {
            $totalPayments = Payment::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->whereDay('created_at', $day)
                ->sum('amount');
            $dailyPayments[] = $totalPayments;
            $dailyLabels[] = Carbon::createFromDate($currentYear, $currentMonth, $day)->format('d');
        }

        $annualPayments = [];
        $years = range(Carbon::now()->subYears(10)->year, Carbon::now()->year + 1);
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach ($years as $year) {
            $monthlyPayments = [];
            foreach ($months as $index => $month) {
                $totalPayments = Payment::whereYear('created_at', $year)
                    ->whereMonth('created_at', $index + 1)
                    ->sum('amount');
                $monthlyPayments[] = $totalPayments;
            }
            $annualPayments[] = $monthlyPayments;
        }



        return view('admin.dashboard.index-1', [
            'totalInvoices' => $totalInvoices,
            'dueInvoices' => $invoiceCounts->due_invoices,
            'paidInvoices' => $invoiceCounts->paid_invoices,
            'refundInvoices' => $invoiceCounts->refund_invoices,
            'chargebackInvoices' => $invoiceCounts->chargeback_invoices,
            'invoicesProgress' => $invoicesProgress,
            'recentPayments' => $recentPayments,
            'leadStatuses' => $leadStatuses,
            'leadCounts' => $leadCounts,
            'dailyPayments' => $dailyPayments,
            'dailyLabels' => $dailyLabels,
            'annualPayments' => $annualPayments,
            'months' => $months,
        ]);
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
