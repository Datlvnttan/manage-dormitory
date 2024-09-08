<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\InfingeHistoryRequest;
use App\Models\Role;
use App\Models\SinhVien;
use App\Models\SinhVienViPham;
use App\Models\ViPham;
use App\Services\StaffNotification;
use App\Services\Type;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InfringeUserApiController extends Controller
{
    public function getInfringeHistory(Request $request)
    {
        try
        {                
            $user = Auth::user();
            $curentIndex = ($request->page - 1)*config('app.PAGE_NUMBER_MAX');
            $data = DB::table('SinhVienViPham')
                    ->select(
                        "SinhVienViPham.*",
                        "ViPham.NoiDung",                                                
                    )
                    ->join("ViPham","ViPham.MaViPham","=","SinhVienViPham.MaViPham");                            
            if($request->tatCa==true)
                return response()->json([
                    'success'=>true,
                    'data'=>$data->where("MaSV",$user->MaSV)
                                ->skip($curentIndex)
                                ->take(config('app.PAGE_NUMBER_MAX'))->get(),
                    'numpages' => ceil(SinhVienViPham::where("MaSV",$user->MaSV)->count()/config('app.PAGE_NUMBER_MAX'))                       
                    ]);
            $data = $data->where("MaSV",$user->MaSV);                                            
            if (!$request->thangHienTai)
            {                                  
                $data=$data->where(DB::raw('YEAR(SinhVienViPham.ThoiGianViPham)'),$request->nam);
                if ($request->thang != 0)
                    $data=$data->where(DB::raw('MONTH(SinhVienViPham.ThoiGianViPham)'),$request->thang);               
            }
            else
            {
                $today = Carbon::now(); 
                $data=$data->where(DB::raw('YEAR(SinhVienViPham.ThoiGianViPham)'),$today->year)
                            ->where(DB::raw('MONTH(SinhVienViPham.ThoiGianViPham)'),$today->month);
            }
            if (($request->daGiaiQuyet && !$request->chuaGiaiQuyet) 
                || (!$request->daGiaiQuyet && $request->chuaGiaiQuyet))
                $data=$data->where("SinhVienViPham.DaGiaiQuyet","=",$request->daGiaiQuyet?1:0); 
            $numpages = ceil($data->count()/config('app.PAGE_NUMBER_MAX'));
            return response()->json([
                'success'=>true,
                'data'=>$data->skip($curentIndex)
                            ->take(config('app.PAGE_NUMBER_MAX'))->get(),  
                'numpages'=>$numpages                      
            ]);
        }catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>"Đã xảy ra lỗi".$e->getMessage()
            ]);
        } 
    }
    public function report($maViPham,$thoiGianViPham)
    {
        // return ResponseJson::success(data:Carbon::parse($thoiGianViPham));
        return Call::TryCatchResponseJson(function() use($maViPham,$thoiGianViPham){
            $user = auth()->user();
            $viPham = ViPham::find($maViPham);
            if(!isset($viPham))
                return ResponseJson::error("Mã vi phạm không tồn tại!!!");  
            $query = SinhVienViPham::where("MaSV",$user->MaSV)
                            ->where("MaViPham",$maViPham)
                            ->where("ThoiGianViPham",Carbon::parse($thoiGianViPham));
            $sinhVienViPham = $query->first();                   
            if(!isset($sinhVienViPham))
                return ResponseJson::error("Lỗi vi phạm này của bạn không tồn tại!!!");  
            if($sinhVienViPham->TrangThai=="Không chính xác")
                return ResponseJson::error("Bạn đã báo cáo lỗi vi phạm này!!!");  
            $sinhVienViPham = $query->update([
                "TrangThai"=>"Không chính xác"
            ]);
            StaffNotification::build(Type::REPORT,"Phản hồi biên bản vi phạm",
                            "Sinh viên $user->MaSV báo cáo vi phạm không chính xác, nội dung: '$viPham->NoiDung', thời gian: $thoiGianViPham",
                            Role::CanBoQuanLySinhVien,"admin/quanlyvipham/lich-su-vi-pham");
            return ResponseJson::success(data:$sinhVienViPham);
        });
    }
}
