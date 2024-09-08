<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Controllers\RespositoryControllers\RoleRepositoryController;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleApiController extends RoleRepositoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Call::TryCatchResponseJson(function(){
            return ResponseJson::success(data:Role::where("priority","<>",1)->get());            
        });
    }
}
