<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKyChuyenPhong extends Model
{
    use HasFactory;
    protected $table = 'DangKyChuyenPhong';
    protected $primaryKey   = 'MaDangKy';
    public $timestamps = false;
        
    protected $fillable = [
        'MaDangKy',
        'MaSV',
        'MaPhongCu',
        'MaPhongMoi',
        'NgayDangKy',    
        'LyDo',        
        'TrangThaiXetDuyet',        
    ];
    protected $casts = [        
    ];
}
