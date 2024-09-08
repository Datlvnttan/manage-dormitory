<?php

namespace App\Models;

use App\Services\ScheduleService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as AuthenticatableModel;

class SinhVien extends AuthenticatableModel implements JWTSubject
{
    use HasFactory, \Illuminate\Auth\Authenticatable;
    protected $table = 'SinhVien';
    protected $primaryKey   = 'MaSV';
    protected $username = 'MaSV'; 
    // protected $password = 'MatKhau';
    public $timestamps = false;
    protected $fillable = [
        'MaSV',
        'Ho',
        'Ten',
        'SoDienThoai',
        'GioiTinh',
        'Lop',
        'TrangThai',             
        'password',             
        'MatKhau',             
    ];
    protected $casts = [
        'MaSV' => 'string',
        'password' => 'hashed',
    ];
    public function dangKyNoiTru()
    {
        return $this->hasOne(DangKyNoiTru::class, 'MaSV');
    }
    public function phong()
    {
        return $this->belongsTo(Phong::class,"MaPhong");
    }
    public function isLeader()
    {        
        return $this->phong->TruongPhong == $this->MaSV;
    }
    public function getDataChangeRoom()
    {
        return Phong::select(
            'Khu.Ten AS TenKhu',
            'Tang.Ten AS TenTang',
            'Phong.Ten AS TenPhong',
            'Phong.Ma AS MaPhong',
            'dk.MaDangKy',
            'dk.NgayDangKy',
            'dk.LyDo'
        )
        ->join('Tang','Tang.Ma','=','Phong.MaTang')
        ->join('Khu','Khu.Ma','=','Tang.MaKhu')  
        ->Join("DangKyChuyenPhong as dk","dk.MaPhongMoi","=", "Phong.Ma")            
        ->where('dk.MaSV','=',$this->MaSV)
        ->where('dk.TrangThaiXetDuyet','=',"Chờ xét duyệt")
        ->first();
    }
    
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
}
