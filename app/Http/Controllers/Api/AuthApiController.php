<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Call;
use App\Helpers\ResponseJson;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Services\MailService;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class AuthApiController
{
    public function login(LoginRequest $request)
    {              
        if (! $token = AuthService::login($request->TenDangNhap,$request->MatKhau,$request->DangNhapAdmin)) {
            return ResponseJson::error("Unauthorized",401);
        }
        return $this->respondWithToken($token,$request->DangNhapAdmin ? "admin-api":"user-api");
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token,$guard)
    {
        $res = [
            "success"=>true,
            "data"=>[
                'url' => Session::pull(config("app.URL_INTENDED",'url_intended')) ?? "/",  
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL()
            ]
            ];
        $response = new Response($res);
        //$response->withCookie(cookie(config("app.TOKEN_AUTH","token_auth"), $token, auth()->factory()->getTTL()*60));
        return $response->cookie("token",$token,auth($guard)->factory()->getTTL());
        // return ResponseJson::success(data:[
        //     'access_token' => $token,
        //     'token_type' => 'bearer',
        //     'expires_in' => auth()->factory()->getTTL()
        // ]);
    }

    public function register(Request $request)
    {
        return Call::TryCatchResponseJson(function() use ($request){
            return AuthService::register($request);
        });
    }
    public function verifyEmail($id, string $token)
    {
        if(MailService::verificaEmail($id,$token))
            return view("auth.verifica_email_success");         
        return view("auth.verifica_email_fail"); 
    }
    
}
