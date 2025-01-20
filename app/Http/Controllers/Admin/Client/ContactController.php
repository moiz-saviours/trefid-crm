<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = config('countries');
        $client_contacts = ClientContact::all();
        return view('admin.clients.contacts.index', compact('client_contacts', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Cache::rememberForever('countries_list', fn() => config('countries'));
        return view('admin.clients.contacts.create', compact('countries'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:client_contacts,email',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:10',
            'ip_address' => 'nullable|string|max:45',
            'status' => 'required|in:0,1',
        ]);

        $client_contact = new ClientContact($request->only([
                'name', 'email', 'phone', 'address', 'city', 'state',
                'country', 'zipcode', 'ip_address', 'status',
            ]) + ['special_key' => ClientContact::generateSpecialKey()]);

        $client_contact->save();

        return response()->json(['client_contact' => $client_contact, 'success' => 'Record created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientContact $client_contact)
    {
        return response()->json(['client_contact' => $client_contact]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientContact $client_contact)
    {
        if (!$client_contact){
            return response()->json(['error' => 'Record not found!'], 404);
        }
        $countries = config('countries');

        return response()->json(['client_contact' => $client_contact, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientContact $client_contact)

    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:client_contacts,email,' . $client_contact->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:10',
            'ip_address' => 'nullable|string|max:45',
            'status' => 'required|in:0,1',
        ]);

        $client_contact->fill($request->only([
            'special_key', 'name', 'email', 'phone', 'address', 'city',
            'state', 'country', 'zipcode', 'ip_address', 'status',
        ]));

        $client_contact->save();
        return response()->json(['success' => 'Record updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(ClientContact $client_contact)
    {
        try {
            if ($client_contact->delete()) {
                return response()->json(['success' => 'The record has been deleted successfully.']);
            }
            return response()->json(['error' => 'An error occurred while deleting the record.']);

        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }

    /**
     * Change the specified resource status from storage.
     */
    public function change_status(Request $request, ClientContact $clientContact)
    {
        try {
            $clientContact->status = $request->query('status');
            $clientContact->save();
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => ' Internal Server Error', 'message' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }
}
