<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Buku Register Permohonan Informasi - PERKI</title>
    <style>

        @page { size: landscape; margin: 1cm; }
        
        body { font-family: 'serif'; font-size: 9px; color: #000; line-height: 1.2; }
        
        .header { text-align: center; margin-bottom: 15px; position: relative; }
        .header h2 { margin: 0; font-size: 14px; text-transform: uppercase; }
        .header p { margin: 2px 0; font-weight: bold; text-transform: uppercase; }
        
        table { width: 100%; border-collapse: collapse; table-layout: fixed; margin-top: 10px; }
        
        th { 
            background-color: #e2e8f0; 
            border: 1px solid #000; 
            padding: 4px 2px; 
            text-align: center; 
            font-size: 8px; 
            font-weight: bold;
        }
        
        td { 
            border: 1px solid #000; 
            padding: 4px; 
            vertical-align: top; 
            word-wrap: break-word;
        }

        .text-center { text-align: center; }
        .bg-gray { background-color: #f1f5f9; }

        .keterangan-section { margin-top: 15px; font-size: 8px; }
        .footer { margin-top: 20px; float: right; width: 300px; text-align: center; }
        .clear { clear: both; }
    </style>
</head>
<body>

    <div class="header">
        <h2>REGISTER PERMINTAAN INFORMASI PUBLIK</h2>
        <p>PEMERINTAH KABUPATEN BELITUNG TIMUR</p>
    </div>

    <table>
        <thead>
            {{-- Baris 1 Header --}}
            <tr>
                <th rowspan="2" width="20">No</th>
                <th rowspan="2" width="40">Tgl</th>
                <th rowspan="2" width="70">Nama</th>
                <th rowspan="2" width="80">Alamat</th>
                <th rowspan="2" width="60">Nomor Kontak</th>
                <th rowspan="2" width="60">Pekerjaan</th>
                <th rowspan="2" width="100">Informasi Yang Diminta</th>
                <th rowspan="2" width="80">Tujuan Penggunaan</th>
                <th colspan="2">Status Informasi</th>
                <th colspan="2">Bentuk Informasi Yang Dikuasai</th>
                <th colspan="2">Jenis Permohonan</th>
                <th rowspan="2" width="80">Keputusan</th>
                <th rowspan="2" width="60">Alasan Penolakan</th>
                <th colspan="2">Hari dan Tanggal</th>
                <th colspan="2">Biaya & Cara Pembayaran</th>
            </tr>
            {{-- Baris 2 Header (Sub-kolom) --}}
            <tr>
                {{-- Status --}}
                <th width="20">Ya</th>
                <th width="20">Tdk</th>
                {{-- Bentuk --}}
                <th width="30">Soft copy</th>
                <th width="30">Hard copy</th>
                {{-- Jenis --}}
                <th width="35">Melihat/ Mengetahui</th>
                <th width="35">Meminta Salinan</th>
                {{-- Hari/Tgl --}}
                <th width="50">Pemberitahuan Tertulis</th>
                <th width="50">Pemberian Informasi</th>
                {{-- Biaya --}}
                <th width="30">Biaya</th>
                <th width="30">Cara</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $p)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->no_hp }}</td>
                <td>{{ $p->pekerjaan }}</td>
                <td>{{ $p->rincian_informasi }}</td>
                <td>{{ $p->tujuan_penggunaan }}</td>
                
                {{-- Status Info --}}
                <td class="text-center">{{ $p->status == 'SELESAI' ? 'V' : '' }}</td>
                <td class="text-center">{{ $p->status == 'DITOLAK' ? 'V' : '' }}</td>
                
                {{-- Bentuk --}}
                <td class="text-center">{{ $p->format_informasi == 'Elektronik' ? 'V' : '' }}</td>
                <td class="text-center">{{ $p->format_informasi == 'Cetak' ? 'V' : '' }}</td>
                
                {{-- Jenis --}}
                <td class="text-center">{{ $p->cara_perolehan == 'Melihat' ? 'V' : '' }}</td>
                <td class="text-center">{{ $p->cara_perolehan == 'Salinan' ? 'V' : '' }}</td>
                
                <td>{{ $p->status == 'SELESAI' ? 'Informasi diberikan' : 'Ditolak/Proses' }}</td>
                <td>{{ $p->alasan_penolakan ?? '-' }}</td>
                
                {{-- Hari/Tgl --}}
                <td class="text-center">{{ \Carbon\Carbon::parse($p->created_at)->addDays(3)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $p->status == 'SELESAI' ? \Carbon\Carbon::parse($p->updated_at)->format('d/m/Y') : '-' }}</td>
                
                {{-- Biaya --}}
                <td class="text-center">Gratis</td>
                <td class="text-center">N/A</td>
            </tr>
            @empty
            <tr>
                <td colspan="20" class="text-center" style="padding: 20px;">Data Tidak Ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="keterangan-section">
        <strong>KETERANGAN:</strong><br>
        1. Nomor pendaftaran permohonan informasi Publik. 2. Tanggal permohonan diterima. 3. Nama pemohon. 4. Alamat lengkap pemohon. 5. Nomor kontak pemohon. 6. Pekerjaan pemohon. 7. Rincian informasi yang diminta. 8. Alasan/tujuan penggunaan informasi.
    </div>

    <div class="footer">
        <p>Manggar, {{ now()->translatedFormat('d F Y') }}</p>
        <p><strong>ADMIN PPID UTAMA</strong></p>
        <br><br><br>
        <p><strong>( __________________________ )</strong></p>
    </div>
    <div class="clear"></div>

</body>
</html>