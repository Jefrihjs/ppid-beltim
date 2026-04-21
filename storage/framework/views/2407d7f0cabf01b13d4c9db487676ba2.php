<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .logo { width: 60px; }
        .title { font-weight: bold; text-decoration: underline; text-align: center; margin-bottom: 20px; text-transform: uppercase; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table-data th, .table-data td { border: 1px solid black; padding: 10px; text-align: left; }
        .footer-table { margin-top: 30px; width: 100%; }
        .qr-code { width: 80px; }
    </style>
</head>
<body>
    <div class="header">
        <img src="data:image/png;base64,<?php echo e(base64_encode(file_get_contents(public_path('images/logo-beltim.png')))); ?>" class="logo"><br>
        <strong style="font-size: 16px;">Pejabat Pengelola Informasi dan Dokumentasi</strong><br>
        <strong style="font-size: 18px;">PPID - BELTIM</strong>
    </div>

    <div class="title">Pemberitahuan Tertulis</div>

    <p>Berdasarkan permohonan informasi pada tanggal <strong><?php echo e($permohonan->created_at->format('d F Y')); ?></strong> dengan nomor pendaftaran <strong><?php echo e($permohonan->nomor_registrasi); ?></strong>, Kami menyampaikan kepada Saudara/i:</p>

    <table style="margin-left: 20px;">
        <tr><td>Nama</td><td>: <?php echo e($permohonan->nama); ?></td></tr>
        <tr><td>Alamat</td><td>: <?php echo e($permohonan->alamat); ?></td></tr>
        <tr><td>Nomor Telp./Email</td><td>: <?php echo e($permohonan->no_hp); ?> / <?php echo e($permohonan->email); ?></td></tr>
    </table>

    <p>Pemberitahuan sebagai berikut:</p>
    <p><strong>Informasi Dapat Diberikan</strong></p>

    <table class="table-isi">
        <tr>
            <td width="5%" class="text-center">1</td>
            <td width="40%">Penguasaan Informasi Publik</td>
            <td>
                
                <?php if(($pemberitahuan->penguasaan ?? '') == 'opd_lain'): ?>
                    <strong><?php echo e($pemberitahuan->nama_opd ?? 'Badan Publik Lain'); ?></strong>
                <?php else: ?>
                    <strong>Dinas Komunikasi dan Informatika Kab. Belitung Timur</strong>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>Bentuk fisik yang tersedia</td>
            <td><?php echo e($pemberitahuan->bentuk_fisik ?? '-'); ?></td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td>Biaya yang dibutuhkan</td>
            <td>
                <?php if(($pemberitahuan->total_biaya ?? 0) > 0): ?>
                    Rp <?php echo e(number_format($pemberitahuan->total_biaya, 0, ',', '.')); ?>

                <?php else: ?>
                    Gratis
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="text-center">4</td>
            <td>Waktu penyediaan</td>
            <td><?php echo e($pemberitahuan->waktu_penyediaan ?? '-'); ?> Hari Kerja</td>
        </tr>
        <tr>
            <td class="text-center">5</td>
            <td>Penjelasan penghitaman/pengaburan</td>
            <td><?php echo e($pemberitahuan->penjelasan_penghitaman ?? 'Tidak ada'); ?></td>
        </tr>
    </table>

    <table class="footer-table">
        <tr>
            <td width="30%">
                
                <img src="data:image/png;base64,<?php echo e(base64_encode(QrCode::format('png')->size(100)->generate(url('/cek-permohonan/'.$permohonan->kode_tracking)))); ?>">
            </td>
            <td width="70%" style="text-align: center; font-size: 10px;">
                Dokumen ini sah, diterbitkan secara elektronik melalui sistem PPID Beltim sehingga tidak memerlukan cap dan tanda tangan basah.<br><br>
                Belitung Timur, <?php echo e($tanggal_cetak); ?><br>
                <strong>TIM PPID</strong><br>
                <strong>Pemerintah Daerah Kabupaten Belitung Timur</strong>
            </td>
        </tr>
    </table>

    <div style="position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 8px; font-style: italic; border-top: 1px solid #ccc; padding-top: 5px;">
        *Berkas ini dicetak pada hari <?php echo e(now()->translatedFormat('l, d F Y')); ?> melalui aplikasi PPID - Lawang Beltim
    </div>
</body>
</html><?php /**PATH /var/www/html/resources/views/admin/permohonan/pdf_pemberitahuan.blade.php ENDPATH**/ ?>