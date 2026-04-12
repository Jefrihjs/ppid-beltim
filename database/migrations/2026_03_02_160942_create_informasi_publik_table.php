<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informasi_publik', function (Blueprint $table) {
            $table->id();
            $table->string('unit_kerja'); // Contoh: Diskominfo, Setda, dll.
            
            // Kategori untuk filter 5 halaman kita
            $table->enum('jenis_informasi', [
                'Utama', 
                'Pembantu', 
                'Berkala', 
                'Setiap Saat', 
                'Serta Merta'
            ]);
            
            $table->string('judul'); // Judul dokumen
            $table->text('deskripsi')->nullable(); // Penjelasan singkat
            $table->string('tipe_file')->default('pdf');
            $table->string('url_akses'); // Link ke file (Google Drive/S3)
            $table->integer('tahun')->default(date('Y'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_publik');
    }
};
