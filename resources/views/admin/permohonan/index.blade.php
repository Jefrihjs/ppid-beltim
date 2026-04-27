@extends('layouts.admin')

@section('content')
<div class="p-8">
    {{-- Breadcrumbs & Title --}}
    <nav class="flex text-sm text-slate-500 mb-4 gap-2 italic">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Beranda</a>
        <span>/</span>
        <span class="text-slate-900 font-medium">Permohonan Informasi</span>
    </nav>
    
    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-800">PPID <span class="text-xs font-normal text-blue-600 ml-2">( Pejabat Pengelola Informasi dan Dokumentasi )</span></h2>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        {{-- Permohonan Baru --}}
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-50 flex flex-col items-center text-center group hover:shadow-md transition">
            <div class="relative mb-4">
                <svg class="w-10 h-10 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span class="absolute -top-2 -right-2 bg-emerald-400 text-white text-[10px] font-black w-6 h-6 flex items-center justify-center rounded-full border-2 border-white">{{ $stats['baru'] }}</span>
            </div>
            <h3 class="text-3xl font-black text-emerald-400">{{ $stats['baru'] }}</h3>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">Permohonan Informasi Baru</p>
        </div>

        {{-- Permohonan Diproses --}}
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-50 flex flex-col items-center text-center group hover:shadow-md transition">
            <div class="mb-4 text-slate-800">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <h3 class="text-3xl font-black text-blue-500">{{ $stats['diproses'] }}</h3>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">Permohonan Informasi Diproses</p>
        </div>

        {{-- Permohonan Terselesaikan --}}
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-50 flex flex-col items-center text-center group hover:shadow-md transition">
            <div class="mb-4 text-slate-800">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14l2 2 4-4m5 2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h10l5-5z"/></svg>
            </div>
            <h3 class="text-3xl font-black text-indigo-500">{{ $stats['selesai'] }}</h3>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">Permohonan Informasi Terselesaikan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- KOLOM KIRI: Permohonan Baru --}}
        <div class="space-y-4">
            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Permohonan Informasi Baru</h3>
            
            <div class="space-y-4">
                {{-- GANTI $permohonans menjadi $permohonanBaru --}}
                @forelse($permohonanBaru as $item)
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:border-blue-300 transition-all group relative overflow-hidden">
                        {{-- Aksen warna biru di pinggir agar kelihatan 'Baru' --}}
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-blue-600"></div>

                        <div class="flex justify-between items-start mb-3">
                            <a href="{{ route('admin.permohonan.show', $item->id) }}" class="text-blue-600 font-black text-[11px] uppercase tracking-wider hover:underline">
                                #{{ $item->nomor_registrasi }}
                            </a>
                            <span class="text-[9px] font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg">
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </span>
                        </div>

                        <p class="text-xs font-bold text-slate-800 mb-2 line-clamp-2 leading-relaxed">
                            {{ $item->nama }}
                        </p>
                        
                        <p class="text-[10px] text-slate-500 italic line-clamp-1 mb-4">
                            "{{ $item->rincian_informasi }}"
                        </p>

                        <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                            <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest bg-blue-50 px-3 py-1.5 rounded-full">
                                {{ $item->status }}
                            </span>
                            <a href="{{ route('admin.permohonan.show', $item->id) }}" class="text-[10px] font-black text-slate-400 group-hover:text-blue-600 transition-colors uppercase tracking-widest">
                                Detail &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-slate-50/50 p-12 rounded-[2.5rem] border border-dashed border-slate-200 text-center">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Tidak ada permohonan baru</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- KOLOM KANAN: Tabel Semua Permohonan --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-6">Semua Permohonan Informasi</h3>
                
                <div class="flex justify-between items-center mb-4 text-xs text-slate-500 italic">
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
                        <thead class="bg-slate-800 text-white uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 border border-slate-700 text-center w-10">#</th>
                                <th class="px-4 py-3 border border-slate-700">Nomor Permohonan</th>
                                <th class="px-4 py-3 border border-slate-700">Nama Pemohon / Kategori</th>
                                <th class="px-4 py-3 border border-slate-700 text-center">Status</th>
                                <th class="px-4 py-3 border border-slate-700 text-center">Aksi</th> {{-- Judul Aksi --}}
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($permohonans as $index => $p)
                            <tr class="hover:bg-slate-50 transition">
                                {{-- Nomor Urut Tabel --}}
                                <td class="px-4 py-3 border border-slate-100 text-center font-bold">
                                    {{ $permohonans->firstItem() + $index }}
                                </td>
                                
                                {{-- Kolom Nomor Permohonan Resmi --}}
                                <td class="px-4 py-3 border border-slate-100">
                                    <a href="{{ route('admin.permohonan.show', $p->id) }}" class="text-blue-600 font-bold hover:underline">
                                        {{-- 
                                        Pastikan field ini adalah yang berisi format 001/PPID/VIII/2023.
                                        Jika kamu menyimpannya di kolom 'nomor_registrasi', maka tetap pakai ini.
                                        --}}
                                        {{ $p->nomor_registrasi }}
                                    </a>
                                </td>

                                <td class="px-4 py-3 border border-slate-100 text-slate-600 font-medium italic">
                                    {{ $p->nama }}
                                </td>

                                <td class="px-4 py-3 border border-slate-100 text-center uppercase text-[10px] font-bold text-slate-500">
                                    {{ $p->status }}
                                </td>

                                <td class="px-4 py-3 border border-slate-100 text-center">
                                    <form action="{{ route('admin.permohonan.destroy', $p->id) }}" method="POST" id="delete-form-{{ $p->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                onclick="confirmDelete('{{ $p->id }}')" 
                                                class="p-1.5 bg-red-50 text-red-600 rounded shadow-sm hover:bg-red-600 hover:text-white transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex justify-between items-center text-xs text-slate-500 italic">
                    <p>Showing {{ $permohonans->firstItem() }} to {{ $permohonans->lastItem() }} of {{ $permohonans->total() }} entries</p>
                    <div class="flex gap-1">
                        {{ $permohonans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data permohonan akan dihapus permanen dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Warna merah tailwind
            cancelButtonColor: '#64748b', // Warna slate tailwind
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '2rem'
        }).then((result) => {
            if (result.isConfirmed) {
                // Cari form berdasarkan ID lalu submit
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>