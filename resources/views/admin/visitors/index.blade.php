@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tight">Statistik Pengunjung</h2>
            <p class="text-xs text-slate-500 font-medium italic">Pantau trafik portal secara real-time.</p>
        </div>
        {{-- Tombol Cetak PDF --}}
        <a href="{{ route('admin.visitors.pdf') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-red-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            CETAK LAPORAN (PDF)
        </a>
    </div>

    {{-- Stats Cards (Counter) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Hari Ini</span>
            <h4 class="text-4xl font-black text-slate-900">{{ number_format($stats['today']) }}</h4>
            <p class="text-[10px] text-blue-600 font-bold mt-2 uppercase italic">Kunjungan Unik</p>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Total Hits</span>
            <h4 class="text-4xl font-black text-slate-900">{{ number_format($stats['total']) }}</h4>
            <p class="text-[10px] text-slate-400 font-bold mt-2 uppercase italic">Sejak Web Rilis</p>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm ring-2 ring-green-500/20">
            <span class="text-[10px] font-black text-green-600 uppercase tracking-widest block mb-2">Live Tracking</span>
            <h4 class="text-4xl font-black text-green-500">{{ number_format($stats['live']) }}</h4>
            <p class="text-[10px] text-green-600 font-bold mt-2 uppercase italic">5 Menit Terakhir</p>
        </div>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-50 bg-slate-50/50">
            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">Log Pengunjung Terbaru</h3>
        </div>
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50">
                <tr>
                    <th class="p-4 text-[10px] font-black uppercase text-slate-400">Waktu</th>
                    <th class="p-4 text-[10px] font-black uppercase text-slate-400">Alamat IP</th>
                    <th class="p-4 text-[10px] font-black uppercase text-slate-400">Informasi Perangkat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($visitors as $v)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-4 text-xs font-bold text-slate-600">{{ \Carbon\Carbon::parse($v->created_at)->diffForHumans() }}</td>
                    <td class="p-4 text-xs font-black text-slate-800">{{ $v->ip_address }}</td>
                    <td class="p-4 text-[10px] font-medium text-slate-500 italic max-w-xs truncate" title="{{ $v->user_agent }}">
                        {{ $v->user_agent }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 bg-slate-50">
            {{ $visitors->links() }}
        </div>
    </div>
</div>
@endsection