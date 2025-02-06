<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $user = auth()->user();
        $AllInvoices = $user->invoices()->whereMonth('created_at', Carbon::now()->month);
        $userTarget = $user->target;
        $totalSalesAmount = $AllInvoices->whereHas('payment', fn($query) => $query->where('status', 1))->with('payment')->get()->sum(fn($invoice) => $invoice->payment->amount ?? 0);
        $targetAchieved = $userTarget && $totalSalesAmount ? ($totalSalesAmount / $userTarget) * 100 : 0;
        $freshInvoices = $AllInvoices->where('type', 0)->whereHas('payment', fn($query) => $query->where('status', 1))->with('payment')->get()->sum(fn($invoice) => $invoice->payment->amount ?? 0);
        $upsaleInvoices = $AllInvoices->where('type', 1)->whereHas('payment', fn($query) => $query->where('status', 1))->with('payment')->get()->sum(fn($invoice) => $invoice->payment->amount ?? 0);
        $freshInvoiceProgress = ($freshInvoices + $upsaleInvoices) > 0 ? ($freshInvoices / ($freshInvoices + $upsaleInvoices)) * 100 : 0;
        $upsaleInvoiceProgress = ($freshInvoices + $upsaleInvoices) > 0 ? ($upsaleInvoices / ($freshInvoices + $upsaleInvoices)) * 100 : 0;
        view()->share(compact('totalSalesAmount','userTarget', 'freshInvoices', 'upsaleInvoices', 'targetAchieved', 'freshInvoiceProgress', 'upsaleInvoiceProgress'));
    }

    public function index()
    {
        return view('user.dashboard');
    }
}
