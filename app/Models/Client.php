<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    use Notifiable, SoftDeletes;

    protected $table = 'clients';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_key',
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
        'loggable',
        'loggable_id',
        'status',
    ];

    /**
     * Generate a unique client key.
     *
     * @return string
     */
    public static function generateClientKey()
    {
        do {
            $clientKey = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('client_key', $clientKey)->exists());

        return $clientKey;
    }
}
