<?php

namespace App\Models;

use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class TeamTarget extends Model
{
    use Notifiable, SoftDeletes, ActivityLoggable;

    protected $table = 'team_targets';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'special_key',
        'team_key',
        'target_amount',
        'month',
        'year',
        'creator_type',
        'creator_id',
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
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($team_target) {
            $team_target->special_key = self::generateSpecialKey();
            if (auth()->check()) {
                $team_target->creator_type = get_class(auth()->user());
                $team_target->creator_id = auth()->user()->id;
            }
        });
    }

    /**
     * The team associated with the team target.
     */
    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_key', 'team_key');
    }
}
