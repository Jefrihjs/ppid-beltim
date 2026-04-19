<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengunjung</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0; font-style: italic; }
        .stats-container { margin-bottom: 30px; }
        .stats-table {
            width: 100%;
            margin-bottom: 30px;
            border: none;
        }
        .stats-table td {
            width: 33%;
            border: 1px solid #ddd; /* Tetap ada bingkai kotak */
            padding: 15px;
            text-align: center;
            border-radius: 8px; /* Kadang radius tidak muncul di tabel, tapi tidak apa-apa */
            background: #ffffff;
        }
        .stats-label {
            font-size: 10px;
            text-transform: uppercase;
            color: #666;
            display: block;
            margin-bottom: 5px;
        }
        .stats-value {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f4f4f4; padding: 10px; border: 1px solid #ddd; font-size: 10px; text-transform: uppercase; }
        td { padding: 8px; border: 1px solid #ddd; font-size: 10px; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PEMERINTAH KABUPATEN BELITUNG TIMUR</h2>
        <h3>Laporan Statistik Pengunjung Portal PPID</h3>
        <p>Tanggal Cetak: <?php echo e($date); ?></p>
    </div>

    <table class="stats-table">
        <tr>
            <td>
                <span class="stats-label">Kunjungan Hari Ini</span>
                <span class="stats-value"><?php echo e($stats['today']); ?></span>
            </td>
            <td>
                <span class="stats-label">Kunjungan Bulan Ini</span>
                <span class="stats-value"><?php echo e($stats['this_month']); ?></span>
            </td>
            <td>
                <span class="stats-label">Total Seluruh Hits</span>
                <span class="stats-value"><?php echo e($stats['total']); ?></span>
            </td>
        </tr>
    </table>

    <h4>Lampiran: Log 50 Pengunjung Terakhir</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu Akses</th>
                <th>IP Address</th>
                <th>User Agent (Perangkat)</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $visitors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td align="center"><?php echo e($key + 1); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($v->created_at)->format('d/m/Y H:i')); ?></td>
                <td><?php echo e($v->ip_address); ?></td>
                <td><?php echo e(substr($v->user_agent, 0, 80)); ?>...</td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Manggar, <?php echo e($date); ?></p>
        <p style="margin-top:60px"><strong>Admin PPID Beltim</strong></p>
    </div>
</body>
</html><?php /**PATH /var/www/html/resources/views/admin/visitors/pdf.blade.php ENDPATH**/ ?>