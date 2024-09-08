<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'HoaDon';
    public $timestamps = false;
    protected $primaryKey   = 'MaHoaDon';

    protected $fillable = [
        'MaHoaDon',
        'MaPhong',          
        'NgayTao',
        'ThanhTien',  
        'DaThanhToan',
        'NguoiTao',
        'TrangThai'
    ];
    protected $casts = [
        'MaHoaDon' => 'string',
        'NgayTao' => 'datetime',
    ];
}
