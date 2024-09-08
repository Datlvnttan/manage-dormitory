<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'DichVu';
    protected $primaryKey   = 'MaDichVu';
    protected $fillable = [
        'MaDichVu',
        'TenDichVu',
        'GiaHienTai' ,
        'BatBuoc' ,
        'TinhTheoChiSo' ,        
    ];
    protected $casts = [
        'MaDichVu'=>'string',
        'BatBuoc' => 'boolean',
        'TinhTheoChiSo' => 'boolean',
        'GiaHienTai' => 'integer',
        'Khoa' => 'boolean',
    ];
}
