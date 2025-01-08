<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $all_invoices = Invoice::whereIn('brand_key', Auth::user()->teams()->with('brands')->get()->pluck('brands.*.brand_key')->flatten()->unique())->with(['brand', 'customer_contact'])->get();
        $my_invoices = $all_invoices->filter(function ($invoice) {
            return $invoice->agent_type === get_class(Auth::user()) && $invoice->agent_id === Auth::id();
        });
        return view('user.invoices.index', compact('all_invoices', 'my_invoices'));
    }
}
