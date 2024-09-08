<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function contractList()
    {
        return view('admin.contract.contract_list');
    }
    public function contractInfo($MaHopDong) {
        return view('admin.contract.contract_info')->with('MaHopDong',$MaHopDong);
    }
}
