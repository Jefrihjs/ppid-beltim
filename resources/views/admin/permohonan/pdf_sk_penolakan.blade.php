<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 1.5cm 2cm; }
        body { font-family: 'Times New Roman', serif; font-size: 11pt; line-height: 1.3; color: #000; }
        .kop { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 15px; position: relative; }
        .logo { position: absolute; left: 0; top: 0; width: 75px; }
        .judul-sk { text-align: center; font-weight: bold; margin-bottom: 20px; text-transform: uppercase; }
        .table-data { width: 100%; margin-bottom: 15px; border-collapse: collapse; }
        .table-data td { vertical-align: top; padding: 2px 0; }
        .kotak-label { border: 1px solid #000; padding: 10px; text-align: center; font-weight: bold; margin: 10px 0; width: 250px; margin-left: auto; margin-right: auto; }
        .box-kecil { display: inline-block; width: 15px; height: 15px; border: 1px solid #000; margin-right: 10px; vertical-align: middle; }
        .footer { margin-top: 30px; }
        .ttd { float: right; width: 250px; text-align: center; }
    </style>
</head>
<body>
    <div class="kop">
        @php
            $path = public_path('images/logo-ppid-beltim.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_exists($path) ? file_get_contents($path) : null;
            $base64 = $data ? 'data:image/' . $type . ';base64,' . base64_encode($data) : null;
        @endphp

        @if($base64)
            <img src="{{ $base64 }}" class="logo-beltim" style="position: absolute; left: 0; top: 10px; width: 80px; height: auto;">
        @else
            <div style="position: absolute; left: 0; width: 80px; font-size: 8pt; color: #ccc;">(Logo)</div>
        @endif

        <div class="header-text">
            <h3 style="margin: 0; font-size: 14pt; text-transform: uppercase; font-weight: normal; line-height: 1.2;">
                Pemerintah Kabupaten Belitung Timur
            </h3>
            <h2 style="margin: 0; font-size: 12pt; text-transform: uppercase; font-weight: bold; line-height: 1.2;">
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

    <div class="judul-sk">
        SURAT KEPUTUSAN PPID TENTANG PENOLAKAN PERMOHONAN INFORMASI<br>
        No. Pendaftaran: {{ $permohonan->nomor_registrasi }}
    </div>

    <table class="table-data">
        <tr><td width="30%">Nama</td><td width="2%">:</td><td>{{ $permohonan->nama }}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{{ $permohonan->alamat }}</td></tr>
        <tr><td>Nomor Telp/Email</td><td>:</td><td>{{ $permohonan->no_hp }} / {{ $permohonan->email }}</td></tr>
        <tr><td>Rincian Informasi yang dibutuhkan</td><td>:</td><td>{{ $permohonan ->rincian_informasi ?? '-' }}</td></tr>
    </table>

    <p>PPID memutuskan bahwa Informasi yang dimohon adalah:</p>
    <div class="kotak-label">INFORMASI YANG DIKECUALIKAN</div>

    <p>Pengecualian Informasi didasarkan pada alasan:</p>
    <div style="margin-left: 20px;">
        {{-- Cek apakah Pasal 17 dipilih --}}
        @if($pemberitahuan && $pemberitahuan->pasal_17)
            <div style="margin-bottom: 5px;">
                <span style="font-family: DejaVu Sans, sans-serif;">✔</span> 
                Pasal 17 Huruf <strong>{{ strtoupper($pemberitahuan->pasal_17) }}</strong> UU Keterbukaan Informasi Publik
            </div>
        @endif

        {{-- Cek apakah UU Lain diisi --}}
        @if($pemberitahuan && $pemberitahuan->uu_lain)
            <div style="margin-bottom: 5px;">
                <span style="font-family: DejaVu Sans, sans-serif;">✔</span> 
                {{ $pemberitahuan->uu_lain }}
            </div>
        @endif
        
        {{-- Jika keduanya kosong (buat jaga-jaga) --}}
        @if(!$pemberitahuan || (!$pemberitahuan->pasal_17 && !$pemberitahuan->uu_lain))
            <div style="color: #999; font-style: italic;">(Dasar hukum belum ditentukan)</div>
        @endif
    </div>

    <p style="text-align: justify;">Bahwa berdasarkan Pasal-Pasal di atas, membuka Informasi tersebut dapat menimbulkan konsekuensi sebagai berikut:<br>
    <i>"{{ $pemberitahuan->konsekuensi ?? '...................' }}"</i></p>

    <p>Dengan demikian menyatakan bahwa:</p>
    <div class="kotak-label">PERMOHONAN INFORMASI DITOLAK</div>

    <p style="font-size: 9pt; font-style: italic;">Jika Pemohon Informasi keberatan atas penolakan ini maka Pemohon Informasi dapat mengajukan keberatan kepada atasan PPID selambat-lambatnya 30 (tiga puluh) hari kerja sejak menerima Surat Keputusan ini.</p>

    <table style="width: 100%; border: 1.5px solid #000; border-collapse: collapse; margin-top: 30px; font-family: Arial, sans-serif;">
        <tr>
            {{-- Sisi Kiri: Kotak QR --}}
            <td style="width: 100px; text-align: center; border-right: 1.5px solid #000; padding: 10px; vertical-align: middle;">
                @php
                    // Langsung link ke PDF-nya biar discan langsung terbuka filenya
                    $qrLink = route('admin.permohonan.cetak_penolakan', $permohonan->id);
                    $qrcode = base64_encode(QrCode::format('svg')->size(75)->errorCorrection('H')->generate($qrLink));
                @endphp
                <img src="data:image/svg+xml;base64,{{ $qrcode }}" style="width: 75px; height: 75px;">
                <p style="font-size: 7px; margin-top: 5px; font-weight: bold;">SCAN VERIFIKASI</p>
            </td>

            {{-- Sisi Kanan: Teks Pengesahan --}}
            <td style="padding: 15px; vertical-align: top; text-align: center; line-height: 1.4;">
                <p style="margin: 0 0 15px 0; font-size: 10.5px;">
                    Dokumen ini sah, diterbitkan secara elektronik melalui sistem PPID Kabupaten Belitung Timur sehingga tidak memerlukan cap dan tanda tangan basah.
                </p>
                
                <div style="font-size: 11px;">
                    <p style="margin: 0;">Belitung Timur, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <p style="font-weight: bold; margin: 5px 0 0 0; text-transform: uppercase;">PPID UTAMA</p>
                    <p style="font-weight: bold; margin: 0;">Pemerintah Kabupaten Belitung Timur</p>
                    
                    {{-- Nama dan NIP dihapus, diganti garis atau dikosongkan --}}
                     <p style="text-decoration: underline; font-weight: bold; text-transform: uppercase; margin: 0; font-size: 12px;">
                    {{ $namaKetua }}
                </p>
                <p style="margin: 0; font-weight: bold;">NIP. {{ $nipKetua }}</p>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>