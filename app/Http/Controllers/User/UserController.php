<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index',['user'=>Auth::user()]);
    }
    public function information()
    {
        return view('user.information',['user'=>Auth::user()]);
    }
}
