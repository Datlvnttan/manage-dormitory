<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\ThongBaoNhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationAdminApiController extends Controller
{
    public function index()
    {
        return Call::TryCatchResponseJson(function(){
            $user = Auth::guard("admin-api")->user();
            $notifications = ThongBaoNhanVien::leftJoin("roles","roles.id","=","ThongBaoNhanVien.role_id")
                                            ->whereNull("role_id")
                                            ->orWhere("roles.id","=",$user->role_id)
                                            ->orWhere("roles.priority",">",$user->role->priority)
                                            ->orderByDesc("NgayTao")
                                            ->get();
            return ResponseJson::success(data:$notifications);
        });                                            
    }
}
