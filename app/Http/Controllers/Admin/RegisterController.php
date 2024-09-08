<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registrationReview(){
        return view('admin.register.registration_review');
    }
    public function CheckRegistrationInformation($MaSV)
    {
        return view('admin.register.check_register_info')->with('MaSV',$MaSV);
    }
}
