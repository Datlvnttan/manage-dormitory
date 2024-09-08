<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function showBillList()
    {
        return view('admin.bill.bill_list')->with('today_year',Carbon::now()->year);
    }
    public function billDetails($MaHoaDon)
    {        
        return view('admin.bill.bill_details')->with('MaHoaDon',$MaHoaDon);
    }
    public function billCreate()
    {
        return view('admin.bill.bill_create');
    }    
    public function billEdit($MaHoaDon)
    {
        return view('admin.bill.bill_edit')->with('MaHoaDon',$MaHoaDon);
    }    
}
