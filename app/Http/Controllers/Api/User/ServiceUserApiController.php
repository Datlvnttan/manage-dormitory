<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\Role;
use App\Models\SuDungDichVuDon;
use App\Services\StaffNotification;
use App\Services\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceUserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Call::TryCatchResponseJson(function(){
            $user = auth()->user();
            $dichVus = SuDungDichVuDon::select('DichVu.*','NgayDangKy', DB::raw('ISNULL(DangSuDung, 0) as DangSuDung'))
            ->rightJoin('DichVu', function ($join) use($user) {
                $join->on('DichVu.MaDichVu', '=', 'SuDungDichVuDon.MaDichVu')                    
                    ->where('MaSV', $user->MaSV);
            })
            ->where("BatBuoc",false)
            ->where("TinhTheoChiSo",false)
            ->get();
            return ResponseJson::success(data:$dichVus);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $user = auth()->user();
            $dichVu = DichVu::find($request->MaDichVu);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại");
            if($dichVu->TinhTheoChiSo == true)
                return ResponseJson::error("Bạn không thể đăng kí dịch vụ tính theo chỉ số");
            if($dichVu->BacBuoc == true)
                return ResponseJson::error("Bạn không cần đăng ký dịch vụ bắt buộc");
            $query = SuDungDichVuDon::where("MaDichVu",$request->MaDichVu)
                                    ->where("MaSV",$user->MaSV);
            $suDungDichVuDon = $query->first();
            if(isset($suDungDichVuDon))
            {
                if($suDungDichVuDon->DangSuDung == true)
                    return ResponseJson::error("Bạn đang sử dụng dịch vụ này rồi");
                $suDungDichVuDon = $query->update([
                    "NgayDangKy"=>now()
                ]);
            }
            else
            {
                $suDungDichVuDon = SuDungDichVuDon::create([
                        "MaSV"=>$user->MaSV,
                        "MaDichVu"=>$dichVu->MaDichVu,
                        "DangSuDung"=>0,
                        "NgayDangKy"=>now()                             
                ]);
            }
            StaffNotification::build(Type::INFO,"Yêu cầu đăng ký dịch vụ cá nhân mới",
                                "$user->MaSV - $user->Ho $user->Ten đăng ký dịch vụ $dichVu->TenDichVu",
                            Role::CanBoQuanLyDichVu,"admin/dichvu/dich-vu-ca-nhan");
            return ResponseJson::success(data:$suDungDichVuDon);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Call::TryCatchResponseJson(function()use($id){
            $user = auth()->user();
            $dichVu = DichVu::find($id);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại");
            if($dichVu->DangSuDung == true)
                return ResponseJson::error("Dịch vụ đã được xét duyệt, bạn không thể hủy, vui lòng đển gặp nhân viên kí túc xá để hủy");            
            $query = SuDungDichVuDon::where("MaDichVu",$dichVu->MaDichVu)
                                    ->where("MaSV",$user->MaSV);
            $suDungDichVuDon = $query->first();
            if(!isset($suDungDichVuDon))            
                return ResponseJson::error("Bạn chưa gửi đăng ký sử dụng dịch vụ này");                            
            $query->delete();
            return ResponseJson::success("Hủy đăng ký dịch vụ thành công");
        });
    }
}
