<?php

namespace App\Models;

use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AssignTeamBrand extends Model
{

    use Notifiable, ActivityLoggable;

    protected $guarded = [];

    protected $table = 'assign_team_brands';

    /**
     * Define the relationship between AssignTeamBrand and Team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_key', 'team_key');
    }

    /**
     * Define the relationship between AssignTeamBrand and Brand.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_key','brand_key');
    }

    /**
     * Attach multiple users to a team.
     *
     * @param array $brandKeys
     * @return void
     */
    public function attachBrands(array $brandKeys)
    {
        $this->team->brands()->sync($brandKeys);
    }
}
