<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    // Tambahkan baris sakti ini Pak:
    protected $fillable = [
        'caption',
        'image_path',
        'is_active'
    ];
}