<?php

namespace App\Models;

use App\Models\Scopes\RemoveSoftDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThietBi extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'ThietBi';
    protected $primaryKey   = 'MaThietBi';
    public $timestamps = false;      
    protected $fillable = [  
        'MaThietBi',      
        'TenThietBi',
        'TongSoLuong',                     
        'SoLuongMoiPhong',                 
    ];
    protected $casts = [        
        'MaThietBi' => 'string',        
        'TenThietBi' => 'string',                   
        'TongSoLuong'=>'integer',        
        'SoLuongMoiPhong'=>'integer',        
    ];
    protected $dates = ['deleted_at'];  
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope(new RemoveSoftDeletedScope());
    // }
}
