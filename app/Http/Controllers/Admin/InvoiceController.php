<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the invoices.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new invoice.
     */
    public function create()
    {
        return view('admin.invoices.create');
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_key' => 'nullable|integer',
            'team_key' => 'nullable|integer',
            'agent_id' => 'nullable|integer',
            'invoice_key' => 'nullable|integer',
            'invoice_number' => 'required|string|unique:invoices|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'status' => 'nullable|integer|in:0,1',
        ]);

        Invoice::create($request->only(['brand_key', 'team_key', 'agent_id', 'invoice_key', 'invoice_number', 'description', 'amount', 'status']));

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified invoice.
     */
    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified invoice.
     */
    public function edit(Invoice $invoice)
    {
        return view('admin.invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'brand_key' => 'nullable|integer',
            'team_key' => 'nullable|integer',
            'agent_id' => 'nullable|integer',
            'invoice_key' => 'nullable|integer',
            'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number,' . $invoice->id,
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'status' => 'nullable|integer|in:0,1',
        ]);

        $invoice->update($request->only(['brand_key', 'team_key', 'agent_id', 'invoice_key', 'invoice_number', 'description', 'amount', 'status']));

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified invoice from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice deleted successfully.');
    }
}
