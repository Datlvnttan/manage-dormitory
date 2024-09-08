<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Khu;
use Exception;
use Illuminate\Http\Request;

class KhuApiController extends Controller
{
    public function getAreaList()
    {
        try
        {            
            return response()->json(
                [
                    'success'=>true,
                    'data'=>Khu::all()
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
}
