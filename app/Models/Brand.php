<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use App\Traits\ActivityLoggable;

class Brand extends Model
{
    use Notifiable, SoftDeletes, ActivityLoggable;

    protected $table = 'brands';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['brand_key', 'name', 'url', 'logo', 'email', 'description', 'status'];

    public function generateBrandKey($id)
    {
        $idStr = (string)$id;
        $digitsToAdd = 6 - strlen($idStr);
        $randomDigits = '';
        for ($i = 0; $i < $digitsToAdd; $i++) {
            $randomDigits .= rand(0, 9);
        }
        $brandKey = $idStr . $randomDigits;
        $brandKeyArray = str_split($brandKey);
        shuffle($brandKeyArray);
        $shuffledBrandKey = implode('', $brandKeyArray);
        return str_pad($shuffledBrandKey, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Generate a unique special key.
     *
     * @return string
     */
    public static function generateSpecialKey(): string
    {
        do {
            $specialKey = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('brand_key', $specialKey)->exists());
        return $specialKey;
    }

    /**
     * Automatically set the special_key and creator details before creating the record.
     * @return void
     */
//    protected static function booted(): void
//    {
//        static::creating(function ($brand) {
//            $brand->brand_key = self::generateSpecialKey();
//        });
//    }

    protected static function boot()
    {
        parent::boot();

        /**
         * Automatically set the special_key and creator details before creating the record.
         * @return void
         */
        static::creating(function ($brand) {
            $brand->brand_key = self::generateSpecialKey();
        });

        static::created(function () {
            Cache::forget('brands_list');
            Cache::remember('brands_list', config('cache.durations.short_lived'), function () {
                return Brand::all();
            });
        });
        static::updated(function () {
            Cache::forget('brands_list');
            Cache::remember('brands_list', config('cache.durations.short_lived'), function () {
                return Brand::all();
            });
        });
        static::deleted(function () {
            Cache::forget('brands_list');
        });
    }

    public function contacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CustomerContact::class, 'brand_key');
    }
}

