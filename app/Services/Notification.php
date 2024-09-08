<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Models\LoaiThongBao;
use App\Models\ThongBaoSinhVien;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use Carbon\Carbon;

class Notification
{

    // 'success'
    // 'failed'
    // 'remind' : nhắc nhở
    // 'warning' : cảnh cáo
    // 'info'

    public static function build($type,?string $title,$content,?string $receiver = null,?string $uri = null)
    {
        $loaiThongBao = Type::getType($type);
        if(!isset($loaiThongBao))
            return false;   
        if($title == null)
            $title=$loaiThongBao->Loai;   
        return ThongBaoSinhVien::create([
            "KhoaLoaiThongBao"=>$type,
            "NguoiNhan"=>$receiver,
            "TieuDe"=>$title,
            "NoiDung"=>$content,            
            "Uri"=>$uri,
            "DaXem"=>0,
            "NgayTao"=>now()
        ]);        
    }        
}

