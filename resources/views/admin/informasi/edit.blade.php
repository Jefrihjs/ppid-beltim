@extends('layouts.admin')

@section('content')
<div class="p-8 max-w-4xl mx-auto">
    {{-- Header Form --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.informasi.index') }}" class="p-3 bg-white rounded-xl border border-slate-100 shadow-sm text-slate-400 hover:text-slate-900 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-black text-slate-900">Edit Informasi</h1>
            <p class="text-slate-500 text-sm">Perbarui data dokumen PPID yang sudah ada.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <form action="{{ route('admin.informasi.update', $info->id) }}" method="POST" class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-10">
        @csrf
        @method('PUT') 

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Judul Utama --}}
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Judul Informasi</label>
                <input type="text" name="title" value="{{ old('title', $info->title) }}" required 
                    class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700 transition-all">
            </div>

            {{-- Jenis Informasi (Dropdown) --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Jenis Informasi</label>
                <select name="category" required class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
                    <option value="berkala" {{ $info->category == 'berkala' ? 'selected' : '' }}>BERKALA</option>
                    <option value="serta merta" {{ $info->category == 'serta merta' ? 'selected' : '' }}>SERTA MERTA</option>
                    <option value="setiap saat" {{ $info->category == 'setiap saat' ? 'selected' : '' }}>SETIAP SAAT</option>
                </select>
            </div>

            {{-- Sub-Judul / Kelompok (id_kel) --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">
                    Pilih Sub-Judul (Kelompok)
                </label>

                <select name="id_kel" required
                    class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">

                    <option value="">-- Pilih Kelompok Informasi --</option>

                    @foreach($sub_juduls as $sub)
                        <option value="{{ $sub->id }}" @selected($info->id_kel == $sub->id)>
                            {{ $sub->name }}
                        </option>
                    @endforeach

                </select>

                <p class="mt-2 text-[10px] text-slate-400">
                    *Ini akan menentukan di kelompok mana informasi ini muncul
                </p>
            </div>

            {{-- Nama OPD --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Nama OPD</label>

                <select name="opd_name" required 
                    class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">

                    <option value="">-- Pilih OPD --</option>

                    @foreach($opds as $opd)
                        <option value="{{ $opd->singkatan }}"
                            @selected($info->opd_name == $opd->singkatan)>
                            {{ $opd->nama_opd }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Link File --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Link Dokumen (URL)</label>
                <input type="url" name="link_url" value="{{ old('link_url', $info->link_url) }}" 
                    class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
            </div>

            {{-- Tahun --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Tahun</label>
                <input type="number" name="tahun" value="{{ old('tahun', $info->tahun) }}" 
                       class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
            </div>

        </div>

        {{-- Tombol Simpan --}}
        <div class="mt-12 flex justify-end gap-4">
            <a href="{{ route('admin.informasi.index') }}" class="px-8 py-4 font-bold text-slate-400 hover:text-slate-900 transition-colors text-xs uppercase tracking-widest">Batal</a>
            <button type="submit" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-slate-200 hover:bg-amber-500 transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection