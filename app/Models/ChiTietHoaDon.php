<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;
    protected $table = 'ChiTietHoaDon';
    // protected $primaryKey   = ['MaHoaDon','MaDichVu'];
    public $timestamps = false;

    protected $fillable = [
        'MaHoaDon',
        'MaDichVu',          
        'DonGia',
        'SoLuong',  
    ];
}
