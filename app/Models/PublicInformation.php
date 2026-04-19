<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicInformation extends Model
{
    protected $table = 'public_informations';

    protected $fillable = [
        'opd_name', 'id_org', 'kelompok', 'category', 
        'title', 'id_kel', 'file_type', 'link_url', 'is_active'
    ];

    /**
     * Daftar Kategori Informasi Publik
     * Biar kalau ada perubahan, cukup edit di sini saja.
     */
    public static function getCategories()
    {
        return [
            'berkala'      => 'Informasi Berkala',
            'setiap saat'  => 'Informasi Setiap Saat',
            'serta merta'  => 'Informasi Serta Merta',
            'dikecualikan' => 'Informasi Dikecualikan',
        ];
    }

    /**
     * Relasi ke Tabel Categories (id_kel)
     * Pastikan nama modelnya 'Category' atau sesuaikan dengan punyamu
     */
    public function kategori_kelompok()
    {
        return $this->belongsTo(Category::class, 'id_kel');
    }
}