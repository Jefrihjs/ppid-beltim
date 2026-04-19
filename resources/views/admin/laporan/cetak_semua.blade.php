<!DOCTYPE html>
<html>
<head>
    <title>Register Permohonan Informasi Publik</title>
    <style>
        @page { size: a4 landscape; margin: 1cm; }
        body { font-family: 'Arial', sans-serif; font-size: 8px; color: #333; }
        .header { text-align: left; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th, td { border: 1px solid #000; padding: 4px 2px; text-align: center; word-wrap: break-word; }
        th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; font-size: 7px; }
        .text-left { text-align: left; padding-left: 4px; }
        .vertical-text { writing-mode: vertical-rl; transform: rotate(180deg); }
    </style>
</head>
<body>
    <div class="header">
        REGISTER PERMOHONAN INFORMASI PUBLIK <br>
        TAHUN {{ $tahun ?? date('Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 20px;">#</th>
                <th rowspan="2" style="width: 40px;">Tgl</th>
                <th rowspan="2" style="width: 60px;">Nama</th>
                <th rowspan="2" style="width: 80px;">Alamat</th>
                <th rowspan="2" style="width: 60px;">Nomor Kontak</th>
                <th rowspan="2" style="width: 50px;">Pekerjaan</th>
                <th rowspan="2" style="width: 90px;">Informasi Yang Diminta</th>
                <th rowspan="2" style="width: 70px;">Tujuan Penggunaan Informasi</th>
                <th rowspan="2" style="width: 45px;">Status</th>
                <th colspan="2">Status Informasi</th>
                <th colspan="2">Bentuk Informasi yang Dikuasai</th>
                <th colspan="3">Jenis Permohonan</th>
                <th rowspan="2" style="width: 40px;">Keputusan</th>
                <th rowspan="2" style="width: 40px;">Alasan Penolakan</th>
                <th colspan="2">Hari dan Tanggal</th>
                <th colspan="2">Biaya & Cara Pembayaran</th>
            </tr>
            <tr>
                {{-- Status Informasi --}}
                <th style="width: 20px;">Ya</th>
                <th style="width: 20px;">Tidak</th>
                {{-- Bentuk --}}
                <th style="width: 30px;">Softcopy</th>
                <th style="width: 30px;">Hardcopy</th>
                {{-- Jenis --}}
                <th style="width: 35px;">Melihat</th>
                <th style="width: 35px;">Mengetahui</th>
                <th style="width: 35px;">Meminta Salinan</th>
                {{-- Hari/Tgl --}}
                <th style="width: 45px;">Pemberitahuan Tertulis</th>
                <th style="width: 45px;">Pemberian Informasi</th>
                {{-- Biaya --}}
                <th style="width: 30px;">Biaya</th>
                <th style="width: 30px;">Cara</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permohonans as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->created_at->format('d/M/Y') }}</td>
                <td class="text-left">{{ $item->nama }}</td>
                <td class="text-left">{{ $item->alamat }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->pekerjaan ?? '-' }}</td>
                <td class="text-left">{{ $item->rincian_informasi }}</td>
                <td class="text-left">{{ $item->tujuan_penggunaan }}</td>
                <td>{{ strtolower($item->status) }}</td>
                
                {{-- Logika Checkmark sesuai gambar (Ya/Tidak) --}}
                <td>{{ $item->status != 'DITOLAK' ? 'v' : '' }}</td>
                <td>{{ $item->status == 'DITOLAK' ? 'v' : '' }}</td>
                
                {{-- Bentuk Informasi --}}
                <td>{{ $item->jenis_salinan == 'softcopy' ? 'v' : '' }}</td>
                <td>{{ $item->jenis_salinan == 'hardcopy' ? 'v' : '' }}</td>

                {{-- Jenis Permohonan --}}
                <td>{{ $item->cara_memperoleh == 'melihat' ? 'v' : '' }}</td>
                <td>{{ $item->cara_memperoleh == 'mengetahui' ? 'v' : '' }}</td>
                <td>{{ $item->cara_memperoleh == 'salinan' ? 'v' : '' }}</td>

                <td>{{ $item->status == 'SELESAI' ? 'Dipenuhi' : 'Belum Dipenuhi' }}</td>
                <td>{{ $item->status == 'DITOLAK' ? 'dikecualikan' : '-' }}</td>
                
                {{-- Tanggal Pemberitahuan (Ambil dari updated_at) --}}
                <td>{{ $item->updated_at->format('d/M/Y') }}</td>
                <td>{{ $item->status == 'SELESAI' ? $item->updated_at->format('d/M/Y') : '-' }}</td>
                
                <td>gratis</td>
                <td>online</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>