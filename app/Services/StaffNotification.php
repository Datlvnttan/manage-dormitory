<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Models\LoaiThongBao;
use App\Models\Role;
use App\Models\ThongBaoNhanVien;
use App\Models\ThongBaoSinhVien;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use Carbon\Carbon;

class StaffNotification
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
        $role = Role::where("role_name",$receiver)->first();
        return ThongBaoNhanVien::create([
            "KhoaLoaiThongBao"=>$type,
            "role_id"=>$role->id,
            "TieuDe"=>$title,
            "NoiDung"=>$content,            
            "Uri"=>$uri,            
            "NgayTao"=>now()
        ]);        
    }  
    public static function delete($uri)   
    {
        return ThongBaoNhanVien::where("Uri",$uri)->delete();
    }   
}

