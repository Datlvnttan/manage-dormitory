<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\SinhVien;
use Exception;
use Illuminate\Http\Request;

class SinhVienConTroller extends Controller
{
    public function updateInfo(Request $request) 
    {
        try
        {
            $sinhvien = SinhVien::where('MaSV',$request->input('MaSV')) 
                        ->update([
                            'NgaySinh'=>$request->input('NgaySinh'),
                            'GioiTinh'=>$request->input('GioiTinh'),
                            'SoCanCuoc' => $request->input('SoCanCuoc'),
                            'SoDienThoai' => $request->input('SoDienThoai'),
                            'Lop' => $request->input('Lop'),
                            'Email' => $request->input('Email'),
                            'QueQuan' => $request->input('QueQuan'),   
                            'AnhDaiDien' => $request->input('AnhDaiDien'),                        
                        ]);
            return response()->json(
                [
                    'success'=>true,
                    'message'=>"Cập nhật thông tin thành công!!!"
                ]
                );            
        }
        catch(Exception $e)
        {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>"Đã xảy ra lỗi \n Nội dung: ".$e
                ]
                );
        }
    }
}
