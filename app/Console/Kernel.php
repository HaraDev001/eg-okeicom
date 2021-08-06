<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
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
        // レッスンを削除するコマンド
        \App\Console\Commands\LessonFinish::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // レッスン削除のバッチ処理
        $schedule->command('lessonFinish --force')
                 ->withoutOverlapping() // 多重実行を防ぐ
                 // ->everyFiveMinutes();  // 5分ごとに実行
                 ->everyMinute();  // 5分ごとに実行
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
