<?php

namespace App\Models;

use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InvoiceMerchant extends Model
{
    use Notifiable, ActivityLoggable;

    protected $guarded = [];
    protected $table = 'invoice_merchants';

    protected $fillable = ['invoice_key','merchant_type','merchant_id','created_at','updated_at'];


    public function merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentMerchant::class, 'merchant_id', 'id');
    }
}
