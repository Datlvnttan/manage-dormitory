<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfringeUserController extends Controller
{
    public function infringeHistory()
    {        
        return view('user.infringe.infringe_history')->with("today_year",Carbon::now()->year);
    }
}
