<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class InformasiPublik extends Model
{
    use HasFactory;

    protected $table = 'public_informations';

    protected $fillable = [
        'opd_name',
        'category',
        'id_kel',
        'title',
        'deskripsi',
        'file_type',
        'link_url',
        'tahun',
        'kelompok',
        'views',
        'downloads'
    ];

    protected $attributes = [
        'views' => 0,
        'downloads' => 0,
    ];

    public function kategori_kelompok()
    {
        return $this->belongsTo(Category::class, 'id_kel', 'id');
    }

    public function opd()
    {
        // Hubungkan id_org (di tabel informasi) ke id (di tabel opds)
        return $this->belongsTo(Opd::class, 'id_org', 'id');
    }
}