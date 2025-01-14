<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Team extends Model
{
    use Notifiable, SoftDeletes;

    protected $table = 'teams';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['team_key', 'lead_id', 'name', 'description', 'status'];

    public function generateTeamKey($id)
    {
        $idStr = (string)$id;
        $digitsToAdd = 6 - strlen($idStr);
        $randomDigits = '';
        for ($i = 0; $i < $digitsToAdd; $i++) {
            $randomDigits .= rand(0, 9);
        }
        $teamKey = $idStr . $randomDigits;
        $teamKeyArray = str_split($teamKey);
        shuffle($teamKeyArray);
        $shuffledTeamKey = implode('', $teamKeyArray);
        return str_pad($shuffledTeamKey, 6, '0', STR_PAD_LEFT);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, AssignTeamMember::class, 'team_key', 'user_id', 'team_key', 'id')->withTimestamps();
    }
    public function lead(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'lead_id');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'assign_team_brands', 'team_key', 'brand_key', 'team_key', 'brand_key')
            ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($team) {
            Cache::forget('teams_list');
            Cache::remember('teams_list', config('cache.durations.short_lived'), function () {
                return Team::all();
            });
        });

        static::updated(function ($team) {
            Cache::forget('teams_list');
            Cache::remember('teams_list', config('cache.durations.short_lived'), function () {
                return Team::all();
            });
        });

        static::deleted(function ($team) {
            Cache::forget('teams_list');
        });
    }
}
