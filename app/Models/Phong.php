<?php

namespace App\Models;

use App\Models\Scopes\RemoveSoftDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phong extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'Phong';
    protected $primaryKey   = 'Ma';
    public $timestamps = false;
    protected $fillable = [
        'Ma',
        'Ten',
        'SucChua',
        'MaTang',    
        'SoLuongTrong',        
    ];
    protected $casts = [
        'Ma' => 'string',
    ];
    protected $dates = ['deleted_at'];
    
    public static function getInfo($maPhong)
    {
        return DB::table('Phong')
                ->select(
                    'Khu.Ten AS TenKhu',
                    'Tang.Ten AS TenTang',
                    'Phong.Ten AS TenPhong',
                    'Phong.Ma AS MaPhong'
                )
                ->join('Tang','Tang.Ma','=','Phong.MaTang')
                ->join('Khu','Khu.Ma','=','Tang.MaKhu')                
                ->where('Phong.Ma','=',$maPhong)
                ->first();
    }
    
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new RemoveSoftDeletedScope());
    }
}
