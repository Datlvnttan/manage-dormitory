<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ThongBaoSinhVien;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getUserNotification($id)
    {
        $user = auth()->user();
        $thongBao = ThongBaoSinhVien::find($id);           
        if(isset($thongBao))
        {
            if(isset($thongBao->NguoiNhan))
            {
                if($thongBao->NguoiNhan == $user->MaSV)
                {
                    $thongBao->DaXem =true;
                    $thongBao->save();
                    // dd($thongBao->Uri);
                    return redirect($thongBao->Uri ?? "/");
                }
                return redirect("/");
            }     
            return redirect($thongBao->Uri ?? "/");       
        }
        return redirect("/");
    }   
}
