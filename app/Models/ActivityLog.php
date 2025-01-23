<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    protected $fillable = ['action', 'model_type', 'model_id', 'actor_type', 'actor_id', 'description', 'details', 'ip_address'];
//    public function getEntityNameAttribute()
//    {
//        $model = app($this->model_type)->withTrashed()->find($this->model_id);
//        return $model && isset($model->name) ? $model->name : 'Unknown';
//    }
    /** Scopes Start **/
    public function scopeForModel($query, string $modelClass)
    {
        return $query->whereHasMorph('model', [$modelClass]);
    }
    /** Scopes End **/
    /** Relation Start **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function actor(): MorphTo
    {
        return $this->morphTo('actor');
    }
    /** Relation End **/
}
