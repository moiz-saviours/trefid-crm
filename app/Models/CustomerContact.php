<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CustomerContact extends Model
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
        'loggable_type',
        'loggable_id',
        'status',
    ];

    /**
     * Generate a unique client key.
     *
     * @return string
     */
    public static function generateClientKey(): string
    {
        do {
            $clientKey = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('client_key', $clientKey)->exists());

        return $clientKey;
    }

    /**
     * Automatically set the client_key and loggable details before creating the record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($client) {
            $client->client_key = self::generateClientKey();
            if (auth()->check()) {
                $client->loggable_type = get_class(auth()->user());
                $client->loggable_id = auth()->user()->id;
            }
        });
    }

    /**
     * The brand associated with the client.
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_key', 'brand_key');
    }

    /**
     * The team associated with the client.
     */
    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_key', 'team_key');
    }

    /**
     * TODO NEED TO BE UPDATE : LOGGABLE WILL BE FOR WHO CREATED THIS RECORD
     * Define a polymorphic relationship with logs.
     */
    public function company(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(CustomerCompany::class, 'loggable');
    }
}
