<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    public function details()
    {
        // $sinhViens = SinhVien::all();
        // dd($sinhViens);

        $sinhViens = SinhVien::all();
        if(count($sinhViens)==0)
        return response()->json([
            'status'=>false,
            'message' =>'Không tồn tại sinh viên nào'
        ]);
        return response()->json([$sinhViens]);
    }
}
