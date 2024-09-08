<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\DangKyNoiTru;
use App\Models\SinhVien;
use App\Models\ThongBaoSinhVien;
use App\Services\Notification;
use App\Services\NotificationService;
use App\Services\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterApiController extends Controller
{    
    public function getReviewList()
    {
        try
        {
            $ds_dangKy = DangKyNoiTru::all();
            return response()->json([
                'success'=>true,
                'data'=>$ds_dangKy
            ]);
        }
        catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Đã xảy ra lỗi'
            ]); 
        }
    }
    public function checkRegisterInfo(Request $request)  {
        try
        {
            $thongTinSinhVien = DB::table('DangKyNoiTru')
                            ->select(
                                'SinhVien.*',
                                'DangKyNoiTru.*',                                
                                'Phong.Ten as TenPhong',
                                'Phong.SoLuongTrong'
                            )
                            ->join('SinhVien','SinhVien.MaSV','=','DangKyNoiTru.MaSV')
                            ->join('Phong','Phong.Ma','=','DangKyNoiTru.MaPhong')
                            ->where('DangKyNoiTru.MaSV',$request->MaSV)
                            ->first();
            $sl_cho = DB::table('DangKyNoiTru')
                    ->where('MaPhong','=',$thongTinSinhVien->MaPhong)
                    ->where('TrangThai','=','Chờ xét duyệt')
                    ->count();
            $sl_daXet = DB::table('DangKyNoiTru')
                    ->where('MaPhong','=',$thongTinSinhVien->MaPhong)
                    ->where('TrangThai','=','Đã xét duyệt')
                    ->count();
            return response()->json([
                'success'=>true,
                'data'=>[
                    'info'=>$thongTinSinhVien,
                    'soluongcho'=>$sl_cho,
                    'soluongdaxet'=>$sl_daXet
                ]
            ]);
        }
        catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Đã xảy ra lỗi'
            ]); 
        }
        
    }

    public function cancelRegister(Request $request) {        
        try
        {
            $sinhVien = SinhVien::find($request->input('MaSV'));
            if(!isset($sinhVien))
                return ResponseJson::error("Mã sinh viên không tồn tại");
            $dangKyNoiTru = DangKyNoiTru::where('MaSV',$request->input('MaSV'))->first();
            if(!isset($dangKyNoiTru))
                return ResponseJson::error("Đăng ký nội trú không tồn tại");
            if($dangKyNoiTru->TrangThai == "Đã xét duyệt")
                return ResponseJson::error("Đăng ký nội trú này đã được xét duyệt");
            $dangKyNoiTru->TrangThai = 'Bị hủy';
            $dangKyNoiTru->GhiChu = $request->input('ghiChu');
            $dangKyNoiTru->save();
            Notification::build(Type::FAILED,"Đăng ký nội trú thất bại","Yêu cầu đăng ký của bạn đã bị từ chối, lý do: ".$request->input('ghiChu'),$request->input('MaSV'));
            return response()->json([
                'success'=>true,
                'message'=>'Đã hủy đăng ký thành công'
            ]);
        }
        catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Đã xảy ra lỗi'
            ]); 
        }        
    }
    
    public function agreeRegister(Request $request)
    {
        try
        {
            $sinhVien = SinhVien::find($request->input('MaSV'));
            if(!isset($sinhVien))
                return ResponseJson::error("Mã sinh viên không tồn tại");
            $dangKyNoiTru = DangKyNoiTru::where('MaSV',$request->input('MaSV'))->first();
            if(!isset($dangKyNoiTru))
                return ResponseJson::error("Đăng ký nội trú không tồn tại");
            if($dangKyNoiTru->TrangThai == "Bị hủy")
                return ResponseJson::error("Đăng ký nội trú này đã bị hủy");
            $dangKyNoiTru->TrangThai = 'Đã xét duyệt';            
            $dangKyNoiTru->save();                        
            DB::statement('EXEC TaoHopDong ?,?',[$request->MaSV, 'admin1']);            
            $buildNotification = Notification::build(Type::SUCCESS,"Yêu cầu đăng ký nội trú của bạn đã được duyệt","Vui lòng thanh toán hợp đồng để hoàn tất quá trình đăng ký, hợp đồng sẽ tự động bị hủy bỏ trong vòng 7 ngày!!!",$request->input('MaSV'),"user/hopdong");
            return response()->json([
                'success'=>true,
                'message'=>'Phê duyệt hoàn tất',                
            ]);
        }
        catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Đã xảy ra lỗi'.$e->getMessage()
            ]); 
        }   
    }    
}
