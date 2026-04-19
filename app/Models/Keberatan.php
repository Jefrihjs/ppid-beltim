<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keberatan extends Model
{
    protected $fillable = [
        'permohonan_id', 
        'nomor_registrasi_keberatan', 
        'alasan_kode', 
        'kronologi', 
        'tanggapan', 
        'status'
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }
}