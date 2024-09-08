<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DamageReportController extends Controller
{
    public function damageEquipmentList()
    {
        return view('admin.damage.damage_equipment_list')->with('today_year',Carbon::now()->year);
    }
    public function roomReportHanding($MaKhaiBao)
    {
        return view('admin.damage.damage_report_handing')->with('MaKhaiBao',$MaKhaiBao);
    }
}
