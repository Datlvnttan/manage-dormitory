<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillUserController extends Controller
{
    public function billHistory()
    {        
        return view('user.bill.bill_history')->with("today_year",Carbon::now()->year);
    }
    public function billDetail($MaHoaDon)
    {                           
        return view('user.bill.bill_detail')->with("MaHoaDon",$MaHoaDon);               
    }
}
