<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\KhaiBaoHuHong;
use App\Models\PhanBothietBi;
use App\Models\Phong;
use App\Models\Role;
use App\Models\ThietBi;
use App\Models\XuLyKhaiBaoHuHong;
use App\Services\Notification;
use App\Services\StaffNotification;
use App\Services\Type;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DamageReportUserApiController extends Controller
{
    public function getReportHistory(Request $request)
    {
        try{
            $user = auth()->user();
            $data = DB::table('KhaiBaoHuHong')
            ->select(
                "KhaiBaoHuHong.*",            
                "ThietBi.TenThietBi"
            )
            ->join("ThietBi","KhaiBaoHuHong.MaThietBi","=","ThietBi.MaThietBi");
            $curentIndex = ($request->page - 1)*config('app.PAGE_NUMBER_MAX');
            if($request->tatCa==true)
                return response()->json([
                    'success'=>true,
                    'data'=>$data->where("MaPhong",$user->MaPhong)->skip($curentIndex)
                                ->take(config('app.PAGE_NUMBER_MAX'))->get(),
                    'numpages' => ceil($data->count()/config('app.PAGE_NUMBER_MAX')),
                    "isleader" => $user->isLeader()
                    ]);                                                   
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
            return response()->json([
                'success'=>true,
                'data'=>$data->where("MaPhong",$user->MaPhong)->skip($curentIndex)
                            ->take(config('app.PAGE_NUMBER_MAX'))->get(),  
                'numpages'=>$numpages,
                "isleader" => $user->isLeader()                     
            ]);            
        }
        catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>'đã xảy ra lỗi'
            ]);
        }
    }
    public function getCountRequestNoProcess(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){ 
            $user = Auth::user();
            $TongSoLuongChuaXuLy = DB::table('KhaiBaoHuHong')
                    ->select(
                        DB::raw('COALESCE(SUM(KhaiBaoHuHong.TongSoLuong), 0) as TongSoLuongChuaXuLy')
                    )
                    ->where("MaPhong","=",$user->MaPhong)
                    ->where('KhaiBaoHuHong.MaThietBi','=',$request->MaThietBi)  
                    ->where('KhaiBaoHuHong.DaXuLy','=',0)
                    ->groupBy(
                        'KhaiBaoHuHong.MaThietBi',)
                    ->first()->TongSoLuongChuaXuLy??0;
            $thietBi = PhanBothietBi::where("MaThietBi",$request->MaThietBi)
                                    ->where("MaPhong",$user->MaPhong)->first();
            return ResponseJson::success(data:[
                'TongSoLuongChuaXuLy'=>$TongSoLuongChuaXuLy,
                'ThietBi'=>$thietBi,                
            ]);            
        });        
    }
    public function show($maKhaiBao)
    {
        return Call::TryCatchResponseJson(function()use($maKhaiBao){
            $khaiBaoHuHong = KhaiBaoHuHong::select("KhaiBaoHuHong.*",
                                                "Phong.Ten as TenPhong",
                                                "ThietBi.TenThietBi")
                                        ->join("Phong","Phong.Ma","=","KhaiBaoHuHong.MaPhong")
                                        ->join("ThietBi","ThietBi.MaThietBi","=","KhaiBaoHuHong.MaThietBi")
                                        ->where("MaKhaiBao",$maKhaiBao)->first();
            if(!isset($khaiBaoHuHong))
                return ResponseJson::error("Mã khai báo không tồn tại");
            if($khaiBaoHuHong->MaPhong != auth()->user()->MaPhong)
                return ResponseJson::error("Bạn không có quyền truy cập khai báo này");
            $xuLyKhaiBaos = XuLyKhaiBaoHuHong::where("MaKhaiBao",$maKhaiBao)->get();
            return ResponseJson::success(data:[
                "khaibaohuhong"=>$khaiBaoHuHong,
                "xulykhaibaos"=>$xuLyKhaiBaos,
            ]);
        });
    }
    
    public function createDamageReport(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $user = Auth::user();
            if(!$user->isLeader())
                return ResponseJson::error("Chỉ có trưởng phòng mới có quyền khai báo hư hỏng");
            $thietBi = ThietBi::find($request->MaThietBi);
            if(!isset($thietBi))
                return ResponseJson::error("Mã thiết bị không tồn tại");                                   
            $phanBoThietBi = PhanBothietBi::where("MaPhong",$user->MaPhong)
                                        ->where("MaThietBi",$request->MaThietBi)
                                        ->first();   
            if(!isset($phanBoThietBi))
                return ResponseJson::error("Phòng này không có phân bổ thiết bị này");     
            $kb = DB::table("KhaiBaoHuHong")
                    ->where("MaPhong",$user->MaPhong)
                    ->where("MaThietBi",$request->MaThietBi)
                    ->where('DaXuLy',0)
                    ->first();                    
            if($kb)
            {
                if(intval($kb->TongSoLuong)+intval($request->SoLuongHuHong) > $phanBoThietBi->SoLuongPhanBo)
                    return ResponseJson::error("Tổng số lượng khai báo và chưa xử lý vượt quá số lượng mỗi phòng");            
                DB::statement('EXEC CapNhatSoLuongKhaiBaoHuHong ?,?,?',
                            [$request->MaThietBi, $user->MaPhong,$request->SoLuongHuHong]);
            }
            else
            {
                if(intval($request->SoLuongHuHong) > $phanBoThietBi->SoLuongPhanBo)
                    return ResponseJson::error("Tổng số lượng khai báo vượt quá số lượng mỗi phòng");    
                $sl = DB::table("KhaiBaoHuHong")
                    ->where("MaPhong",$user->MaPhong)
                    ->count();
                do
                {
                    $maKB = "KBHH".trim($user->MaPhong)."S". strval(++$sl);
                }
                while(DB::table("KhaiBaoHuHong")
                        ->where("MaKhaiBao",$maKB)
                        ->first()!=null);                       
                $khaiBaoHuHong = KhaiBaoHuHong::create([
                    'MaKhaiBao' => $maKB,
                    'MaPhong' => $user->MaPhong,
                    'MaThietBi' => $request->MaThietBi,
                    'NgayYeuCau' => Carbon::now(),
                    'TongSoLuong' => $request->SoLuongHuHong,
                    'DaXuLy' => 0,
                ]);                
                StaffNotification::build(Type::REPORT,"Khai báo hư hỏng phòng $user->MaPhong",
                                "Thiết bị: $thietBi->TenThietBi, số lượng: $request->SoLuongHuHong",Role::CanBoQuanLySinhVien,
                                "admin/huhongsuachua/xu-ly-khai-bao-hu-hong/$maKB");
            }                
            return ResponseJson::success('Khai báo hư hỏng thành công',$khaiBaoHuHong);                                         
        });
    }
    public function delete($maKhaiBao)
    {
        return Call::TryCatchResponseJson(function()use($maKhaiBao){
            $user = auth()->user();
            if(!$user->isLeader())
                return ResponseJson::error("Chỉ có trưởng phòng mới có quyền xóa khai báo hư hỏng");
            $khaiBaoHuHong = KhaiBaoHuHong::find($maKhaiBao);
            if($khaiBaoHuHong != null)
            {
                if($user->MaPhong != null && $khaiBaoHuHong->MaPhong = $user->MaPhong)
                {                    
                    $khaiBaoHuHong->delete();       
                    StaffNotification::delete("admin/huhongsuachua/xu-ly-khai-bao-hu-hong/$maKhaiBao");                                 
                    return ResponseJson::success('Xóa khai báo thành công');
                }
                return ResponseJson::error('Bạn không có quyền truy cập',401);
            }
            return ResponseJson::error('Mãi khai báo không tồn tại',402);
        });
    }
}
