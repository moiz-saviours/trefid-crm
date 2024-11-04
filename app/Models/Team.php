<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

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
    protected $fillable = ['team_key', 'name', 'description', 'status'];

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

}
