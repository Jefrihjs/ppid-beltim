@extends('layouts.public')

@section('content')

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform -translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     class="mb-6">
    <div class="bg-emerald-500 text-white p-4 rounded-2xl shadow-lg shadow-emerald-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-xl">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest opacity-80">Berhasil</p>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        </div>
        <button @click="show = false" class="text-white/50 hover:text-white font-black text-xl px-4">&times;</button>
    </div>
</div>
@endif

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

<section class="py-24 bg-slate-50 min-h-screen" x-data="{ openDetail: false, openKeberatan: false }">
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
                                
                                {{-- LOGIKA WARNA DINAMIS --}}
                                @if($permohonan->status == 'DIPROSES')
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase rounded-lg border border-emerald-200 shadow-sm">
                                        Diterima / Diproses
                                    </span>
                                @elseif($permohonan->status == 'DITOLAK')
                                    <span class="px-3 py-1 bg-red-100 text-red-700 text-[10px] font-black uppercase rounded-lg border border-red-200 shadow-sm">
                                        Permohonan Ditolak
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-black uppercase rounded-lg border border-amber-200 shadow-sm">
                                        {{ $permohonan->status }}
                                    </span>
                                @endif
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
            <button class="bg-slate-900 text-white px-8 py-3 rounded-2xl text-[10px] font-black uppercase shadow-lg shadow-slate-200 tracking-widest">
                Riwayat Progres
            </button>
            
            {{-- Tombol Ajukan Keberatan --}}
            @if(!$keberatan && in_array($status, ['DIPROSES', 'DITOLAK', 'SELESAI']))
                <button 
                    type="button" 
                    @click.prevent="openKeberatan = true" 
                    class="bg-white text-red-500 px-8 py-3 rounded-2xl text-[10px] font-black uppercase hover:bg-red-50 transition-all border border-red-100 tracking-widest shadow-sm">
                    Ajukan Keberatan
                </button>
            @endif

            {{-- MODAL KEBERATAN --}}
            <div x-show="openKeberatan" 
                class="fixed inset-0 z-[99999] flex items-center justify-center p-6 md:p-10 bg-slate-900/80 backdrop-blur-sm" 
                x-cloak>
                <div @click.away="openKeberatan = false" 
                    class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100 relative"
                    style="max-height: 90vh; margin: 20px;">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-[10px] font-black text-slate-800 uppercase tracking-widest ml-4">Formulir Keberatan</h3>
                        <button @click="openKeberatan = false" class="text-slate-400 hover:text-red-500 font-black px-4">✕</button>
                    </div>
                    
                    <form action="{{ route('admin.permohonan.keberatan.store', $permohonan->id) }}" 
                        method="POST" 
                        class="p-10 overflow-y-auto custom-scrollbar" 
                        style="max-height: calc(90vh - 150px);">
                        @csrf
                        <div class="space-y-6">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-tight">Pilih Alasan Keberatan:</p>
                            
                            <div class="space-y-3">
                                @php
                                    $alasans = [
                                        'A' => 'Permohonan informasi ditolak',
                                        'B' => 'Informasi berkala tidak disediakan',
                                        'C' => 'Permintaan informasi tidak ditanggapi',
                                        'D' => 'Permintaan informasi ditanggapi tidak sebagaimana yang diminta',
                                        'E' => 'Permintaan informasi tidak dipenuhi',
                                        'F' => 'Biaya yang dikenakan tidak wajar',
                                        'G' => 'Informasi disampaikan melebihi jangka waktu'
                                    ];
                                @endphp

                                @foreach($alasans as $key => $teks)
                                <label class="flex items-start gap-3 p-3 border border-slate-100 rounded-xl cursor-pointer hover:bg-slate-50 transition-all">
                                    <input type="radio" name="alasan_keberatan" value="{{ $key }}" class="mt-1 text-red-600 focus:ring-red-500">
                                    <span class="text-xs font-semibold text-slate-700 leading-relaxed"><b class="text-red-500">{{ $key }}.</b> {{ $teks }}</span>
                                </label>
                                @endforeach
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Alasan Tambahan / Kronologi</label>
                                <textarea name="kronologi" rows="3" class="w-full border-2 border-slate-100 rounded-xl p-4 text-sm outline-none focus:border-red-400" placeholder="Jelaskan detail keberatan Anda..."></textarea>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" 
                                    x-data="{ loading: false }" 
                                    @click="loading = true" 
                                    :class="loading ? 'opacity-50 cursor-wait' : ''"
                                    class="w-full py-4 bg-red-600 text-white text-[10px] font-black uppercase rounded-2xl shadow-lg hover:bg-red-700 transition-all tracking-[0.2em]">
                                <span x-show="!loading">Kirim Keberatan Resmi</span>
                                <span x-show="loading" class="flex items-center justify-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Mengirim...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- TIMELINE PROGRESS DINAMIS --}}
        <div class="bg-white p-10 md:p-14 rounded-[2.5rem] shadow-sm border border-slate-100 no-print">
            <div class="relative">
                {{-- Garis Putus-putus --}}
                <div class="absolute left-4 top-0 bottom-0 w-0.5 border-l-2 border-dashed border-slate-200"></div>
                
                @php 
                    $status = strtoupper($permohonan->status); 
                    $hasFile = !empty($permohonan->file_penyelesaian);
                @endphp

                {{-- STEP 01: PENGAJUAN (Selalu Muncul) --}}
                <div class="relative pl-12 mb-12">
                    <div class="absolute left-0 top-0 w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                        <span class="text-white text-[10px] font-black">01</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ $permohonan->created_at->format('d M Y - H:i') }} WIB</span>
                        <h4 class="text-lg font-black text-slate-800 mt-1">Permohonan Terkirim</h4>
                        <p class="text-slate-500 text-sm mt-2">Permohonan informasi Anda telah masuk ke sistem PPID Belitung Timur.</p>
                    </div>
                </div>

                {{-- KONDISI 1: JIKA MASIH BARU (PENDING) --}}
                @if($status == 'PENDING')
                    <div class="relative pl-12 mb-12">
                        <div class="absolute left-0 top-0 w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center border-4 border-white z-10">
                            <span class="text-slate-300 text-[10px] font-black">02</span>
                        </div>
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest">Menunggu Antrean</h4>
                            <p class="text-xs text-slate-400 italic mt-1">Admin PPID belum melakukan tindakan pada permohonan ini.</p>
                        </div>
                    </div>

                {{-- KONDISI 2: JIKA SUDAH DIVERIFIKASI --}}
                @else
                    {{-- STEP 02: VERIFIKASI (Pasti Muncul kalau bukan pending) --}}
                    <div class="relative pl-12 mb-12">
                        <div class="absolute left-0 top-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                            <span class="text-white text-[10px] font-black">02</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">{{ $permohonan->updated_at->format('d M Y - H:i') }} WIB</span>
                            <h4 class="text-lg font-black text-slate-800 mt-1">Permohonan Telah Diverifikasi</h4>
                            <p class="text-slate-500 text-sm mt-2">Tim PPID telah memeriksa berkas identitas dan rincian permohonan Anda.</p>
                        </div>
                    </div>

                    {{-- STEP 03: HASIL KEPUTUSAN (Diferensiasi 3 Kasus) --}}
                    <div class="relative pl-12 {{ $hasFile ? 'mb-12' : '' }}">
                        
                        {{-- KASUS A: TIDAK LENGKAP --}}
                        @if($status == 'TIDAK_LENGKAP')
                            <div class="absolute left-0 top-0 w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                                <span class="text-white text-[10px] font-black">03</span>
                            </div>
                            <div class="bg-amber-50 p-8 rounded-[2rem] border border-amber-200 border-dashed">
                                <h4 class="text-xl font-black text-amber-800 mb-2">Berkas Tidak Lengkap</h4>
                                <p class="text-sm font-bold text-amber-700 italic bg-white/50 p-4 rounded-xl border border-amber-100 mb-4">
                                    "{{ $permohonan->keterangan_tindak_lanjut ?? 'Berkas pendukung tidak sesuai persyaratan.' }}"
                                </p>
                                <p class="text-[11px] font-bold text-slate-600 bg-white p-4 rounded-xl border border-amber-200">
                                    <span class="text-red-600 font-black uppercase tracking-tighter">Keputusan Akhir:</span> Permohonan <span class="text-red-600 underline">tidak dapat dilanjutkan</span>. Mohon ajukan permohonan baru dengan data yang benar.
                                </p>
                            </div>

                        {{-- KASUS B: DITOLAK --}}
                        @elseif($status == 'DITOLAK')
                            <div class="absolute left-0 top-0 w-8 h-8 bg-red-600 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                                <span class="text-white text-[10px] font-black">03</span>
                            </div>
                            <div class="bg-red-50 p-8 rounded-[2rem] border border-red-200">
                                <h4 class="text-xl font-black text-red-800 mb-2">Permohonan Ditolak</h4>
                                <p class="text-sm font-medium text-red-700 italic">"{{ $permohonan->keterangan_tindak_lanjut }}"</p>
                                <p class="mt-4 text-[10px] font-bold text-slate-400 uppercase italic">* Anda dapat mengajukan keberatan jika merasa keputusan ini tidak sesuai.</p>
                            </div>

                        {{-- KASUS C: LANJUT PROSES (Diterima) --}}
                        @elseif($status == 'DIPROSES' && !$hasFile)
                            <div class="absolute left-0 top-0 w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                                <span class="text-white text-[10px] font-black">03</span>
                            </div>
                            <div class="bg-blue-50 p-8 rounded-[2rem] border border-blue-100">
                                <h4 class="text-xl font-black text-blue-800 mb-1">Permohonan Dapat Dipenuhi</h4>
                                <p class="text-sm text-blue-600 font-medium italic">"Admin sedang menyiapkan dokumen informasi untuk Anda."</p>
                            </div>

                        {{-- KASUS D: JIKA SUDAH SELESAI (Transisi ke Step 4) --}}
                        @elseif($hasFile)
                            <div class="absolute left-0 top-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                                <span class="text-white text-[10px] font-black">03</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-800 mt-1">Dokumen Telah Terbit</h4>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed">Verifikasi akhir selesai, dokumen informasi publik telah diterbitkan oleh sistem.</p>
                            </div>
                        @endif
                    </div>

                    {{-- STEP 04: DOWNLOAD (Hanya jika Admin sudah upload bukti) --}}
                    @if($hasFile)
                        <div class="relative pl-12 mt-12">
                            <div class="absolute left-0 top-0 w-8 h-8 bg-slate-900 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                                <span class="text-white text-[10px] font-black">04</span>
                            </div>
                            <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white shadow-2xl">
                                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                                    <div>
                                        <h4 class="text-xl font-black mb-1">Permohonan Selesai</h4>
                                        <p class="text-slate-400 text-sm leading-relaxed">Dokumen informasi publik telah tersedia untuk diunduh.</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $permohonan->file_penyelesaian) }}" target="_blank" 
                                    class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all flex items-center gap-3 shadow-lg shadow-blue-900/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    Unduh Hasil
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- SECTION: TIMELINE KEBERATAN (Muncul otomatis jika ada data di variabel $keberatan) --}}
        @if(isset($keberatan) && $keberatan)
        <div class="mt-12 p-10 md:p-14 bg-rose-50/50 rounded-[2.5rem] border-2 border-dashed border-rose-200 no-print">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div>
                    <h3 class="text-xl font-black text-rose-600 flex items-center gap-3">
                        <span class="flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500"></span>
                        </span>
                        Progres Keberatan Informasi
                    </h3>
                    <p class="text-rose-400 text-xs font-medium mt-1 uppercase tracking-widest">Nomor Registrasi: {{ $keberatan->nomor_registrasi_keberatan }}</p>
                </div>
                <div class="bg-rose-600 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-tighter">
                    Status: {{ $keberatan->status }}
                </div>
            </div>

            <div class="relative">
                {{-- Garis Merah Keberatan --}}
                <div class="absolute left-4 top-0 bottom-0 w-0.5 border-l-2 border-dashed border-rose-200"></div>

                {{-- STEP KBR 01: PENGAJUAN --}}
                <div class="relative pl-12">
                    <div class="absolute left-0 top-0 w-8 h-8 bg-rose-600 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-black text-rose-500 uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($keberatan->created_at)->format('d M Y - H:i') }} WIB
                        </span>
                        <h4 class="text-lg font-black text-slate-800 mt-1">Keberatan Resmi Diajukan</h4>
                        <div class="mt-3 p-5 bg-white rounded-2xl border border-rose-100 shadow-sm">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Alasan Keberatan:</p>
                            <p class="text-sm font-bold text-slate-700 leading-relaxed">
                                @php
                                    $listAlasan = [
                                        'A' => 'Permohonan informasi ditolak',
                                        'B' => 'Informasi berkala tidak disediakan',
                                        'C' => 'Permintaan informasi tidak ditanggapi',
                                        'D' => 'Permintaan informasi ditanggapi tidak sebagaimana yang diminta',
                                        'E' => 'Permintaan informasi tidak dipenuhi',
                                        'F' => 'Biaya yang dikenakan tidak wajar',
                                        'G' => 'Informasi disampaikan melebihi jangka waktu'
                                    ];
                                @endphp
                                {{ $listAlasan[$keberatan->alasan_kode] ?? $keberatan->alasan_kode }}
                            </p>
                            <hr class="my-3 border-rose-50">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kronologi:</p>
                            <p class="text-xs text-slate-600 italic">"{{ $keberatan->kronologi }}"</p>
                        </div>
                    </div>
                </div>

                {{-- STEP KBR 02: TANGGAPAN (Hanya muncul jika status bukan PENDING) --}}
                @if($keberatan->status != 'PENDING')
                <div class="relative pl-12 mt-10">
                    <div class="absolute left-0 top-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($keberatan->updated_at)->format('d M Y - H:i') }} WIB
                        </span>
                        <h4 class="text-lg font-black text-slate-800 mt-1">Tanggapan Atasan PPID</h4>
                        <div class="mt-3 p-5 bg-emerald-50 rounded-2xl border border-emerald-100">
                            <p class="text-sm font-medium text-emerald-900 leading-relaxed">
                                {{ $keberatan->tanggapan_atasan ?? 'Keberatan Anda telah diproses dan ditindaklanjuti oleh Atasan PPID.' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- MODAL DETAIL --}}
        <div x-show="openDetail" x-transition class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm no-print" x-cloak>
            <div @click.away="openDetail = false" class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden max-h-[95vh] flex flex-col">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <h3 class="text-[11px] font-black text-slate-800 uppercase tracking-widest">Detil Permohonan #{{ $permohonan->nomor_registrasi }}</h3>
                    <button @click="openDetail = false" class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow text-slate-400 hover:text-red-500">✕</button>
                </div>
                
                <div class="p-8 overflow-y-auto custom-scrollbar">
                    {{-- Data Tabel --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        @foreach($rows as $label => $value)
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $label }}</p>
                            <p class="text-sm font-semibold text-slate-700 mt-1">{{ $value ?? '-' }}</p>
                        </div>
                        @endforeach
                    </div>

                    {{-- BAGIAN LAMPIRAN KTP --}}
                    <div class="mt-10 pt-6 border-t border-slate-100">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Lampiran Identitas (KTP)</p>
                        
                        @if($permohonan->file_ktp)
                            <div class="group relative w-full md:w-2/3 overflow-hidden rounded-[2rem] border-4 border-white shadow-xl bg-slate-100 transition-all hover:scale-[1.01]">
                                @php
                                    $extension = pathinfo($permohonan->file_ktp, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'webp']))
                                    {{-- Tampilan Jika Gambar --}}
                                    <img src="{{ asset('storage/' . $permohonan->file_ktp) }}" 
                                        class="w-full h-auto object-cover cursor-zoom-in"
                                        @click="window.open($el.src, '_blank')">
                                @else
                                    {{-- Tampilan Jika PDF atau File Lain --}}
                                    <div class="p-8 flex flex-col items-center justify-center gap-3">
                                        <svg class="w-12 h-12 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                        <p class="text-[10px] font-black uppercase text-slate-600">Dokumen KTP (PDF)</p>
                                        <a href="{{ asset('storage/' . $permohonan->file_ktp) }}" target="_blank" class="px-4 py-2 bg-slate-900 text-white text-[9px] font-black uppercase rounded-lg">Buka Dokumen</a>
                                    </div>
                                @endif
                                
                                <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <p class="text-white text-[9px] font-bold uppercase tracking-widest text-center">Klik gambar untuk memperbesar</p>
                                </div>
                            </div>
                        @else
                            <div class="p-6 rounded-[2rem] border-2 border-dashed border-slate-100 flex flex-col items-center justify-center">
                                <span class="text-[10px] font-bold text-slate-400 uppercase italic">Tidak ada file KTP yang diunggah</span>
                            </div>
                        @endif
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