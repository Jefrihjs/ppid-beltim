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
        Schema::table('ppid_pemberitahuan_tertulis', function (Blueprint $table) {
            // Cek satu-satu sebelum nambah, biar nggak tabrakan
            if (!Schema::hasColumn('ppid_pemberitahuan_tertulis', 'permohonan_id')) {
                $table->unsignedBigInteger('permohonan_id')->after('id')->nullable();
            }
            if (!Schema::hasColumn('ppid_pemberitahuan_tertulis', 'penguasaan_informasi')) {
                $table->string('penguasaan_informasi')->nullable();
            }
            if (!Schema::hasColumn('ppid_pemberitahuan_tertulis', 'nama_opd')) {
                $table->string('nama_opd')->nullable();
            }
            if (!Schema::hasColumn('ppid_pemberitahuan_tertulis', 'bentuk_fisik')) {
                $table->string('bentuk_fisik')->nullable(); // Ini yang tadi error
            }
            if (!Schema::hasColumn('ppid_pemberitahuan_tertulis', 'total_biaya')) {
                $table->integer('total_biaya')->default(0);
            }
            if (!Schema::hasColumn('ppid_pemberitahuan_tertulis', 'waktu_penyediaan')) {
                $table->string('waktu_penyediaan')->nullable();
            }
            if (!Schema::hasColumn('ppid_pemberitahuan_tertulis', 'penjelasan_penghitaman')) {
                $table->text('penjelasan_penghitaman')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('ppid_pemberitahuan_tertulis', function (Blueprint $table) {
            $table->dropForeign(['permohonan_id']);
            $table->dropColumn('permohonan_id');
        });
    }
};
