<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
    
    .kop-surat { text-align: center; position: relative; margin-bottom: 20px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .logo-beltim { position: absolute; left: 0; top: 10px; width: 80px; height: auto; }
        .header-text { margin-left: 80px; margin-right: 80px; text-align: center; }
        .clearfix { clear: both; }


    @page {
        margin: 0;
    }
    body {
        margin: 0;
        padding: 0;
        font-family: "Times New Roman", Times, serif;
        line-height: 1.5;
    }

    .page-container {
        /* Margin standar surat dinas: Kiri 2.5cm, Kanan 2cm, Atas 1.5cm */
        padding: 0.5cm 0cm 0cm 0.5cm;
    }

    /* Penyesuaian agar teks isi surat rapi */
    .isi-surat {
        text-align: justify; /* Rata kanan kiri wajib untuk surat dinas */
        margin-top: 20px;
    }

    .isi-surat p {
        margin-bottom: 15px; /* Jarak antar paragraf */
        text-indent: 0; /* Ubah ke 40px jika ingin paragraf menjorok */
    }

    /* Style untuk tabel informasi agar tidak berantakan */
    .info-surat {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 25px;
    }

    .info-surat td {
        padding: 2px 0;
        vertical-align: top;
    }

    /* Perbaikan posisi Tanda Tangan agar pas di kanan bawah */
    .ttd-box {
        float: right;
        width: 300px;
        text-align: center;
        margin-top: 50px;
    }

    .nama-ketua {
        text-decoration: underline;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 0;
    }

    .ttd-nama {
        margin-top: 70px; /* Ruang untuk tanda tangan basah/stempel */
        font-weight: bold;
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="page-container">

    <!-- KOP SURAT -->
    <div class="kop-surat">
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

    <!-- ISI LANJUTAN -->
    <table class="info-surat">
        <tr>
            <td width="15%">Nomor</td>
            <td width="2%">:</td>
            <td width="40%">480/{{ $permohonan->id }}/PPID-UTAMA/{{ date('Y') }}</td>
            <td width="43%" style="text-align:right;">
                Manggar, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td>Sifat</td>
            <td>:</td>
            <td>Segera / Penting</td>
            <td></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td>1 (satu) Berkas</td>
            <td></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><strong>Permintaan Data/Informasi Publik</strong></td>
            <td></td>
        </tr>
    </table>

    <div class="isi-surat">
        <p>Yth. <strong>Kepala {{ $pemberitahuan->nama_opd ?? $permohonan->opd->nama_opd ?? 'Dinas Terkait' }}</strong></p>
        <p>Di - <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat</p>

        <p>
            Menindaklanjuti permohonan informasi publik melalui portal PPID Kabupaten
            Belitung Timur dengan nomor pendaftaran
            <strong>{{ $permohonan->nomor_registrasi}}</strong>, bersama ini kami teruskan
            rincian permohonan sebagaimana terlampir untuk dapat ditindaklanjuti sesuai
            ketentuan yang berlaku.
        </p>

        <p>
            Sehubungan dengan hal tersebut, mohon kiranya dapat memberikan
            data/informasi dimaksud atau memberikan tanggapan paling lambat
            3 (tiga) hari kerja sejak surat ini diterima.
        </p>

        <p>Demikian disampaikan, atas perhatian dan kerja samanya diucapkan terima kasih.</p>
    </div>

    <table class="footer-area" style="width: 100%; border: 1px solid #000; margin-top: 50px; border-collapse: collapse;">
        <tr>
            {{-- Sisi Kiri: Kotak QR --}}
            <td style="width: 20%; text-align: center; border-right: 1px solid #000; padding: 15px; vertical-align: middle;">
                @php
                    // QR Code mengarah ke link PDF Surat ke OPD
                    $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($urlPdf));
                @endphp
                <img src="data:image/svg+xml;base64,{{ $qrcode }}">
                <p style="font-size: 7px; margin-top: 5px; font-family: sans-serif; font-weight: bold; text-transform: uppercase;">SCAN VERIFIKASI</p>
            </td>

            {{-- Sisi Kanan: Informasi Pengesahan --}}
            <td style="width: 80%; padding: 15px; vertical-align: top; text-align: center;">
                <div style="font-family: sans-serif; font-size: 11px; line-height: 1.5;">
                    <p style="margin: 0 0 15px 0; font-style: italic;">
                        Dokumen ini sah, diterbitkan secara elektronik melalui sistem PPID Kabupaten Belitung Timur sehingga tidak memerlukan cap dan tanda tangan basah.
                    </p>
                    
                    <p style="margin: 0;">Manggar, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <p style="font-weight: bold; margin: 5px 0 0 0; text-transform: uppercase;">ATASAN PPID</p>
                    <p style="font-weight: bold; margin: 0 0 15px 0;">Pemerintah Kabupaten Belitung Timur</p>
                    
                    <p style="text-decoration: underline; font-weight: bold; text-transform: uppercase; margin: 0; font-size: 12px;">
                        {{ $namaKetua }}
                    </p>
                    <p style="margin: 0; font-weight: bold;">NIP. {{ $nipKetua }}</p>
                </div>
            </td>
        </tr>
    </table>
<div class="footer-note">
            Dokumen ini diterbitkan dan dicetak secara otomatis melalui Sistem PPID Kabupaten Belitung Timur.
</div>
</div>

<div class="page-break"></div>

<div class="lampiran-wrapper">
    @include('public.cetak_bukti_pdf')
</div>

</body>
</html>