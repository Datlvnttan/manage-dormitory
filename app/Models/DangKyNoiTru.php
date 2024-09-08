<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKyNoiTru extends Model
{
    use HasFactory;
    protected $table = 'DangKyNoiTru';
    protected $primaryKey   = 'MaSV';
    public $timestamps = false;
    protected $casts = [
        'MaSV'=>'string',
    ];
    public function phong()
    {
        return $this->hasMany(Phong::class, 'MaPhong');
    }
}
