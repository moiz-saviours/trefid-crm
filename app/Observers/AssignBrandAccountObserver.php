<?php

namespace App\Observers;

use App\Models\AssignBrandAccount;
use App\Models\ClientCompany;
use App\Models\ClientContact;
use App\Models\PaymentMerchant;

class AssignBrandAccountObserver
{
    public function created(AssignBrandAccount $assignment)
    {
        if ($assignment->assignable_type === ClientContact::class) {
            $contact = ClientContact::find($assignment->assignable_id);
            foreach ($contact->client_companies as $company) {
                AssignBrandAccount::firstOrCreate([
                    'brand_key' => $assignment->brand_key,
                    'assignable_type' => ClientCompany::class,
                    'assignable_id' => $company->special_key
                ]);
                foreach ($company->client_accounts as $account) {
                    AssignBrandAccount::firstOrCreate([
                        'brand_key' => $assignment->brand_key,
                        'assignable_type' => PaymentMerchant::class,
                        'assignable_id' => $account->id
                    ]);
                }
            }
        }
        if ($assignment->assignable_type === ClientCompany::class) {
            $company = ClientCompany::find($assignment->assignable_id);
            foreach ($company->client_accounts as $account) {
                AssignBrandAccount::firstOrCreate([
                    'brand_key' => $assignment->brand_key,
                    'assignable_type' => PaymentMerchant::class,
                    'assignable_id' => $account->id
                ]);
            }
        }
    }
    public function deleted(AssignBrandAccount $assignment)
    {
        if ($assignment->assignable_type === ClientContact::class) {
            $contact = ClientContact::find($assignment->assignable_id);
            foreach ($contact->client_companies as $company) {
                if ($this->hasAssignedAccounts($assignment->brand_key, $company)) {
                    AssignBrandAccount::firstOrCreate([
                        'brand_key' => $assignment->brand_key,
                        'assignable_type' => ClientCompany::class,
                        'assignable_id' => $company->special_key
                    ]);
                } else {
                    AssignBrandAccount::where([
                        'brand_key' => $assignment->brand_key,
                        'assignable_type' => ClientCompany::class,
                        'assignable_id' => $company->special_key
                    ])->delete();
                }

                foreach ($company->client_accounts as $account) {
                    AssignBrandAccount::where([
                        'brand_key' => $assignment->brand_key,
                        'assignable_type' => PaymentMerchant::class,
                        'assignable_id' => $account->id
                    ])->delete();
                }
            }
        }

        if ($assignment->assignable_type === ClientCompany::class) {
            $company = ClientCompany::find($assignment->assignable_id);
            if ($this->hasAssignedAccounts($assignment->brand_key, $company)) {
                AssignBrandAccount::firstOrCreate([
                    'brand_key' => $assignment->brand_key,
                    'assignable_type' => ClientCompany::class,
                    'assignable_id' => $company->special_key
                ]);
            }
            foreach ($company->client_accounts as $account) {
                AssignBrandAccount::where([
                    'brand_key' => $assignment->brand_key,
                    'assignable_type' => PaymentMerchant::class,
                    'assignable_id' => $account->id
                ])->delete();
            }
        }
    }

    /**
     * Check if any accounts under a company are still assigned to the brand.
     */
    private function hasAssignedAccounts($brandKey, ClientCompany $company): bool
    {
        foreach ($company->client_accounts as $account) {
            $isAccountAssigned = AssignBrandAccount::where([
                'brand_key' => $brandKey,
                'assignable_type' => PaymentMerchant::class,
                'assignable_id' => $account->id
            ])->exists();

            if ($isAccountAssigned) {
                return true;
            }
        }

        return false;
    }
}
