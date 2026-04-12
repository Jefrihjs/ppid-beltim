@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- Header Kategori --}}
        <div class="bg-slate-900 rounded-[2.5rem] p-12 text-center mb-12 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <h1 class="text-[24px] font-black text-white tracking-tight uppercase leading-tight">
                @yield('page_title', 'Daftar Informasi Publik Pembantu - Perangkat Daerah')
            </h1>
            <div class="w-16 h-1 bg-amber-500 mx-auto mt-5 rounded-full"></div>
        </div>

        {{-- Konten Tabel --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">

            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <p class="text-slate-500 font-medium italic text-sm">
                    Manfaatkan fitur pencarian untuk menemukan informasi publik Kabupaten Belitung Timur.
                </p>

                <input type="text" id="searchInput" placeholder="Cari dokumen..."
                       class="w-full md:w-80 bg-slate-50 border border-slate-200 px-6 py-3 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-medium">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-slate-400 text-xs font-black uppercase tracking-widest">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Unit Kerja</th>
                            <th class="px-6 py-4">Judul Informasi</th>
                            <th class="px-6 py-4 text-center">Akses</th>
                        </tr>
                    </thead>

                    {{-- POSISI ID DISINI --}}
                    <tbody id="infoTable" class="text-slate-700">
                        @forelse($data_informasi as $index => $item)
                        <tr class="group hover:bg-slate-50 transition-colors">
                            {{-- Nomor Urut --}}
                            <td class="px-6 py-6 bg-slate-50 rounded-l-2xl font-bold group-hover:bg-amber-50 transition-colors">
                                {{ $index + 1 }}
                            </td>
                            
                            {{-- Unit Kerja --}}
                            <td class="px-6 py-6 font-bold text-sm">
                                {{ $item->unit_kerja }}
                            </td>
                            
                            {{-- Detail Informasi --}}
                            <td class="px-6 py-6">
                                <div class="font-bold text-slate-900">{{ $item->judul }}</div>
                                <div class="text-xs text-slate-400 mt-1 italic">{{ $item->deskripsi }}</div>
                            </td>
                            
                            {{-- Tombol Akses --}}
                            <td class="px-6 py-6 bg-slate-50 rounded-r-2xl text-center group-hover:bg-amber-50 transition-colors">
                                <a href="{{ $item->url_akses }}" target="_blank" 
                                class="inline-flex items-center gap-2 bg-slate-900 text-amber-400 px-4 py-2 rounded-xl text-xs font-black hover:bg-amber-500 hover:text-slate-900 transition-all shadow-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    AKSES
                                </a>
                            </td>
                        </tr>
                        @empty
                        {{-- Baris ini akan muncul jika database kosong --}}
                        <tr id="noDataRow">
                            <td colspan="4" class="text-center py-20 text-slate-400 font-medium italic">
                                Belum ada dokumen tersedia untuk kategori ini di portal PPID.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    // Logika pencarian real-time untuk PPID Beltim
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#infoTable tr:not(#noDataRow)');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            // Menampilkan baris jika teks cocok dengan input pencarian
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection