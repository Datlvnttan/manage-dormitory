<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVienViPham extends Model
{
    use HasFactory;    
    protected $table = 'SinhVienViPham';
    // protected $primaryKey   = ["MaViPham","MaSV","ThoiGianViPham"];
    public $timestamps = false;
    protected $fillable = [
        'MaSV',
        'MaViPham',
        'ThoiGianViPham',
        'HinhPhat',
        'NguoiTao',
        'GhiChu',
        'TrangThai',             
    ];
    protected $casts = [
        'MaSV' => 'string',
        'MaViPham' => 'string',
        'HinhPhat' => 'string',
        'NguoiTao' => 'string',
        'GhiChu' => 'string',
        'TrangThai' => 'string',
        // 'DaGiaiQuyet' => 'boolean',
        'ThoiGianViPham' => 'datetime',
    ];
}
