<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Invoice;
use App\Models\Team;
use App\Models\User;
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
        $brands = Brand::all();
        $teams = Team::all();
        $users = User::all();
        return view('admin.invoices.create', compact('brands', 'teams', 'users'));
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_key' => 'required|integer',
            'team_key' => 'required|integer',
            'agent_id' => 'required|integer',
            'description' => 'nullable|string|max:500',
            'amount' => 'required|numeric|min:1|max:' . config('invoice.max_amount'),
        ], [
            'brand_key.required' => 'The brand field is required.',
            'brand_key.integer' => 'The brand must be a valid integer.',
            'team_key.required' => 'The team field is required.',
            'team_key.integer' => 'The team must be a valid integer.',
            'agent_id.required' => 'The agent field is required.',
            'agent_id.integer' => 'The agent must be a valid integer.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 500 characters.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 1.00',
            'amount.max' => 'The amount may not be greater than ' . config('invoice.max_amount') . '.',
        ]);

        Invoice::create($request->only(['brand_key', 'team_key', 'agent_id', 'invoice_key', 'invoice_number',
                'description', 'amount']) + [
                'invoice_key' => Invoice::generateInvoiceKey(),
                'invoice_number' => Invoice::generateInvoiceNumber(),
            ]);

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
