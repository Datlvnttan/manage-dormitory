<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\DichVu;
use App\Models\DichVuPhongCoChiSo;
use App\Models\SuDungDichVuDon;
use App\Services\Notification;
use App\Services\Type;
use Illuminate\Http\Request;

class ServiceApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {            
        return Call::TryCatchResponseJson(function()use($request){   
            $filter = $request->filter;
            if($filter["tatCa"] == null || $filter["tatCa"] == "true")
                $data = DichVu::paginate(config("app.PER_PAGE",10));
            else
            {
                $data = DichVu::select("DichVu.*");
                if(isset($filter["batBuoc"]))
                    $data = $data->where("BatBuoc",$filter["batBuoc"] == "true");
                if(isset($filter["tinhTheoChiSo"]))
                    $data = $data->where("TinhTheoChiSo",$filter["tinhTheoChiSo"] == "true");
                $data = $data->paginate(config("app.PER_PAGE",10));
            }
            return ResponseJson::success(data:$data);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {                
        return Call::TryCatchResponseJson(function()use($request){    
            $tenDichVu = $request->TenDichVu;
            $giaHienTai = $request->GiaHienTai;
            // $batBuoc = $request->BatBuoc;
            $tinhTheoChiSo = $request->TinhTheoChiSo;
            if($tinhTheoChiSo == true)
                $batBuoc = true;
            else 
                $batBuoc = $request->BatBuoc ?? false;
            $dichVu = DichVu::where("TenDichVu",$tenDichVu)->first();
            if(isset($dichVu))
                return ResponseJson::errors([
                    "TenDichVu"=>["Tên dịch vụ đã tồn tại"]
                ]);
            $countService = DichVu::count();
            $maDichVuMoi = "";            
            do
            {
                $maDichVuMoi = "DV00".strval(++$countService);
            }while(DichVu::find($maDichVuMoi)!=null);
            $dichVu = DichVu::create([
                'MaDichVu'=>$maDichVuMoi,
                'TenDichVu'=>$tenDichVu,
                'GiaHienTai'=>$giaHienTai,
                'BatBuoc'=>$batBuoc,
                'TinhTheoChiSo'=>$tinhTheoChiSo 
            ]);
            $title = "Dịch vụ".($tinhTheoChiSo ? " phòng" : ($batBuoc ? " bắt buộc":" cá nhân"))." mới";
            $content = "Tên dịch vụ: '$tenDichVu', giá: $giaHienTai"."đ";
            Notification::build(Type::INFO,$title,$content);
            return ResponseJson::success(data:$dichVu);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Call::TryCatchResponseJson(function()use($id){            
            $dichVu = DichVu::find($id);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại");
            return ResponseJson::success(data:$dichVu);
        });
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        return Call::TryCatchResponseJson(function()use($request,$id){                
            $tenDichVu = $request->TenDichVu;
            $giaHienTai = $request->GiaHienTai;                        
            $tinhTheoChiSo = $request->TinhTheoChiSo ?? false;
            if($tinhTheoChiSo == true)
                $batBuoc = true;
            else 
                $batBuoc = $request->BatBuoc ?? false;
            $dichVu = DichVu::find($id);
            if(!isset($dichVu))
                return ResponseJson::errors("Mã dịch vụ không tồn tại");    
            $title = "Cập nhật thông tin dịch vụ '$dichVu->TenDichVu'";  
            $content = "";
            if($dichVu->TenDichVu != $tenDichVu)
            {
                $content = "Đổi tên thành: '$tenDichVu'";
                $dichVu->TenDichVu = $tenDichVu;
            }                                        
            if($dichVu->GiaHienTai != $giaHienTai)
            {
                $dichVu->GiaHienTai = $giaHienTai;
                $content = ($content == "" ? "C" : $content.", c")."ập nhật giá: $giaHienTai"."đ";
            }

            $message =   "Cập nhật thông tin dịch vụ thành công";
            if($dichVu->Khoa)  
            {
                $dichVu->save();
                $message = $message.(($dichVu->BatBuoc != $batBuoc || $dichVu->TinhTheoChiSo != $tinhTheoChiSo) ? ", nhưng bạn chỉ có thể cập nhật thông tin giá và tên của dịch vụ này" : "");
            }  
            else
            {
                if($dichVu->BatBuoc != $batBuoc)
                {
                    $dichVu->BatBuoc = $batBuoc;
                    $content = $content = ($content == "" ? "T" : $content.", t")."rở thành dịch vụ ".($batBuoc ? "bắt buộc":"cá nhân");
                }            
                if($dichVu->TinhTheoChiSo != $tinhTheoChiSo)
                {
                    $dichVu->TinhTheoChiSo = $tinhTheoChiSo;  
                    $content = $content = ($content == "" ? "T" : $content.", t")."ính theo chỉ số";
                }                   
            }                                                
            $dichVu->save();                               
            Notification::build(Type::INFO,$title,$content);
            return ResponseJson::success($message,$dichVu);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Call::TryCatchResponseJson(function()use($id){    
            $dichVu = DichVu::find($id);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại");
            if($dichVu->batbuoc == false)
                SuDungDichVuDon::where("MaDichVu",$id)->delete();            
            else if($dichVu->TinhTheoChiSo == true)
                DichVuPhongCoChiSo::where("MaDichVu",$id)->delete();   
            $tenDichVu = $dichVu->TenDichVu;             
            $dichVu->delete();           
            Notification::build(Type::INFO,"Xóa bỏ dịch vụ $tenDichVu","Dịch vụ $id - $tenDichVu đã bị xóa khỏi ký túc xá");
            return ResponseJson::success("Xóa dịch vụ thành công");
        });
    }
    public function updateObligatory(string $maDichVu,Request $request)
    {        
        return Call::TryCatchResponseJson(function()use($maDichVu,$request){    
            $dichVu = DichVu::find($maDichVu);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại");   
            if($dichVu->Khoa)                                           
                return ResponseJson::error("Dịch vụ này đã khóa cập nhật trường bắt buộc và tính theo chỉ số");
            if($dichVu->BatBuoc != $request->status)   
            {
                $dichVu->BatBuoc = $request->status ?? false;         
                $content = "Trở thành dịch vụ ".($dichVu->BatBuoc ? "bắt buộc" : "cá nhân");
                if($dichVu->BatBuoc == false)                                    
                    $dichVu->TinhTheoChiSo = false;                
            }            
            $dichVu->save();
            $title = "Cập nhật thông tin dịch vụ '$dichVu->TenDichVu'";            
            Notification::build(Type::INFO,$title,$content);
            return ResponseJson::success(data:$dichVu);
        });
    }
    public function updateHasIndex(string $maDichVu,Request $request)
    {
        return Call::TryCatchResponseJson(function()use($maDichVu,$request){    
            $dichVu = DichVu::find($maDichVu);
            if(!isset($dichVu))
                return ResponseJson::error("Mã dịch vụ không tồn tại");   
            if($dichVu->Khoa)                                           
                return ResponseJson::error("Dịch vụ này đã khóa cập nhật trường bắt buộc và tính theo chỉ số"); 
            if($dichVu->TinhTheoChiSo != $request->status)   
            {
                $dichVu->TinhTheoChiSo = $request->status ?? false;    
                $dichVu->BatBuoc = $request->status ?? false;    
                $dichVu->save();
                $content = "Trở thành dịch vụ ".($dichVu->TinhTheoChiSo ? " tính theo chỉ số" : "cá nhân");
                $title = "Cập nhật thông tin dịch vụ '$dichVu->TenDichVu'";            
                Notification::build(Type::INFO,$title,$content);
            }              
            return ResponseJson::success(data:$dichVu);
        });
    }
}
