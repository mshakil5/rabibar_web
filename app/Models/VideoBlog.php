<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoBlog extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(VideoCat::class, 'category_id');
    }
}
