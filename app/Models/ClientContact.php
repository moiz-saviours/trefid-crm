<?php

namespace App\Models;

use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ClientContact extends Model
{
    use Notifiable, SoftDeletes, ActivityLoggable;

    protected $table = 'client_contacts';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'special_key',
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
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function ($client_contact) {
            $client_contact->special_key = self::generateSpecialKey();
            if (auth()->check()) {
                $client_contact->creator_type = get_class(auth()->user());
                $client_contact->creator_id = auth()->user()->id;
            }
        });
    }
    public function client_company(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClientCompany::class, 'c_contact_key','special_key');
    }
}
