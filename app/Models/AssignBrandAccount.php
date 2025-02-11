<?php

namespace App\Models;

use App\Observers\AssignBrandAccountObserver;
use App\Traits\ActivityLoggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AssignBrandAccount extends Model
{
    use Notifiable, ActivityLoggable;

    protected $guarded = [];
    protected $table = 'assign_brand_accounts';

}
