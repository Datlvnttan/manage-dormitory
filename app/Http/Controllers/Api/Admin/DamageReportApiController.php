<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\KhaiBaoHuHong;
use App\Models\ThietBi;
use App\Models\XuLyKhaiBaoHuHong;
use App\Services\Notification;
use App\Services\Type;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DamageReportApiController extends Controller
{
    public function damageEquimentList(Request $request)
    {                                     
        try
        {    
            $curentIndex = ($request->page - 1)*config('app.PAGE_NUMBER_MAX');
            $data = DB::table('KhaiBaoHuHong')
                    ->select(
                        "KhaiBaoHuHong.*",
                        "Phong.Ten as TenPhong",
                        "ThietBi.TenThietBi"
                    )
                    ->join("ThietBi","KhaiBaoHuHong.MaThietBi","=","ThietBi.MaThietBi")
                    ->join("Phong","KhaiBaoHuHong.MaPhong","=","Phong.Ma");                               
            if($request->tatCa==true)
                return response()->json([
                    'success'=>true,
                    'data'=>$data->skip($curentIndex)
                                ->take(config('app.PAGE_NUMBER_MAX'))->get(),
                    'numpages' => ceil(KhaiBaoHuHong::all()->count()/config('app.PAGE_NUMBER_MAX'))                       
                    ]);
            $data = $data->join("Tang","Phong.MaTang","=","Tang.Ma")
                    ->join("Khu","Tang.MaKhu","=","Khu.Ma");
            if ($request->khu != null)
            {
                $data=$data->where('Khu.Ma',"=",$request->khu);
                if ($request->tang != null)
                {
                    $data=$data->where('Tang.Ma',"=",$request->tang);
                    if ($request->phong != null)
                        $data=$data->where('Phong.Ma',"=",$request->phong);
                }
            }                                        
            if (!$request->thangHienTai)
            {                                  
                $data=$data->where(DB::raw('YEAR(KhaiBaoHuHong.NgayYeuCau)'),$request->nam);
                if ($request->thang != 0)
                    $data=$data->where(DB::raw('MONTH(KhaiBaoHuHong.NgayYeuCau)'),$request->thang);               
            }
            else
            {
                $today = Carbon::now(); 
                $data=$data->where(DB::raw('YEAR(KhaiBaoHuHong.NgayYeuCau)'),$today->year)
                            ->where(DB::raw('MONTH(KhaiBaoHuHong.NgayYeuCau)'),$today->month);
            }
            if (($request->daXuLy && !$request->chuaXuLy) 
                || (!$request->daXuLy && $request->chuaXuLy))
                $data=$data->where("KhaiBaoHuHong.DaXuLy","=",$request->daXuLy?1:0); 
            $numpages = ceil($data->count()/config('app.PAGE_NUMBER_MAX'));
            if(isset($request->paginate) && $request->paginate == false)
                $data = $data->get();
            else
                $data = $data->skip($curentIndex)->take(config('app.PAGE_NUMBER_MAX'))->get();
            return response()->json([
                'success'=>true,
                'data'=>$data,
                'numpages'=>$numpages                      
            ]);
        }catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>"Đã xảy ra lỗi"
            ]);
        }   
    }
    public function dammageReportDetails(Request $request)
    {
        // try
        // {    
            $data = DB::table("KhaiBaoHuHong")
                    ->select(
                        "KhaiBaoHuHong.*",
                        "Phong.Ten as TenPhong",
                        "ThietBi.TenThietBi"
                    )
                    ->join("Phong","KhaiBaoHuHong.MaPhong","=","Phong.Ma")
                    ->join("ThietBi","KhaiBaoHuHong.MaThietBi","=","ThietBi.MaThietBi")
                    ->where("MaKhaiBao","=",$request->MaKhaiBao)
                    ->first();
            return response()->json([
                'success'=>true,
                'data'=>$data                    
            ]);
        // }catch(Exception $e)
        // {
        //     return response()->json([
        //         'success'=>false,
        //         'message'=>"Đã xảy ra lỗi"
        //     ]);
        // } 
    }
    public function dammageReportHandingDetails()
    {
        
    }
    public function dammageReportConfirmHanding(Request $request)
    {
        try
        {
            $list = $request->list;  
            $KhaiBaoHuHong = KhaiBaoHuHong::join("Phong","Phong.Ma","=","KhaiBaoHuHong.MaPhong")
                                        ->join("ThietBi","ThietBi.MaThietBi","=","KhaiBaoHuHong.MaThietBi")
                                        ->where("KhaiBaoHuHong.MaKhaiBao", $request->MaKhaiBao)->first();
            if(!isset($KhaiBaoHuHong))
                return ResponseJson::error("Mã khai báo hưu hỏng khổng tồn tại");
            foreach($list as &$item)
            {
                $item["MaKhaiBao"] = $request->MaKhaiBao;
                XuLyKhaiBaoHuHong::create($item);
            }
            unset($item);            
            DB::table("KhaiBaoHuHong")
            ->where("MaKhaiBao","=",$request->MaKhaiBao)
            ->update([
                "NguoiXuLy"=>"admin1",
                "DaXuLy"=>1
            ]);
            Notification::build(Type::INFO,"Hoàn tất sử lý khai báo hư hỏng",
                    "Mã: $KhaiBaoHuHong->MaKhaiBao, thiết bị $KhaiBaoHuHong->TenThietBi đã được xử lý, nhấn vào đây để xem chi tiết",$KhaiBaoHuHong->TruongPhong,
                    "user/khaibaohuhong/$KhaiBaoHuHong->MaKhaiBao");
            return response()->json([
                'success'=>true,
                'message'=>"Xử lý khai báo thành công"
            ]);            
        }
        catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>"Đã xảy ra lỗi"
            ]);
        } 
    }
}
