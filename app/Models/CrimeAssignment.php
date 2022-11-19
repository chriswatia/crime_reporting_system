<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrimeAssignment extends Model
{
    use HasFactory;
    protected $table = 'crime_assignment';
    protected $fillable = ['officer_id', 'crime_id'];
}
