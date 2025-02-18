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
            ->map(function ($account) {
                $limit = min($account->limit, $account->capacity);
                return [
                    'id' => $account->id,
                    'name' => $account->name,
                    'limit' => $limit,
                    'payment_method' => $account->payment_method,
                    'capacity' => $account->capacity,
                ];
            })
            ->reject(function ($account) {
                return $account['limit'] < 1;
            })
            ->unique('id')
            ->groupBy('payment_method')
            ->map(function ($group) {
                return $group->map(function ($account) {
                    return [
                        'id' => $account['id'],
                        'name' => $account['name'],
                        'limit' => $account['limit'],
                    ];
                });
            });
        return response()->json(['data' => $groupedAccounts]);
    }
}
