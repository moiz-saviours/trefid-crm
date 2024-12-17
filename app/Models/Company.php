<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Company extends Model
{

    use Notifiable, SoftDeletes;

    protected $table = 'companies';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_key',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
        'loggable',
        'loggable_id',
        'status',
    ];

    /**
     * Generate a unique client key.
     *
     * @return string
     */
    public static function generateCompanyKey(): string
    {
        do {
            $companyKey = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('company_key', $companyKey)->exists());

        return $companyKey;
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
            $company->company_key = self::generateCompanyKey();
            if (auth()->check()) {
                $company->loggable = get_class(auth()->user());
                $company->loggable_id = auth()->user()->id;
            }
        });

        static::created(function () {
            self::updateCompanyCache();
        });

        static::updated(function () {
            self::updateCompanyCache();
        });

        static::deleted(function () {
            Cache::forget('companies_list');
        });

        static::deleted(function () {
            self::updateCompanyCache();
        });

        static::restored(function () {
            self::updateCompanyCache();
        });
    }


    /**
     * Update the companies cache.
     *
     * @return void
     */
    private static function updateCompanyCache(): void
    {
        Cache::forget('companies_list');
        Cache::remember('companies_list', config('cache.durations.short_lived'), function () {
            return self::all();
        });
    }

}
