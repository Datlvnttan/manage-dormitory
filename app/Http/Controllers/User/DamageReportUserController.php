<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DamageReportUserController extends Controller
{
    public function reportHistory()
    {
        return view('user.damage_report.report_history',[
            'today_year'=>Carbon::now()->year,
            'MaPhong'=>Auth::user()->MaPhong
        ]);
    }
    public function reportCreate()
    {
        return view('user.damage_report.report_create');
    }
    public function show()
    {
        return view('user.damage_report.damage_details');
    }
}
