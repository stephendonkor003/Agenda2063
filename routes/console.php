<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Scheduled Tasks
|--------------------------------------------------------------------------
*/

// Send platform health & analytics report to all users every 5 hours
Schedule::command('platform:status-report')
    ->cron('0 */5 * * *')      // every 5 hours (00:00, 05:00, 10:00, 15:00, 20:00)
    ->withoutOverlapping()
    ->runInBackground()
    ->onFailure(function () {
        \Illuminate\Support\Facades\Log::error('platform:status-report scheduled job failed');
    });

