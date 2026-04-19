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
        Schema::table('permohonans', function (Blueprint $table) {
            // Tambahkan kolom-kolom file yang kurang
            $table->string('file_ktp')->nullable()->after('cara_pengiriman');
            $table->string('file_akta')->nullable()->after('file_ktp');
            $table->string('file_pemberitahuan')->nullable();
            $table->string('file_penyelesaian')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropColumn(['file_ktp', 'file_akta', 'file_pemberitahuan', 'file_penyelesaian']);
        });
    }
};
