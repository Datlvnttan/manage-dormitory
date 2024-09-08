<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuDungDichVuDon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'SuDungDichVuDon';
    // protected $primaryKey   = ["MaViPham","MaSV","ThoiGianViPham"];    
    protected $fillable = [
        'MaSV',
        'MaDichVu',
        'DangSuDung',           
    ];
    protected $casts = [
        'MaSV' => 'string',
        'MaDichVu' => 'string',        
        'DangSuDung' => 'boolean',
    ];
}
