<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PublicInformation;
use Illuminate\Support\Facades\DB;

class PublicInformationSeeder extends Seeder
{
    public function run()
    {
        $file = database_path('data/sql.csv');
        
        if (!file_exists($file)) {
            $this->command->error("File sql.csv tidak ditemukan di database/data/");
            return;
        }

        $fileHandle = fopen($file, 'r');
        fgetcsv($fileHandle); // Lewati Header

        DB::beginTransaction();

        try {
            $count = 0;
            // *** PERUBAHAN DI SINI: Ganti ',' menjadi ';' ***
            while (($row = fgetcsv($fileHandle, 2000, ';')) !== FALSE) {
                
                // Pastikan baris memiliki data yang cukup
                if (!isset($row[4]) || empty(array_filter($row))) {
                    continue;
                }

                PublicInformation::create([
                    'opd_name'  => $row[0] ?? null,
                    'id_org'    => $row[1] ?? null,
                    'kelompok'  => $row[2] ?? null,
                    'category'  => $row[3] ?? null,
                    'title'     => $row[4] ?? 'Tanpa Judul',
                    'id_kel'    => $row[5] ?? null,
                    'file_type' => $row[6] ?? null,
                    'link_url'  => $row[7] ?? null,
                    'is_active' => true,
                ]);
                $count++;
            }
            
            DB::commit();
            $this->command->info("Selesai! $count data DIP berhasil dimasukkan ke database.");
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Gagal import: " . $e->getMessage());
        }

        fclose($fileHandle);
    }
}