@extends('layouts.admin')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-slate-900">Daftar OPD Resmi</h1>
            <p class="text-slate-500 text-sm">Sesuai SK PPID Kabupaten Belitung Timur 2025.</p>
        </div>
        
        <form action="{{ route('admin.opd.store') }}" method="POST" class="flex gap-2">
            @csrf
            <input type="text" name="nama_opd" placeholder="Input Nama OPD Baru..." required
                   class="px-4 py-2 rounded-xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-amber-500 text-sm">
            <button type="submit" class="bg-slate-900 text-white px-6 py-2 rounded-xl font-bold text-xs uppercase hover:bg-amber-500 transition-all">
                + Tambah
            </button>
        </form>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="p-6 text-[10px] font-black uppercase text-slate-400 w-16">No</th>
                    <th class="p-6 text-[10px] font-black uppercase text-slate-400">Nama Unit Kerja / OPD</th>
                    <th class="p-6 text-[10px] font-black uppercase text-slate-400 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($opds as $index => $opd)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-6 text-sm font-bold text-slate-400">{{ $index + 1 }}</td>
                    <td class="p-6">
                        <form action="{{ route('admin.opd.update', $opd->id) }}" method="POST" class="flex items-center gap-4">
                            @csrf @method('PUT')
                            <input type="text" name="nama_opd" value="{{ $opd->nama_opd }}" 
                                   class="w-full bg-transparent border-none focus:ring-0 font-bold text-slate-700 p-0">
                    </td>
                    <td class="p-6 text-right">
                            <button type="submit" class="text-amber-600 font-black text-[10px] uppercase tracking-widest hover:text-slate-900 transition-colors">
                                Simpan Perubahan
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection