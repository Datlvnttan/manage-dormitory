<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\Phong;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DichVuApiController extends Controller
{
    public function getServiceMandatoryList(Request $request)
    {

        try
        {    
            // $data = DB::table('DichVu')
            //         ->select('DichVu.*',
            //                 'DichVuPhongCoChiSo.ChiSoHienTai'
            //         )
            //         ->leftJoin("DichVuPhongCoChiSo",'DichVu.MaDichVu','=','DichVuPhongCoChiSo.MaDichVu')
            //         ->where("DichVu.BatBuoc",'=',1)
            //         ->where('DichVuPhongCoChiSo.MaPhong','=',$request->MaPhong)
            //         ->get();
            return response()->json(
                [
                    'success'=>true,
                    'data'=>DichVu::where("BatBuoc","=",1)->get()
                ]
            );
        }
        catch(Exception $e)
        {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Đã xãy ra lỗi'
                ]
            );
        }
    
    }
    public function statisticsIndividualServiceByRoom(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            //return ResponseJson::success(data:Phong::find($request->MaPhong));
            if($this->checkPrimaryKeyRoom($request->MaPhong))
            {
                $data = DB::table("ThongKeDichVuDonMoiPhong")
                    ->where("MaPhong",$request->MaPhong)->get();
                return ResponseJson::success(data:$data);  
            } 
            return ResponseJson::error("Phòng không tồn tại!!!");         
        });        
    }
    private function checkPrimaryKeyRoom($maPhong)
    {
        $phong = Phong::find($maPhong);
        if(!isset($phong))
            return false;
        return true;
    }
    public function statisticsOfServiceWithIndexByRoom(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){            
            if($this->checkPrimaryKeyRoom($request->MaPhong))
            {
                $data = DB::table("DichVuPhongCoChiSo")
                    ->where("MaPhong",$request->MaPhong)->get();
                return ResponseJson::success(data:$data);  
            } 
            return ResponseJson::error("Phòng không tồn tại!!!");         
        });          
    }
}
