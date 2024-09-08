<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InfringeController extends Controller
{
    public function InfringeHistory()  {
        return view('admin.infringe.infringe_history')->with("today_year",Carbon::now()->year);
    }
    public function infringeHistoryCreate()
    {
        return view('admin.infringe.infringe_history_create')->with("today_year",Carbon::now()->year);
    }
    public function index()
    {
        return view('admin.infringe.index');
    }
}
