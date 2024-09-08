<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\SinhVien;
use App\Models\SuDungDichVuDon;
use App\Services\Notification;
use App\Services\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicePersonalAdminApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return ResponseJson::success(data:$request->filter);
        return Call::TryCatchResponseJson(function() use($request){ 
            $filter = $request->filter;
            $data = SuDungDichVuDon::select(
                "SuDungDichVuDon.*",                        
                "DichVu.TenDichVu",                        
                "DichVu.GiaHienTai",                        
                "SinhVien.Ho as HoSV",
                "SinhVien.Ten as TenSV",
                "Phong.Ma as MaPhong",
                "Phong.Ten as TenPhongCu",
            )
            ->join("DichVu","DichVu.MaDichVu","=","SuDungDichVuDon.MaDichVu")            
            ->join("SinhVien","SuDungDichVuDon.MaSV","=","SinhVien.MaSV")            
            ->join("Phong","SinhVien.MaPhong","=","Phong.Ma");            
            if(!isset($filter) || $filter["tatCa"]=="true")
                return ResponseJson::success(data:$data->paginate(config("app.PER_PAGE",10)));
            $data = $data->join("Tang","Phong.MaTang","=","Tang.Ma")
                ->join("Khu","Tang.MaKhu","=","Khu.Ma");
            if ($filter["khu"] != null)
            {
                $data=$data->where('Khu.Ma',"=",$filter["khu"]);
                if ($filter["tang"] != null)
                {
                    $data=$data->where('Tang.Ma',"=",$filter["tang"]);
                    if ($filter["phong"] != null)
                        $data=$data->where('Phong.Ma',"=",$filter["phong"]);
                }
            }                                        
            if ($filter["thangHienTai"] == "false")
            {                                  
                $data=$data->where(DB::raw('YEAR(SuDungDichVuDon.NgayDangKy)'),$filter["nam"]);
                if ($filter["thang"] != 0)
                    $data=$data->where(DB::raw('MONTH(SuDungDichVuDon.NgayDangKy)'),$filter["thang"]);               
            }
            else
            {
                $today = Carbon::now(); 
                $data=$data->where(DB::raw('YEAR(SuDungDichVuDon.NgayDangKy)'),$today->year)
                            ->where(DB::raw('MONTH(SuDungDichVuDon.NgayDangKy)'),$today->month);
            }
            if($filter["dangSuDung"] != $filter["choXetDuyet"])             
                $data=$data->where("SuDungDichVuDon.DangSuDung","=",$filter["dangSuDung"] == "true");          
            return ResponseJson::success(data:$data->paginate(config("app.PER_PAGE",10)));
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(string $maDichVu,string $maSV)
    {
        return Call::TryCatchResponseJson(function() use($maSV,$maDichVu){  
            $sinhVien = SinhVien::find($maSV);
            if(!isset($sinhVien))
                return ResponseJson::error("Mã sinh viên không tồn tại"); 
            $dichVu = DichVu::find($maDichVu);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại");  
            $query = SuDungDichVuDon::where("MaDichVu",$maDichVu)
                                    ->where("MaSV",$maSV);
            $suDungDichVuDon = $query->first();
            if(isset($suDungDichVuDon))
            {
                if($suDungDichVuDon->DangSuDung == true)
                    return ResponseJson::error("Bạn đang sử dụng dịch vụ này rồi");
                $suDungDichVuDon = $query->update([
                    "DangSuDung"=>true
                ]);
                Notification::build(Type::SUCCESS,"Đăng ký dịch vụ thành công",
                                "Bạn đã đăng ký thành công dịch vụ $dichVu->MaDichVu - $dichVu->TenDichVu, $dichVu->GiaHienTai"."đ",
                                $sinhVien->MaSV);
                return ResponseJson::success("Đã kích hoạt sử dụng dịch vụ cho sinh viên");
            }           
            // return ResponseJson::success(data:$maSV); 
            return ResponseJson::error("Sinh viên này không có đăng ký sử dụng dịch vụ này");            
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $maDichVu,string $maSV)
    {
        return Call::TryCatchResponseJson(function() use($maSV,$maDichVu){ 
            $sinhVien = SinhVien::find($maSV);
            if(!isset($sinhVien))
                return ResponseJson::error("Mã sinh viên không tồn tại");
            $dichVu = DichVu::find($maDichVu);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại");  
            $query = SuDungDichVuDon::where("MaDichVu",$maDichVu)
                                    ->where("MaSV",$maSV);
            $suDungDichVuDon = $query->first();
            if(!isset($suDungDichVuDon))
                return ResponseJson::error("Sinh viên này không có đăng ký sử dụng dịch vụ này");  
            $content ="Bạn đã bị hủy đăng ký sử dụng dịch vụ $dichVu->MaDichVu - $dichVu->TenDichVu";
            if($dichVu->DangSuDung)
            {
                $title="Bạn đã bị hủy bỏ 1 dịch vụ";
                $content = $content.", nếu có sai sót, vui lòng phản hồi lại với nhân viên của ký túc xá";
                $type = Type::INFO;
            }
            else
            {
                $title = "Đăng ký dịch vụ thất bại";
                $type = Type::FAILED;
            }
            $query->delete();            
            Notification::build($type,$title,$content,$sinhVien->MaSV);
            return ResponseJson::success("Hủy sử dụng dịch vụ thành công");
        });
    }
}
