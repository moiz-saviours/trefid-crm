<?php

namespace App\Traits;

use App\Models\ActivityLog;
use function Pest\Laravel\get;

trait ActivityLoggable
{
    /**
     * Boot the trait and listen to the events of the model.
     */
    protected static function bootActivityLoggable()
    {
        static::created(function ($model) {
            $model->logActivity('create', auth()->user()->name . " created a new " . ($model->getTable()) . ": " . $model->name);
        });

        static::updated(function ($model) {
            $entityName = $model->name ?? 'Unknown';

            $model->logActivity('updated', auth()->user()->name . " updated " . ($model->getTable()) . ": " . $entityName);
        });


        static::deleted(function ($model) {
            $entityName = $model->name ?? 'Unknown';

            // Log the activity
            $model->logActivity('deleted', auth()->user()->name . " deleted " . ($model->getTable()) . ": " . $entityName);
        });


    }



    /**
     * Log the activity for the model.
     *
     * @param string $action
     * @param string $description
     * @return void
     */
    protected function logActivity($action, $description)
    {
        ActivityLog::create([
            'action' => $action,
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'actor_type' => get_class(auth()->user()),
            'actor_id' => auth()->id(),
            'description' => $description,
        ]);
    }
}

