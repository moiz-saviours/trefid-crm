<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use function Pest\Laravel\get;

trait ActivityLoggable
{
    public static array $defaultLogEvents = ['created', 'updated', 'deleted'];

    /**
     * Boot the trait and listen to the events of the model.
     */
    protected static function bootActivityLoggable(): void
    {
        $events = property_exists(static::class, 'logEvents') ? static::$logEvents : static::$defaultLogEvents;
        foreach ($events as $event) {
            static::$event(function ($model) use ($event) {
                $model->logActivity($event);
            });
        }
    }

    /**
     * Log the activity for the model.
     *
     * @param string $event
     * @return void
     */
    protected function logActivity(string $event): void
    {
        $user = Auth::user();
        if (!$user) {
            return;
        }

        $description = $this->generateDescription($event, $user);
        ActivityLog::create([
            'action' => $event,
            'model_type' => get_class($this),
            'model_id' => $this->getKey(),
            'actor_type' => get_class($user),
            'actor_id' => $user?->id,
            'description' => $description,
            'details' => json_encode($this->getLogDetails($event)),
            'ip_address' => Request::ip(),
        ]);
    }

    /**
     * Generate a description for the log entry based on the event type.
     *
     * @param string $event
     * @return string
     */
    protected function generateDescription(string $event, $user): string
    {
        $modelName = class_basename($this);
        $userName = $user->name ?? 'System';

        switch ($event) {
            case 'created':
                return "{$userName} created a new {$modelName}: {$this->name}";
            case 'updated':
                $changes = $this->getChanges();
                $changedFields = collect($changes)->keys()->implode(', ');
                return "{$userName} updated {$modelName}: Changed fields - {$changedFields}";
            case 'deleted':
                $deleteType = $this->trashed() ? 'deleted' : 'force deleted';
                return "{$userName} {$deleteType} {$modelName} " .
                    ($this->trashed()
                        ? ": Ref-Id = {$this->id}"
                        : ($this->email
                            ? "with email: {$this->email}"
                            : ($this->name
                                ? "with name: {$this->name}"
                                : '')));
            default:
                return "{$userName} performed {$event} on {$modelName}";
        }
    }

    protected function getLogDetails($event)
    {
        if ($event === 'updated') {
            return [
                'old' => $this->getOriginal(),
                'new' => $this->getChanges(),
            ];
        }
        return $this->toArray();
    }
}

