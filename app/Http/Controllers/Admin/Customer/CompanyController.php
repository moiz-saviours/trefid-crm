<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $all_contacts = Client::all();
        $domains = $all_contacts->map(function ($contact) {
            return substr(strrchr($contact->email, "@"), 1);
        })->unique();
        $existingDomains = Company::whereIn('domain', $domains)->pluck('domain')->toArray();

        $domainsToFetch = $domains->diff($existingDomains);

        foreach ($domainsToFetch as $domain) {
            $response = Http::get('https://api.hunter.io/v2/domain-search', [
                'domain' => $domain,
                'api_key' => env('HUNTER_API_KEY'),
            ]);

            if ($response->successful() && isset($response->json()['data'])) {
                $companyData = $response->json()['data'];
                Company::create([
                    'name' => $companyData['organization'] ?? $domain,
                    'email' => 'no-reply@'.$domain,
                    'domain' => $domain,
                    'city' =>$companyData['city'],
                    'state'=>$companyData['state'],
                    'country'=>$companyData['country'],
                    'zipcode'=>$companyData['postal_code'],
                    'response' => json_encode($companyData),
                    'status' => 1,
                ]);
            }
        }
        $companies = Company::whereIn('domain', $domains)->where('status', 1)->get();

        return view('admin.customers.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.customers.companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }


}
