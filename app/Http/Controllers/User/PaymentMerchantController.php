<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class PaymentMerchantController extends Controller
{
    /**
     * Showing accounts of specified resource.
     */
    public function by_brand($brand_key)
    {
        if (!$brand_key) {
            return response()->json(['error' => 'Oops! Brand not found.'], 404);
        }
        $teams = auth()->user()->teams()->with('brands')->get();
        $brands = $teams->flatMap(function ($team) {
            return $team->brands;
        });

        if (!$brands->contains('brand_key', $brand_key)) {
            return response()->json(['error' => 'Oops! Brand not found.'], 404);
        }
        $brand = Brand::where('brand_key', $brand_key)->first();
        if (!$brand) {
            return response()->json(['error' => 'Oops! Brand not found.'], 404);
        }
        $brand->load('client_accounts');
        $client_accounts = $brand->client_accounts;
        $groupedAccounts = $client_accounts
            ->filter(function ($account) {
                return $account->payment_method === 'authorize';
            })
            ->map(function ($accounts) {
                return $accounts->map(function ($account) {
                    return [
                        'id' => $account->id,
                        'name' => $account->name,
                    ];
                });
            });
        return response()->json(['data' => $groupedAccounts]);
    }

}
