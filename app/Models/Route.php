<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $table = "routes";
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'route_name',
        'key',
        'menu_title',
        'index_location',
        'icon',
    ];
    protected $casts = [
       'route_name'=>'string',
        'key'=>'string',
        'menu_title'=>'string',
        'index'=>'integer',
        'icon'=>'string',
    ];
}
