<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        return view("admin.device.device_index");
    }
    public function deviceAllocation()
    {
        return view("admin.device.device_allocation");
    }
}
