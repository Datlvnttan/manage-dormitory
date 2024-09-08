<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\DangKyNoiTru;
use App\Models\HopDong;
use App\Models\Khu;
use App\Models\Phong;
use App\Services\ScheduleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;


class DangKyNoiTruController extends Controller
{
    public function deleteRegister()
    {
        
        return Call::TryCatchResponseJson(function(){
            $user = auth()->user();
            $dangKyNoiTru = DangKyNoiTru::find($user->MaSV);
            if(!isset($dangKyNoiTru))
                return ResponseJson::error("Bạn chưa đăng ký nội trú");
            if($dangKyNoiTru->TrangThai == "Đã xét duyệt")
                return ResponseJson::error("Đăng ký của bạn đã được xét duyệt, bạn chỉ có quyền hủy");
            $dangKyNoiTru->delete();
            return ResponseJson::success("Xóa đăng ký nội trú thành công");
        });
    }
    public function huyDangKyNoiTru(Request $request)
    {
        try
        {
            $user = Auth::user();
            $dangKy = DB::table('DangKyNoiTru')
                        ->where('MaSV','=',$user->MaSV)
                        ->update([
                            'TrangThai'=>"Bị hủy" ,
                            'GhiChu'=>$request->ghiChu
                        ]);
            HopDong::where('MaSV','=',$user->MaSV)
                            ->where('TrangThai','=',"Chưa hiệu lực")
                            ->delete();
            return response()->json([
                'success'=>true, //Đã có phòng
                'message'=>'Hủy đăng ký nội trú thành công'
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'success'=>false, //Đã có phòng
                'message'=>'Đã xảy ra lỗi!!!'
            ]);
        }
    }
    public function getInfoSubscriber()
    {
        $user = Auth::user();        
        if($user->MaPhong)
        {
            $data = Phong::getInfo($user->MaPhong);            
            $dangkychuyenphong = $user->getDataChangeRoom();
            if(!isset($dangkychuyenphong))
                $count = $this->getCountPeopleLive($user->MaPhong);
            else
                $count = $this->getCountPeopleLive($dangkychuyenphong->MaPhong);
            return response()->json([
                'status'=>1, //Đã có phòng
                'data'=>[
                'data'=>$data,
                'count'=>$count,
                'dangkychuyenphong'=>$dangkychuyenphong
                ]
            ], 200);
        }
        $dangKy = DB::table('DangKyNoiTru')
                ->select(
                    'DangKyNoiTru.*',
                    'Khu.Ten AS TenKhu',
                    'Tang.Ten AS TenTang',
                    'Phong.Ten AS TenPhong'
                )
                ->join('Phong','DangKyNoiTru.MaPhong','=','Phong.Ma')
                ->join('Tang','Tang.Ma','=','Phong.MaTang')
                ->join('Khu','Khu.Ma','=','Tang.MaKhu')                                                                      
                ->where('MaSV','=',$user->MaSV)
                ->first();
        if($dangKy)
        {
            $subCount = $this->getSubscriberCount($dangKy->MaPhong);
            $count = $this->getCountPeopleLive($dangKy->MaPhong);
            $status = -2;            
            if(strcmp($dangKy->TrangThai,'Đã xét duyệt')==0)
                $status = 0;
            else if(strcmp($dangKy->TrangThai,'Chờ xét duyệt')==0)
                $status = -1;
            else if(strcmp($dangKy->TrangThai,'Bị hủy') == 0 && !ScheduleService::isRunning("REGISTER_RESIDENCE"))
                return response()->json([
                    'status'=>-4,       
                    'message'=>"Chưa có đợt đăng ký"     
                ]);
            else
                $status = -2;
            return response()->json([
                'status'=>$status, //Đã gửi đăng ký nội trú và đã được xét duyệt                  
                'data'=>[
                    'dangky'=>$dangKy,                    
                    'subcount'=>$subCount,
                    'count'=>$count
                ],                
            ]);
        }
        if(ScheduleService::isRunning("REGISTER_RESIDENCE"))
            return response()->json([
                'status'=>-3,       
                'message'=>"Bạn chưa có phòng"     
            ]);
        return response()->json([
            'status'=>-4,       
            'message'=>"Chưa có đợt đăng ký"     
        ]);
    }
    // private function getInfo($maPhong)
    // {
    //     return DB::table('Phong')
    //             ->select(
    //                 'Khu.Ten AS TenKhu',
    //                 'Tang.Ten AS TenTang',
    //                 'Phong.Ten AS TenPhong'
    //             )
    //             ->join('Tang','Tang.Ma','=','Phong.MaTang')
    //             ->join('Khu','Khu.Ma','=','Tang.MaKhu')                
    //             ->where('Phong.Ma','=',$maPhong)
    //             ->first();
    // }
    private function getCountPeopleLive($maPhong)
    {
        return DB::table('Phong')                
                ->join('SinhVien','SinhVien.MaPhong','=','Phong.Ma')              
                ->where('Phong.Ma','=',$maPhong)
                ->count();
    }

    private function getSubscriberCount($maPhong)
    {        
        $subCount = DB::table('ThongKeDangKyLuTru')                
        ->select('SoLuongDangKy')          
        ->where('MaPhong','=',$maPhong)
        ->first();
        return $subCount ? $subCount->SoLuongDangKy : 0;
    }
    public function changeRoom(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $user = auth()->user();
            $maPhong = $request->input('maPhong');
            $phong = Phong::find($maPhong);
            if(!isset($phong))
                return ResponseJson::error("Mã phòng không tồn tại");
            if($phong->SoLuongTrong < 1)
                return ResponseJson::error("Phòng này không còn chổ trống");
            $khu = Khu::join("Tang","Tang.MaKhu","=","Khu.Ma")
                        ->join("Phong","Phong.MaTang","=","Tang.Ma")
                        ->where("Phong.Ma",$maPhong)->first();
            if($khu->DoiTuong != $user->GioiTinh)
                return ResponseJson::error("Bạn không được phép đăng ký phòng này");
            $dangKyNoiTru = DangKyNoiTru::where('MaSV',$user->MaSV)->first();
            if($dangKyNoiTru->TrangThai == "Bị hủy")
                return ResponseJson::error("Đăng ký này của bạn đã bị hủy");
            DangKyNoiTru::where('MaSV',$user->MaSV)->update(['MaPhong'=>$maPhong]);
            return ResponseJson::success("Thay đổi phòng thành công");
        });
    }
}
