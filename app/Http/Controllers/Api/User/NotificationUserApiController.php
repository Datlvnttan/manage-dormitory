<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\ThongBaoSinhVien;
use Illuminate\Http\Request;

class NotificationUserApiController extends Controller
{
    public function index()
    {
        return Call::TryCatchResponseJson(function(){
            $user = auth()->user();
            $data = ThongBaoSinhVien::whereNull("NguoiNhan")
                                    ->orWhere("NguoiNhan",$user->MaSV)
                                    ->orderByDesc("NgayTao")
                                    ->get();
            return ResponseJson::success(data:$data);
        });
    }
}
