<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\HopDong;
use App\Models\Role;
use App\Services\Notification;
use App\Services\ScheduleService;
use App\Services\StaffNotification;
use App\Services\Type;
use Illuminate\Http\Request;

class ContractUserApiController extends Controller
{
    public function index()
    {
        return Call::TryCatchResponseJson(function(){
            $user = auth()->user();
            $hopDong = HopDong::select("HopDong.*","SinhVien.AnhDaiDien","SinhVien.Ho","SinhVien.Ten")
                                ->join("SinhVien","SinhVien.MaSV","=","HopDong.MaSV")
                                ->where("HopDong.MaSV",$user->MaSV)
                                ->where("HopDong.TrangThai","<>","Hết hiệu lực")->first();
            if(!isset($hopDong))
                return ResponseJson::error("Không tìm thấy dữu liệu");
            return ResponseJson::success(data:$hopDong);
        });
    }
    public function extension()
    {
        return Call::TryCatchResponseJson(function(){
            $user = auth()->user();            
            $hopDong = HopDong::where("MaSV",$user->MaSV)
                                ->where("TrangThai","<>","Hết hiệu lực")->first();
            if(!isset($hopDong))
                return ResponseJson::error("Không tìm thấy dữ liệu");
            if($hopDong->TrangThai == "Xin gia hạn")
                return ResponseJson::error("Hợp đồng này đã xin gia hạn trước đó");
            if(!ScheduleService::isRunning("CONTRACT_EXTENSION"))
                return ResponseJson::error("Chưa có đợt mở gia hạn hợp đồng");
            $hopDong->TrangThai = "Xin gia hạn";
            $hopDong->save();
            StaffNotification::build(Type::INFO,"Yêu cầu xin gia hạn hợp đồng",
                            "Xem thông tin hợp đồng $hopDong->MaHopDong của sinh viên $user->MaSV xin gia hạn",
                            Role::CanBoQuanLySinhVien,"admin/quanlyhopdong/$hopDong->MaHopDong");
            return ResponseJson::success(data:$hopDong);
        });
    }
    public function CencelExtension()
    {
        return Call::TryCatchResponseJson(function(){
            $user = auth()->user();            
            $hopDong = HopDong::where("MaSV",$user->MaSV)
                                ->where("TrangThai","<>","Hết hiệu lực")->first();
            if(!isset($hopDong))
                return ResponseJson::error("Không tìm thấy dữ liệu");
            if($hopDong->TrangThai == "Xin gia hạn")
            {
                $hopDong->TrangThai = "Có hiệu lực";
                $hopDong->TrangThai = "Có hiệu lực";
                $hopDong->save();
                return ResponseJson::success(data:$hopDong);
            }
            
        });
    }
    public function isRunningContractExtension()
    {
        return Call::TryCatchResponseJson(function(){
            $user = auth()->user();  
            if($user->MaPhong == null || $user->TrangThai !="Đang ở")
                return ResponseJson::status(0); 
            $check = ScheduleService::isRunning("CONTRACT_EXTENSION");
            if($check == true)
            {
                $hopDong = HopDong::where("MaSV",$user->MaSV)
                                ->where("TrangThai","<>","Hết hiệu lực")->first();
                if(!isset($hopDong))
                    return ResponseJson::error("Không tìm thấy dữ liệu");
                if(!ScheduleService::isRunning("CONTRACT_EXTENSION"))
                {
                    if($hopDong->TrangThai == "Xin gia hạn")
                        return ResponseJson::status(2);
                    return ResponseJson::status(-1);
                }
                if($hopDong->TrangThai == "Có hiệu lực")
                {
                    if($hopDong->DaGiaHanTrongDot == true)
                        return ResponseJson::status(3);
                    return ResponseJson::status(1);
                }
                return ResponseJson::status(2);
            }
            return $check;         
            
        });
        
    }
}
