<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title', 
        'content', 
        'category', 
        'image', 
        'is_floating', 
        'is_active'
    ];
}
