<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffManagerAdminController extends Controller
{
    public function index()
    {
        return view("admin.staff.staff_index");
    }
}
