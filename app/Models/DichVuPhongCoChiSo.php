<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichVuPhongCoChiSo extends Model
{
    use HasFactory;    
    protected $table = 'DichVuPhongCoChiSo';
    public $timestamps = false;    

    protected $fillable = [        
        'MaDichVu',          
        'MaPhong',
        'ChiSoHienTai',                          
    ];
    protected $casts = [
        'MaDichVu' => 'string',
        'MaPhong' => 'string',
        'ChiSoHienTai' => 'integer',
    ];
}
