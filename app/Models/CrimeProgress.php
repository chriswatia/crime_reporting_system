<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrimeProgress extends Model
{
    use HasFactory;
    protected $table = 'crime_progress';
    protected $fillable = ['crime_id', 'description', 'created_by', 'file'];
}
