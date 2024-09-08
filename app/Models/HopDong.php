<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HopDong extends Model
{
    use HasFactory;
    protected $table = 'HopDong';
    public $timestamps = false;
    protected $primaryKey   = 'MaHopDong';       
    protected $casts = [
        'MaHopDong' => 'string',
        'DaGiaHanTrongDot'=>"boolean",
        'DaThanhToan'=>"boolean"
    ];
}
