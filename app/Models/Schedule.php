<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'Schedule';
    protected $primaryKey   = "Key";
    public $timestamps = false;
    protected $fillable = [
        'Key',
        'Title',
        'EndTime',
        'Running',
        'Prefix',
        'FlagStart',                 
    ];
    protected $casts = [
        'Key' => 'string',
        'Prefix' => 'string',
        'Title' => 'string',
        'Running' => 'boolean',
        'FlagStart' => 'boolean',
        'EndTime' => 'datetime',
    ];
}
