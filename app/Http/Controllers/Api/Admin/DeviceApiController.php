<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Models\PhanBothietBi;
use App\Models\ThietBi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class DeviceApiController extends Controller
{

    public function getDecives()
    {
        return Call::TryCatchResponseJson(function(){
            return ResponseJson::success(data:ThietBi::all());
        });        
    }
    public function getDecivesOfRoom()
    {
        return Call::TryCatchResponseJson(function(){
            $user = auth()->user();
            $data = PhanBothietBi::select("PhanBothietBi.*","ThietBi.TenThietBi")
                                ->join("ThietBi","ThietBi.MaThietBi","=","PhanBothietBi.MaThietBi")
                                ->where("MaPhong",$user->MaPhong)
                                ->get();
            return ResponseJson::success(data:$data);
        });
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Call::TryCatchResponseJson(function(){
            return ResponseJson::success(data:ThietBi::paginate(config("app.PER_PAGE",10)));
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceRequest $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $tenThietBi = $request->TenThietBi;
            $thietBi = ThietBi::where("TenThietBi",$tenThietBi)->first();
            if(isset($thietBi))
                return ResponseJson::errors([
                    "TenThietBi"=>["Tên thiết bị này đã tồn tại"]
            ]);
            $countDevice = ThietBi::count();
            $maThietBiMoi = "";
            do
            {
                $maThietBiMoi = "TB00".strval(++$countDevice);
            }while(ThietBi::withTrashed()->find($maThietBiMoi)!=null);            
            $thietBi = ThietBi::create([
                'MaThietBi' => $maThietBiMoi,        
                'TenThietBi' => $tenThietBi,                   
                'TongSoLuong'=>$request->TongSoLuong,
                'SoLuongMoiPhong'=>$request->SoLuongMoiPhong ?? 0,
            ]);
            return ResponseJson::success(data:$thietBi);
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
    public function update(DeviceRequest $request, string $id)
    {
        return Call::TryCatchResponseJson(function()use($request,$id){
            $tenThietBi = $request->TenThietBi;
            $thietBi = ThietBi::find($id);
            if(!isset($thietBi))
                return ResponseJson::error("Mã thiết bị không tồn tại");
            if($thietBi->TenThietBi != $tenThietBi)
            {
                $thietBiCheck = ThietBi::where("TenThietBi",$tenThietBi)->first();
                if(isset($thietBiCheck))
                    return ResponseJson::errors([
                        "TenThietBi"=>["Tên thiết bị này đã tồn tại"]
                ]);
            }            
            $thietBi->TenThietBi = $tenThietBi;                      
            $thietBi->TongSoLuong = $request->TongSoLuong;                      
            $thietBi->SoLuongMoiPhong = $request->SoLuongMoiPhong ?? 0;                      
            $thietBi->save();
            return ResponseJson::success(data:$thietBi);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Call::TryCatchResponseJson(function()use($id){            
            $thietBi = ThietBi::find($id);
            if(!isset($thietBi))
                return ResponseJson::error("Mã thiết bị không tồn tại");
            $countPhanBo = PhanBothietBi::where("MaThietBi",$id)->count();
            if($countPhanBo > 0)
                return ResponseJson::error("Thiết bị này đã được phân bổ không thể xóa");                                  
            $thietBi->delete();
            return ResponseJson::success("Xóa thiết bị thành công");
        });
    }
}
