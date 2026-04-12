<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $fillable = [
        'nomor_registrasi',
        'kategori_pemohon',
        'nama',
        'nik',
        'alamat',
        'email',
        'no_hp',
        'pekerjaan',
        'rincian_informasi',
        'tujuan_penggunaan',
        'cara_memperoleh',
        'jenis_salinan',
        'cara_pengiriman',
        'status',
        'diproses_oleh',
        'diproses_pada',
    ];
}
