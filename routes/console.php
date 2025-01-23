<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Schedule::command('sanctum:prune-expired --hours=24')->daily()
    ->appendOutputTo(storage_path('logs/sanctum_output.log'))
//            ->emailOutputOnFailure('your@example.com')
    ->onFailure(function () {
        Log::channel('sanctum_output')->warning("Sanctum prune task failed at " . now());

        $heading = "\n\n===== Sanctum Prune Task Failed at " . now() . " =====\n";
        $output = shell_exec('php artisan sanctum:prune-expired --hours=24');
        $formattedOutput = $heading . $output . "\n";
        $footer = "\n===== End of Sanctum Prune Task Log =====\n\n";
        file_put_contents(storage_path('logs/sanctum_error_output.log'), $formattedOutput . $footer, FILE_APPEND);

        // Mail::to('your@example.com')->send(new TaskFailedNotification);
    });

