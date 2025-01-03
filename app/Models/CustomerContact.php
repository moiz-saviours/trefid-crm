<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CustomerContact extends Model
{

    use Notifiable, SoftDeletes;

    protected $table = 'customer_contacts';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'special_key',
        'brand_key',
        'team_key',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
        'ip_address',
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
     * Automatically set the special_key and creator details before creating the record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($customer_contact) {
            $customer_contact->special_key = self::generateSpecialKey();
            if (auth()->check()) {
                $customer_contact->creator_type = get_class(auth()->user());
                $customer_contact->creator_id = auth()->user()->id;
            }
        });
    }

    /**
     * The brand associated with the customer contact.
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_key', 'brand_key');
    }

    /**
     * The team associated with the customer contact.
     */
    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_key', 'team_key');
    }

    /**
     * TODO NEED TO BE UPDATE : Creator WILL BE FOR WHO CREATED THIS RECORD
     * Define a polymorphic relationship with logs.
     */
    public function company(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(CustomerCompany::class, 'creator');
    }
}
