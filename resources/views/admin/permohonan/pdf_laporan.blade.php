<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Bulanan PPID</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header h3 { margin: 5px 0; font-size: 14px; }
        .header p { margin: 0; font-style: italic; color: #666; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #f2f2f2; border: 1px solid #999; padding: 8px; text-transform: uppercase; font-size: 10px; }
        td { border: 1px solid #999; padding: 8px; vertical-align: top; line-height: 1.4; }
        
        .status-badge { font-weight: bold; text-transform: uppercase; font-size: 9px; }
        .footer { margin-top: 40px; float: right; width: 250px; text-align: center; }
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Pemerintah Kabupaten Belitung Timur</h2>
        <h3>Pejabat Pengelola Informasi dan Dokumentasi (PPID)</h3>
        <p>Rekapitulasi Permohonan Informasi - Periode {{ now()->translatedFormat('F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="12%">Tanggal</th>
                <th width="20%">Nama Pemohon</th>
                <th width="30%">Rincian Informasi</th>
                <th width="25%">Tujuan Penggunaan</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $p)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}</td>
                <td>
                    <strong>{{ $p->nama }}</strong><br>
                    <small>NIK: {{ $p->nik }}</small>
                </td>
                <td>{{ $p->rincian_informasi }}</td>
                <td>{{ $p->tujuan_penggunaan }}</td>
                <td style="text-align: center;">
                    <span class="status-badge">{{ $p->status }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 30px;">Belum ada data permohonan untuk bulan ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Manggar, {{ now()->translatedFormat('d F Y') }}</p>
        <br><br><br><br>
        <p><strong>Admin PPID Kab. Belitung Timur</strong></p>
    </div>
    <div class="clear"></div>
</body>
</html>