<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhaiBaoHuHong extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'KhaiBaoHuHong';
    protected $primaryKey   = 'MaKhaiBao';
    protected $fillable = [
        'MaKhaiBao',
        'MaPhong',
        'MaThietBi' ,
        'NgayYeuCau' ,
        'TongSoLuong' ,
        'DaXuLy', 
    ];
    protected $casts = [
        'MaKhaiBao'=>'string',
        'DaXuLy' => 'boolean',
    ];

}
