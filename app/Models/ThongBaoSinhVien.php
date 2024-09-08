<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBaoSinhVien extends Model
{
    use HasFactory;
    public $timestamps = false;    
    protected $table = 'ThongBaoSinhVien';
    protected $primaryKey   = "Id";    
    protected $fillable = [  
        'KhoaLoaiThongBao',      
        'NguoiNhan',
        'NgayTao',                     
        'TieuDe',         
        'NoiDung',           
        'Uri',           
        'DaXem',     
    ];
    protected $casts = [        
        'KhoaLoaiThongBao' => 'string',        
        'NguoiNhan' => 'string',                   
        'TieuDe' => 'string',   
        'NoiDung' => 'string',        
        'NgayTao' => 'datetime',        
        'Uri' => 'string',        
        'DaXem' => 'boolean',
    ];
}
