<?php

namespace App\Models;

use App\Models\Scopes\RemoveSoftDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanBothietBi extends Model
{
    use HasFactory;
    protected $table = 'PhanBothietBi';
    // protected $primaryKey   = 'MaThietBi';
    public $timestamps = false;        
    protected $fillable = [  
        'MaThietBi',      
        'MaPhong',
        'SoLuongPhanBo'                         
    ];
    protected $casts = [        
        'MaThietBi' => 'string',        
        'MaPhong' => 'string',                   
        'SoLuongPhanBo'=>'integer',                    
    ];
    
}
