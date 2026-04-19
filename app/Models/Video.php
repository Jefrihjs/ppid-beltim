<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'youtube_id',
        'is_main',
        'is_active' 
    ];

    
    protected $casts = [
        'is_main' => 'boolean',
        'is_active' => 'boolean',
    ];
}