<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CustomerContact;
use App\Models\Invoice;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the invoices.
     */
    public function index()
    {
        $invoices = Invoice::all();
        $brands = Brand::where('status', 1)->get();
        $teams = Team::where('status', 1)->get();
        $customer_contacts = CustomerContact::where('status', 1)->get();
        $users = User::where('status', 1)->get();
        return view('admin.invoices.index', compact('invoices', 'brands', 'teams', 'customer_contacts', 'users'));
    }

    /**
     * Show the form for creating a new invoice.
     */
    public function create()
    {
        $brands = Cache::remember('brands_list', config('cache.durations.short_lived'), fn() => Brand::where('status', 1)->get());
        $teams = Cache::remember('teams_list', config('cache.durations.short_lived'), fn() => Team::where('status', 1)->get());
        $customer_contacts = CustomerContact::where('status', 1)->get();
        $users = User::where('status', 1)->get();
        return view('admin.invoices.create', compact('brands', 'teams', 'customer_contacts', 'users'));
    }

    /**
     * Store a newly created invoice in storage.
     */
    /**
     * Store a newly created invoice in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'brand_key' => 'required|integer|exists:brands,brand_key',
                'team_key' => 'nullable|integer|exists:teams,team_key',
                'cus_contact_key' => 'required_if:type,1|nullable|integer|exists:customer_contacts,special_key',
                'customer_contact_name' => 'required_if:type,0|nullable|string|max:255',
                'customer_contact_email' => 'required_if:type,0|nullable|email|max:255|unique:customer_contacts,email',
                'customer_contact_phone' => 'required_if:type,0|nullable|string|max:15',
                'agent_id' => 'nullable|integer',
//            'agent_type' => 'required|string|in:admins,users',
                'description' => 'nullable|string|max:500',
                'amount' => 'required|numeric|min:1|max:' . config('invoice.max_amount'),
                'type' => 'required|integer|in:0,1',/** 0 = fresh, 1 = upsale */
            ], [
                'brand_key.required' => 'The brand field is required.',
                'brand_key.integer' => 'The brand must be a valid integer.',
                'brand_key.exists' => 'The selected brand does not exist.',
                'team_key.required' => 'The team field is required.',
                'team_key.integer' => 'The team must be a valid integer.',
                'team_key.exists' => 'The selected team does not exist.',
                'cus_contact_key.integer' => 'The customer contact key must be a valid integer.',
                'cus_contact_key.exists' => 'The selected customer contact does not exist.',
                'cus_contact_key.required_if' => 'The customer contact key field is required when type is upsale.',
                'customer_contact_name.required_if' => 'The customer contact name is required for fresh customers.',
                'customer_contact_name.string' => 'The customer contact name must be a valid string.',
                'customer_contact_name.max' => 'The customer contact name cannot exceed 255 characters.',
                'customer_contact_email.required_if' => 'The customer contact email is required for fresh customers.',
                'customer_contact_email.email' => 'The customer contact email must be a valid email address.',
                'customer_contact_email.max' => 'The customer contact email cannot exceed 255 characters.',
                'customer_contact_email.unique' => 'This email is already in use.',
                'customer_contact_phone.required_if' => 'The customer contact phone number is required for fresh customers.',
                'customer_contact_phone.string' => 'The customer contact phone number must be a valid string.',
                'customer_contact_phone.max' => 'The customer contact phone number cannot exceed 15 characters.',
                'agent_id.required' => 'The agent field is required.',
                'agent_id.integer' => 'The agent must be a valid integer.',
//            'agent_type.required' => 'The agent type field is required.',
//            'agent_type.in' => 'The agent type must be either "admins" or "users".',
                'description.string' => 'The description must be a string.',
                'description.max' => 'The description may not be greater than 500 characters.',
                'amount.required' => 'The amount field is required.',
                'amount.numeric' => 'The amount must be a number.',
                'amount.min' => 'The amount must be at least 1.00',
                'amount.max' => 'The amount may not be greater than ' . config('invoice.max_amount') . '.',
                'type.required' => 'The invoice type is required.',
                'type.in' => 'The type field must be fresh or upsale.',
            ]);
            $customer_contact = $request->input('type') == 0
                ? CustomerContact::firstOrCreate(
                    ['email' => rand(1, 100) . $request->input('customer_contact_email')],
                    [
                        'brand_key' => $request->input('brand_key'),
                        'team_key' => $request->input('team_key'),
                        'name' => $request->input('customer_contact_name'),
                        'phone' => $request->input('customer_contact_phone'),
                    ]
                )
                : CustomerContact::where('special_key', $request->input('cus_contact_key'))->first();
            if (!$customer_contact) {
                return response()->json(['error' => 'The selected customer contact does not exist.'], 404);
            }
            if (!$customer_contact->special_key) {
                return response()->json(['error' => 'The selected customer contact does not exist. Please select a different or create a new one.'], 404);
            }
            $data = [
                'brand_key' => $request->input('brand_key'),
                'team_key' => $request->input('team_key'),
                'cus_contact_key' => $customer_contact->special_key,
                'description' => $request->input('description'),
                'amount' => $request->input('amount'),
                'type' => $request->input('type'),
                'status' => 0,
            ];
            if ($request->has('agent_id')) {
                $data['agent_id'] = $request->input('agent_id');
                $data['agent_type'] = 'App\Models\User';
            }
//            else {
//                if (!auth()->check()) {
//                    return response()->json(['error' => 'Authentication required to create an invoice'], 401);
//                }
//                $data['agent_id'] = auth()->id();
//                $data['agent_type'] = get_class(auth()->user());
//            }
            $invoice = Invoice::create($data);
            DB::commit();
            $invoice->loadMissing('customer_contact');
            return response()->json(['data' => $invoice, 'success' => 'Record created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating the invoice'], 500);
        }
    }

    /**
     * Display the specified invoice.
     */
    public
    function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified invoice.
     */
    public
    function edit(Invoice $invoice)
    {
        if (!$invoice->id) return response()->json(['error' => 'Invoice does not exist.']);
        $brands = Brand::where('status', 1)->get();
        $teams = Team::where('status', 1)->get();
        $customer_contacts = CustomerContact::where('status', 1)->get();
        $users = User::where('status', 1)->get();
        $invoice->loadMissing('customer_contact');
        return response()->json(['invoice' => $invoice, 'brands' => $brands, 'teams' => $teams, 'customer_contacts' => $customer_contacts, 'users' => $users]);
    }

    /**
     * Update the specified invoice in storage.
     */
    public
    function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'brand_key' => 'required|integer|exists:brands,brand_key',
            'team_key' => 'required|integer|exists:teams,team_key',
            'special_key' => 'required_if:type,1|nullable|integer|exists:customer_contacts,special_key',
            'customer_contact_name' => 'required_if:type,0|nullable|string|max:255',
            'customer_contact_email' => 'required_if:type,0|nullable|email|max:255|unique:customer_contacts,email,' . $invoice->cus_contact_key . ',special_key',
            'customer_contact_phone' => 'required_if:type,0|nullable|string|max:15',
            'agent_id' => 'required|integer',
//            'agent_type' => 'required|string|in:admins,users',
            'description' => 'nullable|string|max:500',
            'amount' => 'required|numeric|min:1|max:' . config('invoice.max_amount'),
            'type' => 'required|integer|in:0,1',/** 0 = fresh, 1 = upsale */
        ], [
            'brand_key.required' => 'The brand field is required.',
            'brand_key.integer' => 'The brand must be a valid integer.',
            'brand_key.exists' => 'The selected brand does not exist.',
            'team_key.required' => 'The team field is required.',
            'team_key.integer' => 'The team must be a valid integer.',
            'team_key.exists' => 'The selected team does not exist.',
            'special_key.integer' => 'The customer contact must be a valid integer.',
            'special_key.exists' => 'The selected customer contact does not exist.',
            'special_key.required' => 'The customer contact field is required when type is upsale.',
            'customer_contact_name.required_if' => 'The customer name is required for fresh customers.',
            'customer_contact_name.string' => 'The customer contact name must be a valid string.',
            'customer_contact_name.max' => 'The customer contact name cannot exceed 255 characters.',
            'customer_contact_email.required_if' => 'The customer contact email is required for fresh customers.',
            'customer_contact_email.email' => 'The customer contact email must be a valid email address.',
            'customer_contact_email.max' => 'The customer contact email cannot exceed 255 characters.',
            'customer_contact_email.unique' => 'This email is already in use.',
            'customer_contact_phone.required_if' => 'The customer contact phone number is required for fresh customers.',
            'customer_contact_phone.string' => 'The customer contact phone number must be a valid string.',
            'customer_contact_phone.max' => 'The customer contact phone number cannot exceed 15 characters.',
            'agent_id.required' => 'The agent field is required.',
            'agent_id.integer' => 'The agent must be a valid integer.',
//            'agent_type.required' => 'The agent type field is required.',
//            'agent_type.in' => 'The agent type must be either "admins" or "users".',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 500 characters.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 1.00',
            'amount.max' => 'The amount may not be greater than ' . config('invoice.max_amount') . '.',
            'type.required' => 'The invoice type is required.',
            'type.in' => 'The type field must be fresh or upsale.',
        ]);
        $customer_contact = $request->input('type') == 0
            ? CustomerContact::firstOrCreate(
                ['email' => $request->input('customer_contact_email')],
                [
                    'brand_key' => $request->input('brand_key'),
                    'team_key' => $request->input('team_key'),
                    'name' => $request->input('customer_contact_name'),
                    'phone' => $request->input('customer_contact_phone'),
                ]
            )
            : CustomerContact::where('special_key', $request->input('cus_contact_key'))->first();
        if (!$customer_contact) {
            return response()->json(['error' => 'The selected customer contact does not exist.']);
//            return redirect()->back()->with('error', 'The selected customer contact does not exist.');
        }
        $invoice->update([
            'brand_key' => $request->input('brand_key'),
            'team_key' => $request->input('team_key'),
            'cus_contact_key' => $customer_contact->special_key,
            'agent_id' => $request->input('agent_id'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'type' => $request->input('type'),
        ]);
        return response()->json(['success' => 'Invoice updated successfully.']);

//        return redirect()->route('admin.invoice.index')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function delete(Invoice $invoice)
    {
        try {
            if ($invoice->delete()) {
                return response()->json(['success' => 'The record has been deleted successfully.']);
            }
            return response()->json(['error' => 'An error occurred while deleting the record.']);

        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }
}
