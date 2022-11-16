<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrimeCategory extends Model
{
    use HasFactory;
    protected $table = 'crime_categories';
    
    protected $fillable = [
        'category_code','category_name', 'created_by','description'
    ];
}
