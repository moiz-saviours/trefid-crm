<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PaymentTransactionLog extends Model
{
    use Notifiable, SoftDeletes;

    protected $table = 'payment_transaction_logs';
    protected $guarded = [];
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_key',
        'cus_contact_key',
        'merchant_id',
        'merchant_type',
        'gateway',
        'transaction_id',
        'auth_code',
        'response',
        'transaction_response',
        'response_code',
        'response_message',
        'request_data',
        'amount',
        'currency',
        'status',
        'error_message'
    ];
    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'response' => 'array',
        'transaction_response' => 'array',
        'request_data' => 'array',
    ];
    /**
     * Relationships
     */
    // Invoice Relation
    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_key', 'invoice_key');
    }

    // Customer Relation
    public function customer_contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CustomerContact::class, 'cus_contact_key', 'special_key');
    }

    public function payment_merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentMerchant::class, 'merchant_id', 'id');
    }
}
