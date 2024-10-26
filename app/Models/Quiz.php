<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    // protected $guarded = [];  
    use HasFactory;

    protected $fillable = [
        'quiz',
        'quiz_type',
        'status',
        'expiry_date',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
