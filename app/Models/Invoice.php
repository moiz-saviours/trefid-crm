<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Invoice extends Model
{
    use Notifiable, SoftDeletes;

//    public function getRouteKeyName()
//    {
//        return 'invoice_key';
//    }
    protected $table = 'invoices';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_key',
        'team_key',
        'cus_contact_key',
        'agent_id',
        'agent_type',
        'creator_id',
        'creator_type',
        'invoice_key',
        'invoice_number',
        'description',
        'amount',
        'status',
    ];

    /**
     * Generate a unique 9-digit invoice key.
     *
     * @return string
     */
    public static function generateInvoiceKey(): string
    {
        do {
            $invoiceKey = str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT);
        } while (self::where('invoice_key', $invoiceKey)->exists());

        return $invoiceKey;
    }

    /**
     * Generate a unique 6-digit invoice number.
     *
     * @return string
     */
    public static function generateInvoiceNumber(): string
    {
        do {
            $invoiceNumber = "INV-" . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('invoice_number', $invoiceNumber)->exists());

        return $invoiceNumber;
    }


    /**
     * Automatically set the special_key and creator details before creating the record.
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function ($invoice) {
            if (auth()->check()) {
                $invoice->creator_type = get_class(auth()->user());
                $invoice->creator_id = auth()->user()->id;
            }
        });
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_key', 'brand_key');
    }

    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_key', 'team_key');
    }

    public function customer_contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CustomerContact::class, 'cus_contact_key', 'special_key');
    }

    public function agent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->morphTo();
    }
}
