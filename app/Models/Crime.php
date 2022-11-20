<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    use HasFactory;

    protected $table = 'crimes';
    protected $fillable = [
        'category_id',
        'description',
        'crime_location',
        'device_type',
        'mac_address',
        'created_by',
        'status',
        'file'
    ];
}
