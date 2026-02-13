<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel;

return function (Schedule $schedule) {
    // Delete last 10 files every hour
    $schedule->command('files:delete-last 10')
        ->hourly()
        ->withoutOverlapping()
        ->appendOutputTo(storage_path('logs/scheduler.log'));

    // Delete all files at midnight (00:00)
    $schedule->command('files:delete-all')
        ->dailyAt('00:00')
        ->withoutOverlapping()
        ->appendOutputTo(storage_path('logs/scheduler.log'));
};

