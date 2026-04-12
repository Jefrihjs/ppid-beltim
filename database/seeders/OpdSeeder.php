<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpdSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel agar tidak terjadi duplikat saat di-run ulang
        DB::table('opds')->truncate();

        $opds = [
            ['nama_opd' => 'Sekretariat Daerah'],
            ['nama_opd' => 'Sekretariat DPRD'],
            ['nama_opd' => 'Inspektorat Daerah'],
            ['nama_opd' => 'Dinas Pendidikan'],
            ['nama_opd' => 'Dinas Kesehatan'],
            ['nama_opd' => 'Dinas Pekerjaan Umum dan Penataan Ruang'],
            ['nama_opd' => 'Dinas Perumahan Rakyat dan Kawasan Permukiman'],
            ['nama_opd' => 'Satuan Polisi Pamong Praja'],
            ['nama_opd' => 'Dinas Sosial, Pemberdayaan Masyarakat dan Desa'],
            ['nama_opd' => 'Dinas Tenaga Kerja, Koperasi, Usaha Kecil dan Menengah'],
            ['nama_opd' => 'Dinas Ketahanan Pangan dan Pertanian'],
            ['nama_opd' => 'Dinas Lingkungan Hidup'],
            ['nama_opd' => 'Dinas Kependudukan dan Pencatatan Sipil'],
            ['nama_opd' => 'Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan Perlindungan Anak'],
            ['nama_opd' => 'Dinas Perhubungan'],
            ['nama_opd' => 'Dinas Komunikasi dan Informatika'],
            ['nama_opd' => 'Dinas Penanaman Modal, Pelayanan Terpadu Satu Pintu dan Perdagangan'],
            ['nama_opd' => 'Dinas Kepemudaan dan Olahraga'],
            ['nama_opd' => 'Dinas Perpustakaan'],
            ['nama_opd' => 'Dinas Perikanan'],
            ['nama_opd' => 'Dinas Kebudayaan dan Pariwisata'],
            ['nama_opd' => 'Dinas Perindustrian'],
            ['nama_opd' => 'Badan Perencanaan Pembangunan, Penelitian dan Pengembangan Daerah'],
            ['nama_opd' => 'Badan Keuangan Daerah'],
            ['nama_opd' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia'],
            ['nama_opd' => 'Badan Penanggulangan Bencana Daerah'],
            ['nama_opd' => 'Badan Kesatuan Bangsa dan Politik'],
            ['nama_opd' => 'RSUD Muhammad Ali'],
            ['nama_opd' => 'Kecamatan Manggar'],
            ['nama_opd' => 'Kecamatan Gantung'],
            ['nama_opd' => 'Kecamatan Dendang'],
            ['nama_opd' => 'Kecamatan Kelapa Kampit'],
            ['nama_opd' => 'Kecamatan Damar'],
            ['nama_opd' => 'Kecamatan Simpang Pesak'],
            ['nama_opd' => 'Kecamatan Simpang Rengiang'],
            ['nama_opd' => 'Bagian Tata Pemerintahan'],
            ['nama_opd' => 'Bagian Hukum'],
            ['nama_opd' => 'Bagian Organisasi'],
            ['nama_opd' => 'Bagian Umum'],
            ['nama_opd' => 'Bagian Ekonomi dan Pembangunan'],
            ['nama_opd' => 'Bagian Kesejahteraan Rakyat'],
        ];

        DB::table('opds')->insert($opds);
    }
}