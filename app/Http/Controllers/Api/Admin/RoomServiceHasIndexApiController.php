<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\DichVuPhongCoChiSo;
use App\Models\Phong;
use Illuminate\Http\Request;

class RoomServiceHasIndexApiController extends Controller
{

    public function index(Request $request)
    {
        // return ResponseJson::success(data:$request->all());
        return Call::TryCatchResponseJson(function() use($request){ 
            $filter = $request->filter;
            $data = DichVuPhongCoChiSo::select(
                "DichVuPhongCoChiSo.*",                        
                "DichVu.TenDichVu",                        
                "DichVu.GiaHienTai",                
                "Phong.Ten as TenPhong",
                "Khu.Ma as MaKhu",
                "Khu.Ten as TenKhu",                
                "Tang.Ma as MaTang",
                "Tang.Ten as TenTang",
            )
            ->join("DichVu","DichVu.MaDichVu","=","DichVuPhongCoChiSo.MaDichVu")                    
            ->join("Phong","Phong.Ma","=","DichVuPhongCoChiSo.MaPhong")
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
            return ResponseJson::success(data:$data->orderBy("MaPhong")->orderBy("DichVuPhongCoChiSo.MaDichVu")->paginate(config("app.PER_PAGE",10)));            
        });
    }
    public function getByRoom(string $maPhong)
    {        
        return Call::TryCatchResponseJson(function() use ($maPhong){
            $data = DichVuPhongCoChiSo::select("DichVuPhongCoChiSo.*","DichVu.TenDichVu")
                                    ->join("DichVu","DichVu.MaDichVu","=","DichVuPhongCoChiSo.MaDichVu")
                                    ->where("MaPhong",$maPhong)->get();
            return ResponseJson::success(data:$data);
        });
    }
    public function resetIndex($maPhong,$maDichVu)
    {
        return Call::TryCatchResponseJson(function() use ($maPhong,$maDichVu){
            $phong = Phong::find($maPhong);
            if(!isset($phong))
                return ResponseJson::error("Mã phòng không tồn tại!");
            $dichVu = DichVu::find($maDichVu);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại!");
            $query = DichVuPhongCoChiSo::where("MaDichVu",$maDichVu)
                                                    ->where("MaPhong",$maPhong);
                 
            $dichVuPhongCoChiSo = $query->first();                   
            if(!isset($dichVuPhongCoChiSo))
                return ResponseJson::error("Phòng này không sử dụng dịch vụ này");      
            $query->update([
                "ChiSoHienTai"=>0
            ]);             
            return ResponseJson::success("Đặt lại chỉ số thành công");
        });
    }
}
