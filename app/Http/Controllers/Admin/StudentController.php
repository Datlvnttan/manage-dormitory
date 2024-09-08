<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentList()
    {
        return view('admin.student.student_list')->with('today_year',Carbon::now()->year);
    }
}
