<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicInformation extends Model
{
    // Tambahkan baris ini untuk memberitahu Laravel nama tabel yang benar
    protected $table = 'public_informations';

    protected $fillable = [
        'opd_name', 'id_org', 'kelompok', 'category', 
        'title', 'id_kel', 'file_type', 'link_url', 'is_active'
    ];
}