<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViPham extends Model
{
    use HasFactory,SoftDeletes;    
    protected $table = 'ViPham';
    protected $primaryKey   = 'MaViPham';
    public $timestamps = false;
    protected $fillable = [
        'MaViPham',
        'NoiDung',
        'MucDoNghiemTrong',        
    ];
    protected $casts = [
        'MaViPham' => 'string',
    ];
    protected $dates = ['deleted_at'];
}
