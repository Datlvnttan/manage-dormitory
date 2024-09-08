<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = "permission";

    protected $fillable = [
        'role_id',
        'route_id',
        'status', 
        'lock'       
    ];
    protected $casts = [
        'role_id' => 'integer',
        'route_id' => 'integer',
        'status' => 'boolean',
        'lock'=> 'boolean',
    ];
    // public $primaryKey = [
    //     'group_route_id',
    //     'route_id'
    // ];
}
