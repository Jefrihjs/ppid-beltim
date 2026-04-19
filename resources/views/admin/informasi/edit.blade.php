@extends('layouts.admin')

@section('content')
{{-- 1.CSS TOM SELECT --}}
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<style>
    .ts-control {
        border: none !important;
        padding: 1rem 1.5rem !important;
        background-color: #f8fafc !important; 
        border-radius: 1rem !important; 
        box-shadow: 0 0 0 1px #e2e8f0 !important; 
        font-weight: 700 !important;
        color: #1e293b !important;
        font-size: 0.875rem !important;
    }
    .ts-wrapper.focus .ts-control {
        box-shadow: 0 0 0 2px #f59e0b !important; 
    }
    .ts-dropdown {
        border-radius: 1rem !important;
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1) !important;
        border: 1px solid #f1f5f9 !important;
        padding: 0.5rem !important;
    }
    /* Placeholder Styling */
    .ts-wrapper .ts-control input::placeholder {
        color: #64748b !important;
        opacity: 1 !important;
        font-weight: 700 !important;
    }
</style>

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
                <select id="select-category" name="category" required>
                    <option value="berkala" {{ $info->category == 'berkala' ? 'selected' : '' }}>BERKALA</option>
                    <option value="serta merta" {{ $info->category == 'serta merta' ? 'selected' : '' }}>SERTA MERTA</option>
                    <option value="setiap saat" {{ $info->category == 'setiap saat' ? 'selected' : '' }}>SETIAP SAAT</option>
                    <option value="dikecualikan" {{ $info->category == 'dikecualikan' ? 'selected' : '' }}>DIKECUALIKAN</option>
                </select>
            </div>

            {{-- Sub-Judul / Kelompok (id_kel) --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Pilih Sub-Judul (Kelompok)</label>
                <select id="select-sub-judul" name="id_kel" required>
                    <option value="">-- Pilih Kelompok Informasi --</option>
                    @foreach($sub_juduls as $sub)
                        <option value="{{ $sub->id }}" @selected($info->id_kel == $sub->id)>
                            {{ $sub->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nama OPD --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Nama OPD</label>
                <select id="select-opd" name="opd_name" required>
                    <option value="">-- Pilih OPD --</option>
                    @foreach($opds as $opd)
                        <option value="{{ $opd->singkatan }}" @selected($info->opd_name == $opd->singkatan)>
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

{{-- 2. JS TOM SELECT --}}
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    const renderConfig = {
        item: function(data, escape) {
            return `<div class="font-bold text-slate-800">${escape(data.text)}</div>`;
        },
        option: function(data, escape) {
            return `<div class="py-3 px-4 border-b border-slate-50">
                        <div class="text-sm font-bold text-slate-700 leading-snug">${escape(data.text)}</div>
                    </div>`;
        }
    };

    new TomSelect("#select-category", { create: false, render: renderConfig });
    new TomSelect("#select-sub-judul", { create: false, sortField: { field: "text", direction: "asc" }, render: renderConfig });
    new TomSelect("#select-opd", { create: false, sortField: { field: "text", direction: "asc" }, render: renderConfig });
</script>
@endsection