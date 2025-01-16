<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['action', 'model_type', 'model_id', 'user_id', 'details'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getEntityNameAttribute()
    {
        $model = app($this->model_type)->withTrashed()->find($this->model_id);

        return $model && isset($model->name) ? $model->name : 'Unknown';
    }
}
