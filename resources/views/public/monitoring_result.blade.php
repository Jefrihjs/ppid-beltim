@extends('layouts.public')

@section('content')

@php
    $rows = [
        'Kode Registrasi'     => $permohonan->nomor_registrasi,
        'Kategori Pemohon'    => ucfirst($permohonan->kategori_pemohon ?? ''),
        'Nama Lengkap'        => $permohonan->nama,
        'NIK'                 => $permohonan->nik ?? '-',
        'Alamat Domisili'     => $permohonan->alamat ?? '-',
        'Email'               => $permohonan->email ?? '-',
        'Telepon'             => $permohonan->no_hp,
        'Rincian Informasi'   => $permohonan->rincian_informasi,
        'Tujuan Penggunaan'   => $permohonan->tujuan_penggunaan ?? '-',
        'Cara Memperoleh'     => $permohonan->cara_memperoleh ?? '-',
        'Jenis Salinan'       => $permohonan->jenis_salinan ?? '-',
    ];
@endphp

<section class="py-24 bg-slate-50 min-h-screen" x-data="{ openDetail: false }">
    <div class="max-w-4xl mx-auto px-6">
       
        {{-- HEADER --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 no-print">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Status <span class="text-blue-600">Permohonan</span></h1>
                <p class="text-slate-500 font-medium mt-1">Lacak progres permintaan informasi Anda secara transparan.</p>
            </div>
            <div class="bg-blue-600 px-6 py-2 rounded-2xl shadow-lg shadow-blue-200">
                <span class="text-[10px] font-black text-blue-100 uppercase tracking-widest block">Kode Permohonan</span>
                <span class="text-white font-black text-xl tracking-wider">#{{ $permohonan->nomor_registrasi }}</span>
            </div>
        </div>

        {{-- CARD RINGKASAN --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden mb-8 no-print">
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row gap-10 items-start">
                    <div class="relative flex-shrink-0">
                        <div class="w-24 h-24 bg-slate-100 rounded-3xl flex items-center justify-center border-2 border-slate-50 shadow-inner">
                            @if($permohonan->kategori_pemohon == 'perorangan')
                                <svg class="w-12 h-12 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            @else
                                <svg class="w-12 h-12 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm10 12h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V9h2v2zm0-4h-2V5h2v2zm4 12h-2v-2h2v2zm0-4h-2v-2h2v2z"/></svg>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-emerald-500 text-white p-2 rounded-xl shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </div>

                    <div class="flex-1">
                        <h2 class="text-2xl font-black text-slate-900">{{ $permohonan->nama }}</h2>
                        <p class="text-slate-400 font-medium text-sm italic mb-6">Diajukan pada {{ $permohonan->created_at->translatedFormat('l, d M Y') }}</p>
                       
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 pt-6 border-t border-slate-50">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kategori</p>
                                <p class="text-sm font-bold text-slate-700 uppercase">{{ $permohonan->kategori_pemohon }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">No. Ponsel</p>
                                <p class="text-sm font-bold text-slate-700">{{ $permohonan->no_hp }}</p>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</p>
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-black uppercase rounded-lg border border-amber-200">
                                    {{ $permohonan->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="bg-slate-50/50 p-6 px-12 border-t border-slate-100 flex items-center justify-between no-print">
                <div class="flex gap-3">
                    <button @click="openDetail = true" class="bg-white border border-slate-200 text-slate-700 px-6 py-2 rounded-xl text-[10px] font-black uppercase hover:bg-slate-900 hover:text-white transition-all shadow-sm tracking-widest">
                        Detil Permohonan
                    </button>
                    <button onclick="window.print()" class="bg-white border border-slate-200 text-slate-700 p-2 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    </button>
                </div>
                <p class="hidden md:block text-[10px] font-bold text-slate-400 uppercase tracking-tighter italic">ID Database: #{{ $permohonan->id }}</p>
            </div>
        </div>

        {{-- NAVIGASI TAB --}}
        <div class="flex gap-2 mb-6 no-print">
            <button class="bg-slate-900 text-white px-8 py-3 rounded-2xl text-[10px] font-black uppercase shadow-lg shadow-slate-200 tracking-widest">Riwayat Progres</button>
            <button class="bg-white text-slate-400 px-8 py-3 rounded-2xl text-[10px] font-black uppercase hover:bg-red-50 hover:text-red-500 transition-all border border-slate-100 tracking-widest">Ajukan Keberatan</button>
        </div>

        {{-- TIMELINE --}}
        <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 no-print">
            <div class="relative">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 border-l-2 border-dashed border-slate-200"></div>
                
                <div class="relative pl-12 mb-10">
                    <div class="absolute left-0 top-0 w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-200 z-10 border-4 border-white">
                        <span class="text-white text-[10px] font-black">01</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ $permohonan->created_at->translatedFormat('d M Y - H:i') }} WIB</span>
                        <h4 class="text-lg font-black text-slate-800 mt-1">Permohonan Terkirim</h4>
                        <p class="text-slate-500 text-sm mt-2">Permohonan informasi Anda telah masuk ke sistem PPID Belitung Timur.</p>
                    </div>
                </div>

                @if($permohonan->status != 'pending')
                <div class="relative pl-12">
                    <div class="absolute left-0 top-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg shadow-emerald-200 z-10 border-4 border-white">
                        <span class="text-white text-[10px] font-black">02</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">{{ $permohonan->updated_at->translatedFormat('d M Y - H:i') }} WIB</span>
                        <h4 class="text-lg font-black text-slate-800 mt-1">{{ ucwords($permohonan->status) }}</h4>
                        <p class="text-slate-500 text-sm mt-2">
                            @if($permohonan->status == 'selesai') Informasi telah disediakan.
                            @elseif($permohonan->status == 'ditolak') Permohonan ditolak.
                            @else Sedang diproses. @endif
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- MODAL DETAIL --}}
        <div x-show="openDetail" x-transition class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm no-print" x-cloak>
            <div @click.away="openDetail = false" class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden max-h-[95vh] flex flex-col">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <h3 class="text-[11px] font-black text-slate-800 uppercase tracking-widest">Detil Permohonan #{{ $permohonan->nomor_registrasi }}</h3>
                    <button @click="openDetail = false" class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow text-slate-400 hover:text-red-500">✕</button>
                </div>
                <div class="p-8 overflow-y-auto custom-scrollbar">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        @foreach($rows as $label => $value)
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $label }}</p>
                            <p class="text-sm font-semibold text-slate-700 mt-1">{{ $value ?? '-' }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="p-8 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button onclick="window.print()" class="px-8 py-3 bg-emerald-500 text-white text-[10px] font-black uppercase rounded-2xl hover:bg-emerald-600">Cetak Data</button>
                    <button @click="openDetail = false" class="px-10 py-3 bg-slate-900 text-white text-[10px] font-black uppercase rounded-2xl">Tutup</button>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

{{-- ====================== AREA PRINT ====================== --}}
<div id="area-print-final">
    <div class="print-header-style">
        <h1>Bukti Permohonan Informasi Publik</h1>
        <p>PPID Kabupaten Belitung Timur</p>
    </div>

    <table class="print-table-style">
        @foreach($rows as $label => $value)
        <tr>
            <td class="print-label">{{ $label }}</td>
            <td class="print-value">{{ $value ?? '-' }}</td>
        </tr>
        @endforeach
    </table>

    <div class="print-footer">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }} WIB<br>
        Kode Registrasi: #{{ $permohonan->nomor_registrasi }}
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

    #area-print-final { display: none !important; }

    @media print {
        .no-print, nav, footer, header, section, .fixed, [x-cloak] {
            display: none !important;
        }

        body, html {
            background: white !important;
            margin: 0;
            padding: 0;
        }

        #area-print-final {
            display: block !important;
            width: 100% !important;
            padding: 30px;
        }

        .print-header-style {
            text-align: center;
            border-bottom: 3px solid #1e40af;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .print-header-style h1 { font-size: 22px; margin: 0; text-transform: uppercase; }
        .print-header-style p { font-size: 14px; margin: 8px 0 0 0; color: #333; }

        .print-table-style {
            width: 100%;
            border-collapse: collapse;
        }
        .print-table-style td {
            border: 1px solid #333;
            padding: 12px;
            font-size: 13px;
            vertical-align: top;
        }
        .print-label {
            background-color: #f1f5f9 !important;
            font-weight: bold;
            width: 40%;
            -webkit-print-color-adjust: exact;
        }

        .print-footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #555;
            font-style: italic;
        }

        @page { size: A4; margin: 15mm; }
    }
</style>