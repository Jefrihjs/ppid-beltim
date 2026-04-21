<!DOCTYPE html>
<html>
<head>
    <title>Bukti Permohonan Informasi</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .wrapper { width: 100%; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .logo { width: 60px; margin-bottom: 10px; }
        .kop-text { font-size: 16px; font-weight: bold; margin: 0; }
        .content-title { text-align: center; font-weight: bold; text-decoration: underline; margin: 20px 0; font-size: 14px; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 5px; vertical-align: top; }
        .qr-section { border: 1px solid #000; width: 100%; margin-top: 30px; }
        .qr-box { padding: 10px; text-align: center; border-right: 1px solid #000; width: 150px; }
        .legal-text { padding: 10px; font-size: 10px; line-height: 1.4; }
        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            {{-- Pastikan path logo benar --}}
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-beltim.png'))) }}" class="logo">
            <p class="kop-text">Pejabat Pengelola Informasi dan Dokumentasi</p>
            <p class="kop-text">PPID - BELTIM</p>
        </div>

        <div class="content-title">TANDA BUKTI PENGAJUAN PERMOHONAN INFORMASI</div>

        <p>Berdasarkan permohonan informasi pada tanggal <strong>{{ $permohonan->created_at->format('d F Y') }}</strong> dengan nomor pendaftaran <strong>{{ $permohonan->nomor_registrasi }}</strong>, Kami menyampaikan kepada Saudara/i:</p>

        <table class="info-table">
            <tr>
                <td width="30%">Nama</td>
                <td width="2%">:</td>
                <td><strong>{{ $permohonan->nama }}</strong></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $permohonan->alamat }}</td>
            </tr>
            <tr>
                <td>Nomor Telp / eMail</td>
                <td>:</td>
                <td>{{ $permohonan->no_hp }} / {{ $permohonan->email }}</td>
            </tr>
            <tr>
                <td>Rincian Informasi</td>
                <td>:</td>
                <td>{{ $permohonan->rincian_informasi }}</td>
            </tr>
        </table>

        <table class="qr-section" cellspacing="0">
            <tr>
                <td class="qr-box">
                    {{-- Kita render ke SVG, lalu di-encode ke base64 agar dompdf bisa baca --}}
                    @php
                        $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($permohonan->kode_tracking));
                    @endphp
                    <img src="data:image/svg+xml;base64,{{ $qrcode }}" style="width: 100px; height: 100px;">
                </td>
                <td class="legal-text">
                    Dokumen ini sah, diterbitkan secara elektronik melalui sistem PPID Beltim sehingga tidak memerlukan cap dan tanda tangan basah. Terima kasih telah menyampaikan permohonan kebutuhan informasi kepada kami.<br><br>
                    <strong>Belitung Timur, {{ date('d F Y') }}</strong><br>
                    <strong>TIM PPID</strong><br>
                    <strong>Pemerintah Daerah Kabupaten Belitung Timur</strong>
                </td>
            </tr>
        </table>

        <div class="footer">
            Kompleks Perkantoran Terpadu<br>
            Jalan Raya Manggar Gantung Desa Padang Kecamatan Manggar<br>
            Situs : https://ppid.beltim.go.id<br>
            <em>*Berkas ini dicetak otomatis melalui aplikasi PPID - Lawang Beltim</em>
        </div>
    </div>
</body>
</html>