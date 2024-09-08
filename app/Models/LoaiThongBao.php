<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiThongBao extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'LoaiThongBao';
    protected $primaryKey   = "Khoa";
    protected $fillable = [        
        'Loai',
        'MauSac',                   
        'Khoa',                   
    ];
    protected $casts = [                     
        'Loai' => 'string',        
        'MauSac' => 'string',
        'Khoa'=>'string'                
    ];
}
