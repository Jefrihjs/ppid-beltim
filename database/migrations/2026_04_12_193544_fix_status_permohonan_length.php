<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            // Kita ubah ukurannya jadi 50 karakter biar muat PEMBERITAHUAN_DIKIRIM
            $table->string('status', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->string('status', 20)->change();
        });
    }
};