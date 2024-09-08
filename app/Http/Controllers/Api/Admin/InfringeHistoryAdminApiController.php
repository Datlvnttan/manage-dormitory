<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\InfingeHistoryRequest;
use App\Models\SinhVien;
use App\Models\SinhVienViPham;
use App\Models\ViPham;
use App\Services\Notification;
use App\Services\Type;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfringeHistoryAdminApiController extends Controller
{
    public function getInfringeHistory(Request $request)
    {
       
        try
        {    
            $curentIndex = ($request->page - 1)*config('app.PAGE_NUMBER_MAX');
            $data = DB::table('SinhVienViPham')
                    ->select(
                        "SinhVienViPham.*",
                        "SinhVien.Ho",
                        "SinhVien.Ten",
                        "ViPham.NoiDung",                                                
                    )
                    ->join("SinhVien","SinhVien.MaSV","=","SinhVienViPham.MaSV")
                    ->join("ViPham","ViPham.MaViPham","=","SinhVienViPham.MaViPham");                            
            if($request->tatCa==true)
                return response()->json([
                    'success'=>true,
                    'data'=>$data->skip($curentIndex)
                                ->take(config('app.PAGE_NUMBER_MAX'))->get(),
                    'numpages' => ceil(SinhVienViPham::all()->count()/config('app.PAGE_NUMBER_MAX'))                       
                    ]);
            $data = $data->join("Phong","SinhVien.MaPhong","=","Phong.Ma")
                    ->join("Tang","Phong.MaTang","=","Tang.Ma")
                    ->join("Khu","Tang.MaKhu","=","Khu.Ma");
            if ($request->khu != null)
            {
                $data=$data->where('Khu.Ma',"=",$request->khu);
                if ($request->tang != null)
                {
                    $data=$data->where('Tang.Ma',"=",$request->tang);
                    if ($request->phong != null)
                        $data=$data->where('Phong.Ma',"=",$request->phong);
                }
            }                                        
            if (!$request->thangHienTai)
            {                                  
                $data=$data->where(DB::raw('YEAR(SinhVienViPham.ThoiGianViPham)'),$request->nam);
                if ($request->thang != 0)
                    $data=$data->where(DB::raw('MONTH(SinhVienViPham.ThoiGianViPham)'),$request->thang);               
            }
            else
            {
                $today = Carbon::now(); 
                $data=$data->where(DB::raw('YEAR(SinhVienViPham.ThoiGianViPham)'),$today->year)
                            ->where(DB::raw('MONTH(SinhVienViPham.ThoiGianViPham)'),$today->month);
            }
            $trangThai = [];
            if ($request->daXuLy)
                $trangThai[] = "Đã xử lý";
            if ($request->chuaXuLy)
                $trangThai[] = "Chưa xử lý";
            if ($request->khongChinhXac)
                $trangThai[] = "Không chính xác";
            $data = $data 
                    ->whereIn('SinhVienViPham.TrangThai', $trangThai);            
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
                'message'=>"Đã xảy ra lỗi".$e->getMessage()
            ]);
        } 
    }
    public function getInfringeHistoryById($maSV)
    {
        return Call::TryCatchResponseJson(function() use ($maSV){
            $data = SinhVienViPham::select("SinhVienViPham.*","ViPham.NoiDung","ViPham.MucDoNghiemTrong")
                                ->join("ViPham","ViPham.MaViPham","=","SinhVienViPham.MaViPham")
                                ->where("MaSV",$maSV)->get();
            return ResponseJson::success(data:$data);
        });
    }

    public function create(InfingeHistoryRequest $request)
    {
        
        return Call::TryCatchResponseJson(function() use($request){
            $sinhVien = SinhVien::find($request->MaSV);
            if(!isset($sinhVien))
                return ResponseJson::error("Mã sinh viên không tồn tại!");
            $viPham = ViPham::find($request->MaViPham);
            if(!isset($viPham))
                return ResponseJson::error("Mã vi phạm không tồn tại!");
            // return ResponseJson::success(data:$request->HinhPhat);
            $sinhVienViPham = SinhVienViPham::create([
                'MaSV' => $request->MaSV,
                'MaViPham' => $request->MaViPham,
                'HinhPhat' => $request->HinhPhat,
                'NguoiTao' => 'admin1',                                
                'ThoiGianViPham' => Carbon::now(),
                'TrangThai'=>"Chưa xử lý"
            ]);
            Notification::build(Type::INFO,"Biên bản vi phạm",
                    "Bạn đã vi phạm nội dung $viPham->NoiDung, hình phạt: $request->HinhPhat, phẩn hồi với nhân viên nếu có sai sót",
                    $request->MaSV,"user/vipham/lich-su-vi-pham");
            return ResponseJson::success(data:$sinhVienViPham);
        });
    }
    public function accuracy($maSV,$maViPham,$thoiGianViPham)
    {        
        return Call::TryCatchResponseJson(function() use($maSV,$maViPham,$thoiGianViPham){
            $sinhVien = SinhVien::find($maSV);
            if(!isset($sinhVien))
                return ResponseJson::error("Mã sinh viên không tồn tại!");
            $viPham = ViPham::find($maViPham);
            if(!isset($viPham))
                return ResponseJson::error("Mã vi phạm không tồn tại!");
            $query = SinhVienViPham::where("MaSV",$maSV)
                                ->where("MaViPham",$maViPham)
                                ->where("ThoiGianViPham",Carbon::parse($thoiGianViPham));
            $sinhVienViPham = $query->first();                   
            if(!isset($sinhVienViPham))
                return ResponseJson::error("Lỗi vi phạm này không tồn tại!!!");  
            if($sinhVienViPham->TrangThai=="Đã xử lý")
                return ResponseJson::error("Lỗi vi phạm này đã xác nhận xử lý");  
            $sinhVienViPham = $query->update([
                "TrangThai"=>"Chưa xử lý"
            ]);
            Notification::build(Type::FAILED,"Phản hồi không thành công",
                "Phần hồi biên bản vi phạm của bạn không thành công, vui lòng kiểm tra lại, nội dung: $viPham->NoiDung",
                $maSV,"user/vipham/lich-su-vi-pham");
            return ResponseJson::success(data:$sinhVienViPham);
        });
    }
    public function confrim($maSV,$maViPham,$thoiGianViPham)
    {        
        return Call::TryCatchResponseJson(function() use($maSV,$maViPham,$thoiGianViPham){
            $sinhVien = SinhVien::find($maSV);
            if(!isset($sinhVien))
                return ResponseJson::error("Mã sinh viên không tồn tại!");
            $viPham = ViPham::find($maViPham);
            if(!isset($viPham))
                return ResponseJson::error("Mã vi phạm không tồn tại!");
            $query = SinhVienViPham::where("MaSV",$maSV)
                                ->where("MaViPham",$maViPham)
                                ->where("ThoiGianViPham",Carbon::parse($thoiGianViPham));
            $sinhVienViPham = $query->first();                   
            if(!isset($sinhVienViPham))
                return ResponseJson::error("Lỗi vi phạm này không tồn tại!!!");  
            if($sinhVienViPham->TrangThai=="Không chính xác")
                return ResponseJson::error("Lỗi vi phạm này đã bị báo cáo không chính xác");  
            $sinhVienViPham = $query->update([
                "TrangThai"=>"Đã xử lý"
            ]);
            return ResponseJson::success(data:$sinhVienViPham);
        });
    }
}
