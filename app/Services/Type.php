<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Models\LoaiThongBao;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use Carbon\Carbon;

class Type
{
    // 'success'
    // 'failed'
    // 'remind' : nhắc nhở
    // 'warning' : cảnh cáo
    // 'info'
    const SUCCESS = "success";
    const FAILED = "failed";
    const REMIND = "remind";
    const WARNING = "warning";
    const INFO = "info";
    const REPORT = "report";
    public static function getType($type)
    {
        return LoaiThongBao::find($type);        
    }        
}

