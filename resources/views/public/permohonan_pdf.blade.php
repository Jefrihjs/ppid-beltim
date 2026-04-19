<!DOCTYPE html>
<html>
<head>
    <title>Bukti Permohonan Informasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; mb: 20px; }
        .title { font-weight: bold; font-size: 16px; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 8px; vertical-align: top; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PPID KABUPATEN BELITUNG TIMUR</h2>
        <p>Alamat: Komplek Perkantoran Terpadu Manggar, Belitung Timur</p>
    </div>

    <div style="text-align: center;">
        <p class="title">BUKTI PENGAJUAN PERMOHONAN INFORMASI</p>
        <p>Kode Monitoring: <strong>{{ $permohonan->kode_tracking }}</strong></p>
    </div>

    <table>
        <tr><td width="30%">Nomor Registrasi</td><td>: {{ $permohonan->nomor_registrasi }}</td></tr>
        <tr><td>Tanggal Pengajuan</td><td>: {{ $permohonan->created_at->format('d/m/Y H:i') }} WIB</td></tr>
        <tr><td>Nama Pemohon</td><td>: {{ $permohonan->nama }}</td></tr>
        <tr><td>NIK</td><td>: {{ $permohonan->nik }}</td></tr>
        <tr><td>Rincian Informasi</td><td>: {{ $permohonan->rincian_informasi }}</td></tr>
        <tr><td>Tujuan Penggunaan</td><td>: {{ $permohonan->tujuan_penggunaan }}</td></tr>
        <tr><td>Status Saat Ini</td><td>: {{ strtoupper($permohonan->status) }}</td></tr>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
        <p>Simpan bukti ini untuk memantau status permohonan Anda.</p>
    </div>
</body>
</html>