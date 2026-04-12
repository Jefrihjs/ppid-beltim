<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 1. Kasih tahu Laravel kalau nama tabelnya adalah 'categories'
    protected $table = 'categories';

    // 2. Pastikan Primary Key-nya adalah 'id'
    protected $primaryKey = 'id';

    // 3. Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'name',
        'slug'
    ];

    // 4. Hubungan balik (Inverse Relationship) ke InformasiPublik (Opsional tapi bagus ada)
    public function informasi_publik()
    {
        return $this->hasMany(InformasiPublik::class, 'id_kel', 'id');
    }
}