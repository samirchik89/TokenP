<?php

namespace App\Console;

use App\Console\Commands\CheckTransactionStatus;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\ETHTransactions::class,
        \App\Console\Commands\BTCConfirmation::class,
        \App\Console\Commands\BTCTransactions::class,
        \App\Console\Commands\TokenDeployStatus::class,
        \App\Console\Commands\ETHTransactionStatusUpdate::class,
        \App\Console\Commands\Tazapay_check::class,
        \App\Console\Commands\ClearAllTables::class,
        \App\Console\Commands\DatabaseBackupCommand::class,
        CheckTransactionStatus::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // $schedule->command('token:deploy')
        //     ->everyMinute()->withoutOverlapping(5)->runInBackground();
        // $schedule->command('btc:transactions')
        //          ->everyMinute()->withoutOverlapping(5)->runInBackground();

        // $schedule->command('btc:checkstatus')
        //          ->everyMinute()->withoutOverlapping(5)->runInBackground();

        // $schedule->command('ethtransaction:apistatus')
        //     ->everyMinute()->withoutOverlapping(5)->runInBackground();

        // $schedule->command('token:investortransfer')
        //     ->everyMinute()->withoutOverlapping(5)->runInBackground();
        //$schedule->command('eth:statusupdate')
          //  ->everyMinute()->withoutOverlapping(5)->runInBackground();

        // $schedule->command('tazapay:check')
        //     ->everyMinute()->withoutOverlapping(5)->runInBackground();
        // $schedule->command('eth:transactions')
        //         ->everyFiveMinutes();

        $schedule->command('db:backup')
            ->twiceDaily(9, 21)  // Run at 9 AM and 9 PM
            ->withoutOverlapping()
            ->runInBackground();

        $schedule->command('check:transaction-status')
            ->everyMinute()
            ->withoutOverlapping()
            ->runInBackground();

        Schema::defaultStringLength(191);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
