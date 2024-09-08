<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\InfingeRequest;
use App\Models\ViPham;
use Illuminate\Http\Request;

class InfringeAdminApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        return Call::TryCatchResponseJson(function()use($request){  
            if($request->tatca == null && $request->mucdonghiemtrong == null)
                return ResponseJson::success(data:ViPham::all());  
            if($request->tatca==true)
            {
                $data = ViPham::whereNull("deleted_at");                            
            }
            else
                $data = ViPham::where("MucDoNghiemTrong",$request->mucdonghiemtrong)->whereNull("deleted_at");
            return ResponseJson::success(data:$data->paginate(config("app.PER_PAGE",10)));
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Call::TryCatchResponseJson(function() use ($request){
            $noiDung = trim($request->NoiDung);
            if(!isset($noiDung) || $noiDung == "")
                return ResponseJson::error("Nội dung vi phạm không được để trống");
            $mucDoNghiemTrong = trim($request->MucDoNghiemTrong);
            if(!isset($mucDoNghiemTrong) || $mucDoNghiemTrong == "")
                return ResponseJson::error("Mức độ nghiệm trọng không được để trống");
            if(!is_numeric($mucDoNghiemTrong))
                return ResponseJson::error("Mức độ nghiệm trọng phải là kiểu số nguyên");
            if(intval($mucDoNghiemTrong) < 1)
                return ResponseJson::error("Mức độ nghiệm trọng phải lớn hơn 0");
            if(intval($mucDoNghiemTrong) > 10)
                return ResponseJson::error("Mức độ nghiệm trọng không được lớn hơn 10");
            $countViPham = ViPham::withTrashed()->count();
            $maViPham = "";
            do 
            {
                $maViPham = "VP00".strval(++$countViPham);
            } while(ViPham::withTrashed()->find($maViPham) != null);
            $viPham = ViPham::create([
                'MaViPham'=>$maViPham,
                'NoiDung'=>$request->NoiDung,
                'MucDoNghiemTrong'=>$request->MucDoNghiemTrong,
            ]);
            return ResponseJson::success(data:$viPham);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $maViPham)
    {        
        return Call::TryCatchResponseJson(function() use ($maViPham){
            return ResponseJson::success(data:ViPham::find($maViPham));
        });
    }    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $maViPham)
    {
        return Call::TryCatchResponseJson(function() use ($maViPham,$request){
            $viPham = ViPham::find($maViPham);
            if(!isset($viPham))
                return ResponseJson::error("Mã vi phạm không tồn tại");          
            $noiDung = trim($request->NoiDung);
            if(!isset($noiDung) || $noiDung == "")
                return ResponseJson::error("Nội dung vi phạm không được để trống");
            $mucDoNghiemTrong = trim($request->MucDoNghiemTrong);
            if(!isset($mucDoNghiemTrong) || $mucDoNghiemTrong == "")
                return ResponseJson::error("Mức độ nghiệm trọng không được để trống");
            if(!is_numeric($mucDoNghiemTrong))
                return ResponseJson::error("Mức độ nghiệm trọng phải là kiểu số nguyên");
            if(intval($mucDoNghiemTrong) < 1)
                return ResponseJson::error("Mức độ nghiệm trọng phải lớn hơn 0"); 
            $viPham->NoiDung = $noiDung;
            $viPham->MucDoNghiemTrong = $mucDoNghiemTrong;
            $viPham->save();                                    
            return ResponseJson::success(data:$viPham);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $maViPham)
    {
        return Call::TryCatchResponseJson(function() use ($maViPham){
            $viPham = ViPham::find($maViPham);
            if(!isset($viPham))
                return ResponseJson::error("Mã vi phạm không tồn tại"); 
            $viPham->delete();
            return ResponseJson::success("Xóa vi phạm thành công");
        });
    }
}
