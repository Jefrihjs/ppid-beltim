@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    {{-- Header Halaman --}}
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-[28px] font-black text-slate-900 tracking-tight">Daftar Permohonan</h2>
            <p class="text-slate-400 font-medium text-sm">Kelola seluruh permintaan informasi publik yang masuk ke sistem.</p>
        </div>
        {{-- Tombol opsional jika ingin tambah data manual --}}
        <div class="bg-white px-4 py-2 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Data:</span>
            <span class="text-sm font-black text-slate-900 ml-1">{{ $permohonans->total() }}</span>
        </div>
    </div>

    {{-- Tabel Utama --}}
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-black text-slate-800 uppercase tracking-widest text-xs">Arsip Permohonan Masuk</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-4 text-center w-16">No</th>
                        <th class="px-8 py-4">Nomor Registrasi</th>
                        <th class="px-8 py-4">Nama Pemohon</th>
                        <th class="px-8 py-4">Tujuan Penggunaan</th>
                        <th class="px-8 py-4 text-center">Status</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($permohonans as $index => $p)
                    <tr class="hover:bg-slate-50/80 transition group">
                        <td class="px-8 py-6 text-center text-xs font-bold text-slate-400">
                            {{ $permohonans->firstItem() + $index }}
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-black text-slate-900 text-xs block uppercase tracking-tighter">{{ $p->nomor_registrasi }}</span>
                            <span class="text-[10px] text-slate-400 font-medium">{{ $p->created_at->format('d M Y, H:i') }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-bold text-slate-800 text-sm block">{{ $p->nama }}</span>
                            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-black">NIK: {{ $p->nik ?? '-' }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-xs text-slate-500 max-w-xs truncate italic">"{{ $p->tujuan_penggunaan }}"</p>
                        </td>
                        <td class="px-8 py-6 text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'diproses'  => 'bg-blue-100 text-blue-700',
                                    'selesai' => 'bg-emerald-100 text-emerald-700',
                                    'ditolak' => 'bg-red-100 text-red-700'
                                ];
                                $lowStatus = strtolower($p->status);
                                $class = $statusClasses[$lowStatus] ?? 'bg-slate-100 text-slate-700';
                            @endphp
                            <span class="px-4 py-1.5 {{ $class }} rounded-full text-[9px] font-black uppercase tracking-wider">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('admin.permohonan.show', $p->id) }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[10px] font-black hover:bg-amber-500 hover:text-slate-900 transition shadow-sm hover:shadow-md">
                                DETAIL DATA
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <p class="text-slate-400 italic text-sm font-medium">Belum ada data permohonan yang tersimpan dalam sistem.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Navigasi Halaman (Pagination) --}}
        <div class="p-8 bg-slate-50/50 border-t border-slate-50">
            {{ $permohonans->links() }}
        </div>
    </div>
</div>
@endsection