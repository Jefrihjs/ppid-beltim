<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 1cm 1.5cm; }
        body { font-family: 'Times New Roman', serif; font-size: 11px; line-height: 1.4; color: #000; }
        
        .kop-surat { text-align: center; position: relative; margin-bottom: 10px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .logo-kop { position: absolute; left: 0; top: 10px; width: 80px; height: auto; }
        
        /* Judul dan Nomor Pendaftaran */
        .title-area { 
            text-align: center; 
            margin: 15px 0; 
        }
        .title-surat { 
            font-weight: bold; 
            text-transform: uppercase; 
            font-size: 12pt; 
            text-decoration: underline;
            margin-bottom: 2px;
        }
        .nomor-pendaftaran {
            font-size: 10pt;
            font-weight: normal;
        }

        .dimmed { color: #a1a1a1; text-decoration: line-through; }
        .active-section { background-color: #fff9e6; border: 2px solid #000 !important; }
        .checkbox-big { 
            display: inline-block; 
            width: 14px; 
            height: 14px; 
            border: 1.5px solid #000; 
            text-align: center; 
            line-height: 14px; 
            font-weight: bold; 
            background: #fff;
        }
        .footer-note {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px; 
            text-align: center;
            color: #999;
            font-size: 9px;
            font-style: italic;
            border-top: 0.5px solid #eee;
            padding-top: 5px;
        }
        
        .table-pemohon { width: 100%; margin-bottom: 10px; }
        .table-pemohon td { vertical-align: top; }

        .table-isi { width: 100%; border-collapse: collapse; margin-top: 5px; }
        .table-isi th, .table-isi td { border: 1px solid black; padding: 5px; vertical-align: top; }
        .text-center { text-align: center; }
        .bg-gray { background-color: #f2f2f2; font-weight: bold; }

        .footer-area { width: 100%; margin-top: 20px; }
        .qr-box { width: 100px; text-align: center; vertical-align: bottom; }
        .ttd-box { width: 250px; text-align: center; float: right; }
        
        .checkbox { display: inline-block; width: 10px; height: 10px; border: 1px solid #000; margin-right: 5px; text-align: center; line-height: 10px; font-size: 8px; }
    </style>
</head>
<body>
    @php
        // 1. Definisikan logika status
        $status = strtoupper($permohonan->status);
        
        // 2. Ambil alasan tolak/tidak tersedia dari tabel pemberitahuan
        $alasanTolak = $pemberitahuan->alasan_tolak ?? '';

        // 3. LOGIKA PENENTU (DIPERBAIKI):
        // $canProvide: TRUE jika informasi diberikan (Status SELESAI/DIPENUHI & Alasan Kosong)
        $canProvide = in_array($status, ['DIPROSES', 'SELESAI', 'DIPENUHI']) && empty($alasanTolak);
        
        // $cannotProvide: TRUE jika ada penolakan (Status DITOLAK/TIDAK_LENGKAP atau Alasan Terisi)
        $cannotProvide = in_array($status, ['DITOLAK', 'TIDAK_LENGKAP']) || !empty($alasanTolak);

        // Variabel tambahan jika Bapak ingin pakai logika "Dicoret" yang lebih simpel
        $isADicoret = $cannotProvide; // Baris A dicoret jika tidak bisa menyediakan
        $isBDicoret = $canProvide;    // Baris B dicoret jika bisa menyediakan
    @endphp
    <div class="kop-surat">
        <img src="{{ public_path('images/logo-ppid-beltim.png') }}" class="logo-kop">
        <div style="margin-left: 80px;">
            <h3 style="margin: 0; font-size: 14pt; text-transform: uppercase; font-weight: normal; line-height: 1.2;">
                Pemerintah Kabupaten Belitung Timur
            </h3>
            <h2 style="margin: 0; font-size: 14pt; text-transform: uppercase; font-weight: bold; line-height: 1.2;">
                Pejabat Pengelola Informasi dan Dokumentasi
            </h2>
            <p style="margin: 5px 0 0 0; font-size: 9pt; font-style: italic;">
                Alamat: Komplek Perkantoran Terpadu Manggarawan, Belitung Timur, Bangka Belitung 33511
            </p>
            <p style="margin: 0; font-size: 9pt; font-style: italic;">
                Email: ppid@beltim.go.id | Website: ppid.beltim.go.id
            </p>
        </div>
    </div>

    <div class="title-area">
        <div class="title-surat">
            {{ $canProvide ? 'PEMBERITAHUAN TERTULIS' : 'PEMBERITAHUAN PENOLAKAN PERMOHONAN' }}
        </div>
        <div class="nomor-pendaftaran">Nomor Pendaftaran: <strong>{{ $permohonan->nomor_registrasi }}</strong></div>
    </div>

    <p style="margin-top: 0;">Berdasarkan permohonan Informasi pada tanggal <strong>{{ $permohonan->created_at->locale('id')->translatedFormat('d F Y') }}</strong>, Kami menyampaikan kepada Saudara/i:</p>

    <table class="table-pemohon">
        <tr><td width="20%"><strong>Nama</strong></td><td width="2%">:</td><td>{{ $permohonan->nama }}</td></tr>
        <tr><td><strong>Alamat</strong></td><td>:</td><td>{{ $permohonan->alamat }}</td></tr>
        <tr><td><strong>No. Telp/Email</strong></td><td>:</td><td>{{ $permohonan->no_hp }} / {{ $permohonan->email }}</td></tr>
    </table>

    <p style="margin-bottom: 5px;">Pemberitahuan sebagai berikut:</p>
    <div style="margin-top: 15px; font-weight: bold; text-decoration: underline;" 
        class="{{ !$canProvide ? 'dimmed' : '' }}">
        A. Informasi Dapat Diberikan
    </div>

    <table class="table-isi {{ !$canProvide ? 'dimmed' : '' }}">
        <tr class="bg-gray">
            <th width="5%">No.</th>
            <th width="35%">Hal-hal terkait Informasi Publik</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td class="text-center">1.</td>
            <td>Penguasaan Informasi Publik</td>
            <td>
                {{-- Centang Kami --}}
                <div class="checkbox">
                    @if(isset($pemberitahuan->penguasaan) && $pemberitahuan->penguasaan == 'kami') v @endif
                </div> Kami<br>

                {{-- Centang Badan Publik Lain --}}
                <div class="checkbox">
                    @if(isset($pemberitahuan->penguasaan) && $pemberitahuan->penguasaan == 'opd_lain') v @endif
                </div>
                Badan Publik lain, yaitu 
                <strong>{{ ($pemberitahuan->nama_opd ?? '') ?: '................' }}</strong>
            </td>
        </tr>
        <tr>
            <td class="text-center">2.</td>
            <td>Bentuk fisik tersedia</td>
            <td>
                <div class="checkbox">
                    @if(($pemberitahuan->bentuk_fisik ?? '') == 'Softcopy') v @endif
                </div> Softcopy (Digital)<br>
                <div class="checkbox">
                    @if(($pemberitahuan->bentuk_fisik ?? '') == 'Hardcopy') v @endif
                </div> Hardcopy (Salinan Rekaman/Cetak)
            </td>
        </tr>
        {{-- POIN NOMOR 3: BIAYA DI PDF --}}
        <tr>
            <td style="vertical-align: top; text-align: center;">3.</td>
            <td style="vertical-align: top;">Biaya yang dibutuhkan</td>
            <td>
                @php 
                    $salinan = $pemberitahuan->biaya_salinan ?? 0;
                    $kirim = $pemberitahuan->biaya_kirim ?? 0;
                    $lain = $pemberitahuan->biaya_lain ?? 0;
                    $total = $pemberitahuan->total_biaya ?? 0;
                @endphp

                {{-- Baris Penyalinan --}}
            @if($total > 0)
                <div style="margin-bottom: 5px;">
                    <span class="checkbox">@if($salinan > 0) v @else &nbsp; @endif</span> 
                    Penyalinan: Rp {{ number_format($salinan, 0, ',', '.') }}
                </div>

                {{-- Baris Pengiriman --}}
                <div style="margin-bottom: 5px;">
                    <span class="checkbox">@if($kirim > 0) v @else &nbsp; @endif</span> 
                    Pengiriman: Rp {{ number_format($kirim, 0, ',', '.') }}
                </div>

                {{-- Baris Lain-lain --}}
                <div style="margin-bottom: 5px;">
                    <span class="checkbox">@if($lain > 0) v @else &nbsp; @endif</span> 
                    Lain-lain: Rp {{ number_format($lain, 0, ',', '.') }}
                </div>

                {{-- Jika Gratis --}}
                <div style="margin-bottom: 5px;">
                    <span class="checkbox">@if($total == 0) v @else &nbsp; @endif</span> 
                    Lain-lain (Gratis)
                </div>
            @else
                <div style="margin-bottom: 5px;"><span class="checkbox">&nbsp;</span> Penyalinan: Rp -</div>
                <div style="margin-bottom: 5px;"><span class="checkbox">&nbsp;</span> Pengiriman: Rp -</div>
                <div style="margin-bottom: 5px;"><span class="checkbox">&nbsp;</span> Lain-lain: Rp -</div>
                
                <div style="margin-bottom: 5px;">
                    <span class="checkbox">v</span> 
                    Lain-lain (Gratis)
                </div>
            @endif
                <div style="margin-top: 10px; font-weight: bold; border-top: 1px solid #000; padding-top: 5px;">
                    Total Biaya: Rp {{ number_format($total, 0, ',', '.') }}
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">4.</td>
            <td>Waktu penyediaan</td>
            <td>{{ $pemberitahuan->waktu_penyediaan ?? '.......' }} hari</td>
        </tr>
        <tr>
            <td class="text-center">5.</td>
            <td>Penjelasan penghitaman/pengaburan Informasi yang dimohon</td>
            <td>{{ $pemberitahuan->penjelasan_penghitaman ?? '.........................................................' }}</td>
        </tr>
    </table>

    <div style="margin-top: 15px; font-weight: bold;" 
    class="{{ $canProvide ? 'dimmed' : '' }}">
    B. Informasi tidak dapat diberikan karena:
    </div>

    <div style="margin-left: 20px; margin-top: 5px;" class="{{ $canProvide ? 'dimmed' : '' }}">
        {{-- Alasan 1: Belum Dikuasai --}}
        <div class="checkbox-big">
            @if($cannotProvide && str_contains($alasanTolak, 'belum dikuasai')) v @endif
        </div> 
        Informasi yang diminta belum dikuasai<br>

        {{-- Alasan 2: Belum Didokumentasikan --}}
        <div class="checkbox-big">
            @if($cannotProvide && str_contains($alasanTolak, 'belum didokumentasikan')) v @endif
        </div> 
        Informasi yang diminta belum didokumentasikan
    </div>

    {{-- Kalimat jangka waktu yang akan terisi otomatis jika ada datanya --}}
    <p style="margin-left: 20px; margin-top: 5px;" class="{{ $canProvide ? 'dimmed' : '' }}">
        Penyediaan informasi yang belum didokumentasikan dilakukan dalam jangka waktu 
        <strong>{{ $pemberitahuan->jangka_waktu_dokumentasi ?? '.........' }}</strong> hari kerja.
    </p>

    <table class="footer-area" style="width: 100%; border: 1px solid #000; margin-top: 30px; border-collapse: collapse;">
    <tr>
        {{-- Sisi Kiri: Kotak QR --}}
        <td style="width: 20%; text-align: center; border-right: 1px solid #000; padding: 15px; vertical-align: middle;">
            @php
                // QR Code mengarah ke link PDF
                $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($urlPdf));
            @endphp
            <img src="data:image/svg+xml;base64,{{ $qrcode }}">
            <p style="font-size: 7px; margin-top: 5px; font-family: sans-serif; font-weight: bold;">SCAN VERIFIKASI</p>
        </td>

        {{-- Sisi Kanan: Teks & Tanda Tangan --}}
        <td style="width: 80%; padding: 15px; vertical-align: top; text-align: center;">
            <div style="font-family: sans-serif; font-size: 11px; line-height: 1.4;">
                <p style="margin: 0 0 15px 0;">
                    Dokumen ini sah, diterbitkan secara elektronik melalui sistem PPID Beltim sehingga tidak memerlukan cap dan tanda tangan basah. Terima kasih telah menyampaikan permohonan kebutuhan informasi kepada kami.
                </p>
                
                <p style="margin: 0;">Belitung Timur, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p style="font-weight: bold; margin: 5px 0 0 0; text-transform: uppercase;">TIM PPID</p>
                <p style="font-weight: bold; margin: 0 0 15px 0;">Pemerintah Daerah Kabupaten Belitung Timur</p>
                
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