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
    protected static function boot()
    {
        parent::boot();

        static::created(function ($brand) {
            Cache::forget('brands_list');
            Cache::remember('brands_list', config('cache.durations.short_lived'), function () {
                return Brand::all();
            });
        });

        static::updated(function ($brand) {
            Cache::forget('brands_list');
            Cache::remember('brands_list', config('cache.durations.short_lived'), function () {
                return Brand::all();
            });
        });

        static::deleted(function ($brand) {
            Cache::forget('brands_list');
        });
    }

    public function contacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CustomerContact::class, 'brand_key');
    }
}

