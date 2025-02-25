<?php

namespace App\Http\Controllers\User\Customer;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CustomerContact;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $teams = $user->teams()->with('brands')->get();
        $brands = $teams->flatMap(function ($team) {
            return $team->brands;
        });
        $countries = config('countries');
        $all_contacts = CustomerContact::whereIn('brand_key', Auth::user()->teams()->with(['brands' => function ($query) {
            $query->where('status', 1);
        }])->get()->pluck('brands.*.brand_key')->flatten())
            ->whereIn('team_key', Auth::user()->teams()->pluck('teams.team_key')->flatten()->unique())
            ->get();
        $contacts = CustomerContact::all();
        $my_contacts = $all_contacts->filter(function ($contact) {
            return $contact->creator_type === get_class(Auth::user()) && $contact->creator_id === Auth::id();

        });
        return view('user.customers.contacts.index', compact('all_contacts', 'my_contacts', 'contacts', 'brands', 'teams', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_key' => 'required|integer|exists:brands,brand_key',
            'team_key' => 'nullable|integer|exists:teams,team_key',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customer_contacts,email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:10',
            'ip_address' => 'nullable|string|max:45',
            'status' => 'required|in:0,1',
            'phone' => 'nullable|regex:/^(\+?\d{1,3})[\d\s().-]+$/|min:8|max:20',
        ], [
            'brand_key.required' => 'The brand field is required.',
            'brand_key.integer' => 'The brand must be a valid integer.',
            'brand_key.exists' => 'Please select a valid brand.',
            'team_key.required' => 'The team field is required.',
            'team_key.integer' => 'The team must be a valid integer.',
            'team_key.exists' => 'Please select a valid team.',
        ]);
        $customer_contact = new CustomerContact($request->only([
                'brand_key', 'team_key', 'name',
                'email', 'phone', 'address', 'city', 'state',
                'country', 'zipcode', 'ip_address', 'creator_type',
                'creator_id', 'status',
            ]) + ['special_key' => CustomerContact::generateSpecialKey()]);
        $customer_contact->save();
        $customer_contact->loadMissing('brand','company');
        return response()->json(['data' => $customer_contact, 'success' => 'Contact Created Successfully!']);
    }

    public function edit(CustomerContact $customer_contact)
    {
        if (!$customer_contact->id) return response()->json(['error' => 'Oops! Customer contact not found!']);
        $brands = Brand::where('status', 1)->get();
        $teams = Team::where('status', 1)->get();
        $countries = config('countries');
       // return view('user.customers.contacts.edit', compact('customer_contact', 'brands', 'teams', 'countries'));
        return response()->json(['customer_contact' => $customer_contact, 'brands' => $brands, 'teams' => $teams, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerContact $customer_contact)
    {
        return response()->json(['data' => $customer_contact, 'success' => 'Contact Updated Successfully!']);
        $request->validate([
            'brand_key' => 'required|integer|exists:brands,brand_key',
            'team_key' => 'nullable|integer|exists:teams,team_key',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customer_contacts,email,' . $customer_contact->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:10',
            'ip_address' => 'nullable|string|max:45',
            'status' => 'required|in:0,1',
            'phone' => 'nullable|regex:/^(\+?\d{1,3})[\d\s().-]+$/|min:8|max:20',
        ], [
            'brand_key.required' => 'The brand field is required.',
            'brand_key.integer' => 'The brand must be a valid integer.',
            'brand_key.exists' => 'Please select a valid brand.',
            'team_key.required' => 'The team field is required.',
            'team_key.integer' => 'The team must be a valid integer.',
            'team_key.exists' => 'Please select a valid team.',
        ]);
        $customer_contact->fill($request->only([
            'special_key', 'brand_key', 'team_key', 'name',
            'email', 'phone', 'address', 'city', 'state',
            'country', 'zipcode', 'ip_address', 'status',
        ]));
        $customer_contact->save();
        $customer_contact->loadMissing('brand','company');
        return response()->json(['data' => $customer_contact, 'success' => 'Contact Updated Successfully!']);
    }

}
