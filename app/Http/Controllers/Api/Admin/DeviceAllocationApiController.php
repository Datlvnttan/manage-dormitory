<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\PhanBothietBi;
use App\Models\Phong;
use App\Models\ThietBi;
use App\Services\Notification;
use App\Services\Type;
use Illuminate\Http\Request;

class DeviceAllocationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Call::TryCatchResponseJson(function() use($request){ 
            $filter = $request->filter;
            $data = PhanBothietBi::select(
                "PhanBothietBi.*",                        
                "ThietBi.TenThietBi",                        
                "ThietBi.TongSoLuong",                
                "Phong.Ten as TenPhong",
                "Khu.Ma as MaKhu",
                "Khu.Ten as TenKhu",                
                "Tang.Ma as MaTang",
                "Tang.Ten as TenTang",
            )
            ->join("ThietBi","ThietBi.MaThietBi","=","PhanBothietBi.MaThietBi")                    
            ->join("Phong","Phong.Ma","=","PhanBothietBi.MaPhong")
            ->join("Tang","Phong.MaTang","=","Tang.Ma")
            ->join("Khu","Tang.MaKhu","=","Khu.Ma");                     
            if(isset($filter) && $filter["tatCa"]!="true")
            {                
                if ($filter["khu"] != null)
                {
                    $data=$data->where('Khu.Ma',"=",$filter["khu"]);
                    if ($filter["tang"] != null)
                    {
                        $data=$data->where('Tang.Ma',"=",$filter["tang"]);
                        if ($filter["phong"] != null)
                            $data=$data->where('Phong.Ma',"=",$filter["phong"]);
                    }
                }                                                        
            }                            
            return ResponseJson::success(data:$data->orderBy("MaPhong")->orderBy("PhanBothietBi.MaThietBi")->paginate(config("app.PER_PAGE",10)));            
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Call::TryCatchResponseJson(function() use($request){             
            $thietBi = ThietBi::find($request->MaThietBi);
            if(!isset($thietBi))
                return ResponseJson::error("Mã thiết bị không tồn tại");
            $phong = Phong::find($request->MaPhong);
            if(!isset($phong))
                return ResponseJson::error("Mã phòng không tồn tại");
            if(!isset($request->SoLuongPhanBo))
                return ResponseJson::error("Số lượng phân bổ không được để trống");
            $phanBoThietBi = PhanBothietBi::where("MaPhong",$request->MaPhong)
                                            ->where("MaThietBi",$request->MaThietBi)->first();
            if(isset($phanBoThietBi))
                    return ResponseJson::error("Phòng này đã phân bổ thiết bị này");
            $phanBoThietBi = PhanBothietBi::create([
                'MaThietBi' => $request->MaThietBi,    
                'MaPhong' => $request->MaPhong,
                'SoLuongPhanBo'=>$request->SoLuongPhanBo
            ]);
            Notification::build(Type::INFO,"Phân bổ phiết bị mới","Phòng của bạn đã được phân bổ thêm thiết bị: $thietBi->TenThietBi, số lượng: $request->SoLuongPhanBo, phản hồi lại với nhân viên nếu có sai sót",$phong->TruongPhong);            
            return ResponseJson::success(data:$phanBoThietBi);            
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $maThietBi,$maPhong)
    {
        return Call::TryCatchResponseJson(function() use($maThietBi,$maPhong,$request){             
            $thietBi = ThietBi::find($maThietBi);
            if(!isset($thietBi))
                return ResponseJson::error("Mã thiết bị không tồn tại");
            $phong = Phong::find($maPhong);
            if(!isset($phong))
                    return ResponseJson::error("Mã phòng không tồn tại");
            $query = PhanBothietBi::where("MaPhong",$maPhong)
                                    ->where("MaThietBi",$maThietBi);
            $phanBoThietBi = $query->first();
            if(!isset($phanBoThietBi))
                    return ResponseJson::error("Phòng này chưa phân bổ thiết bị này");
            if(!isset($request->SoLuongPhanBo))
                return ResponseJson::error("Số lượng phân bổ không được để trống");
            $phanBoThietBi = $query->update([
                "SoLuongPhanBo"=>$request->SoLuongPhanBo
            ]);   
            Notification::build(Type::INFO,"Phân bổ phiết bị mới","Cập nhật số lượng thiết bị $thietBi->TenThietBi thành $request->SoLuongPhanBo, phản hồi lại với nhân viên nếu có sai sót",$phong->TruongPhong);                     
            return ResponseJson::success(data:$phanBoThietBi);            
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $maThietBi,string $maPhong)
    {
        return Call::TryCatchResponseJson(function() use($maThietBi,$maPhong){             
            $thietBi = ThietBi::find($maThietBi);
            if(!isset($thietBi))
                return ResponseJson::error("Mã thiết bị không tồn tại");
            $phong = Phong::find($maPhong);
            if(!isset($phong))
                    return ResponseJson::error("Mã phòng không tồn tại");
            $query = PhanBothietBi::where("MaPhong",$maPhong)
                            ->where("MaThietBi",$maThietBi);
            $phanBoThietBi = $query->first();
            if(!isset($phanBoThietBi))
                return ResponseJson::error("Phòng này chưa phân bổ thiết bị này");
            $query->delete();
            return ResponseJson::success("Xóa phân bổ thiết bị thành công");            
        });
    }
    public function getUnallocateDeviceByRoom(Request $request)
    {
        return Call::TryCatchResponseJson(function() use($request){                         
            $phong = Phong::find($request->MaPhong);
            if(!isset($phong))
                    return ResponseJson::error("Mã phòng không tồn tại");
            
            $data = ThietBi::whereNotIn('MaThietBi',function($query)use($request){
                        $query->select('PhanBothietBi.MaThietBi')
                                ->from('PhanBothietBi')
                                ->where("MaPhong",$request->MaPhong);
                    })->get();            
            return ResponseJson::success(data:$data);            
        });
    }
}
