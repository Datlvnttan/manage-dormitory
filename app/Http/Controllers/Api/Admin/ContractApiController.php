<?php

namespace App\Http\Controllers\Api\admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\HopDong;
use App\Services\Notification;
use App\Services\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractApiController extends Controller
{
    public function getContract(Request $request)
    {
        return Call::TryCatchResponseJson(function()use ($request) {
            $ds_trangThai = $request->ds_trangThai;
            $hopdongs = DB::table('HopDong');
            foreach ($ds_trangThai as $trangThai) 
                $hopdongs->orWhere("TrangThai",'=',$trangThai);        
            $hopdongs=$hopdongs->paginate(config('app.PER_PAGE'));
            return ResponseJson::success(data:$hopdongs);
        });        

    }
    public function details(Request $request)
    {
        try
        {        
        $hopdong = HopDong::where("MaHopDong","=",$request->MaHopDong)->first();;   
        return response()->json([
            'success'=>true,
            'data'=>$hopdong,            
        ]);
        }catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>"Đã xảy ra lỗi"
            ]);
        }
    }
    public function contractPayment(Request $request) {
        try
        {   
            $hopDong = HopDong::find($request->MaHopDong);
            if(!isset($hopDong))
                return ResponseJson::error("Mã hợp đồng không tồn tại");
            if($hopDong->DaThanhToan == true)
                return ResponseJson::error("Hợp đồng đã thanh toán trước đó");
            if($hopDong->TrangThai =="Hết hiệu lực")
                return ResponseJson::error("Hợp đồng đã hết hiệu lực, không thể thanh toán");
            if($hopDong->TrangThai =="Xin gia hạn")
            {
                $hopDong->DaGiaHanTrongDot = true;
                $title = "Gia hạn hợp đồng thành công";
                $content = "Thanh toán và gia hạn thành công hợp đồng $hopDong->MaHopDong";
            }
            else
            {
                $title = "Hợp đồng của bạn đã được thanh toán";
                $content = "Xin chúc mừng bạn đã trở thành thành viên của ký túc xá";
            }
            Notification::build(Type::SUCCESS,$title,$content,$hopDong->MaSV,"user/hopdong");
            $hopDong->DaThanhToan = true;            
            $hopDong->save();            
        return response()->json([
            'success'=>true,
            'message'=>"Thao tác thành công, hợp đồng đã có hiệu lực",            
        ]);
        }catch(Exception $e)
        {
            return response()->json([
                'success'=>false,
                'message'=>"Đã xảy ra lỗi"
            ]);
        }        
    }
}
