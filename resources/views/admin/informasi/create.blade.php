@extends('layouts.admin')

@section('content')
<div class="p-8 max-w-4xl mx-auto">
    {{-- Header Form --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.informasi.index') }}" class="p-3 bg-white rounded-xl border border-slate-100 shadow-sm text-slate-400 hover:text-slate-900 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-900">Tambah Informasi Baru</h1>
            <p class="text-slate-500 text-sm">Input data dokumen ke dalam sistem PPID.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <form action="{{ route('admin.informasi.store') }}" method="POST" class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-10">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Judul Utama --}}
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Judul Informasi</label>
                <input type="text" name="title" required placeholder="Contoh: Data Kasus COVID-19..." 
                       class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700 transition-all">
            </div>

            {{-- Jenis Informasi (Dropdown) --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Jenis Informasi</label>
                <select name="category" required class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
                    <option value="berkala">BERKALA</option>
                    <option value="serta merta">SERTA MERTA</option>
                    <option value="setiap saat">SETIAP SAAT</option>
                </select>
            </div>

            {{-- Sub-Judul / Kelompok (id_kel) --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Pilih Sub-Judul (Kelompok)</label>
                <select name="id_kel" required class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
                    <option value="">-- Pilih Kelompok Informasi --</option>
                    @foreach($sub_juduls as $sub)
                        {{-- Logika untuk menandai pilihan yang sudah tersimpan sebelumnya --}}
                        <option value="{{ $sub->id }}" {{ (isset($info) && $info->id_kel == $sub->id) ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                    @endforeach
                </select>
                <p class="mt-2 text-[10px] text-slate-400">*Ini akan menentukan di kelompok mana informasi ini muncul (seperti di gambar 1)</p>
            </div>

            {{-- Nama OPD --}}
            <select name="opd_name" required class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
                <option value="">-- Pilih OPD --</option>
                @foreach($opds as $opd)
                    <option value="{{ $opd->nama_opd }}" {{ (isset($info) && $info->opd_name == $opd->nama_opd) ? 'selected' : '' }}>
                        {{ $opd->nama_opd }}
                    </option>
                @endforeach
            </select>

            {{-- Link File --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Link Dokumen (URL)</label>
                <input type="url" name="link_url" placeholder="https://..." 
                       class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
            </div>

            {{-- Status & Kelompok (Hidden/Default) --}}
            <input type="hidden" name="kelompok" value="utama">
            <input type="hidden" name="is_active" value="1">

        </div>

        {{-- Tombol Simpan --}}
        <div class="mt-12 flex justify-end gap-4">
            <button type="reset" class="px-8 py-4 font-bold text-slate-400 hover:text-slate-900 transition-colors">Reset</button>
            <button type="submit" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-slate-200 hover:bg-amber-500 transition-all">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection