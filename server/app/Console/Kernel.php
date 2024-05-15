<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Определить расписание выполнения команд приложения.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
           Log::info("Schedule");
        })->everySecond();
    }
}