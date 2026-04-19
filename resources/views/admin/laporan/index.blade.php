@extends('layouts.admin')

@section('content')
<div class="p-8">
    {{-- HEADER & TITLE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900">Rekapitulasi Laporan PPID</h2>
            <p class="text-slate-500 text-sm italic">Kabupaten Belitung Timur</p>
        </div>

        {{-- FORM FILTER & CETAK --}}
        <div class="flex flex-wrap md:flex-nowrap items-end gap-3 bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm">
            {{-- Filter Jenis --}}
            <div class="flex flex-col gap-1">
                <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Jenis Data</label>
                <select id="filterJenis" class="px-4 py-2 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-blue-500 w-48">
                    <option value="permohonan" {{ request('jenis') == 'permohonan' ? 'selected' : '' }}>Permohonan Informasi</option>
                    <option value="keberatan" {{ request('jenis') == 'keberatan' ? 'selected' : '' }}>Keberatan Informasi</option>
                </select>
            </div>

            {{-- Filter Tahun --}}
            <div class="flex flex-col gap-1">
                <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Tahun</label>
                <select id="filterTahun" class="px-4 py-2 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-blue-500 w-28">
                    @for($i = date('Y'); $i >= 2023; $i--)
                        <option value="{{ $i }}" {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-2">
                <button onclick="applyFilter()" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition shadow-md shadow-blue-100">
                    Filter
                </button>
                <button onclick="printLaporan()" class="px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-800 transition flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak PDF
                </button>
            </div>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden transition-all">
        <div class="p-6 border-b border-slate-50 bg-slate-50/30">
            <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="w-2 h-4 bg-blue-600 rounded-full"></span>
                Data {{ request('jenis') == 'keberatan' ? 'Keberatan' : 'Permohonan' }} - {{ request('tahun', date('Y')) }}
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider border-b border-slate-100">No</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider border-b border-slate-100">Tgl Masuk</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider border-b border-slate-100">Nama Pemohon</th>
                        @if(request('jenis') == 'keberatan')
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider border-b border-slate-100">Alasan</th>
                        @else
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider border-b border-slate-100">Rincian Informasi</th>
                        @endif
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider border-b border-slate-100 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($permohonans as $index => $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-xs font-bold text-slate-400">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-xs text-slate-500 font-medium">
                            {{ $item->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs font-black text-slate-900">
                                {{ request('jenis') == 'keberatan' ? ($item->permohonan->nama ?? 'N/A') : $item->nama }}
                            </div>
                            <div class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">
                                {{ request('jenis') == 'keberatan' ? $item->nomor_registrasi_keberatan : $item->nomor_registrasi }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-600 leading-relaxed">
                            @if(request('jenis') == 'keberatan')
                                <span class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded font-black text-[9px]">KODE {{ $item->alasan_kode }}</span>
                                <span class="ml-1 italic text-slate-400">{{ Str::limit($item->kronologi, 40) }}</span>
                            @else
                                {{ Str::limit($item->rincian_informasi, 60) }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $status = strtoupper($item->status);
                                $color = match($status) {
                                    'PENDING' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    'DIPROSES' => 'bg-amber-50 text-amber-600 border-amber-100',
                                    'SELESAI' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                    'TIDAK_LENGKAP', 'DITOLAK' => 'bg-rose-50 text-rose-600 border-rose-100',
                                    default => 'bg-slate-50 text-slate-600 border-slate-100'
                                };
                            @endphp
                            <span class="px-3 py-1 border {{ $color }} rounded-full text-[9px] font-black uppercase tracking-widest">
                                {{ $status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-24 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-sm font-black uppercase tracking-widest">Belum ada data untuk tahun ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Hidden Iframe for Printing --}}
<iframe id="printFrame" style="display:none;"></iframe>

<script>
    function applyFilter() {
        const jenis = document.getElementById('filterJenis').value;
        const tahun = document.getElementById('filterTahun').value;
        window.location.href = `?jenis=${jenis}&tahun=${tahun}`;
    }

    function printLaporan() {
        const jenis = document.getElementById('filterJenis').value;
        const tahun = document.getElementById('filterTahun').value;
        const frame = document.getElementById('printFrame');
        
        // Sesuaikan dengan route cetak kamu
        frame.src = `{{ route('admin.laporan.cetak') }}?jenis=${jenis}&tahun=${tahun}`;
        
        frame.onload = function() {
            frame.contentWindow.focus();
            frame.contentWindow.print();
        };
    }
</script>
@endsection