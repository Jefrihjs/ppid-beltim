@extends('layouts.public')

@section('content')
@php
    $title = $page_title ?? 'Daftar Informasi Publik';
    
    // DETEKTOR HALAMAN: Berdasarkan kolom 'kelompok' (utama/pembantu)
    $isTablePage = str_contains(strtolower($title), 'utama') || str_contains(strtolower($title), 'pembantu');
    
    // Logic Tab Default untuk halaman kategori (berkala, setiap saat, serta merta)
    $defaultTab = 'berkala';
    if(str_contains(strtolower($title), 'setiap saat')) { $defaultTab = 'setiap saat'; }
    elseif(str_contains(strtolower($title), 'serta merta')) { $defaultTab = 'serta merta'; }
    
    $activeTab = request()->query('category', $defaultTab);

    // Ambil data dan pastikan relasi 'kategori_kelompok' (tabel categories) ikut terbawa
    $semuaData = collect($data_informasi ?? $informations ?? collect())->flatten();
@endphp

<div class="max-w-7xl mx-auto px-4 py-12" x-data="{ tab: '{{ $activeTab }}', search: '' }">
    
    {{-- Header --}}
    <div class="bg-slate-900 rounded-t-[2.5rem] p-10 text-center shadow-lg border-b-4 border-amber-500">
        <h1 class="text-2xl font-black text-white uppercase italic tracking-tight">{{ $title }}</h1>
        <p class="text-amber-500 mt-2 font-bold uppercase text-[10px] tracking-[0.3em]">PPID Kabupaten Belitung Timur</p>
    </div>

    <div class="bg-white rounded-b-[2.5rem] shadow-sm border border-slate-100 p-8 min-h-[600px]">
        
        {{-- Kolom Pencarian --}}
        <div class="max-w-2xl mx-auto mb-10">
            <div class="relative group">
                <input type="text" x-model="search" placeholder="Cari berdasarkan Judul, OPD, Jenis, atau Kategori..." 
                       class="w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 focus:bg-white outline-none transition-all">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
        </div>

        @if($semuaData->isEmpty())
            <div class="text-center py-20 text-slate-400 font-black uppercase text-xs">Data Tidak Ditemukan</div>
        @else

            {{-- MODE 1: TAMPILAN TABEL (Untuk Utama & Pembantu) --}}
            @if($isTablePage)
                <div class="overflow-x-auto border border-slate-200 rounded-xl">
                    <table class="w-full text-left border-collapse bg-white">
                        <thead class="sticky top-0 z-10">
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="p-4 text-[11px] font-black uppercase text-slate-700 border-r w-12 text-center">#</th>
                                <th class="p-4 text-[11px] font-black uppercase text-slate-700 border-r w-48">Unit Kerja</th>
                                <th class="p-4 text-[11px] font-black uppercase text-slate-700 border-r w-32">Jenis Informasi</th>
                                <th class="p-4 text-[11px] font-black uppercase text-slate-700 border-r w-50">Kategori</th> {{-- Batasi lebar --}}
                                <th class="p-4 text-[11px] font-black uppercase text-slate-700 border-r">Judul Informasi</th> {{-- Tanpa w- agar fleksibel --}}
                                <th class="p-4 text-[11px] font-black uppercase text-slate-700 text-center w-24">Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($semuaData as $index => $doc)
                                <tr class="hover:bg-slate-50 transition-colors" x-show="...">
                                    <td class="p-4 text-sm font-bold text-center border-r">{{ $index + 1 }}</td>
                                    
                                    <td class="p-4 text-[12px] border-r leading-tight uppercase font-medium text-slate-600">
                                        {{ $doc->opd_name }}
                                    </td>
                                    
                                    <td class="p-4 text-center border-r">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-700 text-[9px] font-black uppercase rounded border border-blue-100">
                                            {{ $doc->category }}
                                        </span>
                                    </td>

                                    {{-- Kolom Kategori dengan batasan lebar --}}
                                    <td class="p-4 border-r w-40">
                                        <div class="text-[10px] text-slate-500 uppercase font-black tracking-tighter leading-tight break-words">
                                            {{ $doc->kategori_kelompok->name ?? 'Informasi Lainnya' }}
                                        </div>
                                    </td>

                                    {{-- Kolom Judul yang Utama --}}
                                    <td class="p-4 border-r min-w-[300px]">
                                        <a href="{{ route('public.informasi.show', $doc->id) }}" class="text-blue-600 font-extrabold hover:underline block text-sm leading-snug">
                                            {{ $doc->title }}
                                        </a>
                                        @if($doc->description)
                                            <p class="text-[11px] text-slate-400 italic mt-1 line-clamp-2">{{ $doc->description }}</p>
                                        @endif
                                    </td>

                                    <td class="p-4 text-center">
                                        <a href="{{ route('public.informasi.show', $doc->id) }}" class="inline-flex items-center justify-center w-10 h-10 bg-cyan-50 text-cyan-600 rounded-full hover:bg-cyan-600 hover:text-white transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            {{-- MODE 2: TAMPILAN TAB (Untuk Berkala, Setiap Saat, Serta Merta) --}}
            @else
                {{-- Navigasi Tab --}}
                <div class="flex flex-wrap justify-center gap-3 mb-10">
                    @foreach(['berkala' => '📅 Berkala', 'setiap saat' => '🔓 Setiap Saat', 'serta merta' => '🚨 Serta Merta'] as $key => $label)
                        <button @click="tab = '{{ $key }}'" 
                                :class="tab === '{{ $key }}' ? '{{ $key == 'berkala' ? 'bg-blue-600' : ($key == 'setiap saat' ? 'bg-emerald-600' : 'bg-red-600') }} text-white shadow-lg' : 'bg-slate-100 text-slate-600'" 
                                class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>

                @foreach(['berkala', 'setiap saat', 'serta merta'] as $kat)
                    <div x-show="tab === '{{ $kat }}'" style="display: none;">
                        @php
                            // Filter berdasarkan kolom category, lalu Group berdasarkan id_kel (Tabel Categories)
                            $filtered = $semuaData->filter(function($item) use ($kat) {
                                return trim(strtolower($item->category)) === trim(strtolower($kat));
                            })->groupBy('id_kel');
                        @endphp

                        @forelse($filtered as $idKel => $items)
                            <div class="mb-12">
                                {{-- NAMA SUB-JUDUL DARI TABEL CATEGORIES --}}
                                <div class="flex items-center gap-4 mb-6">
                                    <span class="bg-amber-100 text-amber-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border border-amber-200">
                                        📁 {{ $items->first()->kategori_kelompok->name ?? 'Informasi Umum' }}
                                    </span>
                                    <div class="flex-1 h-px bg-slate-100"></div>
                                </div>

                                <div class="grid gap-4">
                                    @foreach($items as $doc)
                                        <div class="flex flex-col md:flex-row md:items-center justify-between p-6 bg-white border border-slate-100 rounded-[2rem] hover:shadow-lg transition-all group"
                                             x-show="'{{ strtolower($doc->title . ' ' . $doc->opd_name) }}'.includes(search.toLowerCase())">
                                            <div class="flex-1">
                                                <h4 class="text-slate-800 font-bold text-sm group-hover:text-blue-600 transition-colors">{{ $doc->title }}</h4>
                                                <span class="px-2 py-0.5 bg-slate-50 text-[9px] text-slate-500 font-black uppercase rounded-md italic mt-2 inline-block border border-slate-100">🏛️ {{ $doc->opd_name }}</span>
                                            </div>
                                            <a href="{{ route('public.informasi.show', $doc->id) }}" class="mt-4 md:mt-0 px-6 py-2 bg-slate-900 text-white rounded-xl font-black text-[10px] uppercase hover:bg-blue-600 transition-all text-center">Lihat Detail</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="py-20 text-center text-slate-400 italic text-xs uppercase font-bold tracking-widest">Data {{ $kat }} Belum Tersedia</div>
                        @endforelse
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>
@endsection