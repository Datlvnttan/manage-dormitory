<?php
namespace App\Services;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Models\Premium;
use App\Models\Role;
use App\Models\SinhVien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Str;

class AuthService
{
    public static function login($tenDangNhap,$matKhau,$dangNhapAdmin = false)
    {         
        try {            
            if($dangNhapAdmin)
                $token = auth('admin-api')->attempt(['TenDangNhap' => $tenDangNhap, 'password' => $matKhau]);
            else
                $token = auth("user-api")->attempt(['MaSV' => $tenDangNhap, 'password' => $matKhau]);
            return $token;
        } catch (JWTException $e) {
            return ResponseJson::error($e->getMessage(), 500);
        }            
    }
    public static function register(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $sinhVien = SinhVien::find($request->MaSinhVien);
            if(isset($sinhVien))
                return ResponseJson::error("Mã sinh viên đã tồn tại");
            if(Str::length($request->MaSinhVien) != 10)
                return ResponseJson::error("Mã sinh viên phải có đúng 10 ký tự");
            if(!isset($request->Ho))
                return ResponseJson::error("Họ sinh viên không được để trống");
            if(!isset($request->Ten))
                return ResponseJson::error("Tên sinh viên không được để trống");
            if(!isset($request->GioiTinh))
                return ResponseJson::error("Giới tính không được để trống");
            if($request->GioiTinh != "Nam" && $request->GioiTinh != "Nữ")
                return ResponseJson::error("Giới tính chỉ có thể làm nam hoặc nữ");
            if(!isset($request->SoDienThoai))
                return ResponseJson::error("Số điện thoại sinh viên không được để trống");
            if(Str::length($request->SoDienThoai) != 10)
                return ResponseJson::error("Số điện thoại phải có đúng 10 ký tự");
            if(!isset($request->Lop))
                return ResponseJson::error("Lớp không được để trống");
            if(!isset($request->MatKhau))
                return ResponseJson::error("Mật khẩu sinh viên không được để trống");
            if(!isset($request->NhapLaiMatKhau))
                return ResponseJson::error("Mật khẩu nhập lại không được để trống");            
            if($request->NhapLaiMatKhau != $request->MatKhau)
                return ResponseJson::error("Mật khẩu nhập lại không trùng khớp");
            $sinhVien = SinhVien::create([
                'MaSV'=>$request->MaSinhVien,
                'Ho'=>$request->Ho,
                'Ten'=>$request->Ten,
                'SoDienThoai'=>$request->SoDienThoai,
                'GioiTinh'=>$request->GioiTinh,
                'Lop'=>$request->Lop,
                'TrangThai'=>"Chưa đăng ký",             
                'password'=>$request->MatKhau,
                "MatKhau"=>$request->MatKhau,
            ]);            
            return ResponseJson::success(msg:"đăng ký tài khoản thành công");
        });
    }
    public static function logout()
    {
        //Auth::logout();        
        return ResponseJson::success("Log out successfully");          
    }

}

