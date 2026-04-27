@extends('layouts.admin')

@section('content')
{{-- PEMBUNGKUS UTAMA --}}
<div class="p-6" x-data="{ openPemberitahuan: false, openTidakLengkap: false, openUploadSelesai: false, openUpdateStatus: false }">
    
    {{-- 1. HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Detil Permohonan Informasi</h1>
            <p class="text-slate-500 text-sm font-medium">Kelola dan tindak lanjuti permintaan informasi publik secara transparan.</p>
        </div>
        <a href="{{ route('admin.permohonan.index') }}" class="bg-white border border-slate-200 text-slate-600 px-5 py-2.5 rounded-2xl font-bold hover:bg-slate-50 transition-all text-sm shadow-sm">
            &larr; Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- KOLOM KIRI: INFORMASI DATA --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="bg-slate-900 px-10 py-5 flex justify-between items-center">
                    <span class="text-slate-400 font-black tracking-[0.2em] text-[10px] uppercase">Data Identitas Pemohon</span>
                    <span class="px-4 py-1.5 {{ $permohonan->status == 'pending' ? 'bg-amber-500' : 'bg-emerald-500' }} text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-lg shadow-black/20">
                        {{ str_replace('_', ' ', strtoupper($permohonan->status)) }}
                    </span>
                </div>
                
                <div class="p-5 md:p-12 space-y-8 md:space-y-10">
                    @php
                        $infoFields = [
                            'Kode Permohonan' => ['val' => $permohonan->kode_tracking, 'class' => 'font-mono font-black text-blue-600 tracking-wider text-base md:text-lg break-all'],
                            'Nomor Pendaftaran' => ['val' => $permohonan->nomor_registrasi, 'class' => 'font-black text-slate-800 text-sm md:text-base'],
                            'Nama Lengkap Pemohon' => ['val' => $permohonan->nama . ' (' . strtoupper($permohonan->kategori_pemohon) . ')', 'class' => 'font-black text-slate-900 text-lg md:text-xl tracking-tight leading-tight'],
                            'NIK / No. Identitas' => ['val' => $permohonan->nik, 'class' => 'font-bold text-slate-700 text-sm md:text-base'],
                            'Pekerjaan' => ['val' => $permohonan->pekerjaan ?? '-', 'class' => 'font-bold text-slate-700 text-sm md:text-base'],
                            'Alamat Domisili' => ['val' => $permohonan->alamat, 'class' => 'font-semibold text-slate-600 italic leading-relaxed bg-slate-50 p-4 md:p-5 rounded-2xl border border-slate-100 text-sm md:text-base'],
                            'Kontak' => ['val' => $permohonan->email . ' / ' . $permohonan->no_hp, 'class' => 'font-bold text-slate-700 text-sm md:text-base break-words'],
                        ];
                    @endphp

                    @foreach($infoFields as $label => $data)
                        <div class="w-full pb-6 md:pb-8 border-b border-slate-50 last:border-0 last:pb-0">
                            <label class="block text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] md:tracking-[0.25em] mb-2 md:mb-3">
                                {{ $label }}
                            </label>
                            <div class="{{ $data['class'] }}">
                                {{ $data['val'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mt-6">
                <h3 class="text-sm font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    Rincian Permohonan Informasi
                </h3>

                <div class="space-y-6">
                    {{-- RINCIAN INFORMASI --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Rincian Informasi yang Dibutuhkan</label>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-sm text-slate-700 leading-relaxed">
                            {{ $permohonan->rincian_informasi ?? '-' }}
                        </div>
                    </div>

                    {{-- TUJUAN PENGGUNAAN --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tujuan Penggunaan Informasi</label>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-sm text-slate-700 leading-relaxed">
                            {{ $permohonan->tujuan_penggunaan ?? '-' }}
                        </div>
                    </div>

                    {{-- GRID UNTUK CARA & SALINAN --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Cara Memperoleh</label>
                            <p class="text-sm font-bold text-slate-700 capitalize">{{ $permohonan->cara_memperoleh ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jenis Salinan</label>
                            <p class="text-sm font-bold text-slate-700 capitalize">{{ $permohonan->jenis_salinan ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Cara Pengiriman</label>
                            <p class="text-sm font-bold text-slate-700 capitalize">{{ $permohonan->cara_pengiriman ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TAMPILAN RESUME KEBERATAN (Muncul jika status permohonan adalah KEBERATAN) --}}
            @if($permohonan->status == 'KEBERATAN' && $permohonan->keberatan)
                <div class="mt-12 bg-white rounded-[2.5rem] border-2 border-slate-100 shadow-xl overflow-hidden animate__animated animate__fadeIn">
                    {{-- Header Resume --}}
                    <div class="{{ strtoupper($permohonan->keberatan->status) == 'DITANGGAPI' ? 'bg-emerald-500' : 'bg-amber-500' }} p-6 flex justify-between items-center text-white transition-colors duration-500">
                        <h3 class="font-black uppercase text-xs tracking-widest">Detail Pernyataan Keberatan</h3>
                        <span class="bg-white/20 px-4 py-1.5 rounded-full text-[10px] font-black uppercase">
                            {{ strtoupper($permohonan->keberatan->status) == 'DITANGGAPI' ? 'Ditanggapi' : 'Belum Ditanggapi' }}
                        </span>
                    </div>

                    <div class="p-10 space-y-10">
                        {{-- A. INFORMASI PENGAJU KEBERATAN --}}
                        <section class="mb-10">
                            <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-4 border-b-2 border-slate-100 pb-2 flex items-center gap-2">
                                <span class="w-1.5 h-4 bg-amber-500 rounded-full"></span>
                                A. Informasi Pengaju Keberatan
                            </h4>
                            
                            <div class="space-y-3 px-2">
                                {{-- Baris 1: No Registrasi Keberatan --}}
                                <div class="flex flex-col md:flex-row md:items-center border-b border-slate-50 py-2">
                                    <span class="w-full md:w-64 text-slate-400 font-bold uppercase text-[9px] tracking-wider">Nomor Registrasi Keberatan</span>
                                    <span class="font-black text-slate-800 text-sm">: {{ $permohonan->keberatan->nomor_registrasi_keberatan ?? '-' }}</span>
                                </div>

                                {{-- Baris 2: No Permohonan Informasi --}}
                                <div class="flex flex-col md:flex-row md:items-center border-b border-slate-50 py-2">
                                    <span class="w-full md:w-64 text-slate-400 font-bold uppercase text-[9px] tracking-wider">Nomor Permohonan Informasi</span>
                                    <span class="font-black text-slate-800 text-sm">: {{ $permohonan->nomor_registrasi }}</span>
                                </div>

                                {{-- Baris 3: Tujuan Penggunaan --}}
                                <div class="flex flex-col md:flex-row md:items-start border-b border-slate-50 py-2">
                                    <span class="w-full md:w-64 text-slate-400 font-bold uppercase text-[9px] tracking-wider">Tujuan Penggunaan Informasi</span>
                                    <div class="flex-1 flex items-start gap-1">
                                        <span class="font-black text-slate-800 text-sm">:</span>
                                        <span class="font-bold text-slate-600 text-sm italic">{{ $permohonan->tujuan_penggunaan ?? '-' }}</span>
                                    </div>
                                </div>

                                {{-- Identitas Pemohon (Sesuai gambar image_def6fc) --}}
                                <div class="mt-6 pt-4 space-y-3 bg-slate-50/50 p-6 rounded-3xl border border-slate-100">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4 italic">Identitas Pemohon :</p>
                                    
                                    <div class="flex flex-col md:flex-row">
                                        <span class="w-full md:w-64 text-slate-400 font-bold text-[9px] uppercase">Nama</span>
                                        <span class="font-black text-slate-800 text-sm">: {{ $permohonan->nama }}</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row">
                                        <span class="w-full md:w-64 text-slate-400 font-bold text-[9px] uppercase">Alamat</span>
                                        <span class="font-bold text-slate-600 text-sm">: {{ $permohonan->alamat }}</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row">
                                        <span class="w-full md:w-64 text-slate-400 font-bold text-[9px] uppercase">Pekerjaan</span>
                                        <span class="font-bold text-slate-600 text-sm">: {{ $permohonan->pekerjaan }}</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row">
                                        <span class="w-full md:w-64 text-slate-400 font-bold text-[9px] uppercase">Nomor Ponsel</span>
                                        <span class="font-bold text-slate-600 text-sm">: {{ $permohonan->no_hp }}</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- B. ALASAN KEBERATAN --}}
                        <section>
                            <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-4 border-b pb-2">B. Alasan Pengajuan Keberatan</h4>
                            <div class="space-y-2">
                                @php
                                    $selectedAlasans = explode(',', $permohonan->keberatan->alasan);
                                    $allAlasans = [
                                        'A' => 'Permohonan informasi ditolak',
                                        'B' => 'Informasi berkala tidak disediakan',
                                        'C' => 'Permintaan informasi tidak ditanggapi',
                                        'D' => 'Permintaan informasi ditanggapi tidak sebagaimana yang diminta',
                                        'E' => 'Permintaan informasi tidak dipenuhi',
                                        'F' => 'Biaya yang dikenakan tidak wajar',
                                        'G' => 'Informasi disampaikan melebihi jangka waktu'
                                    ];
                                @endphp

                                @foreach($allAlasans as $key => $teks)
                                    <div class="flex items-center gap-3 text-xs {{ in_array($key, $selectedAlasans) ? 'text-slate-900 font-black' : 'text-slate-300' }}">
                                        <span class="w-6 font-bold">{{ $key }}.</span>
                                        <span class="flex-1">{{ $teks }}</span>
                                        @if(in_array($key, $selectedAlasans))
                                            <span class="text-blue-600 font-black">✔</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        {{-- C. KASUS POSISI --}}
                        <section>
                            <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-2 border-b pb-2">C. Kasus Posisi</h4>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-xs font-medium text-slate-600 italic">
                                {{ $permohonan->keberatan->kronologi }}
                            </div>
                        </section>

                        {{-- D. TANGGAPAN & TOMBOL AKSI --}}
                        <section class="pt-6 border-t-2 border-dashed border-slate-100" x-data="{ showForm: false }">
                            <div class="flex flex-col md:flex-row justify-between gap-6 mb-10">
                                <div class="text-[10px] font-bold text-slate-400 uppercase leading-relaxed">
                                    Hari/Tanggal Tanggapan Atas Keberatan Akan Diberikan :<br>
                                    <span class="text-sm font-black text-slate-800">{{ \Carbon\Carbon::parse($permohonan->keberatan->created_at)->addDays(30)->translatedFormat('l, d F Y') }}</span>
                                </div>
                                <div class="text-center">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mb-8">Pengaju Keberatan,</p>
                                    <p class="font-black text-slate-900 underline">{{ $permohonan->nama }}</p>
                                </div>
                            </div>

                            @if(strtoupper($permohonan->keberatan->status) != 'DITANGGAPI')
                            {{-- TOMBOL UNTUK MEMUNCULKAN FORM --}}
                            <div x-show="!showForm" class="pt-4 border-t border-slate-50">
                                <button @click="showForm = true" 
                                        class="px-6 py-3 border-2 border-indigo-600 text-indigo-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all shadow-lg shadow-indigo-50 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Berikan Tanggapan
                                </button>
                            </div>
                            @else
                                {{-- TAMPILKAN TANGGAPAN & TOMBOL CETAK --}}
                                <div class="mt-4 p-6 bg-emerald-50 border border-emerald-100 rounded-3xl">
                                    <h4 class="text-[10px] font-black text-emerald-600 uppercase mb-2">Tanggapan Atasan PPID:</h4>
                                    <p class="text-sm text-slate-700 leading-relaxed font-medium italic mb-6">
                                        "{{ $permohonan->keberatan->tanggapan ?? 'Belum ada tanggapan' }}"
                                    </p>

                                    {{-- Tombol Cetak PDF muncul di sini kalau sudah ditanggapi --}}
                                    <div class="pt-4 border-t border-emerald-200/50 flex justify-end">
                                        <a href="{{ route('admin.permohonan.cetak_keberatan', $permohonan->id) }}" 
                                        target="_blank"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                            </svg>
                                            Cetak Formulir Keberatan
                                        </a>
                                    </div>
                                </div>
                            @endif

                            {{-- FORM TANGGAPAN --}}
                            <div x-show="showForm" x-cloak x-transition class="mt-8 relative z-50">
                                <form action="{{ route('admin.keberatan.tanggapi', $permohonan->keberatan->id) }}" 
                                    method="POST" 
                                    style="background-color: #f8fafc !important; border: 2px solid #6366f1 !important; display: block !important;"
                                    class="p-10 rounded-[3rem] shadow-2xl overflow-visible">
                                    @csrf
                                    
                                    <h4 class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mb-6">Input Keputusan Atasan PPID</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <label class="text-[9px] font-black text-slate-400 uppercase mb-2 block">Nama Atasan PPID</label>
                                            <input type="text" name="nama_atasan" required 
                                                class="w-full p-4 bg-white border border-slate-200 rounded-2xl text-sm outline-none focus:border-indigo-500">
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-black text-slate-400 uppercase mb-2 block">Posisi Atasan</label>
                                            <input type="text" name="posisi_atasan" required 
                                                class="w-full p-4 bg-white border border-slate-200 rounded-2xl text-sm outline-none focus:border-indigo-500">
                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <label class="text-[9px] font-black text-slate-400 uppercase mb-2 block">Keputusan / Tanggapan</label>
                                        <textarea name="tanggapan" rows="5" required 
                                                class="w-full p-5 bg-white border border-slate-200 rounded-2xl text-sm outline-none focus:border-indigo-500" 
                                                placeholder="Isi tanggapan resmi..."></textarea>
                                    </div>

                                    <div class="flex justify-end gap-4 pt-6 border-t border-slate-200">
                                        <button type="button" @click="showForm = false" 
                                                class="px-6 py-3 text-[10px] font-black text-slate-400 uppercase">
                                            Batal
                                        </button>
                                        
                                        {{-- TOMBOL UTAMA - Saya kasih BG Hitam biar PASTI KELIHATAN --}}
                                        <button type="submit" 
                                                style="background-color: #1e293b !important; color: white !important; opacity: 1 !important;"
                                                class="px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-indigo-600 transition-all cursor-pointer">
                                            Kirim Tanggapan Sekarang
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div> 
                </div> 

                @endif 
        </div>

        {{-- KOLOM KANAN: LAMPIRAN & AKSI --}}
        <div class="space-y-8">
            
            {{-- 1. Lampiran KTP --}}
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Berkas Identitas</h3>
            @if($permohonan->file_ktp)
                <a href="{{ asset('storage/' . $permohonan->file_ktp) }}" target="_blank" class="flex items-center gap-4 p-5 bg-slate-50 rounded-2xl hover:bg-blue-600 hover:text-white transition-all group border border-slate-100 shadow-sm">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-blue-600 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black uppercase tracking-tight">KTP Pemohon</p>
                        <p class="text-[9px] font-bold uppercase opacity-60">Lihat Lampiran &rarr;</p>
                    </div>
                </a>
            @else
                <div class="p-6 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 text-center">
                    <p class="text-[10px] text-slate-400 font-black uppercase italic tracking-widest">KTP Belum Diunggah</p>
                </div>
            @endif
        </div>

        {{-- 2. Lampiran Akta Notaris (Hanya tampil jika Lembaga) --}}
        @if(strtoupper($permohonan->kategori_pemohon) == 'LEMBAGA')
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 mt-6">
            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Berkas Akta Lembaga</h3>
            @if($permohonan->file_akta)
                <a href="{{ asset('storage/' . $permohonan->file_akta) }}" target="_blank" class="flex items-center gap-4 p-5 bg-emerald-50 rounded-2xl hover:bg-emerald-600 hover:text-white transition-all group border border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-emerald-600 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black uppercase tracking-tight">Akta Notaris / Lembaga</p>
                        <p class="text-[9px] font-bold uppercase opacity-60">Lihat Lampiran &rarr;</p>
                    </div>
                </a>
            @else
                <div class="p-6 bg-amber-50 rounded-2xl border-2 border-dashed border-amber-200 text-center">
                    <p class="text-[10px] text-amber-600 font-black uppercase italic tracking-widest">Akta Belum Diunggah</p>
                </div>
            @endif
        </div>
        @endif

            @php
                // Definisikan status yang dianggap "Sudah Ditindaklanjuti"
                $sudahDitindak = in_array(strtoupper($permohonan->status), ['DIPROSES', 'DITOLAK', 'TIDAK_LENGKAP', 'SELESAI']);
            @endphp

            {{-- Panel Tindak Lanjut --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Panel Tindak Lanjut</h3>
                        
                        <div class="space-y-4">
                            <button @click="openUpdateStatus = true" 
                                    type="button"
                                    style="background-color: #4f46e5 !important; color: #ffffff !important;"
                                    class="flex w-full p-4 rounded-2xl items-center justify-center gap-2 mb-4 shadow-lg shadow-indigo-100 active:scale-95 transition-all cursor-pointer border-none">
                                <span class="font-black text-[11px] uppercase tracking-widest pointer-events-none">
                                    Update Status Manual
                                </span>
                            </button>

                            <div class="border-t border-slate-50 pt-4">
                                @if(strtoupper($permohonan->status) == 'PENDING')
                                    {{-- Tombol Pemberitahuan (Biru) --}}
                                    <button @click="openPemberitahuan = true" 
                                        style="background-color: #2563eb !important; color: white !important;"
                                        class="w-full py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 mb-4">
                                        Buat Pemberitahuan
                                    </button>
                                    
                                    <button @click="openTidakLengkap = true" 
                                        class="w-full py-4 bg-white border-2 border-slate-200 text-slate-600 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-slate-50 transition-all">
                                        Informasi Tidak Lengkap
                                    </button>
                                @else
                                    {{-- Tampilan Tombol Terkunci (Disabled) --}}
                                    <div class="space-y-3">
                                        <button disabled class="w-full py-4 bg-slate-100 text-slate-400 border border-slate-200 rounded-2xl font-black text-[11px] uppercase tracking-widest cursor-not-allowed flex items-center justify-center gap-2 opacity-60">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"/></svg>
                                            Pemberitahuan Terkirim
                                        </button>
                                        
                                        <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                                            <p class="text-[10px] font-bold text-emerald-700 text-center uppercase tracking-tight">
                                                Aksi Terkunci: Permohonan telah diproses
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Garis Pembatas --}}
                            <div class="relative py-4 flex items-center">
                                <div class="flex-grow border-t border-slate-100"></div>
                                <span class="flex-shrink mx-4 text-[9px] font-black text-slate-300 uppercase italic tracking-widest">Next Step</span>
                                <div class="flex-grow border-t border-slate-100"></div>
                            </div>

                            {{-- Logika Tombol Upload Bukti --}}
                            @if(in_array(strtoupper($permohonan->status), ['DIPROSES', 'DIPENUHI', 'SELESAI']))
                                <div class="p-4 border-2 border-dashed border-slate-200 rounded-2xl bg-emerald-50/30">
                                    {{-- PASTIKAN ROUTE NAME SAMA DENGAN DI WEB.PHP --}}
                                    <form action="{{ route('admin.permohonan.upload_selesai', $permohonan->id) }}" 
      method="POST" 
      enctype="multipart/form-data">
    
    @csrf {{-- Wajib ada untuk keamanan POST --}}

    <div class="mb-4">
        <label class="block text-[10px] font-black text-slate-500 uppercase mb-2">Upload Dokumen Hasil Informasi</label>
        <input type="file" name="file_penyelesaian" 
               class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" 
               required>
    </div>

    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all shadow-lg active:scale-95">
        <i class="fas fa-check-circle mr-2"></i> Simpan & Kirim ke Pemohon
    </button>
</form>
                                </div>
                            @else
                                <div class="bg-slate-50 p-4 rounded-2xl text-center border border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">
                                        <i class="fas fa-lock mr-1"></i> Upload Terkunci (Status: {{ $permohonan->status }})
                                    </p>
                                    <p class="text-[9px] text-slate-400 italic mt-1 font-medium italic">Selesaikan tahapan tindak lanjut terlebih dahulu.</p>
                                </div>
                            @endif
                     
            </div>

            {{-- PANEL PERMOHONAN DATA KE OPD --}}
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl p-6 md:p-8 mt-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-slate-800 uppercase">Surat Permohonan ke OPD</h3>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-tight">Otomatis Berdasarkan Pilihan Pemberitahuan</p>
                        </div>
                    </div>
                </div>

                @php
                    // Ambil data pemberitahuan untuk tahu OPD mana yang dipilih
                    $pemberitahuan = \DB::table('ppid_pemberitahuan_tertulis')->where('id_permohonan', $permohonan->id)->first();
                @endphp

                @if($pemberitahuan && $pemberitahuan->penguasaan == 'opd_lain')
                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">OPD Tujuan Saat Ini:</label>
                            <p class="text-xs font-black text-slate-700 uppercase">{{ $pemberitahuan->nama_opd }}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            {{-- Tombol Unduh Surat Dinas ke OPD --}}
                            <a href="{{ route('admin.permohonan.cetak_ke_opd', $permohonan->id) }}" target="_blank"
                            class="w-full py-4 bg-slate-900 hover:bg-black text-white rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shadow-lg flex items-center justify-center gap-3 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh Surat Permohonan ke OPD
                            </a>
                        </div>
                    </div>
                @else
                    <div class="p-6 bg-amber-50 rounded-2xl border border-amber-100 text-center">
                        <p class="text-[10px] font-bold text-amber-600 uppercase tracking-tight">
                            Status: Penguasaan Informasi berada di Kami (PPID Utama). <br>
                            <span class="opacity-50 italic text-[9px]">Tidak perlu surat terusan ke OPD lain.</span>
                        </p>
                    </div>
                @endif
            </div>

            {{-- 3. Arsip Dokumen Hasil --}}
            <div class="bg-slate-50/50 p-5 md:p-8 rounded-[2rem] md:rounded-[2.5rem] border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Status Dokumen Keluar</h3>
                <div class="space-y-4">
                    @php
                        $status = strtoupper($permohonan->status);
                        $pemberitahuan = \DB::table('ppid_pemberitahuan_tertulis')
                                            ->where('id_permohonan', $permohonan->id)
                                            ->first();
                        
                        $isDikecualikan = ($pemberitahuan && $pemberitahuan->alasan_tolak == 'Dikecualikan');

                        if ($status == 'TIDAK_LENGKAP') {
                            $docTitle = 'Surat Ketidaklengkapan';
                            $docRoute = route('admin.permohonan.cetak_penolakan', $permohonan->id);
                        } elseif ($status == 'DITOLAK') {
                            if ($isDikecualikan) {
                                $docTitle = 'SK Penolakan';
                                $docRoute = route('admin.permohonan.cetak_penolakan', $permohonan->id);
                            } else {
                                $docTitle = 'Pemberitahuan Tertulis';
                                // Sesuai error tadi, pastikan namanya cetak_pemberitahuan (bukan P besar)
                                $docRoute = route('admin.permohonan.cetak_pemberitahuan', $permohonan->id);
                            }
                        } else {
                            $docTitle = 'Pemberitahuan Tertulis';
                            $docRoute = route('admin.permohonan.cetak_pemberitahuan', $permohonan->id);
                        }

                        $docs = [
                            ['title' => $docTitle, 'route' => $docRoute],
                            ['title' => 'Bukti Penyelesaian', 'route' => $permohonan->file_penyelesaian ? asset('storage/' . $permohonan->file_penyelesaian) : null],
                        ];
                    @endphp

                    {{-- 3. Baru panggil $docs di foreach --}}
                    @foreach($docs as $doc)
                        @if($permohonan->status != 'pending' || $loop->first)
                            <div class="flex items-center justify-between flex-wrap md:flex-nowrap gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                <div class="flex items-center gap-3 min-w-0"> 
                                    <div class="shrink-0 p-2.5 {{ in_array($status, ['DITOLAK', 'TIDAK_LENGKAP']) ? 'bg-red-50 text-red-600' : ($status != 'PENDING' ? 'bg-blue-50 text-blue-600' : 'bg-slate-50 text-slate-300') }} rounded-xl">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] font-black text-slate-800 uppercase tracking-tight truncate">{{ $doc['title'] }}</p>
                                        <p class="text-[9px] font-bold {{ $permohonan->status != 'PENDING' ? 'text-emerald-500' : 'text-slate-400' }}">
                                            {{ $permohonan->status != 'PENDING' ? 'Tersedia' : 'Pending' }}
                                        </p>
                                    </div>
                                </div>
                                
                                @if(isset($doc['route']) && $doc['route'] != null)                                
                                    <a href="{{ $doc['route'] }}" target="_blank" 
                                    class="ml-auto md:ml-0 px-4 py-2 {{ in_array($status, ['DITOLAK', 'TIDAK_LENGKAP']) && $loop->first ? 'bg-red-600' : 'bg-slate-800' }} text-white text-[9px] font-black uppercase rounded-xl hover:opacity-80 transition-all shadow-sm whitespace-nowrap active:scale-95">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
                {{-- AREA LOG AKTIVITAS (ALL-IN-ONE) --}}
                <div class="mt-10 bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10 flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                        Log Aktivitas Permohonan & Keberatan
                    </h3>

                    <div class="space-y-12 relative">
                        {{-- Garis Vertical --}}
                        <div class="absolute left-[19px] top-2 bottom-2 w-0.5 border-l-2 border-dashed border-slate-200"></div>

                        {{-- 01. PERMOHONAN MASUK --}}
                        <div class="relative flex items-start gap-6">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-black z-10 shadow-lg shadow-blue-100">01</div>
                            <div>
                                <p class="text-[11px] font-black text-blue-600 uppercase mb-1">
                                    {{ \Carbon\Carbon::parse($permohonan->created_at)->translatedFormat('d M Y - H:i') }} WIB
                                </p>
                                <h4 class="text-lg font-black text-slate-800">Permohonan Masuk</h4>
                                <p class="text-xs text-slate-500 mt-1 italic">User **{{ $permohonan->nama }}** mendaftarkan permohonan informasi.</p>
                            </div>
                        </div>

                        {{-- 02. VERIFIKASI ADMIN --}}
                        <div class="relative flex items-start gap-6 {{ $permohonan->status == 'BARU' ? 'opacity-40' : '' }}">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full {{ $permohonan->status == 'BARU' ? 'bg-slate-200 text-slate-400' : 'bg-emerald-500 text-white' }} flex items-center justify-center text-xs font-black z-10 shadow-lg">02</div>
                            <div>
                                @if($permohonan->status != 'BARU')
                                    <p class="text-[11px] font-black text-emerald-600 uppercase mb-1">
                                        {{ \Carbon\Carbon::parse($permohonan->updated_at)->translatedFormat('d M Y - H:i') }} WIB
                                    </p>
                                    <h4 class="text-lg font-black text-slate-800">Verifikasi & Tindak Lanjut</h4>
                                    <p class="text-xs text-slate-500 mt-1 italic">Admin telah memproses permohonan. Status: **{{ $permohonan->status }}**</p>
                                @else
                                    <h4 class="text-lg font-black text-slate-300 italic">Menunggu Verifikasi...</h4>
                                @endif
                            </div>
                        </div>

                        {{-- BAGIAN KEBERATAN (HANYA MUNCUL JIKA ADA DATA) --}}
                        @if($permohonan->keberatan)
                            {{-- 03. PENGAJUAN KEBERATAN --}}
                            <div class="relative flex items-start gap-6">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white text-xs font-black z-10 shadow-lg shadow-amber-100">03</div>
                                <div>
                                    <p class="text-[11px] font-black text-amber-600 uppercase mb-1">
                                        {{ \Carbon\Carbon::parse($permohonan->keberatan->created_at)->translatedFormat('d M Y - H:i') }} WIB
                                    </p>
                                    <h4 class="text-lg font-black text-slate-800">Pengajuan Keberatan</h4>
                                    <p class="text-xs text-slate-500 mt-1 italic">Pemohon mengajukan keberatan resmi ({{ $permohonan->keberatan->nomor_registrasi_keberatan }})</p>
                                </div>
                            </div>

                            {{-- 04. TANGGAPAN ATASAN --}}
                            @php $isDone = strtoupper($permohonan->keberatan->status) == 'DITANGGAPI'; @endphp
                            <div class="relative flex items-start gap-6 {{ !$isDone ? 'opacity-40' : '' }}">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-slate-900 flex items-center justify-center text-white text-xs font-black z-10 shadow-xl shadow-slate-200 border-2 border-white">04</div>
                                <div>
                                    @if($isDone)
                                        <p class="text-[11px] font-black text-indigo-600 uppercase mb-1">
                                            {{ \Carbon\Carbon::parse($permohonan->keberatan->updated_at)->translatedFormat('d M Y - H:i') }} WIB
                                        </p>
                                        <h4 class="text-lg font-black text-slate-800">Keberatan Ditanggapi</h4>
                                        <p class="text-xs text-slate-500 mt-1 italic">Atasan PPID telah memberikan tanggapan resmi.</p>
                                    @else
                                        <h4 class="text-lg font-black text-slate-300 italic">Menunggu Tanggapan Atasan PPID...</h4>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SEMUA MODAL TARUH DI BAWAH SINI --}}
    @include('admin.permohonan.modal_pemberitahuan')
    @include('admin.permohonan.modal_tidak_lengkap')
    @include('admin.permohonan.modal_upload_selesai')
    @include('admin.permohonan.modal_update_status')

</div>

<style>
    .bg-white.rounded-\[2rem\] {
        overflow: visible !important; 
    }
    
    select option {
        padding: 10px;
        background: #fff;
        color: #334155;
    }
</style>
@endsection