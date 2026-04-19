<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 13px; line-height: 1.8; color: #333; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 15px; }
        .logo { width: 70px; }
        .title { font-weight: bold; text-decoration: underline; text-align: center; margin-bottom: 30px; text-transform: uppercase; font-size: 15px; }
        .info-table { width: 100%; margin-bottom: 25px; margin-left: 20px; }
        .info-table td { vertical-align: top; padding: 2px 0; }
        .content-section { margin-top: 20px; }
        .footer-box { margin-top: 50px; width: 100%; border: 1px solid #000; padding: 15px; }
        .qr-code { width: 90px; }
        .footer-text { font-size: 10px; text-align: center; line-height: 1.4; }
    </style>
</head>
<body>
    {{-- Header / Kop Surat --}}
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-beltim.png'))) }}" class="logo"><br>
        <span style="font-size: 16px; font-weight: bold; display: block; margin-top: 10px;">Pejabat Pengelola Informasi dan Dokumentasi</span>
        <span style="font-size: 20px; font-weight: bold;">PPID - BELTIM</span>
    </div>

    <div class="title">{{ $judul }}</div>

    <div class="content-section">
        <p>Berdasarkan permohonan informasi pada tanggal <strong>{{ $permohonan->created_at->translatedFormat('d F Y') }}</strong> dengan nomor pendaftaran <strong>{{ $permohonan->nomor_registrasi }}</strong>, Kami menyampaikan kepada Saudara/i:</p>

        <table class="info-table">
            <tr>
                <td width="35%">Nama</td>
                <td width="3%">:</td>
                <td>{{ $permohonan->nama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $permohonan->alamat }}</td>
            </tr>
            <tr>
                <td>Nomor Telp./eMail</td>
                <td>:</td>
                <td>{{ $permohonan->no_hp }} / {{ $permohonan->email }}</td>
            </tr>
        </table>

        <p>Pemberitahuan sebagai berikut:</p>
        
        {{-- LOGIKA JUDUL PESAN DINAMIS --}}
        @if(strtoupper($permohonan->status) == 'TIDAK_LENGKAP')
            <p style="font-weight: bold; font-size: 14px; margin-bottom: 5px; color: #b45309;">Berkas Permohonan Tidak Lengkap</p>
        @else
            <p style="font-weight: bold; font-size: 14px; margin-bottom: 5px; color: #dc2626;">Permohonan Informasi Ditolak</p>
        @endif

        {{-- ISI ALASAN DARI ADMIN --}}
        <div style="margin-left: 20px; padding: 15px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
            <p style="margin: 0; line-height: 1.6;">{{ $alasan }}</p>
        </div>

        {{-- TAMBAHKAN INSTRUKSI JIKA TIDAK LENGKAP --}}
        @if(strtoupper($permohonan->status) == 'TIDAK_LENGKAP')
            <p style="margin-top: 15px; font-size: 11px; font-style: italic;">
                *Catatan: Dikarenakan berkas tidak lengkap, permohonan ini tidak dapat diproses lebih lanjut. Silakan melakukan permohonan ulang dengan data yang lengkap.
            </p>
        @endif
    </div>

    {{-- Footer Box dengan QR Code --}}
    <table class="footer-box">
        <tr>
            <td width="25%" style="text-align: center;">
                <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(100)->margin(0)->generate(url('/cek/'.$permohonan->kode_tracking))) }}" class="qr-code">
            </td>
            <td width="75%" class="footer-text">
                Dokumen ini sah, diterbitkan secara elektronik melalui sistem PPID Beltim sehingga tidak memerlukan cap dan tanda tangan basah. Terima kasih telah menyampaikan permohonan kebutuhan informasi kepada kami.<br><br>
                Belitung Timur, {{ $tanggal_cetak }}<br>
                <strong>TIM PPID</strong><br>
                <strong>Pemerintah Daerah Kabupaten Belitung Timur</strong>
            </td>
        </tr>
    </table>

    {{-- Watermark / Catatan Kaki --}}
    <div style="margin-top: 60px; text-align: center; font-size: 9px; color: #777;">
        Kompleks Perkantoran Terpadu<br>
        Jalan Raya Manggar Gantung Desa Padang Kecamatan Manggar<br>
        Situs : https://ppid.beltim.go.id<br>
        <strong style="color: #000;">*Berkas ini dicetak pada hari {{ now()->translatedFormat('l, d F Y') }} melalui aplikasi PPID - Lawang Beltim</strong>
    </div>
</body>
</html>