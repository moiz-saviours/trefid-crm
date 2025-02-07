<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CheckoutController extends ApiInvoiceController
{
    public function index()
    {
        $invoiceID = request('InvoiceID');
        $response = $this->fetch_invoice($invoiceID);
        $invoiceDetails = $response->getData(true);
        return view('checkout', compact('invoiceDetails'));
    }
}
