<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class CustomerCompany extends Model
{
    use Notifiable, SoftDeletes;

    protected $table = 'customer_companies';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'special_key',
        'domain',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
        'response',
        'creator_type',
        'creator_id',
        'status',
    ];

    /**
     * Generate a unique special key.
     *
     * @return string
     */
    public static function generateSpecialKey(): string
    {
        do {
            $specialKey = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('special_key', $specialKey)->exists());
        return $specialKey;
    }

    /**
     * Automatically set the client_key and loggable details before creating the record.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::boot();
        static::creating(function ($company) {
            $company->special_key = self::generateSpecialKey();
            if (auth()->check()) {
                $company->creator_type = get_class(auth()->user());
                $company->creator_id = auth()->user()->id;
            }
        });
        static::created(function () {
            self::updateCustomerCompanyCache();
        });
        static::updated(function () {
            self::updateCustomerCompanyCache();
        });
        static::deleted(function () {
            Cache::forget('companies_list');
        });
        static::deleted(function () {
            self::updateCustomerCompanyCache();
        });
        static::restored(function () {
            self::updateCustomerCompanyCache();
        });
    }

    /**
     * Update the companies cache.
     *
     * @return void
     */
    private static function updateCustomerCompanyCache(): void
    {
        Cache::forget('companies_list');
        Cache::remember('companies_list', config('cache.durations.short_lived'), function () {
            return self::all();
        });
    }

    public function contacts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CustomerContact::class, AssignCompanyContact::class, 'cus_company_key', 'cus_contact_key', 'special_key', 'special_key')->withTimestamps();
    }
}
