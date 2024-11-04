<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client; // Make sure to use the correct Client model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_key' => 'nullable|integer',
            'team_key' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:10',
            'ip_address' => 'nullable|string|max:45',
            'loggable' => 'nullable|string|max:255',
            'loggable_id' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $client = new Client($request->only([
            'brand_key', 'team_key', 'name',
            'email', 'phone', 'address', 'city', 'state',
            'country', 'zipcode', 'ip_address', 'loggable',
            'loggable_id', 'status',
        ])+ ['client_key' => Client::generateClientKey()]);

        $client->save();

        return redirect()->route('admin.client.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:10',
            'ip_address' => 'nullable|string|max:45',
            'loggable' => 'nullable|string|max:255',
            'loggable_id' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $client->fill($request->only([
            'client_key', 'brand_key', 'team_key', 'name',
            'email', 'phone', 'address', 'city', 'state',
            'country', 'zipcode', 'ip_address', 'loggable',
            'loggable_id', 'status',
        ]));

        $client->save();

        return redirect()->route('admin.client.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('admin.client.index')->with('success', 'Client deleted successfully.');
    }
}
