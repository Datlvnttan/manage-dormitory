<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\ChiTietHoaDon;
use App\Models\DichVu;
use App\Models\HoaDon;
use App\Models\Phong;
use App\Services\Notification;
use App\Services\Type;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


//này có cái biến admin1
class BillApiController extends Controller
{
    public function getBills(Request $request)
    {        
       return Call::TryCatchResponseJson(function()use($request){            
            $curentIndex = ($request->page - 1)*config('app.PAGE_NUMBER_MAX');                          
            if($request->tatCa==true)
                return response()->json([
                    'success'=>true,
                    'data'=>DB::table('HoaDon')->skip($curentIndex)
                            ->take(config('app.PAGE_NUMBER_MAX'))->get(),
                    'numpages' => ceil(HoaDon::all()->count()/config('app.PAGE_NUMBER_MAX')) ,                          
                    ]);
            $data = DB::table('HoaDon')
                    ->select(
                        "HoaDon.*"
                    )
                    ->join("Phong","HoaDon.MaPhong","=","Phong.Ma")
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
                $data=$data->where(DB::raw('YEAR(HoaDon.NgayTao)'),$request->nam);
                if ($request->thang != 0)
                    $data=$data->where(DB::raw('MONTH(HoaDon.NgayTao)'),$request->thang);               
            }
            else
            {
                $today = Carbon::now(); 
                $data=$data->where(DB::raw('YEAR(HoaDon.NgayTao)'),$today->year)
                            ->where(DB::raw('MONTH(HoaDon.NgayTao)'),$today->month);
            }           
            $trangThai = [];
            if ($request->daThanhToan)
                $trangThai[] = "Đã thanh toán";
            if ($request->chuaThanhToan)
                $trangThai[] = "Chưa thanh toán";
            if ($request->khongChinhXac)
                $trangThai[] = "Không chính xác";
            $data = $data 
                    ->whereIn('TrangThai', $trangThai);
            if(isset($request->paginate)&&$request->paginate==false)
                $data = $data->get();
            else
                $data = $data->skip($curentIndex)->take(config('app.PAGE_NUMBER_MAX'))->get();
            $numpages = ceil($data->count()/config('app.PAGE_NUMBER_MAX'));                          
            
            return response()->json([
                'success'=>true,
                'data'=>$data,  
                'numpages'=>$numpages                        
            ]);
       
        });                   
    }
    public function billDetails(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){        
            $hoaDon = HoaDon::select("HoaDon.*","Phong.Ten as TenPhong")
                            ->join("Phong","Phong.Ma","=","HoaDon.MaPhong")
                            ->where("MaHoaDon","=",$request->MaHoaDon)->first();
            $chiTietHoaDon = DB::table("ChiTietHoaDon")
                    ->select(
                            "ChiTietHoaDon.*",
                            "DichVu.TenDichVu")
                    ->join("DichVu","DichVu.MaDichVu","ChiTietHoaDon.MaDichVu")
                    ->where("MaHoaDon","=",$request->MaHoaDon)
                    ->get();
            return ResponseJson::success(data:[
                "hoadon"=>$hoaDon,
                "chitiethoadon"=>$chiTietHoaDon
            ]);
        });        
    }
    public function billPayment(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){  
            $hoaDon = HoaDon::find($request->MaHoaDon);
            if(!isset($hoaDon))     
                return ResponseJson::error("Mã hóa đơn không tồn tại");
            if($hoaDon->TrangThai == "Đã thanh toán")     
                return ResponseJson::error("Hóa đơn này đã thanh toán rồi");
            if($hoaDon->TrangThai == "Không chính xác")     
                return ResponseJson::error("Hóa đơn này đã bị báo cáo không chính xác");
            $hoaDon->TrangThai = "Đã thanh toán";
            $hoaDon->save();            
            $phong = Phong::find($hoaDon->MaPhong);
            $ngayTao = Carbon::parse($hoaDon->NgayTao);
            Notification::build(Type::SUCCESS,"Hoàn tất thanh toán hóa đơn tháng $ngayTao->month, năm $ngayTao->year",
                "Hóa đơn '$hoaDon->MaHoaDon' đã được thanh toán",            
                $phong->TruongPhong,"user/quanlyhoadon/$hoaDon->MaHoaDon");
        return ResponseJson::success("Thanh toán hóa đơn thành công");
        });          
    }

    public function billCreate(Request $request)
    {        
        return Call::TryCatchResponseJson(function()use($request){                          
            $maPhong = trim($request->input('phong'));
            $phong = Phong::find($maPhong);
            if(!isset($phong))
                return ResponseJson::error("Mã phòng không tồn tại");
            $today = Carbon::now(); 
            $hoaDon = HoaDon::where(DB::raw('YEAR(HoaDon.NgayTao)'),$today->year)
                ->where(DB::raw('MONTH(HoaDon.NgayTao)'),$today->month)
                ->where("MaPhong",$maPhong)->first();
            if(isset($hoaDon))
                return ResponseJson::error("Phòng này đã tạo hóa đơn trong tháng này!!!");
            $sl = DB::table("HoaDon")
            ->where("MaPhong","=",$request->input('phong'))
            ->count();
            $maHoaDonMoi = "";
            do
            {
                $maHoaDonMoi = "HD".$maPhong.str(++$sl);
            } while(HoaDon::where("MaHoaDon",$maHoaDonMoi)->first());
            $ngayTao = Carbon::now();
            $hoaDon = HoaDon::create([
                'MaHoaDon'=>$maHoaDonMoi,
                'MaPhong'=>$request->input('phong'),
                'NgayTao'=>$ngayTao,
                'ThanhTien'=>0,
                'TrangThai'=>"Chưa thanh toán",
                'NguoiTao'=>'admin1'
            ]);
            $dichVuBatBuoc = DichVu::where('BatBuoc','=','1')
                                    ->get();              
            foreach($dichVuBatBuoc as $item)
            {
                $sl =  intval($request->input("Sl".$item->MaDichVu));
                ChiTietHoaDon::create([
                    'MaHoaDon' => $maHoaDonMoi,
                    'MaDichVu' => $item->MaDichVu,
                    'DonGia' => $item->GiaHienTai,
                    'SoLuong' => $sl,
                ]);                
            }  
            $hoaDon = HoaDon::find($maHoaDonMoi);
            $today = now();
            Notification::build(Type::INFO,"Hóa đơn tháng ".$today->month." năm $today->year, phòng $phong->Ten",
                                "Thành tiền: $hoaDon->ThanhTien, xem chi tiết hóa đơn $maHoaDonMoi",
                                $phong->TruongPhong,"user/quanlyhoadon/$maHoaDonMoi");
            return ResponseJson::success(data:$hoaDon);          
        });                                       
    }

    public function billDetailsSingleService(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $data = DB::table("ChiTietHoaDon")
            ->select(
                "TenDichVu",
                "DonGia",
                "SoLuong"
            )
            ->join("DichVu","DichVu.MaDichVu","=","ChiTietHoaDon.MaDichVu")            
            ->where("MaHoaDon",$request->MaHoaDon)
            ->where("BatBuoc",0)->get(); 
            return ResponseJson::success(data:$data);
        });         
    }
    
    public function billDetailsForceService(Request $request)
    {
        return Call::TryCatchResponseJson(function()use($request){
            $status = 1;
            if(strcmp(HoaDon::where("MaHoaDon",$request->MaHoaDon)
                    ->first()->TrangThai,"Không chính xác")!=0)
                    $status = 0;
            $data = DB::table("ChiTietHoaDon")
            ->select(
                "ChiTietHoaDon.MaDichVu",
                "TenDichVu",
                "DonGia",
                "SoLuong",
                "ChiSoHienTai",
                "TinhTheoChiSo"                
            )
            ->join("HoaDon","HoaDon.MaHoaDon","=","ChiTietHoaDon.MaHoaDon")
            ->join("DichVu","DichVu.MaDichVu","=","ChiTietHoaDon.MaDichVu")            
            ->leftJoin('DichVuPhongCoChiSo', function ($join) {
                $join->on('ChiTietHoaDon.MaDichVu', '=', 'DichVuPhongCoChiSo.MaDichVu')
                    ->on('HoaDon.MaPhong', '=', 'DichVuPhongCoChiSo.MaPhong');
            })            
            ->where("HoaDon.MaHoaDon",$request->MaHoaDon)
            ->where("BatBuoc",1)->get();  
            return ResponseJson::status($status,data:$data);              
        });        
    }
    public function billEdit(Request $request,$maHoaDon)
    {
        return Call::TryCatchResponseJson(function()use($request,$maHoaDon){
            $hoaDon = HoaDon::find($maHoaDon);
            if(!isset($hoaDon))
                return ResponseJson::error("Mã hóa đơn không tồn tại");
            $chiTietHoaDons = ChiTietHoaDon::join("DichVu","DichVu.MaDichVu","=","ChiTietHoaDon.MaDichVu")
                                    ->where('MaHoaDon','=',$maHoaDon)
                                    ->where("BatBuoc",1)
                                    ->cursor();  
            $hoaDon->TrangThai = "Chưa thanh toán";           
            $hoaDon->save();
            foreach($chiTietHoaDons as $item)
            {
                $sl =  intval($request->input("Sl".trim($item->MaDichVu)));                              
                ChiTietHoaDon::where('MaHoaDon','=',$maHoaDon)
                            ->where('MaDichVu', $item->MaDichVu)
                            ->update(['SoLuong' => $sl]);                                 
            }   
            $phong = Phong::find($hoaDon->MaPhong);
            Notification::build(Type::INFO,"Phản hồi báo cáo hóa đơn $hoaDon->MaHoaDon",
                "Báo cáo hóa đơn '$hoaDon->MaHoaDon' của bạn đã được xem xét, thông tin hóa đơn đã được cập nhật chỉnh sửa",            
                $phong->TruongPhong,"user/quanlyhoadon/$hoaDon->MaHoaDon");                    
            return ResponseJson::success(data:$hoaDon);
        });                                                             
    }
    public function reportBillCancel($maHoaDon)
    {
        //return ResponseJson::success(data:$request->all());
        return Call::TryCatchResponseJson(function()use($maHoaDon){
            $hoaDon = HoaDon::find($maHoaDon);
            if(!isset($hoaDon))
                return ResponseJson::error("Mã hóa đơn không tồn tại");
            if($hoaDon->TrangThai != "Không chính xác")
                return ResponseJson::error("Hóa đơn này không bị báo cáo");
            $hoaDon->TrangThai = "Chưa thanh toán";
            $hoaDon->save();
            $phong = Phong::find($hoaDon->MaPhong);
            Notification::build(Type::INFO,"Phản hồi báo cáo hóa đơn $hoaDon->MaHoaDon",
                                "Báo cáo hóa đơn của bạn đã bị hủy bỏ, chúng tôi đã xác thực rằng không có thông tin sai sót",
                                $phong->TruongPhong,"user/quanlyhoadon/$hoaDon->MaHoaDon");
            return ResponseJson::success("Hủy bỏ báo cáo hóa đơn '$maHoaDon' thành công");

        });  
    }  
}
