<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        \App\Models\Setting::create(['key' => 'hero_title', 'value' => 'Akses Informasi Terbuka']);
        \App\Models\Setting::create(['key' => 'hero_subtitle', 'value' => 'Temukan informasi publik Kabupaten Belitung Timur']);
    }
}
