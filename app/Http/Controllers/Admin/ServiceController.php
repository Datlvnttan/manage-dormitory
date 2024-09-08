<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.service.service_index');
    }
    public function servicePersonal()
    {        
        return view('admin.service.service_personal_index')->with("today_year",Carbon::now()->year);        
    }
    public function serviceRoom()
    {
        return view('admin.service.service_room_index')->with("today_year",Carbon::now()->year);
    }
}
