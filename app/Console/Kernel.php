<?php

namespace App\Console;

use App\Console\Commands\CarBase\CarMakesSync;
use App\Console\Commands\CarBase\CarModelsSync;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        CarMakesSync::class,
        CarModelsSync::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
