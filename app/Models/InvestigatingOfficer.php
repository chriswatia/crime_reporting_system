<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigatingOfficer extends Model
{
    use HasFactory;
    protected $table = 'investigating_officers';
    protected $fillable = [
        'user_id',
        'category_id',
        'status',
        'created_by'
    ];
}
