<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\HopDong;
use App\Models\Schedule;
use App\Services\Notification;
use App\Services\ScheduleService;
use App\Services\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class OpenFeatureAdminApiController extends Controller
{
    public function getStatus()
    {
        return Call::TryCatchResponseJson(function(){
            return ResponseJson::success(data:Schedule::all());
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function openRegisterResidence(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $modelSchedule = ScheduleService::openFeature(config("setting.REGISTER_RESIDENCE"),$request->thoi_han);
            if($modelSchedule == false )
                return ResponseJson::error("Thời gian không hợp lệ");
            Notification::build(Type::INFO,"Đợt đăng ký nội trú đang diễn ra",
                            "Hãy nhanh tay đăng ký để trở thành người của ký túc xá, thời hạn đăng ký đến hết $modelSchedule->EndTime",null,"user/dangkynoitru/dang-ky-noi-tru");
            return ResponseJson::success(data:$modelSchedule);            
            // config()->set("setting.OPEN_REGISTER_RESIDENCE",true);
            // $endTimes = Carbon::parse($request->thoi_han_dong_dang_ky_noi_tru);
            // config()->set("setting.END_TIME_OPEN_REGISTER_RESIDENCE",$endTimes);
            // Artisan::call("schedule:run");
        });
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function closeRegisterResidence()
    {
        return Call::TryCatchResponseJson(function(){
            $modelSchedule = ScheduleService::closeFeature(config("setting.REGISTER_RESIDENCE"));
            return ResponseJson::success("Đã đóng đăng ký nội trú",data:$modelSchedule);
        });
    }
    public function openContractExtension(Request $request)
    {
        // return ResponseJson::success(data:$request->all());
        return Call::TryCatchResponseJson(function()use($request){
            $modelSchedule = ScheduleService::openFeature(config("setting.CONTRACT_EXTENSION"),$request->thoi_han);
            if($modelSchedule == false )
            return ResponseJson::error("Thời gian không hợp lệ");
            Notification::build(Type::INFO,"Đợt gia hạn hợp đồng đang diễn ra","Gia hạn hợp đồng đang được mở, thời hạn $modelSchedule->EndTime");
            return ResponseJson::success(data:$modelSchedule);  
            // return $modelSchedule == false ? ResponseJson::error("Thời gian không hợp lệ") : ResponseJson::success(data:$modelSchedule);
            
            // config()->set("setting.OPEN_REGISTER_RESIDENCE",true);
            // $endTimes = Carbon::parse($request->thoi_han_dong_dang_ky_noi_tru);
            // config()->set("setting.END_TIME_OPEN_REGISTER_RESIDENCE",$endTimes);
            // Artisan::call("schedule:run");
        });
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function closeContractExtension()
    {
        return Call::TryCatchResponseJson(function(){
            $modelSchedule = ScheduleService::closeFeature(config("setting.CONTRACT_EXTENSION"));
            HopDong::where("DaGiaHanTrongDot",true)->update([
                "DaGiaHanTrongDot"=>false
            ]);
            return ResponseJson::success("Đã đóng gian hạn hợp đồng",data:$modelSchedule);
        });
    }

    
}
