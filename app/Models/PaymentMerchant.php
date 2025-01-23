<?php

namespace App\Models;

use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PaymentMerchant extends Model
{
    use Notifiable, SoftDeletes, ActivityLoggable;

    protected $table = 'payment_merchants';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_key',
        'name',
        'descriptor',
        'vendor_name',
        'email',
        'login_id',
        'transaction_key',
        'test_login_id',
        'test_transaction_key',
        'limit',
        'environment',
        'status',
    ];

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_key', 'brand_key');
    }
}
