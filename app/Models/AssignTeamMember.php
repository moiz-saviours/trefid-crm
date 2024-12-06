<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AssignTeamMember extends Model
{
    use Notifiable;

    protected $guarded = [];

    protected $table = 'assign_team_members';

    /**
     * Define the relationship between AssignTeamMember and Team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_key', 'team_key');
    }

    /**
     * Define the relationship between AssignTeamMember and User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Attach multiple users to a team.
     *
     * @param array $userIds
     * @return void
     */
    public function attachUsers(array $userIds)
    {
        $this->team->users()->sync($userIds);
    }
}
