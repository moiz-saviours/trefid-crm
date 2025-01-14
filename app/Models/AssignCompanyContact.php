<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class AssignCompanyContact extends Model
{
    use Notifiable;

    protected $guarded = [];
    protected $table = 'assign_company_contacts';

    /**
     * Define the relationship between AssignCompanyContact and Company.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(CustomerCompany::class, 'cus_company_key', 'special_key');
    }

    /**
     * Define the relationship between AssignCompanyContact and Contact.
     *
     * @return BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(CustomerContact::class, 'cus_contact_key', 'special_key');
    }

    /**
     * Attach multiple contacts to a company.
     *
     * @param array $contactKeys
     * @return void
     */
    public function attachContacts(array $contactKeys): void
    {
        $this->company->contacts()->sync($contactKeys);
    }

    /**
     * Attach multiple companies to a contacts.
     *
     * @param array $companyKeys
     * @return void
     */
    public function attachCompanies(array $companyKeys): void
    {
        $this->contact->companies()->sync($companyKeys);
    }
}
