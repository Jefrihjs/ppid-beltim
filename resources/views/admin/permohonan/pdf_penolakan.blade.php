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
    <div class="kop-surat" style="text-align: center; font-family: 'Times New Roman', serif; position: relative; margin-bottom: 20px; border-bottom: 3px double #000; padding-bottom: 10px;">
    
        {{-- Logo ditempatkan secara absolut agar teks kop tetap di tengah --}}
        <img src="{{ public_path('images/logo-ppid-beltim.png') }}" 
            style="position: absolute; left: 0; top: 30px; width: 80px; height: auto;">
        
        <div style="margin-left: 80px;"> {{-- Memberi ruang agar teks tidak tertutup logo --}}
            <h3 style="margin: 0; font-size: 14pt; text-transform: uppercase; font-weight: normal; line-height: 1.2;">
                Pemerintah Kabupaten Belitung Timur
            </h3>
            <h2 style="margin: 0; font-size: 14pt; text-transform: uppercase; font-weight: bold; line-height: 1.2;">
                Pejabat Pengelola Informasi dan Dokumentasi
            </h2>
            
            <p style="margin: 5px 0 0 0; font-size: 10pt; font-style: italic;">
                Alamat: Komplek Perkantoran Terpadu Manggarawan, Belitung Timur, Bangka Belitung 33511
            </p>
            <p style="margin: 0; font-size: 10pt; font-style: italic;">
                Email: ppid@beltim.go.id | Website: ppid.beltim.go.id
            </p>
        </div>
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
            <td class="qr-box">
                @php
                    $qrLink = route('admin.permohonan.cetak_penolakan', $permohonan->id);
                     
                    $qrcode = base64_encode(QrCode::size(100)
                                ->errorCorrection('H')
                                ->generate($qrLink));
                @endphp
                
                <img src="data:image/png;base64, {!! $qrcode !!}">
                <p style="font-size: 8px; margin-top: 5px;">Scan untuk verifikasi dokumen</p>
            </td>
            <td width="75%" class="footer-text">
                Dokumen ini sah, diterbitkan secara elektronik melalui sistem PPID Beltim sehingga tidak memerlukan cap dan tanda tangan basah. Terima kasih telah menyampaikan permohonan kebutuhan informasi kepada kami.<br><br>
                Belitung Timur, {{ $tanggal_cetak }}<br>
                <strong>TIM PPID</strong><br>
                <strong>Pemerintah Daerah Kabupaten Belitung Timur</strong>
            </td>
        </tr>
    </table>

</body>
</html>