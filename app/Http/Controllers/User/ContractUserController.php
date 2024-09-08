<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractUserController extends Controller
{
    public function index()
    {
        return view("user.contract.contract_details");
    }
}
