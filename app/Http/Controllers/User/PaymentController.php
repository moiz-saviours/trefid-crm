<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $all_payments = Payment::whereIn('brand_key', Auth::user()->teams()->with('brands')->get()->pluck('brands.*.brand_key')->flatten())->with(['customer_contact'])->get();
        $my_payments = $all_payments->filter(function ($payment) {
            return $payment->agent_id === Auth::id();
        });

        return view('user.payment.index', compact('all_payments', 'my_payments'));
    }
}
