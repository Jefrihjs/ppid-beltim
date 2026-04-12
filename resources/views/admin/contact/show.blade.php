@extends('layouts.admin')

@section('admin_content')
<div class="max-w-4xl space-y-8">
    <a href="{{ route('admin.pesan.index') }}" class="inline-flex items-center gap-2 text-xs font-black text-slate-400 hover:text-slate-900 transition group">
        <span class="group-hover:-translate-x-1 transition-transform">←</span> KEMBALI KE KOTAK MASUK
    </a>

    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden p-10 md:p-16">
        <div class="flex flex-col md:flex-row justify-between items-start gap-6 mb-12 border-b border-slate-50 pb-10">
            <div>
                <span class="text-[10px] font-black text-amber-500 uppercase tracking-[0.2em] mb-2 block">Detail Pengirim</span>
                <h3 class="text-2xl font-black text-slate-900">{{ $contactMessage->name }}</h3>
                <p class="text-slate-500 font-bold text-sm">{{ $contactMessage->email }}</p>
                <p class="text-slate-400 text-xs mt-1">{{ $contactMessage->phone ?? 'Tidak ada nomor telp' }}</p>
            </div>
            <div class="text-md-right">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Diterima Pada</p>
                <p class="text-sm font-black text-slate-800">{{ $contactMessage->created_at->format('d F Y - H:i') }}</p>
            </div>
        </div>

        <div class="space-y-6">
            <div>
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-4">Subjek Pesan</p>
                <h4 class="text-xl font-bold text-slate-800 tracking-tight">{{ $contactMessage->subject }}</h4>
            </div>

            <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-100">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-4 italic">Isi Pesan:</p>
                <div class="text-slate-600 leading-relaxed font-medium whitespace-pre-line">
                    {{ $contactMessage->message }}
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-slate-50 flex gap-4">
            <a href="mailto:{{ $contactMessage->email }}" class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-xs hover:bg-blue-900 transition shadow-lg shadow-slate-200 uppercase tracking-widest">
                Balas via Email
            </a>
            @if($contactMessage->dibaca_pada)
                <div class="flex items-center gap-2 ml-auto text-[10px] font-black text-slate-300 uppercase tracking-widest">
                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div>
                    Dibaca pada: {{ \Carbon\Carbon::parse($contactMessage->dibaca_pada)->format('d/m/Y H:i') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection