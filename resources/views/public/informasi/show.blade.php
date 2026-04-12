@extends('layouts.public')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <nav class="flex text-slate-400 text-[10px] font-black uppercase tracking-widest mb-8">
        <a href="/" class="hover:text-amber-600 transition-colors">Beranda</a> 
        <span class="mx-3 text-slate-300">›</span>
        <a href="{{ route('public.informasi.index') }}" class="hover:text-amber-600 transition-colors">Informasi Publik</a> 
        <span class="mx-3 text-slate-300">›</span>
        <span class="text-amber-600 italic lowercase">detail informasi</span>
    </nav>

    <div class="bg-slate-900 rounded-t-[2rem] p-8 text-center shadow-lg border-b-4 border-amber-500">
        <h1 class="text-2xl font-black text-white uppercase tracking-tight">Detail Informasi Publik</h1>
    </div>

    <div class="bg-white rounded-b-[2rem] shadow-xl p-8 md:p-12 border border-slate-100">
        <div class="mb-10">
            {{-- Judul: Pakai Slate-900 agar tegas --}}
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight mb-4 lowercase first-letter:uppercase">
                {{ $info->title }}
            </h2>
            <p class="text-slate-500 text-sm leading-relaxed border-l-4 border-slate-100 pl-4 italic">
                Berikut adalah rincian informasi publik mengenai "{{ $info->title }}" yang dikelola oleh {{ $info->opd_name }}. Dokumen ini disediakan untuk memenuhi kewajiban keterbukaan informasi publik.
            </p>
        </div>

        <div class="space-y-0 border-t border-slate-100">
            {{-- Statistik Informasi --}}
            <div class="flex flex-wrap gap-4 mb-8">
                <div class="flex items-center gap-2 px-4 py-2 bg-slate-50 rounded-lg border border-slate-100">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span class="text-[11px] font-black uppercase text-slate-500 tracking-wider">
                        Dilihat: <span class="text-slate-900 ml-1">{{ number_format($info->views) }}</span> kali
                    </span>
                </div>

                <div class="flex items-center gap-2 px-4 py-2 bg-slate-50 rounded-lg border border-slate-100">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span class="text-[11px] font-black uppercase text-slate-500 tracking-wider">
                        Diunduh: <span class="text-slate-900 ml-1">{{ number_format($info->downloads) }}</span> kali
                    </span>
                </div>
            </div>
            {{-- Row Unit Kerja --}}
            <div class="grid grid-cols-1 md:grid-cols-3 py-5 border-b border-slate-50 items-center">
                <div class="font-black text-slate-400 uppercase text-[10px] tracking-widest">Unit Kerja</div>
                <div class="md:col-span-2 text-slate-700 font-bold uppercase text-sm">{{ $info->opd_name }}</div>
            </div>

            {{-- Row Jenis Informasi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 py-5 border-b border-slate-50 items-center">
                <div class="font-black text-slate-400 uppercase text-[10px] tracking-widest">Jenis Informasi</div>
                <div class="md:col-span-2 text-amber-600 font-bold uppercase text-sm">{{ $info->category }}</div>
            </div>

            {{-- Row Tipe Sumber --}}
            <div class="grid grid-cols-1 md:grid-cols-3 py-5 border-b border-slate-50 items-center">
                <div class="font-black text-slate-400 uppercase text-[10px] tracking-widest">Tipe Sumber</div>
                <div class="md:col-span-2 text-slate-500 font-medium lowercase text-sm">dokumen elektronik (file/link)</div>
            </div>

            {{-- Row Tombol Akses: Ganti ke warna Amber agar mencolok --}}
            <div class="grid grid-cols-1 md:grid-cols-3 py-8 items-center">
                <div class="font-black text-slate-400 uppercase text-[10px] tracking-widest">Akses Informasi</div>
                <div class="md:col-span-2">
                    @if($info->link_url)
                        <a href="{{ route('public.informasi.download', $info->id) }}" target="_blank" 
                        class="inline-flex items-center gap-3 px-8 py-3 bg-amber-500 text-slate-900 rounded-xl font-black text-xs uppercase hover:bg-slate-900 hover:text-white transition-all shadow-lg shadow-amber-100 group">
                            <svg class="w-4 h-4 fill-current transition-transform group-hover:scale-110" viewBox="0 0 20 20">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                            </svg>
                            Buka Dokumen
                        </a>
                    @else
                        <span class="text-slate-300 italic text-xs font-bold">Link Tidak Tersedia</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 text-center">
        <a href="{{ url()->previous() }}" class="text-slate-400 hover:text-slate-900 font-black text-[10px] uppercase tracking-[0.2em] transition-colors border-b-2 border-transparent hover:border-amber-500 pb-1">
            ← Kembali ke daftar
        </a>
    </div>
</div>
@endsection