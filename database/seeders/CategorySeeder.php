<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Kosongkan dulu tabel agar ID mulai dari 1 lagi
        Category::truncate();

        $categories = [
            'Informasi Profil dan Badan Publik',
            'Ringkasan Informasi Mengenai Program/Kegiatan yang sedang dijalankan dalam lingkup Badan Publik',
            'Ringkasan Informasi Mengenai Kinerja Berupa Narasi Tentang Realisasi Kegiatan yang Telah Maupun Sedang di Jalankan Berserta Capaiannya',
            'Ringkasan Laporan Keuangan Pemerintah Kabupaten Belitung Timur',
            'Ringkasan Laporan Akses Informasi Publik Melalui PPID Kab. Belitung Timur',
            'Informasi Mengenai Peraturan, Keputusan dan/atau Kebijakan Yang Mengikat dan/atau Berdampak Bagi Publik yang dikeluarkan oleh Pemerintah Kabupaten Belitung Timur',
            'Informasi mengenai Hak dan Tata Cara Memperoleh Informasi Publik Serta tata Cara Pengajuan Keberatan Serta Proses Penyelesaian Sengketa Informasi Publik Berikut Pihak-pihak yang bertanggung jawab',
            'Tata Cara Pengaduan Penyalahgunaan Wewenang Atau Pelanggaran Oleh Pejabat Publik',
            'Tata Cara Pengaduan Penyalahgunaan Wewenang Atau Pelanggaran Oleh Pihak Yang Mendapat Izin/Perjanjian Kerja dari Badan Publik Yang Bersangkutan',
            'Informasi Mengenai Pengumuman Pengadaan Barang dan Jasa di Lingkungan Pemerintah Kab. Belitung Timur',
            'Informasi Mengenai Prosedur Peringatan Dini Pemerintah Kab. Belitung Timur',
            'Lainnya',
            'Pengamatan Gejala Bencana',
            'Analisis Hasil Pengamatan Gejala Bencana',
            'Pengambilan Keputusan Oleh Pihak Yang Berwenang',
            'Peringatan Bencana',
            'Pengambilan Tindakan Oleh Masyarakat',
            'Lokasi Evakuasi',
            'Pelaksanaan Penyelamatan dan Evakuasi',
            'Informasi Mengenai Pandemi Virus COVID-19',
            'Daftar Informasi Publik PPID Kabupaten Belitung Timur',
            'Daftar Informasi Publik PPID Perangkat Daerah Kabupaten Belitung Timur',
            'Informasi Mengenai Peraturan, Keputusan, dan Kebijakan Pemerintah Kabupaten Belitung Timur',
            'Informasi Mengenai Organisasi, Administrasi, Kepegawaian, dan Keuangan Pemerintah Kabupaten Belitung Timur',
            'Surat-surat Perjanjian Pemerintah Daerah Kabupaten Belitung Timur dengan Pihak Ketiga',
            'Surat Menyurat Pimpinan/Pejabat Pemerintah Kabupaten Belitung Timur Dalam Rangka Pelaksanaan Tugas Pokok dan Fungsi dan wewenangnya',
            'Syarat-syarat Perizinan, Izin Yang Diterbitkan/Dikeluarkan Berikut Dokumen Pendukungnya, dan Laporan Penataan Izin Yang Diberikan',
            'Data Perbendaharaan/Inventaris Asset',
            'Rencana Strategis Pemerintah Kabupaten Belitung Timur',
            'Agenda Kerja Pimpinan Satuan Kerja Pemerintah Kabupaten Belitung Timur',
            'Informasi Mengenai Kegiatan Pelayanan Informasi Publik Pemerintah Kabupaten Belitung Timur',
            'Jumlah, Jenis, dan Gambaran Umum Pelanggaran Yang ditemukan dalam pengawasan internal serta laporan penindakannya',
            'Jumlah, Jenis, dan Gambaran Umum Pelanggaran Yang Dilaporkan Oleh Masyarakat Serta Tindak Lanjut',
            'Peraturan Perundang-undangan yang telah disahkan beserta kajian akademiknya',
            'Informasi dan Kebijakan yang disampaikan Pejabat Publik dalam pertemuan yang terbuka untuk umum',
            'Informasi Publik Lain Yang Telah Dinyatakan Terbuka Bagi masyarakat berdasarkan mekanisme keberatan dan/atau penyelesaian sengketa',
            'Informasi tentang standar pengumuman informasi',
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }
    }
}