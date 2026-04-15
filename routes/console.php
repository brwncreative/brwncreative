<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('queue:work --timeout=3600')->everyFiveMinutes()->withoutOverlapping();
Schedule::command('queue:restart')->twiceDaily();
Schedule::command('queue:retry all')->everyOddHour()->withoutOverlapping();
Schedule::command('optimize:clear')->twiceDailyAt(7, 22, 10);
Schedule::command('optimize')->twiceDailyAt(7, 22, 10);

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
