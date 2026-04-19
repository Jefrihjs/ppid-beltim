@extends('layouts.admin')

@section('content')
{{-- 1.CSS TOM SELECT --}}
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<style>
    
    .ts-wrapper .ts-control input::placeholder {
        color: #475569 !important; /* Slate-600 */
        opacity: 1 !important;
        font-weight: 700 !important;
    }

    
    #select-category-ts-control input {
        opacity: 1 !important;
        display: block !important;
        color: #475569 !important;
    }

    
    .ts-control {
        border: none !important;
        padding: 1rem 1.5rem !important;
        background-color: #f8fafc !important; 
        border-radius: 1rem !important;
        box-shadow: 0 0 0 1px #e2e8f0 !important;
        color: #1e293b !important; 
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

            {{-- Jenis Informasi --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Jenis Informasi</label>
                <select id="select-category" name="category" required placeholder="Pilih Jenis Informasi...">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="berkala">BERKALA</option>
                    <option value="serta merta">SERTA MERTA</option>
                    <option value="setiap saat">SETIAP SAAT</option>
                    <option value="dikecualikan">DIKECUALIKAN</option>
                </select>
            </div>

            {{-- Sub-Judul / Kelompok (PAKAI TOM SELECT) --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Pilih Sub-Judul (Kelompok)</label>
                <select id="select-sub-judul" name="id_kel" placeholder="Cari atau pilih kelompok...">
                    <option value="">-- Silahkan Pilih Kelompok Informasi --</option>
                    @foreach($sub_juduls as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Nama OPD --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Unit Kerja / OPD</label>
                <select id="select-opd" name="opd_name" required placeholder="Cari Nama Dinas/OPD...">
                    <option value="">-- Pilih Unit Kerja --</option>
                    @foreach($opds as $opd)
                        <option value="{{ $opd->nama_opd }}">{{ $opd->nama_opd }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Link File --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Link Dokumen (URL)</label>
                <input type="url" name="link_url" placeholder="https://..." 
                       class="w-full px-6 py-4 bg-slate-50 border-none ring-1 ring-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700">
            </div>

            {{-- Hidden Inputs --}}
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

{{-- 2.JS TOM SELECT --}}
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    // 1. Tom Select untuk Jenis Informasi
    new TomSelect("#select-category", {
        create: false,
        placeholder: "PILIH JENIS INFORMASI...", 
        
        render: {
            item: function(data, escape) {
                return `<div class="font-bold text-slate-800 uppercase text-xs tracking-widest">${escape(data.text)}</div>`;
            },
            option: function(data, escape) {
                return `<div class="py-3 px-4 border-b border-slate-50 font-bold text-slate-700 uppercase text-xs tracking-widest hover:bg-slate-50">${escape(data.text)}</div>`;
            }
        }
    });

    // 2. Tom Select untuk Sub-Judul (Kelompok)
    new TomSelect("#select-sub-judul", {
        create: false,
        sortField: { field: "text", direction: "asc" },
        render: {
            option: function(data, escape) {
                return `<div class="py-3 px-4 border-b border-slate-50">
                            <div class="text-sm font-bold text-slate-700 leading-snug">${escape(data.text)}</div>
                        </div>`;
            }
        }
    });

    // 3. Tom Select untuk Unit Kerja / OPD
    new TomSelect("#select-opd", {
        create: false,
        sortField: { field: "text", direction: "asc" },
        render: {
            option: function(data, escape) {
                return `<div class="py-3 px-4 border-b border-slate-50">
                            <div class="text-sm font-bold text-slate-700">${escape(data.text)}</div>
                        </div>`;
            }
        }
    });
</script>
@endsection