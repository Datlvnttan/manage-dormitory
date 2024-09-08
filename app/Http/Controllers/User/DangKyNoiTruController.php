<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DangKyNoiTru;
use App\Models\HopDong;
use App\Models\NhanVien;
use App\Models\Phong;
use App\Models\Role;
use App\Models\ThongBaoNhanVien;
use App\Models\ThongBaoSinhVien;
use App\Services\ScheduleService;
use App\Services\StaffNotification;
use App\Services\Type;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DangKyNoiTruController extends Controller
{
    private function check($user)
    {
        if($user->AnhDaiDien == null ||
        $user->AnhDaiDien == null ||
        $user->Email == null ||
        $user->GioiTinh == null ||
        $user->NgaySinh == null ||
        $user->QueQuan == null ||
        $user->SoDienThoai == null ||
        $user->Lop == null)
            return false;
        return true;
    }
    private function checkRegisterResidence()
    {
        $user = Auth::user();
        $dangKyNoiTru = DangKyNoiTru::find($user->MaSV);        
        if(isset($dangKyNoiTru))
        {
            if($dangKyNoiTru->TrangThai == "Chờ xét duyệt")
                return 1;
            if($dangKyNoiTru->TrangThai == "Đã xét duyệt")
                return 2;
        }
        return 3;
    }
    public function index(){
        $user = Auth::user();
        $hopDong = HopDong::where("MaSV",$user->MaSV)->where("TrangThai","<>","Hết hiệu lực")->where("TrangThai","<>","Chưa hiệu lực")->first();
        if(isset($hopDong))
            return  view('user.dangkynoitru.ban_da_la_thanh_vien_cua_ky_tuc_xa'); 
        if($this->checkRegisterResidence() == 1)
            return view('user.dangkynoitru.dang_ky_thanh_cong',['user'=>$user]);
        if(!ScheduleService::isRunning("REGISTER_RESIDENCE"))
            return view('user.dangkynoitru.chua_mo_dot_dang_ky');        
        if(!$this->check($user))
            return view('user.dangkynoitru.chua_duoc_phep');        
        return view('user.dangkynoitru.index_dangKyNoiTru',['user'=>$user]);      
    }
    public function xacNhanDangKy(Request $request)
    {        
        $user = Auth::user();
        $hopDong = HopDong::where("MaSV",$user->MaSV)->where("TrangThai","<>","Hết hiệu lực")->where("TrangThai","<>","Chưa hiệu lực")->first();
        if(isset($hopDong))
            return view('user.dangkynoitru.ban_da_la_thanh_vien_cua_ky_tuc_xa'); 
        if($this->checkRegisterResidence()==1)
            return view('user.dangkynoitru.dang_ky_thanh_cong',['user'=>$user]);
        if(!ScheduleService::isRunning("REGISTER_RESIDENCE"))
            return view('user.dangkynoitru.chua_mo_dot_dang_ky');       
        if(!$this->check($user))
            return view('user.dangkynoitru.chua_duoc_phep');
        // $hopDong = HopDong::where("MaSV",$user->MaSV)
        //                     ->where("TrangThai","<>","Hết hiệu lực")
        //                     ->first();
        // if(isset($hopDong))
        //     return view('user.dangkynoitru.khong_thanh_cong');
        return view('user.dangkynoitru.xac_nhan_dang_ky',[
            'user'=>$user,
            'phong'=>Phong::getInfo($request->input('maPhong')),
            'today'=>Carbon::now(),
        ]);
    }
    public function dangKyNoiTru(Request $request)
    {
        $user = Auth::user();
        $hopDong = HopDong::where("MaSV",$user->MaSV)->where("TrangThai","<>","Hết hiệu lực")->where("TrangThai","<>","Chưa hiệu lực")->first();
        if(isset($hopDong))
            return view('user.dangkynoitru.ban_da_la_thanh_vien_cua_ky_tuc_xa'); 
        if(($dangkyNoiTru = $this->checkRegisterResidence()) == 1)
            return view('user.dangkynoitru.dang_ky_thanh_cong',['user'=>$user]);
        if($dangkyNoiTru == 2)
            return view('user.dangkynoitru.da_ton_tai_dang_ky_da_xet_duyet');
        if(!ScheduleService::isRunning("REGISTER_RESIDENCE"))
            return view('user.dangkynoitru.chua_mo_dot_dang_ky');          
        if(!$this->check($user))
            return view('user.dangkynoitru.chua_duoc_phep');                                   
        DB::statement('exec TaoDangKyNoiTru ?,?', array($user->MaSV,$request->maPhong));
        StaffNotification::build(Type::INFO,"Có một yêu cầu đăng ký nội trú",
            "Sinh viên $user->MaSV đã gửi yêu cầu đăng ký nội trú!!!",Role::CanBoQuanLySinhVien,"admin/quanlyxetduyet/$user->MaSV");
        return view('user.dangkynoitru.dang_ky_thanh_cong',['user'=>$user]);
    }
    // public function dangKyThanhCong()
    // {        
    //     $user = Auth::user();
    //     return view('user.dangkynoitru.dang_ky_thanh_cong',['user'=>$user]);
    // }
}
