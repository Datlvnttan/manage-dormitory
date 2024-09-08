<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleService
{
    public static function isRunning($key)
    {  
        $schedule = Schedule::find(config("setting.$key"));
        if($schedule->EndTime == null)
            return false;
        $endTime = Carbon::parse($schedule->EndTime);
        if($schedule->Running && ($endTime->gte(now())))      
            return true;
        $schedule->Running = false;
        $schedule->EndTime = null;
        $schedule->save();        
        return false;
    }

    public static function openFeature($key,$times)
    {
        $endTimes = Carbon::parse($times);
        if($endTimes->lte(now()))
            return false;
        $modelSchedule = Schedule::find($key);
        $modelSchedule->Running = true;        
        $modelSchedule->EndTime = $endTimes;
        $modelSchedule->save();
        return $modelSchedule;
    }
    public static function closeFeature($key)
    {
        $modelSchedule = Schedule::find($key);
        $modelSchedule->Running = false;
        $modelSchedule->EndTime = null;
        $modelSchedule->save();
        return $modelSchedule;    
    }
}

