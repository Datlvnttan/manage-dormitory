<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class CloseResidenceRegistrationFeature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'close:register-residence';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {                
        Log::info("vào ròi đóa má");        
        $modelSchedule = Schedule::find(config("setting.REGISTER_RESIDENCE")); 
        $modelSchedule->Running = false;
        $modelSchedule->EndTime = null;
        $modelSchedule->save();
    }
}
