<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\Role;
use App\Services\StaffNotification;
use App\Services\Type;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillUserApiController extends Controller
{
    public function getBillByRoom(Request $request)
    {
        try
        {           
            $user = Auth::user();   
            $curentIndex = ($request->page - 1)*config('app.PAGE_NUMBER_MAX');                          
            $data = DB::table('HoaDon')
                    ->select("MaHoaDon",
                    DB::raw("MONTH(NgayTao) as Thang"),
                    DB::raw("YEAR(NgayTao) as Nam"),
                    "ThanhTien",
                    "TrangThai")
            ->where("MaPhong",$user->MaPhong);    
            if($request->tatCa==true)
                return response()->json([
                    'success'=>true,
                    'data'=>$data                            
                            ->skip($curentIndex)
                            ->take(config('app.PAGE_NUMBER_MAX'))->get(),
                    'numpages' => ceil(HoaDon::where("MaPhong",$user->MaPhong)->count()/config('app.PAGE_NUMBER_MAX')) ,                          
                    ]);                                                    
            if (!$request->thangHienTai)
            {                                  
                $data=$data->where(DB::raw('YEAR(HoaDon.NgayTao)'),$request->nam);
                if ($request->thang != 0)
                    $data=$data->where(DB::raw('MONTH(HoaDon.NgayTao)'),$request->thang);               
            }
            else
            {
                $today = Carbon::now(); 
                $data=$data->where(DB::raw('YEAR(HoaDon.NgayTao)'),$today->year)
                            ->where(DB::raw('MONTH(HoaDon.NgayTao)'),$today->month);
            }
            $trangThai = [];
            if ($request->daThanhToan)
                $trangThai[] = "Đã thanh toán";
            if ($request->chuaThanhToan)
                $trangThai[] = "Chưa thanh toán";
            if ($request->khongChinhXac)
                $trangThai[] = "Không chính xác";
            $data = $data 
                    ->whereIn('TrangThai', $trangThai);
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
                'message'=>"Đã xảy ra lỗi"
            ]);
        } 
    }    
    public function reportBillWrongInfo( $maHoaDon)
    {
        return Call::TryCatchResponseJson(function()use($maHoaDon){
            $hoaDon = HoaDon::find($maHoaDon);
            if(!isset($hoaDon))
                return ResponseJson::error("Mã hóa đơn không tồn tại");
            if($hoaDon->MaPhong != auth()->user()->MaPhong)
                return ResponseJson::error("Bạn không có quyền truy cập hóa đơn này");
            if($hoaDon->TrangThai == "Đã thanh toán")
                return ResponseJson::error("Hóa đơn này đã thanh toán, không thể báo cáo");
            if($hoaDon->TrangThai == "Không chính xác")
                return ResponseJson::error("Bạn đã báo cáo hóa đơn này rồi");
            $hoaDon->TrangThai = "Không chính xác";
            $hoaDon->save();
            StaffNotification::build(Type::REPORT,"Hóa đơn không chính xác",
            "Hóa đơn $hoaDon->MaHoaDon bị báo cáo thông tin không đúng thông tin, vui lòng xem xét lại",
            Role::CanBoQuanLyDichVu,"admin/quanlyhoadon/$hoaDon->MaHoaDon");
            return ResponseJson::success("Báo cáo hóa đơn '$maHoaDon' thành công");

        });        
    }
    public function reportBillCancel($maHoaDon)
    {
        //return ResponseJson::success(data:$request->all());
        return Call::TryCatchResponseJson(function()use($maHoaDon){
            $hoaDon = HoaDon::find($maHoaDon);
            if(!isset($hoaDon))
                return ResponseJson::error("Mã hóa đơn không tồn tại");
            if($hoaDon->TrangThai != "Không chính xác")
                return ResponseJson::error("Hóa đơn này không bị báo cáo");
            $hoaDon->TrangThai = "Chưa thanh toán";
            $hoaDon->save();
            StaffNotification::delete("admin/quanlyhoadon/$hoaDon->MaHoaDon");
            return ResponseJson::success("Hủy bỏ báo cáo hóa đơn '$maHoaDon' thành công");

        });  
    }    
    public function billDetail(Request $request)
    {
        try
        {
            $user = Auth::user();
            $hoaDon = DB::table("HoaDon")
                    ->select("HoaDon.*")
                    ->join("Phong","Phong.Ma","=","HoaDon.MaPhong")                    
                    ->where("Phong.Ma","=",$user->MaPhong)                    
                    ->where("MaHoaDon","=",$request->MaHoaDon)
                    ->first();  
            if(!$hoaDon)      
                return response()->json([
                    'success'=>false,
                    'message'=>"Bạn không có quyền truy cập vào hóa đơn này"
                ]);
            $chiTietHoaDon = ChiTietHoaDon::select(
                                        "ChiTietHoaDon.*",
                                        "TenDichVu"
                                )
                                ->join('DichVu',"DichVu.MaDichVu","=","ChiTietHoaDon.MaDichVu")
                                ->where("MaHoaDon",$hoaDon->MaHoaDon)
                                            ->get();
            return response()->json([
                'success'=>true,
                'data'=>[
                    'hoadon'=>$hoaDon,
                    'chitiethoadon'=>$chiTietHoaDon
                ]
            ]);
        }catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>"Đã xảy ra lỗi"
            ]);
        }         
    }
}
