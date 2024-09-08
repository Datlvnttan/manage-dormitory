<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XuLyKhaiBaoHuHong extends Model
{
    use HasFactory;
    protected $table = 'XuLyKhaiBaoHuHong';
    protected $fillable = [
        'MaXuLy',
        'MaKhaiBao',
        'SoLuong',  
        'ThayMoi',
        'NguyenNhan',
        'ChiPhiPhatSinh',     
    ];
    public $timestamps = false;
    protected $primaryKey   = 'MaXuLy';
    protected $casts = [
        'ThayMoi' => 'boolean',
    ];
}
