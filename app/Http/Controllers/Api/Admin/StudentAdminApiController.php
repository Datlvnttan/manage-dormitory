<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\SinhVien;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentAdminApiController extends Controller
{
    public function getStudents(Request $request)
    {
        try
        {    
            $curentIndex = ($request->page - 1)*config('app.PAGE_NUMBER_MAX');
            $data = DB::table('SinhVien')
                    ->select(
                        "SinhVien.*",  
                        "DangKyNoiTru.TrangThai as TrangThaiDangKy"                     
                    )
                    ->leftJoin("DangKyNoiTru","SinhVien.MaSV","=","DangKyNoiTru.MaSV");                                            
            if($request->tatCa==true)
                return response()->json([
                    'success'=>true,
                    'data'=>$data->skip($curentIndex)
                                ->take(config('app.PAGE_NUMBER_MAX'))->get(),
                    'numpages' => ceil(SinhVien::all()->count()/config('app.PAGE_NUMBER_MAX'))                       
                    ]);
            $trangThai = [];
            if($request->dangO==true)
            {
                $trangThai[] = "Đang ở";
                $data = $data->leftJoin("Phong","Phong.Ma","=","SinhVien.MaPhong")
                        ->leftJoin("Tang","Phong.MaTang","=","Tang.Ma")
                        ->leftJoin("Khu","Tang.MaKhu","=","Khu.Ma");
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
            }                                                             
            if ($request->chuaDangKy)
                $trangThai[] = "Chưa đăng ký";
            if ($request->tamVang)
                $trangThai[] = "Tạm vắng";
            if ($request->biCam)
                $trangThai[] = "Bị cấm";
            $data = $data ->orWhereIn('SinhVien.TrangThai', $trangThai);
            $trangThai = [];
            if ($request->daXetDuyet)
                $trangThai[] = "Đã xét duyệt";
            if ($request->choXetDuyet)
                $trangThai[] = "Chờ xét duyệt";
            if ($request->biHuy)
                $trangThai[] = "Bị hủy";
            $data = $data ->orWhereIn('DangKyNoiTru.TrangThai', $trangThai);
            $numpages = ceil($data->count()/config('app.PAGE_NUMBER_MAX'));
            return response()->json([
                'success'=>true,
                'data'=>$data->skip($curentIndex)
                            ->take(config('app.PAGE_NUMBER_MAX'))->get(),  
                'numpages'=>$numpages,                                   
            ]);
        }catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>"Đã xảy ra lỗi".$e->getMessage()
            ]);
        }     
    }
    public function getStudentByRoom(Request $request)
    {       
        
        try
        {
            $sinhViens = SinhVien::select(
                [
                    "AnhDaiDien",
                    "MaSV",
                    "Ho",
                    "Ten",
                    "Lop",
                    "SoDienThoai",
                    "Email",
                    "TrangThai"
                ]
            )->where("MaPhong","=",$request->MaPhong)
            ->get(); 
            return response()->json(
                [
                    'success'=>true,
                    'data'=>$sinhViens
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
    public function show($maSinhVien)
    {
        return Call::TryCatchResponseJson(function() use($maSinhVien){
            $sinhVien = SinhVien::find($maSinhVien);    
            if(!isset($sinhVien))
                return ResponseJson::error("Mã sinh viên không tồn tại");
            return ResponseJson::success(data:$sinhVien);
        });
    }
}
