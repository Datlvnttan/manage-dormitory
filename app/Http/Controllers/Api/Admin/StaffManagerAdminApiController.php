<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\NhanVien;
use Illuminate\Http\Request;

class StaffManagerAdminApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Call::TryCatchResponseJson(function(){
            $data = NhanVien::select("NhanVien.*","roles.role_name as ChucVu")
                                ->join("roles","roles.id","=","NhanVien.role_id");
            return ResponseJson::success(data:$data->paginate(config("app.PER_PAGE",10)));
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffRequest $request)
    {
        return Call::TryCatchResponseJson(function() use($request){
            $tenDangNhap = $request->TenDangNhap;
            $nhanVien = NhanVien::find($tenDangNhap);
            if(isset($nhanVien))
                return ResponseJson::errors([
                    "TenDangNhap"=>["Tên đăng nhập đã tồn tại"]
            ]);
            $nhanVien = NhanVien::create([
                "TenDangNhap"=>$tenDangNhap,
                "Ho"=>$request->Ho,
                "Ten"=>$request->Ten,
                "SoDienThoai"=>$request->SoDienThoai,
                "role_id"=>$request->ChucVu,
                "MatKhau"=>"123",
                "password"=>"123",
            ]);
            return ResponseJson::success(data:$nhanVien);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StaffRequest $request, string $id)
    {
        return Call::TryCatchResponseJson(function() use($request,$id){            
            $nhanVien = NhanVien::find($id);
            if(!isset($nhanVien))
                return ResponseJson::error("Tên đăng nhập không tồn tại");
            if($request->TenDangNhap!=$id)
            $nhanVienCheck = NhanVien::fid($request->TenDangNhap);
            if(isset($nhanVienCheck))
                return ResponseJson::error("Tên đăng nhập mới đã tồn tại");
            $nhanVien->TenDangNhap = $request->TenDangNhap;
            $nhanVien->Ho = $request->Ho;
            $nhanVien->Ten = $request->Ten;
            $nhanVien->SoDienThoai = $request->SoDienThoai;
            $nhanVien->ChucVu = $request->ChucVu;
            $nhanVien->password = "123";
            $nhanVien->save();
            return ResponseJson::success(data:$nhanVien);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Call::TryCatchResponseJson(function() use($id){            
            $nhanVien = NhanVien::find($id);
            if(!isset($nhanVien))
                return ResponseJson::error("Tên đăng nhập không tồn tại");           
            $nhanVien->delete();
            return ResponseJson::success(data:$nhanVien);
        },function(){
            return ResponseJson::error("Không thể xóa tài khoản này");
        });
    }
    public function resetPassword(string $id)
    {
        return Call::TryCatchResponseJson(function() use($id){            
            $nhanVien = NhanVien::find($id);
            if(!isset($nhanVien))
                return ResponseJson::error("Tên đăng nhập không tồn tại");           
            $nhanVien->password = "123";
            $nhanVien->save();
            return ResponseJson::success(data:$nhanVien);
        });
    }
}
