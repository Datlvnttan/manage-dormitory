<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBaoNhanVien extends Model
{
    use HasFactory;
    public $timestamps = false;    
    protected $table = 'ThongBaoNhanVien';
    protected $primaryKey   = "Id";    
    protected $fillable = [  
        'KhoaLoaiThongBao',      
        'role_id',
        'NgayTao',                     
        'TieuDe',         
        'NoiDung',           
        'Uri',                      
    ];
    protected $casts = [        
        'KhoaLoaiThongBao' => 'string',        
        'role_id' => 'integer',                   
        'TieuDe' => 'string',   
        'NoiDung' => 'string',        
        'NgayTao' => 'datetime',        
        'Uri' => 'string',                
    ];
}
