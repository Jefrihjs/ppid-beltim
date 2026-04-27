<!DOCTYPE html>
<html>
<head>
    <title>Formulir Keberatan - {{ $permohonan->kode_tracking }}</title>
    <style>
        @page { margin: 1cm 1.5cm; }
        body { font-family: 'serif'; font-size: 10px; line-height: 1.2; color: #000; }
        
        /* Kop Surat & Header PERKI */
        .header-perki { text-align: right; font-weight: bold; margin-bottom: 10px; font-size: 9px; }
        .kop-box { border: 1px solid #000; padding: 5px; margin-bottom: 5px; text-align: center; }
        .logo-placeholder { border: 1px solid #000; width: 80px; height: 50px; float: left; padding: 5px; }
        
        .title-box { text-align: center; margin-top: 10px; }
        .title-box h3 { margin: 0; font-size: 11px; }

        /* Tabel Struktur */
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        .no-border td { border: none; padding: 1px 3px; vertical-align: top; }
        .line-bottom { border-bottom: 1px solid #000; }
        
        .check-box { width: 15px; height: 15px; border: 1px solid #000; display: inline-block; vertical-align: middle; text-align: center; line-height: 15px; font-weight: bold; }
        
        .footer-note {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px; /* Atur tinggi footer */
            text-align: center;
            color: #999;
            font-size: 9px;
            font-style: italic;
            border-top: 0.5px solid #eee;
            padding-top: 5px;
        }
        .clear { clear: both; }

        .check-box { 
            width: 15px; 
            height: 15px; 
            border: 1px solid #000; 
            display: inline-block; 
            text-align: center; 
            line-height: 13px; /* Sesuaikan agar posisi V di tengah kotak */
            font-family: Arial, sans-serif; /* Pakai font standar agar karakter muncul */
        }
    </style>
</head>
<body>
        <p style="text-align: right; margin: 5px 0 0 0; font-style: italic; font-weight: bold; font-size: 10px;">
            (RANGKAP DUA)
        </p>
        

    <div class="kop-surat" style="text-align: center; font-family: 'Times New Roman', serif; position: relative; margin-bottom: 20px; border-bottom: 3px double #000; padding-bottom: 10px;">
    
        @php
            $path = public_path('images/logo-ppid-beltim.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_exists($path) ? file_get_contents($path) : null;
            $base64 = $data ? 'data:image/' . $type . ';base64,' . base64_encode($data) : null;
        @endphp

        @if($base64)
            <img src="{{ $base64 }}" class="logo-beltim" style="position: absolute; left: 0; top: 20px; width: 80px; height: auto;">
        @else
            <div style="position: absolute; left: 0; width: 80px; font-size: 8pt; color: #ccc;">(Logo)</div>
        @endif
        
        <div style="margin-left: 80px;">
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

    <div class="title-box">
        <h3 style="margin: 0; line-height: 1.5; text-transform: uppercase;">
            PERNYATAAN KEBERATAN ATAS PERMINTAAN<br>
            INFORMASI PUBLIK
        </h3>
    </div>

    {{-- BAGIAN A --}}
    <p><strong>A. INFORMASI PENGAJU KEBERATAN</strong></p>
    <table class="no-border" style="margin-left: 20px;">
        <tr>
            <td width="30%">Nomor Registrasi Keberatan</td>
            <td width="2%">:</td>
            <td class="line-bottom">{{ $keberatan->nomor_registrasi_keberatan }}</td>
            
        </tr>
        <tr>
            <td>Nomor Pendaftaran Permohonan Informasi</td>
            <td>:</td>
            <td class="line-bottom" colspan="2">{{ $permohonan->nomor_registrasi }}</td>
        </tr>
            <td>Tujuan Penggunaan Informasi</td>
            <td>:</td>
            <td class="line-bottom" colspan="2">{{ $permohonan->tujuan_penggunaan }}</td>
        </tr>
        <tr><td colspan="4" style="padding-top: 5px;"><strong>Identitas Pemohon</strong></td></tr>
        <tr>
            <td style="padding-left: 20px;">Nama</td>
            <td>:</td>
            <td class="line-bottom" colspan="2">{{ $permohonan->nama }}</td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">Alamat</td>
            <td>:</td>
            <td class="line-bottom" colspan="2">{{ $permohonan->alamat }}</td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">Pekerjaan</td>
            <td>:</td>
            <td class="line-bottom" colspan="2">{{ $permohonan->pekerjaan ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">Nomor Telepon</td>
            <td>:</td>
            <td class="line-bottom" colspan="2">{{ $permohonan->no_hp }}</td>
        </tr>
        <tr><td colspan="4" style="padding-top: 5px;"><strong>Identitas Kuasa Pemohon **</strong></td></tr>
        <tr><td style="padding-left: 20px;">Nama</td><td>:</td><td class="line-bottom" colspan="2">-</td></tr>
        <tr><td style="padding-left: 20px;">Alamat</td><td>:</td><td class="line-bottom" colspan="2">-</td></tr>
        <tr><td style="padding-left: 20px;">Nomor Telepon</td><td>:</td><td class="line-bottom" colspan="2">-</td></tr>
    </table>

    {{-- BAGIAN B --}}
    <p><strong>B. ALASAN PENGAJUAN KEBERATAN***</strong></p>
    <table class="no-border" style="margin-left: 20px;">
        @php
            $alasan_kip = [
                'a' => 'Permohonan Informasi di tolak.',
                'b' => 'Informasi berkala tidak disediakan.',
                'c' => 'Permintaan informasi tidak ditanggapi.',
                'd' => 'Permintaan informasi ditanggapi tidak sebagaimana yang diminta.',
                'e' => 'Permintaan informasi tidak dipenuhi.',
                'f' => 'Biaya yang dikenakan tidak wajar.',
                'g' => 'Informasi disampaikan melebihi jangka waktu yang ditentukan.'
            ];
        @endphp
        @foreach($alasan_kip as $key => $val)
        <tr>
            <td width="30" align="center">
                <div class="check-box" style="font-family: DejaVu Sans, sans-serif;">
                    @php
                        // 1. Bersihkan input dari DB (Hapus titik di akhir dan spasi berlebih)
                        $alasanDariDB = trim(rtrim($keberatan->alasan, '.'));
                        
                        // 2. Bersihkan teks pilihan sistem (Hapus titik di akhir)
                        $pilihanSistem = trim(rtrim($val, '.'));
                    @endphp

                    {{-- Logika: Cek apakah key cocok (misal 'd' == 'd') --}}
                    {{-- ATAU cek apakah teksnya SAMA PERSIS setelah dibersihkan --}}
                    @if(strtolower($keberatan->alasan) == $key || strcasecmp($alasanDariDB, $pilihanSistem) == 0)
                        v
                    @endif
                </div>
            </td>
            <td>{{ $key }}. {{ $val }}</td>
        </tr>
        @endforeach
    </table>

    {{-- BAGIAN C --}}
    <p><strong>C. KASUS POSISI (tambahkan kertas bila perlu)</strong></p>
    <div style="margin-left: 20px; border-bottom: 1px solid #000; min-height: 40px;">
        {{ $keberatan->kronologi }}
    </div>

    {{-- BAGIAN D --}}
    <p><strong>D. HARI/TANGGAL TANGGAPAN ATAS KEBERATAN AKAN DIBERIKAN :</strong> 
       <span style="border-bottom: 1px solid #000;">{{ \Carbon\Carbon::parse($keberatan->created_at)->addDays(30)->translatedFormat('d F Y') }}</span>
    </p>

    <p>Demikian keberatan ini saya sampaikan, atas perhatian dan tanggapannya, saya ucapkan terimakasih.</p>

    <table class="no-border" style="margin-top: 10px;">
        <tr>
            <td width="50%"></td>
            <td style="text-align: center;">Manggar, {{ \Carbon\Carbon::parse($keberatan->created_at)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">
                Mengetahui,<br>
                <strong>Petugas Informasi<br>(Penerima Keberatan)</strong><br><br><br><br>
                ( {{ auth()->user()->name ?? '............................................' }} )<br>
            </td>
            <td style="text-align: center;">
                <br><strong>Pengaju Keberatan</strong><br><br><br><br><br>
                ( {{ $permohonan->nama }} )<br>
            </td>
        </tr>
    </table>


    <div class="footer-note">
            Dokumen ini diterbitkan dan dicetak secara otomatis melalui Sistem PPID Kabupaten Belitung Timur.
    </div>
</body>
</html>