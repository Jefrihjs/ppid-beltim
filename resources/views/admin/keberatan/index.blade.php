@extends('layouts.admin')

@section('content')
<div class="p-8">
    {{-- Breadcrumbs & Title --}}
    <nav class="flex text-sm text-slate-500 mb-4 gap-2 italic">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Beranda</a>
        <span>/</span>
        <span class="text-slate-900 font-medium">Keberatan atas Informasi</span>
    </nav>
    
    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-800">PPID <span class="text-xs font-normal text-blue-600 ml-2">( Pejabat Pengelola Informasi dan Dokumentasi )</span></h2>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        {{-- Ajuan Baru --}}
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-50 flex flex-col items-center text-center group hover:shadow-md transition">
            <div class="relative mb-4">
                <svg class="w-10 h-10 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-black w-6 h-6 flex items-center justify-center rounded-full border-2 border-white">{{ $stats['baru'] }}</span>
            </div>
            <h3 class="text-3xl font-black text-red-600">{{ $stats['baru'] }}</h3>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">Ajuan Keberatan Baru</p>
        </div>

        {{-- Ajuan Ditanggapi --}}
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-50 flex flex-col items-center text-center group hover:shadow-md transition">
            <div class="mb-4 text-slate-800">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <h3 class="text-3xl font-black text-emerald-500">{{ $stats['proses'] + $stats['selesai'] }}</h3>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">Ajuan Keberatan Ditanggapi</p>
        </div>

        {{-- Keputusan Disanggah --}}
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-50 flex flex-col items-center text-center group hover:shadow-md transition">
            <div class="mb-4 text-slate-800">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
            <h3 class="text-3xl font-black text-amber-500">{{ $stats['total'] }}</h3>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">Keputusan Disanggah</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Ganti bagian ini di file Blade kamu --}}
        <div class="space-y-4">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-4 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="text-sm font-bold text-slate-700">Ajuan Keberatan Baru</h3>
                    <span class="bg-red-600 text-white text-[10px] px-2 py-0.5 rounded font-black">Baru {{ $stats['baru'] }}</span>
                </div>
                <div class="p-2">
                    @forelse($keberatans->where('status', 'pending')->take(5) as $kb)
                        <div class="p-3 hover:bg-slate-50 rounded-lg transition border-b border-slate-50 last:border-0">
                            <p class="text-[10px] font-black text-blue-600 uppercase">{{ $kb->nomor_registrasi_keberatan }}</p>
                            <p class="text-xs font-bold text-slate-800">{{ $kb->permohonan->nama }}</p>
                            <p class="text-[9px] text-slate-400 italic">Alasan: {{ $kb->alasan_kode }}</p>
                        </div>
                    @empty
                        <div class="p-10 text-center">
                            <p class="text-slate-300 italic text-sm">Tidak ada ajuan baru</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Tabel Utama Kanan --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-6">Semua Ajuan Keberatan Informasi</h3>
                
                <div class="flex justify-between items-center mb-4 text-xs text-slate-500">
                    <div>Show 
                        <select class="border-slate-200 rounded-lg py-1 px-2 focus:ring-0">
                            <option>10</option>
                        </select> entries
                    </div>
                    <div class="flex items-center gap-2">
                        Search: <input type="text" class="border-slate-200 rounded-lg py-1 px-3 focus:ring-blue-500">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border border-slate-100">
                        <thead>
                            <tr class="bg-slate-800 text-white uppercase tracking-wider">
                                <th class="px-4 py-3 border border-slate-700 text-center w-10">#</th>
                                <th class="px-4 py-3 border border-slate-700">Nomor Ajuan</th>
                                <th class="px-4 py-3 border border-slate-700">Nama Pemohon / Kuasa</th>
                                <th class="px-4 py-3 border border-slate-700 text-center">Alasan</th>
                                <th class="px-4 py-3 border border-slate-700 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($keberatans as $index => $k)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-3 border border-slate-100 text-center font-bold">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 border border-slate-100">
                                    <a href="{{ route('admin.permohonan.show', $k->permohonan_id) }}" class="text-blue-600 font-bold hover:underline">
                                        {{ $k->nomor_registrasi_keberatan }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 border border-slate-100 text-slate-600 font-medium italic">
                                    {{ $k->permohonan->nama ?? 'N/A' }}
                                </td>
                                {{-- Ganti baris 83 sampai 93 dengan ini Jef --}}
                                <td class="px-4 py-3 border border-slate-100 text-center">
                                    @php
                                        // Logika warna persis web asli
                                        $badgeColors = [
                                            'A' => 'bg-red-500', 
                                            'B' => 'bg-orange-500', 
                                            'C' => 'bg-amber-500', 
                                            'D' => 'bg-blue-500',
                                            'E' => 'bg-indigo-500',
                                            'F' => 'bg-purple-500',
                                            'G' => 'bg-rose-500'
                                        ];
                                        // Ambil huruf kode, lalu cari warnanya
                                        $kode = strtoupper($k->alasan_kode);
                                        $color = $badgeColors[$kode] ?? 'bg-slate-300';
                                    @endphp

                                    @if($k->alasan_kode)
                                        <div class="flex flex-col items-center">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full {{ $color }} text-white font-black shadow-sm text-[10px]">
                                                {{ $kode }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 border border-slate-100 text-center">
                                    {{-- Status Badge biar cakep seperti di gambar kamu --}}
                                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase border bg-emerald-50 text-emerald-600 border-emerald-200">
                                        {{ $k->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex justify-between items-center text-xs text-slate-500 italic">
                    <p>Showing 1 to {{ $keberatans->count() }} of {{ $stats['total'] }} entries</p>
                    <div class="flex gap-1">
                        <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-50">Previous</button>
                        <button class="px-3 py-1 bg-blue-600 text-white rounded">1</button>
                        <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-50">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection