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
        Schema::table('public_informations', function (Blueprint $table) {
            $table->integer('views')->default(0); // Untuk jumlah dilihat
            $table->integer('downloads')->default(0); // Untuk jumlah diunduh
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public_informations', function (Blueprint $table) {
            //
        });
    }
};
