<?php

namespace App\Console;

use App\Models\Schedule as ModelsSchedule;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $lenght = 0;
        $modelSchedule = ModelsSchedule::find(config("setting.REGISTER_RESIDENCE"));      
        // Log::info(config("setting.REGISTER_RESIDENCE"));
        if($modelSchedule->Running == false && $modelSchedule->FlagStart == true)            
        {
            $lenght++;
            $modelSchedule->FlagStart = false;
            $modelSchedule->Running = true;           
            $times = $modelSchedule->EndTime;
            // $modelSchedule->save();
            // "2023-11-22 18:47:55"             
            $scheduledTime = Carbon::parse($times);
            Log::info("Ngày nè:".$times);
            Log::info("Ngày nè:".$scheduledTime->day);
            // $schedule->call(function(){
            //     Artisan::call('close:register-residence');
            // })->when(function()use($scheduledTime){
            //     return Carbon::now()->gte($scheduledTime);
            // });
            // $schedule->job()->onOneServer
            $schedule->command('close:register-residence')->at($scheduledTime)
                    ->when(function () use($scheduledTime){
                    return now()->month == $scheduledTime->month && now()->year == $scheduledTime->year;
                })->runInBackground();
            // $schedule->command('close:register-residence')->on($scheduledTime)->runInBackground();
            // $schedule->command('close:register-residence')->monthlyOn(23, '0:00')->when(function () {
            //     return now()->month == 12 && now()->year == 2023;
            // })->runInBackground();
        }
        else
            $schedule->command('close:register')->everySecond();
        // if($lenght == 0)
        // {
        //     Artisan::call("schedule:stop");
        // }
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
