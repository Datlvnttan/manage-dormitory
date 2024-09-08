<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\DangKyChuyenPhong;
use App\Models\Khu;
use App\Models\Phong;
use App\Models\Role;
use App\Models\SinhVien;
use App\Services\Notification;
use App\Services\StaffNotification;
use App\Services\Type;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PhongApiController extends Controller
{
    public function getEmptyRoom()
    {
        return Call::TryCatchResponseJson(function(){
            $user = Auth::user();   
            $phongs = Phong::select(
                'Phong.Ma as MaPhong',
                'Phong.Ten',
                'SoLuongTrong',
                DB::raw('COUNT(*) as LuotDangKy')
            )
            ->join('Tang','Tang.Ma','=','MaTang')
            // ->join('Khu','Tang.MaKhu','=','Khu.Ma')
            ->join('Khu',function($join) use($user){
                $join->on('Tang.MaKhu','=','Khu.Ma')
                ->where("Khu.DoiTuong","=",$user->GioiTinh);
            })
            ->leftJoin('DangKyNoiTru', 'Phong.Ma','=','DangKyNoiTru.MaPhong')
            ->where("Khu.DoiTuong","=",$user->GioiTinh)
            ->where('SoLuongTrong','<>',0);
            if(isset($user->MaPhong))
                $phongs = $phongs->where('Phong.Ma','<>',$user->MaPhong);
            $phongs = $phongs->groupBy(
            'Phong.Ma',
            'Phong.Ten',
            'SoLuongTrong')
            ->get();
            return ResponseJson::success(data:$phongs);            
        });                    
    }
    public function registerChangeRoom(Request $request)
    {
        return Call::TryCatchResponseJson(function() use ($request){
            $user = Auth::user();
            if(!isset($user->MaPhong))
                return ResponseJson::error("Bạn chưa đăng ký nội trú");   
            $lyDo = trim($request->LyDo);
            if(!isset($lyDo) || $lyDo =="")            
                return ResponseJson::error("Lý do không được để trống");   
            $phong = Phong::find($request->MaPhong);
            if(!isset($phong))
                return ResponseJson::error("Mã phòng không tồn tại");  
            $countRegisterChangeRoom = DangKyChuyenPhong::where("MaSV",$user->MaSV)
                                                        ->where("TrangThaiXetDuyet","Chờ xét duyệt")            
                                                        ->count();
            if($countRegisterChangeRoom > 0)  
                return ResponseJson::failed("Bạn đã gửi 1 đăng ký chuyển phòng trước đó, vui lòng chờ xét duyệt từ quản lý ký túc xá");
            if($phong->Ma == $user->MaPhong)
                return ResponseJson::error("Bạn đang ở phòng này");   
            if($phong->SoLuongTrong < 1)
                return ResponseJson::error("Phòng này không còn chổ trống");            
            $dangKyChuyenPhong = DangKyChuyenPhong::create([
                'MaSV'=>$user->MaSV,
                'MaPhongCu'=>$user->MaPhong,
                'MaPhongMoi'=>$phong->Ma,
                'NgayDangKy'=>Carbon::now(),    
                'LyDo'=>$lyDo,                        
            ]);
            StaffNotification::build(Type::INFO,"Có một yêu cầu chuyển phòng mới","Sinh viên $user->maSV - $user->TenSV yêu cầu chuyển từ phòng ".$user->phong->TenPhong." sang phòng ".trim($phong->TenPhong),
                            Role::CanBoQuanLySinhVien,"admin/lich-su-chuyen-phong");
            return ResponseJson::success(data:$dangKyChuyenPhong);            
        });         
       
    }
    public function changeRoomUpdate($maDangKy, Request $request){
        return Call::TryCatchResponseJson(function() use ($maDangKy,$request){
            $user = Auth::user();
            $dangKyChuyenPhong = DangKyChuyenPhong::find($maDangKy);
            if(!isset($dangKyChuyenPhong))
                return ResponseJson::error("Mã đăng ký không tồn tại");
            if($user->MaSV != $dangKyChuyenPhong->MaSV)
                return ResponseJson::error("Đây không phải là đăng ký chuyển phòng của bạn"); 
            if($dangKyChuyenPhong->TrangThaiXetDuyet != "Chờ xét duyệt")
                return ResponseJson::failed("Yêu cầu này đã được xét duyệt, bạn không thể thay đổi nữa");  
            $lyDo = trim($request->LyDo);
            if(!isset($lyDo) || $lyDo =="")            
                return ResponseJson::error("Lý do không được để trống");               
            $phong = Phong::find($request->MaPhong);
            if(!isset($phong))
                return ResponseJson::error("Mã phòng không tồn tại");              
            if($phong->Ma == $user->MaPhong)
                return ResponseJson::error("Bạn đang ở phòng này");   
            if($phong->SoLuongTrong < 1)
                return ResponseJson::error("Phòng này không còn chổ trống"); 
            $dangKyChuyenPhong->MaPhongMoi = $request->MaPhong;
            $dangKyChuyenPhong->LyDo = $lyDo;
            $dangKyChuyenPhong->save();    
            return ResponseJson::success(data:$dangKyChuyenPhong);  
        }); 
    }
    public function changeRoomDelete($maDangKy){
        return Call::TryCatchResponseJson(function() use ($maDangKy){
            $user = Auth::user();
            $dangKyChuyenPhong = DangKyChuyenPhong::find($maDangKy);
            if(!isset($dangKyChuyenPhong))
                return ResponseJson::error("Mã đăng ký không tồn tại");
            if($user->MaSV != $dangKyChuyenPhong->MaSV)
                return ResponseJson::error("Đây không phải là đăng ký chuyển phòng của bạn");   
            if($dangKyChuyenPhong->TrangThaiXetDuyet != "Chờ xét duyệt")
                return ResponseJson::failed("Yêu cầu này đã được xét duyệt, bạn không thể thay đổi nữa");            
            $dangKyChuyenPhong->delete();    
            return ResponseJson::success("Xóa yêu cầu đăng ký chuyển phòng thành công");  
        }); 
    }
    public function getRoomByFloor(Request $request, $maTang)
    {
        return Call::TryCatchResponseJson(function() use ( $request,$maTang){
            $phongs = DB::table('Phong');
            if($request->check_invoice!=null && $request->check_invoice == true)
            {                
                $phongs = $phongs->whereNotIn('Phong.Ma', function ($query) {
                                $query->select('HoaDon.MaPhong')
                                    ->from('HoaDon')
                                    ->whereYear('HoaDon.NgayTao', now()->year)
                                    ->whereMonth('HoaDon.NgayTao', now()->month);
                            });
            }
            $phongs = $phongs->where('MaTang','=',$maTang)
            ->whereNull("deleted_at")
            ->get();

            return ResponseJson::success(data:$phongs);              
        });       
    }
    public function getRooms(Request $request)
    {
        try
        {    
            $curentIndex = ($request->page - 1)*config('app.PAGE_NUMBER_MAX');
            $phongs = DB::table('Phong')
            ->select(
                'Phong.*',
                'Khu.Ten AS TenKhu',
                'Khu.DoiTuong',
                'Khu.Ma AS MaKhu',
                'Tang.Ten AS TenTang',                
            )            
            ->join('Tang','Tang.Ma','=','Phong.MaTang')
            ->join('Khu','Khu.Ma','=','Tang.MaKhu')
            ->whereNull("Phong.deleted_at");
            if(isset($request->khu))
            {
                $phongs = $phongs->where('Khu.Ma','=',$request->khu);
                if(isset($request->tang))
                {
                    $phongs = $phongs->where('Tang.Ma','=',$request->tang);
                }
            }
            //->paginate(config('app.PAGE_NUMBER_MAX'), ['*'], 'page', $page);
            $phongs = $phongs->skip($curentIndex)
            ->take(config('app.PAGE_NUMBER_MAX'))
            ->get();
            $numpages = $request->numpages ?? ceil(Phong::all()->count()/config('app.PAGE_NUMBER_MAX'));
            return response()->json(
                [
                    'success'=>true,
                    'data'=>$phongs,
                    'numpages'=>$numpages
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
    public function roomDetails(Request $request)
    {        
        try
        {
            $phong = DB::table('Phong')
                ->select(
                    'Phong.*',
                    'Khu.Ten AS TenKhu',
                    'Khu.Ma AS MaKhu',
                    'Tang.Ten AS TenTang'
                )
                ->join('Tang','Tang.Ma','=','Phong.MaTang')
                ->join('Khu','Khu.Ma','=','Tang.MaKhu')
                ->where("Phong.Ma","=",$request->MaPhong)
                ->first();
            return response()->json(
                [
                    'success'=>true,
                    'data'=>$phong
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
    public function changeManager(Request $request)
    {
        try
        {
            DB::table('Phong')                
                ->where("Phong.Ma","=",$request->MaPhong)
                ->update([
                    "TruongPhong"=>$request->MaSV
                ]);
            return response()->json(
                [
                    'success'=>true,
                    'message'=>"Cập nhật trưởng phòng thành công"
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
    public function update($maPhong,Request $request)
    {        
        return Call::TryCatchResponseJson(function()use($maPhong,$request){
            $phong = Phong::find($maPhong);
            if(!isset($phong))            
                return ResponseJson::error('Phòng không tồn tại');            
            $tenPhong = $request->TenPhong;
            $sucChua = $request->SucChua;
            $maKhu = $request->MaKhu;
            $maTang = $request->MaTang;
            if(!isset($tenPhong))
                return ResponseJson::error('Tên phòng không được để trống');  
            if(Phong::where('Ma',"<>",$maPhong)
                ->where('Ten',$request->TenPhong)->first()!=null)
                return ResponseJson::error('Tên phòng mới này đã tồn tại');
            if(!isset($sucChua))
                return ResponseJson::error('Sức chứa không được để trống'); 
            else if(!is_numeric($sucChua))
                return ResponseJson::error('Sức chứa phải là kiểu số nguyên');   
            else
            {
                $countSinhVienInPhong = SinhVien::where('MaPhong',$phong->Ma)->count();
                if($countSinhVienInPhong > $sucChua)
                    return ResponseJson::error('Số lượng sinh viên đang ở đang ở phòng này lớn hơn sức chứa mà bạn muốn cập nhật');  
            }              
            if(!isset($maKhu))
                return ResponseJson::error('Vui lòng chọn khu');  
            if(!isset($maTang))
                return ResponseJson::error('Vui lòng chọn tầng'); 
            if($phong->SucChua != $phong->SoLuongTrong)
            {
                $khu = Khu::find($maKhu);
                $khuCu = Khu::join('Tang','Tang.MaKhu','=','Khu.Ma')
                            ->join('Phong','Phong.MaTang','=','Tang.Ma')
                            ->where("Phong.Ma",$phong->Ma)
                            ->first();
                if($khu->DoiTuong!=$khuCu->DoiTuong)
                    return ResponseJson::error('Không thể chọn khu có đối tượng giới tính sử dựng khác khu ban đầu khi đã có sinh viên vào ở');  
            }
            $phong->Ten = $tenPhong;  
            $phong->SucChua = $sucChua;              
            $phong->MaTang = $maTang;  
            $phong->save();
            return ResponseJson::success(data:$phong);
        });
    }
    public function create(Request $request)
    {        
        return Call::TryCatchResponseJson(function()use($request){                     
            $tenPhong = $request->TenPhong;
            $sucChua = $request->SucChua;
            $maKhu = $request->MaKhu;
            $maTang = $request->MaTang;
            if(!isset($tenPhong))
                return ResponseJson::error('Tên phòng không được để trống');  
            if(Phong::where('Ten',$request->TenPhong)->first()!=null)
                return ResponseJson::error('Tên phòng này đã tồn tại');
            if(!isset($sucChua))
                return ResponseJson::error('Sức chứa không được để trống'); 
            else if(!is_numeric($sucChua))
                return ResponseJson::error('Sức chứa phải là kiểu số nguyên');                      
            if(!isset($maKhu))
                return ResponseJson::error('Vui lòng chọn khu');  
            if(!isset($maTang))
                return ResponseJson::error('Vui lòng chọn tầng'); 
            $countPhongInTang = Phong::where('MaTang', $maTang)->count();
            $maPhong = null;
            do
            {
                $maPhong = $maKhu.$maTang."0".(++$countPhongInTang);
            }while ( Phong::withTrashed()->find($maPhong)!=null);
            $phong = Phong::create([
                "Ma"=>$maPhong,
                "Ten"=>$tenPhong,
                "SucChua"=>$sucChua,                
                "MaTang"=>$maTang,
                "SoLuongTrong"=>$sucChua,

            ]);            
            return ResponseJson::success(data:$phong);
        });
    }
    public function delete($maPhong)
    {
        return Call::TryCatchResponseJson(function()use($maPhong){
            $phong = Phong::find($maPhong);
            if(!isset($phong))            
                return ResponseJson::error('Phòng không tồn tại');            
            $countSinhVienInPhong = SinhVien::where('MaPhong',$phong->Ma)->count();
            if($countSinhVienInPhong > 0)
                return ResponseJson::error('Phòng hiện đang có người ở, không thể xóa');  
            $phong->delete();
            return ResponseJson::success(data:$phong);
        });
    }
    
}
