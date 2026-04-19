<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            // Tambahkan kolom untuk menampung alasan keberatan dan statusnya
            $table->text('alasan_keberatan')->nullable()->after('status');
            $table->string('status_keberatan')->default('PENDING')->after('alasan_keberatan');
            $table->text('tanggapan_keberatan')->nullable()->after('status_keberatan');
        });
    }

    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropColumn(['alasan_keberatan', 'status_keberatan', 'tanggapan_keberatan']);
        });
    }
};
