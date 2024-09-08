<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TangApiController extends Controller
{
    public function getFloorByArea($maKhu)
    {
        try
        {
            $tangs = DB::table('Tang')
            ->where('MaKhu','=',$maKhu)
            ->get();
            return response()->json(
                [
                    'success'=>true,
                    'data'=>$tangs
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
