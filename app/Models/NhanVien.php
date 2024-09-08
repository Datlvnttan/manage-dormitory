<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as AuthenticatableModel;
use Illuminate\Support\Facades\DB;

class NhanVien extends AuthenticatableModel implements JWTSubject
{
    use HasFactory, \Illuminate\Auth\Authenticatable;    


    protected $table = 'NhanVien';
    protected $primaryKey   = 'TenDangNhap';
    protected $username = 'TenDangNhap'; 
    // protected $password = 'MatKhau';    
    public $timestamps = false;    

    protected $fillable = [
        'TenDangNhap',
        'Ho',
        'Ten',
        'SoDienThoai',
        'role_id',    
        'MatKhau',    
        'password',        
    ];
    protected $casts = [
        'password' => 'hashed',
        'TenDangNhap' => 'string',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class,"role_id");
    }
    public function getRole()
    {
        return $this->role->role_name;
    }    
    // private $routeInterfaces;
    public function getRouteMenus()
    {                       
        return NhanVien::select("routes.index_location ","routes.route_name","routes.menu_title","routes.icon")->distinct()
            ->join("permission","NhanVien.role_id","=","permission.role_id")            
            ->join("routes","routes.id","=","permission.route_id")
            ->where("NhanVien.TenDangNhap",$this->TenDangNhap)
            ->whereNotNull("routes.menu_title")
            ->orderBy("index_location")->get();           
        // return $this->routeInterfaces;
    }
    
}
