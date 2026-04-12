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
    Schema::create('permohonans', function (Blueprint $table) {
        $table->id();

        $table->string('nomor_registrasi')->unique();

        // Identitas Pemohon
        $table->enum('kategori_pemohon', ['perorangan','lembaga']);
        $table->string('nama');
        $table->string('nik', 20)->nullable();
        $table->text('alamat');
        $table->string('email')->nullable();
        $table->string('no_hp', 20);
        $table->string('pekerjaan')->nullable();

        // Data Permohonan
        $table->text('rincian_informasi');
        $table->text('tujuan_penggunaan');

        $table->enum('cara_memperoleh', [
            'melihat',
            'membaca',
            'mendengar',
            'mencatat'
        ]);

        $table->enum('jenis_salinan', [
            'softcopy',
            'hardcopy'
        ])->nullable();

        $table->enum('cara_pengiriman', [
            'email',
            'faksimili',
            'diambil',
            'kurir',
            'ekspedisi'
        ])->nullable();

        // Status Internal
        $table->enum('status', [
            'pending',
            'diproses',
            'selesai',
            'ditolak'
        ])->default('pending');

        $table->string('diproses_oleh')->nullable();
        $table->timestamp('diproses_pada')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
