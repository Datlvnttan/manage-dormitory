<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function index()
    {        
        // dd(config("app.run"));
        Config::set('app.run', true);
        return view('home.index');
    }
    public function login()
    {        
        return view('home.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }
    public function register()
    {
        return view("home.register");
    }
}
