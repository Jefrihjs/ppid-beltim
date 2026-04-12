<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('public_informations', function (Blueprint $table) {
            $table->id();
            $table->string('opd_name')->nullable();    // PENANGGUNG JAWAB
            $table->string('id_org')->nullable();      // id_org (18915, dll)
            $table->string('kelompok')->nullable();    // utama / pembantu
            $table->string('category')->nullable();    // jenis informasi (berkala, serta merta, dll)
            $table->text('title');                     // judul
            $table->string('id_kel')->nullable();      // id_kel
            $table->string('file_type')->nullable();   // tipe file (link / pdf)
            $table->text('link_url')->nullable();      // src (URL link-nya)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_information');
    }
};
