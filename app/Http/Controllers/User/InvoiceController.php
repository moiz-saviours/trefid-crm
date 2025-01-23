<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CustomerContact;
use App\Models\Invoice;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        $brands = Brand::where('status', 1)->get();
        $teams = Team::where('status', 1)->get();
        $customer_contacts = CustomerContact::where('status', 1)->get();
        $users = User::where('status', 1)->get();
        $all_invoices = Invoice::whereIn('brand_key', Auth::user()->teams()->with('brands')->get()->pluck('brands.*.brand_key')->flatten()->unique())->with(['brand', 'customer_contact'])->get();
        $my_invoices = $all_invoices->filter(function ($invoice) {
            return $invoice->agent_type === get_class(Auth::user()) && $invoice->agent_id === Auth::id();
        });
        return view('user.invoices.index', compact('all_invoices', 'my_invoices','brands', 'teams', 'customer_contacts', 'users', 'invoices'));
    }

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
                'taxable' => 'nullable|boolean',
                'tax_type' => 'nullable|in:none,percentage,fixed',
                'tax_value' => 'nullable|integer|min:0',
                'currency' => 'nullable|in:USD,GBP,AUD,CAD',
                'tax_amount' => 'nullable|numeric|min:0',
                'total_amount' => 'required|numeric|min:1|max:' . config('invoice.max_amount'),
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

                'taxable.boolean' => 'The taxable field must be true or false.',
                'tax_type.in' => 'The tax type must be one of the following: none, percentage, fixed.',
                'tax_value.integer' => 'The tax value must be an integer.',
                'tax_value.min' => 'The tax value must be at least 0.',
                'currency.in' => 'The currency must be one of the following: USD, GBP, AUD, CAD.',
                'tax_amount.numeric' => 'The tax amount must be a valid number.',
                'tax_amount.min' => 'The tax amount must be at least 0.',

                'total_amount.required' => 'The total amount field is required.',
                'total_amount.numeric' => 'The total amount must be a number.',
                'total_amount.min' => 'The total amount must be at least 1.00',
                'total_amount.max' => 'The total amount may not be greater than ' . config('invoice.max_amount') . '.',
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
                return response()->json(['error' => 'The selected customer contact does not exist.'], 404);
            }
            if (!$customer_contact->special_key) {
                return response()->json(['error' => 'The selected customer contact does not exist. Please select a different or create a new one.'], 404);
            }

            $taxable = $request->input('taxable', false);
            $tax_type = $request->input('tax_type', 'none');
            $tax_value = $request->input('tax_value', 0);
            $tax_amount = $request->input('tax_amount', 0);
            $amount = $request->input('amount');
            $total_amount = $amount;

            if ($taxable) {
                if ($tax_type == 'percentage' && $tax_value > 0) {
                    $calculated_tax_amount = ($amount * $tax_value) / 100;
                    if ($tax_amount > 0 && $tax_amount != $calculated_tax_amount) {
                        return response()->json(['error' => 'The provided tax amount does not match the calculated percentage tax.'], 400);
                    }
                } elseif ($tax_type == 'fixed' && $tax_value > 0) {
                    if ($tax_amount > 0 && $tax_amount != $tax_value) {
                        return response()->json(['error' => 'The provided tax amount does not match the fixed tax value.'], 400);
                    }
                } elseif ($tax_type == 'none') {
                    if ($tax_amount > 0) {
                        return response()->json(['error' => 'Tax amount should be 0 when tax type is none.'], 400);
                    }
                }
            }

            if ($taxable) {
                $total_amount = $amount + $tax_amount;
            }
            $data = [
                'brand_key' => $request->input('brand_key'),
                'team_key' => $request->input('team_key'),
                'cus_contact_key' => $customer_contact->special_key,
                'description' => $request->input('description'),
                'amount' => $request->input('amount'),
                'taxable' => $taxable,
                'tax_type' => $tax_type,
                'tax_value' => $tax_value,
                'tax_amount' => $tax_amount,
                'total_amount' => $total_amount,
                'type' => $request->input('type'),
                'status' => 0,
            ];
            if ($request->has('agent_id')) {
                $data['agent_id'] = $request->input('agent_id');
                $data['agent_type'] = 'App\Models\User';
            }
            //TODO
//            else {
//                if (!auth()->check()) {
//                    return response()->json(['error' => 'Authentication required to create an invoice'], 401);
//                }
//                $data['agent_id'] = auth()->id();
//                $data['agent_type'] = get_class(auth()->user());
//            }
            $invoice = Invoice::create($data);
            DB::commit();
            $invoice->loadMissing('customer_contact', 'brand', 'team', 'agent');
            $invoice->date = "Today at " . $invoice->created_at->timezone('GMT+5')->format('g:i A') . "GMT + 5";
            return response()->json(['data' => $invoice, 'success' => 'Record created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating the record', 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(Invoice $invoice)
    {
        if (!$invoice->id) return response()->json(['error' => 'Invoice does not exist.']);
        $brands = Brand::where('status', 1)->get();
        $teams = Team::where('status', 1)->get();
        $customer_contacts = CustomerContact::where('status', 1)->get();
        $users = User::where('status', 1)->get();
        $invoice->loadMissing('customer_contact');
        return response()->json(['invoice' => $invoice, 'brands' => $brands, 'teams' => $teams, 'customer_contacts' => $customer_contacts, 'users' => $users]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        DB::beginTransaction();
        try {
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
            if (!$customer_contact || !$customer_contact->special_key) {
                return response()->json(['error' => 'The selected customer contact does not exist.']);
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
            DB::commit();
            $invoice->loadMissing('customer_contact', 'brand', 'team', 'agent');
            if ($invoice->created_at->isToday()) {
                $date = "Today at " . $invoice->created_at->timezone('GMT+5')->format('g:i A') . "GMT + 5";
            } else {
                $date = $invoice->created_at->timezone('GMT+5')->format('M d, Y g:i A') . "GMT + 5";
            }
            $invoice->date = $date;
            return response()->json(['data' => $invoice, 'success' => 'Record updated successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while updating the record', 'message' => $e->getMessage()], 500);
        }
    }
}
