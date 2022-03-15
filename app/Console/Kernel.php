<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendFeedbackAfterDinnerEmails::class,
        Commands\SendFollowupAfterDinnerEmails::class,
        Commands\SendFeedbackRetroactively::class,
        Commands\SendSelectDateLaterEmails::class,
        //Commands\FetchFeedbackResponses::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:run --only-db')->daily();
        $schedule->command('feedback:send')->dailyAt(16);
        $schedule->command('feedback:followup_send')->dailyAt(17);
        $schedule->command('send:selectdatelater')->dailyAt(11);
        //$schedule->command('FetchFeedbackResponses')->hourly(01);
    }
}
