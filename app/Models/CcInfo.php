<?php

namespace App\Models;

use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CcInfo extends Model
{
    use Notifiable, SoftDeletes, ActivityLoggable;

    /**
     * @var mixed|string
     */
    protected $table = 'cc_infos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'special_key',
        'cus_contact_key',
        'invoice_key',
        'card_name',
        'card_type',
        'card_number',
        'card_cvv',
        'card_month_expiry',
        'card_year_expiry',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
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
        static::creating(function ($cc_info) {
            $cc_info->special_key = self::generateSpecialKey();
        });
    }
}
