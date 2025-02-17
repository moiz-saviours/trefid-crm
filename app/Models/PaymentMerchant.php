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
        'c_contact_key',
        'c_company_key',
        'name',
        'descriptor',
        'vendor_name',
        'email',
        'login_id',
        'transaction_key',
        'test_login_id',
        'test_transaction_key',
        'limit',
        'capacity',
        'environment',
        'status',
    ];

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_key', 'brand_key');
    }

    public function client_contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ClientContact::class, 'c_contact_key', 'special_key');
    }

    public function client_company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ClientCompany::class, 'c_company_key', 'special_key');
    }

    public function brands(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(
            Brand::class,          // Related model
            'assignable',          // Morph name
            AssignBrandAccount::class,
            'assignable_id',       // Foreign key on pivot table
            'brand_key',            // Related model key on pivot table
            'id',                  // Local model key
            'brand_key'                   // Related model key
        );
    }

    /**Scopes*/
    public function scopeHasSufficientLimitAndCapacity($query, $amount)
    {
        $total_amount = Payment::where('merchant_id', $this->id)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount');
        return $query->where('limit', '>=', $amount)->where('capacity', '>=', $total_amount);
    }
    /**Scopes*/
}
