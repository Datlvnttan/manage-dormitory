<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\SinhVien;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class AuthController extends Controller
{
    public function login(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'MaSV' => 'required|max:10',
            'MatKhau' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=> false, 'error'=>$validator->errors()], 401);
        }       
        $user = SinhVien::where('MaSV', $request->MaSV)->first();
        // return 1;
        if ($user) {
            //$tokenResult = $user->createToken('Personal Access Token');
            if($request->MatKhau){
                if ($request->MatKhau == $user->MatKhau) {  
                    Auth::login($user);                                    
                    return response()->json([
                        'success' =>true,
                        'user' =>$user,                        
                        'message' => 'Đăng nhập thành công',
                        'url'=>session('previous_url') ?? '/',
                    ]);
                } else {
                    return response()->json([
                        'success' =>false,                        
                        'message' => 'Mật khẩu không chính xác!!!',
                    ]);
                }
            }
            return response()->json([
                'success' =>false,                        
                'message' => 'Chưa nhập mật khẩu',
            ]);
        } else {
            $response = ["message" =>'Tài khoản không tồn tại   '];
            return response()->json($response);
        }

    }    
}
