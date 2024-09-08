<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeRoomRequest;
use App\Models\DangKyChuyenPhong;
use App\Services\Notification;
use App\Services\Type;
use Carbon\Carbon;
use Illuminate\Http\filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangeRoomApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChangeRoomRequest $request)
    {
        // return ResponseJson::success(data:$request->filter);
        return Call::TryCatchResponseJson(function() use($request){ 
            $filter = $request->filter;
            $data = DangKyChuyenPhong::select(
                "DangKyChuyenPhong.*",                        
                "SinhVien.Ho as HoSV",
                "SinhVien.Ten as TenSV",
                // "PhongHienTai.Ma as MaPhongHienTai",
                // "PhongHienTai.Ten as TenPhongHienTai",
                "PhongMoi.Ten as TenPhongMoi",
                "PhongCu.Ten as TenPhongCu",
            )
            ->join("SinhVien","DangKyChuyenPhong.MaSV","=","SinhVien.MaSV")
            // ->join("Phong as PhongHienTai","SinhVien.MaPhong","=","PhongHienTai.Ma")
            ->join("Phong as PhongCu","DangKyChuyenPhong.MaPhongCu","=","PhongCu.Ma")
            ->join("Phong as PhongMoi","DangKyChuyenPhong.MaPhongMoi","=","PhongMoi.Ma");
            // return ResponseJson::success(data:$data->get());            
            if(!isset($filter) || $filter["tatCa"]=="true")
                return ResponseJson::success(data:$data->paginate(config("app.PER_PAGE",10)));
            // return ResponseJson::success(data:$data->get()); 
                $data = $data->join("Tang","PhongCu.MaTang","=","Tang.Ma")
                    ->join("Khu","Tang.MaKhu","=","Khu.Ma");
            if (isset($filter["khu"]))
            {
                $data=$data->where('Khu.Ma',"=",$filter["khu"]);
                if (isset($filter["tang"]))
                {
                    $data=$data->where('Tang.Ma',"=",$filter["tang"]);
                    if (isset($filter["phong"]))
                        $data=$data->where('PhongCu.Ma',"=",$filter["phong"]);
                }
            }                                        
            if ($filter["thangHienTai"] == "false")
            {                                  
                $data=$data->where(DB::raw('YEAR(DangKyChuyenPhong.NgayDangKy)'),$filter["nam"]);
                if ($filter["thang"] != 0)
                    $data=$data->where(DB::raw('MONTH(DangKyChuyenPhong.NgayDangKy)'),$filter["thang"]);               
            }
            else
            {
                $today = Carbon::now(); 
                $data=$data->where(DB::raw('YEAR(DangKyChuyenPhong.NgayDangKy)'),$today->year)
                            ->where(DB::raw('MONTH(DangKyChuyenPhong.NgayDangKy)'),$today->month);
            }

            $trangThaiXetDuyet = [];
            if ($filter["choXetDuyet"] == "true")
                $trangThaiXetDuyet[] = "Chờ xét duyệt";
            if (isset($filter["thanhCong"]) && $filter["thanhCong"] == "true")
                $trangThaiXetDuyet[] = "Thành công";
            if ( isset($filter["thatBai"]) && $filter["thatBai"] == "true")
                $trangThaiXetDuyet[] = "Thất bại";
            $data = $data->whereIn('TrangThaiXetDuyet', $trangThaiXetDuyet);   
            if(isset($request->paginate) && $request->paginate == false)
                $data = $data->get();
            else
                $data = $data->paginate(config("app.PER_PAGE",10));     
            return ResponseJson::success(data:$data);
        });
    }

    public function agreeRegister($maDangKy)
    {
        return Call::TryCatchResponseJson(function()use($maDangKy){ 
            return $this->updateStatusRegister($maDangKy,"Thành công");
        });        
    }
    public function cancelRegister($maDangKy)
    {
        return Call::TryCatchResponseJson(function()use($maDangKy){
            return $this->updateStatusRegister($maDangKy,"Thất bại");
        });        
    }
    private function updateStatusRegister($maDangKy,$status)
    {
        $dangKyChuyenPhong = DangKyChuyenPhong::find($maDangKy);
            if(!isset($dangKyChuyenPhong))
                return ResponseJson::error("Mã đăng ký không tồn tại");
            if($dangKyChuyenPhong->TrangThaiXetDuyet != "Chờ xét duyệt")                
                return ResponseJson::error("Đăng ký này đã xét duyệt trước đó");
            $dangKyChuyenPhong->TrangThaiXetDuyet = $status;
            $dangKyChuyenPhong->save();
            if($status == true)
            {
                Notification::build(Type::SUCCESS,"Chuyển phòng thành công","Đăng ký chuyển phòng của bạn đã được xét duyệt",$dangKyChuyenPhong->MaSV);
            }
            else
                Notification::build(Type::FAILED,"Chuyển phòng thất bại","Đăng ký chuyển phòng của bạn đã bị hủy bỏ",$dangKyChuyenPhong->MaSV);
        return ResponseJson::success(data:$dangKyChuyenPhong);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $filter)
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
    public function update(Request $filter, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
