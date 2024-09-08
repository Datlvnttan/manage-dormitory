<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khu extends Model
{
    use HasFactory;
    protected $table = 'Khu';
    protected $primaryKey   = 'Ma';
    public $timestamps = false;
    protected $fillable = [
        'Ma',
        'Ten',
        'DoiTuong',        
    ];
    protected $casts = [
        'Ma' => 'string',
    ];
}
