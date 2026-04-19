@extends('layouts.public')

{{-- 1. CSS ditaruh di atas section --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .heroSwiper { width: 100%; height: 100vh; }
    .swiper-slide { 
        display: flex !important; 
        align-items: center !important; 
        justify-content: center !important; 
        height: 100vh !important;
        background-size: cover;
        background-position: center;
    }
    /* Animasi Teks Slider */
    .swiper-slide-active h1 { animation: fadeInUp 0.8s ease-out forwards; }
    .swiper-slide-active p { animation: fadeInUp 1.2s ease-out forwards; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@section('content')

{{-- ================= 1. HERO SLIDER ================= --}}
<section id="hero" class="relative h-screen overflow-hidden">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            @php 
                $slides = \App\Models\Hero::where('is_active', true)->orderBy('order')->get(); 
            @endphp
            
            @forelse($slides as $slide)
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/images/' . $slide->image) }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-slate-900/90"></div>

                <div class="relative z-10 w-full max-w-5xl px-6 text-center">
                    @if($slide->show_title)
                    <h1 class="text-4xl md:text-7xl font-black text-white mb-6 tracking-tight drop-shadow-2xl leading-tight">
                        {!! $slide->title !!}
                    </h1>
                    @endif
                    @if($slide->show_subtitle)
                    <p class="text-lg md:text-2xl text-slate-200 max-w-3xl mx-auto font-medium drop-shadow-md italic">
                        {{ $slide->subtitle }}
                    </p>
                    @endif
                </div>
            </div>
            @empty
            <div class="swiper-slide bg-slate-900 flex items-center justify-center text-white text-center">
                <div>
                    <h1 class="text-3xl font-bold">PPID KABUPATEN BELITUNG TIMUR</h1>
                    <p class="mt-2 text-slate-400">Silakan tambahkan data slide di Panel Admin.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        {{-- Navigasi Slider --}}
        <div class="swiper-button-next !text-white !w-12 !h-12 after:!text-2xl"></div>
        <div class="swiper-button-prev !text-white !w-12 !h-12 after:!text-2xl"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

{{-- Container Utama Home --}}
<div x-data="{ scrolled: false }" 
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 80 })"
     class="relative -mt-32 z-20"> 

    {{-- A. BAR PENCARIAN (SEARCH) --}}
    <div :class="scrolled ? 'translate-y-0 opacity-100' : 'translate-y-20 opacity-0'"
        class="max-w-4xl mx-auto px-6 transition-all duration-700 ease-out transform">
        
        {{-- Hubungkan ke route public.search --}}
        <form action="{{ route('public.search') }}" method="GET" class="bg-white rounded-[2.5rem] p-2 shadow-2xl flex items-center border border-slate-100 shadow-blue-900/10">
            <div class="pl-6 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            
            {{-- WAJIB: Tambahkan name="keyword" agar ditangkap Controller --}}
            <input type="text" name="keyword" placeholder="Cari informasi publik (RKA, LAKIP, Profil)..." 
                class="w-full border-none focus:ring-0 bg-transparent text-[10px] font-black uppercase tracking-widest p-4">
                
            <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-full font-black uppercase text-[10px] tracking-widest hover:bg-slate-900 transition-all">
                CARI DATA
            </button>
        </form>
    </div>

    {{-- B. GRID MENU LAYAR UTAMA --}}
    <<div :class="scrolled ? 'translate-y-0 opacity-100' : 'translate-y-40 opacity-0'"
     class="max-w-7xl mx-auto px-6 mt-12 transition-all duration-1000 ease-out transform delay-100 flex justify-center"> {{-- Tambahkan flex & justify-center di sini --}}
    
    {{-- Grid dengan justify-items-center agar isinya tegak lurus di tengah --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 w-full justify-items-center">
        
        {{-- Menu 1: Permohonan Informasi --}}
        <a href="{{ route('permohonan.informasi') }}" class="w-full p-8 bg-white rounded-[3rem] shadow-xl hover:shadow-2xl transition-all text-center group border border-slate-50">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-blue-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-700 leading-tight">Permohonan<br>Informasi</span>
        </a>

        {{-- Menu 2: Pengajuan Keberatan --}}
        <a href="{{ route('keberatan.form') }}" class="w-full p-8 bg-white rounded-[3rem] shadow-xl hover:shadow-2xl transition-all text-center group border border-slate-50">
            <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-4.726 0-8.683-1.833-8.683-4.125s3.957-4.125 8.683-4.125m0 8.25c4.726 0 8.683-1.833 8.683-4.125s-3.957-4.125-8.683-4.125M12 3c4.726 0 8.683 1.833 8.683 4.125s-3.957 4.125-8.683-4.125M12 3c-4.726 0-8.683 1.833-8.683 4.125s3.957 4.125 8.683 4.125" />
                </svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-700 leading-tight">Pengajuan<br>Keberatan</span>
        </a>

        {{-- Menu 3: Penyelesaian Sengketa --}}
        <a href="{{ route('sengketa.form') }}" class="w-full p-8 bg-white rounded-[3rem] shadow-xl hover:shadow-2xl transition-all text-center group border border-slate-50">
            <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-amber-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h3.375c.621 0 1.125.504 1.125 1.125V21M3 3h18M3 21h18M5 6.75h14v10.5a.75.75 0 0 1-.75.75H5.75a.75.75 0 0 1-.75-.75V6.75Z" />
                </svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-700 leading-tight">Penyelesaian<br>Sengketa</span>
        </a>

        {{-- Menu 4: Cek Status --}}
        <a href="{{ route('monitoring.form') }}" class="w-full p-8 bg-white rounded-[3rem] shadow-xl hover:shadow-2xl transition-all text-center group border border-slate-50">
            <div class="w-16 h-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-red-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6" />
                </svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-700 leading-tight">Cek Status<br>Permohonan</span>
        </a>
    </div>
</div>
</div>

{{-- ================= 3. ALUR PERMOHONAN ================= --}}
<section class="mt-8 relative py-10 overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-50 via-white to-slate-50"></div>

    <div class="text-center mb-16 px-6">
        <span class="inline-block px-4 py-1.5 mb-4 text-xs font-black tracking-[0.2em] text-blue-600 bg-blue-50 rounded-full uppercase">
            Prosedur Layanan
        </span>
        <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight">
            Alur Permohonan <span class="text-blue-600 font-black">Informasi</span>
        </h2>
        <div class="w-20 h-1.5 bg-amber-500 mx-auto mt-6 rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative">
        <div class="hidden lg:block absolute top-16 left-0 right-0 h-1 bg-slate-200">
            <div class="h-full bg-gradient-to-r from-blue-900 via-blue-500 to-emerald-500 w-full rounded-full opacity-60"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
            @php
                $steps = [
                    ['title' => 'Ajukan Permohonan', 'desc' => 'Pemohon mengisi formulir online & melampirkan Identitas (KTP).', 'color' => 'bg-slate-900', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                    ['title' => 'Verifikasi PPID', 'desc' => 'Petugas memeriksa kelengkapan administrasi dan kejelasan permohonan.', 'color' => 'bg-blue-700', 'icon' => 'M9 12l2 2l4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ['title' => 'Pemberian Jawaban', 'desc' => 'Jawaban diberikan maksimal 10 hari kerja (+7 hari jika data kompleks).', 'color' => 'bg-blue-500', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['title' => 'Informasi Diberikan', 'desc' => 'Jika sesuai, informasi dikirim via sistem/email. Proses Selesai.', 'color' => 'bg-emerald-600', 'icon' => 'M5 13l4 4L19 7'],
                ];
            @endphp

            @foreach($steps as $index => $step)
            <div class="group relative pt-6 md:pt-0">
                <div class="relative z-10 w-24 h-24 mx-auto flex items-center justify-center rounded-[2.5rem] {{ $step['color'] }} text-white shadow-2xl transition-all duration-500 group-hover:scale-110 group-hover:rotate-6 ring-8 ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                    </svg>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center font-black text-xs border-4 border-white">
                        {{ $index + 1 }}
                    </div>
                </div>
                <div class="mt-8 bg-white/80 backdrop-blur-sm p-8 rounded-[2.5rem] shadow-sm border border-slate-100 transition-all duration-500 group-hover:shadow-2xl group-hover:shadow-blue-200 group-hover:-translate-y-2 text-center h-full">
                    <h3 class="font-black text-slate-800 uppercase tracking-tight text-sm">{{ $step['title'] }}</h3>
                    <p class="mt-4 text-sm text-slate-500 leading-relaxed font-medium italic">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Mekanisme Keberatan --}}
    <div class="mt-40 max-w-7xl mx-auto px-6">
        <div class="bg-white border-2 border-slate-100 rounded-[3rem] p-10 md:p-16 shadow-2xl shadow-slate-200 relative overflow-hidden">
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-red-50 rounded-full opacity-50"></div>
            <div class="relative z-10 grid lg:grid-cols-3 gap-12 items-center">
                <div class="lg:col-span-1">
                    <span class="text-red-600 font-black tracking-widest text-xs uppercase">Eskalasi Layanan</span>
                    <h3 class="text-3xl font-extrabold text-slate-900 mt-2">Permohonan Tidak Sesuai?</h3>
                    <p class="mt-4 text-slate-500 font-medium">Anda memiliki hak konstitusional untuk mengajukan keberatan melalui mekanisme yang berlaku.</p>
                </div>
                <div class="lg:col-span-2 grid md:grid-cols-3 gap-6">
                    <div class="p-6 rounded-3xl bg-red-50 border border-red-100 group hover:bg-red-600 transition-all">
                        <div class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center font-black text-lg group-hover:bg-white group-hover:text-red-600">1</div>
                        <h4 class="mt-4 font-bold text-slate-800 group-hover:text-white">Keberatan</h4>
                        <p class="mt-2 text-xs text-slate-500 group-hover:text-red-100 italic">Ajukan tertulis ke Atasan PPID.</p>
                    </div>
                    <div class="p-6 rounded-3xl bg-slate-900 border border-slate-800 group hover:bg-amber-500 transition-all">
                        <div class="w-12 h-12 bg-white text-slate-900 rounded-2xl flex items-center justify-center font-black text-lg group-hover:bg-slate-900 group-hover:text-white">2</div>
                        <h4 class="mt-4 font-bold text-white group-hover:text-slate-900">Tanggapan</h4>
                        <p class="mt-2 text-xs text-slate-400 group-hover:text-slate-800 leading-tight italic">Tunggu jawaban resmi resmi.</p>
                    </div>
                    <div class="p-6 rounded-3xl bg-red-50 border border-red-100 group hover:bg-red-600 transition-all">
                        <div class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center font-black text-lg group-hover:bg-white group-hover:text-red-600">3</div>
                        <h4 class="mt-4 font-bold text-slate-800 group-hover:text-white">Sengketa</h4>
                        <p class="mt-2 text-xs text-slate-500 group-hover:text-red-100 leading-tight italic">Mediasi Komisi Informasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= 5. PANDUAN VIDEO & DOKUMENTASI (POIN 3) ================= --}}
<section class="py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-12 gap-12 items-start">
            
            {{-- KOLOM KIRI: VIDEO TATA CARA (UTAMA) --}}
            <div class="lg:col-span-7">
                <div class="bg-white p-4 rounded-[3rem] shadow-xl border border-slate-100">
                    <div class="relative aspect-video rounded-[2.5rem] overflow-hidden bg-slate-900 shadow-inner">
                        {{-- Ganti ID dQw4w9WgXcQ dengan ID YouTube PPID Beltim --}}
                        <iframe class="w-full h-full" 
                            src="https://www.youtube.com/embed/{{ $mainVideo->youtube_id ?? 'dQw4w9WgXcQ' }}" 
                            frameborder="0" allowfullscreen>
                        </iframe>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tighter">Video Panduan Permohonan</h3>
                        <p class="text-xs text-slate-500 mt-2 font-medium italic">Ikuti langkah-langkah mudah mengajukan informasi publik melalui video edukasi ini.</p>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FOTO KEGIATAN / INFOGRAFIS --}}
            <div x-data="{ open: false, imgSrc: '', caption: '' }" class="lg:col-span-5 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 rounded-full border border-amber-100 mb-2">
                    <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-amber-700 uppercase tracking-widest">Galeri & Infografis</span>
                </div>
                <h2 class="text-3xl font-black text-slate-900 leading-tight uppercase tracking-tighter">
                    Dokumentasi <br><span class="text-blue-600">Layanan Informasi</span>
                </h2>
                
                <div class="grid grid-cols-2 gap-4">
                    @forelse($galleries->take(2) as $foto)
                        <div class="group relative aspect-square rounded-[2rem] overflow-hidden cursor-pointer shadow-md hover:shadow-xl transition-all duration-500 border-4 border-white"
                            @click="open = true; imgSrc = '{{ asset('storage/' . $foto->image_path) }}'; caption = '{{ $foto->caption }}'">
                            
                            <img src="{{ asset('storage/' . $foto->image_path) }}" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="{{ $foto->caption }}">
                            
                            {{-- Overlay Hover --}}
                            <div class="absolute inset-0 bg-blue-600/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <div class="bg-white/90 p-3 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 py-10 text-center border-2 border-dashed border-slate-200 rounded-[2rem]">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Belum ada dokumentasi</p>
                        </div>
                    @endforelse
                </div>

                {{-- TOMBOL TAMPILKAN SEMUA --}}
                @if($galleries->count() > 2)
                    <div class="mt-6 flex justify-start">
                        <a href="{{ route('public.gallery') }}" 
                        class="group inline-flex items-center gap-3 px-6 py-3 bg-white border border-slate-200 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 hover:shadow-lg hover:shadow-blue-100 transition-all duration-300">
                            <span>Lihat Semua Foto</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                @endif

                <p class="text-sm text-slate-500 font-medium leading-relaxed italic border-l-4 border-blue-500 pl-4">
                    "Keterbukaan informasi adalah kunci transparansi pemerintahan di Kabupaten Belitung Timur."
                </p>

                {{-- MODAL OVERLAY (Muncul saat foto diklik) --}}
                <div x-show="open" 
                    x-transition.opacity
                    class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/95 p-4 md:p-10"
                    style="display: none;"
                    @keydown.escape.window="open = false">
                    
                    {{-- Tombol Tutup --}}
                    <button @click="open = false" class="absolute top-5 right-5 text-white/50 hover:text-white transition-colors">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <div class="relative max-w-5xl w-full flex flex-col items-center" @click.away="open = false">
                        <img :src="imgSrc" class="max-w-full max-h-[80vh] rounded-[2.5rem] shadow-2xl border-8 border-white/10">
                        <p x-text="caption" class="mt-6 text-white text-lg font-bold uppercase tracking-widest text-center"></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================= 4. AKSES CEPAT LAYANAN ================= --}}
<section class="bg-white py-24 relative overflow-hidden">
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-64 h-64 bg-slate-50 rounded-full blur-3xl"></div>
    <div class="max-w-6xl mx-auto px-6 relative text-center">
        <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Akses Cepat Layanan</h2>
        <p class="mt-4 text-slate-500 font-medium italic">Pilih layanan di bawah ini untuk memulai pengajuan secara daring</p>
        <div class="w-12 h-1 bg-amber-500 mx-auto mt-6 rounded-full mb-16"></div>

        <div class="grid md:grid-cols-2 gap-8 lg:gap-12 text-left">
            {{-- Permohonan Informasi --}}
            <a href="{{ url('/permohonan') }}" class="group relative bg-slate-50 rounded-[2.5rem] p-10 transition-all hover:bg-slate-900 hover:shadow-2xl hover:-translate-y-2 overflow-hidden">
                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-blue-500/10 rounded-full group-hover:bg-white/5 transition-colors"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-blue-100 text-blue-700 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-amber-500 group-hover:text-slate-900 transition-all transform group-hover:rotate-6">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M19.5 14.25v-7.5a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5A2.25 2.25 0 006.75 19.5h7.5m3-3l-3 3m0 0l-3-3m3 3v-6" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 group-hover:text-white transition-colors">Permohonan Informasi</h3>
                    <p class="mt-4 text-slate-600 group-hover:text-slate-300 italic">Ajukan permintaan data atau dokumen publik secara online.</p>
                </div>
            </a>

            {{-- Pengajuan Keberatan --}}
            <a href="{{ url('/monitoring') }}" class="group relative bg-slate-50 rounded-[2.5rem] p-10 transition-all hover:bg-red-600 hover:shadow-2xl hover:-translate-y-2 overflow-hidden">
                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-red-500/10 rounded-full group-hover:bg-white/5 transition-colors"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-white group-hover:text-red-600 transition-all transform group-hover:-rotate-6">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM10.29 3.86l-7.5 13.5A1.875 1.875 0 004.42 20.25h15.16a1.875 1.875 0 001.63-2.89l-7.5-13.5a1.875 1.875 0 00-3.42 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 group-hover:text-white transition-colors">Pengajuan Keberatan</h3>
                    <p class="mt-4 text-slate-600 group-hover:text-red-50 italic">Sampaikan keberatan jika permohonan informasi Anda ditolak.</p>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- ================= JS SCRIPTS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".heroSwiper", {
        loop: true,
        effect: "fade",
        fadeEffect: { crossFade: true },
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    });
</script>

{{-- Logic Menampilkan Pengumuman Melayang (Floating) --}}
@php
    // Ambil data pengumuman yang dicentang is_floating dan statusnya aktif
    $floating = \App\Models\Announcement::where('is_floating', true)
                ->where('is_active', true)
                ->latest()
                ->first();
@endphp

@if($floating)
<div x-data="{ open: true }" x-show="open" 
     class="fixed bottom-10 right-10 z-[999] w-56 md:w-72"
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="opacity-0 translate-y-10"
     x-transition:enter-end="opacity-100 translate-y-0">
    
    <div class="relative bg-white p-2 rounded-[2.5rem] shadow-[0_20px_50px_rgba(220,38,38,0.3)] border-2 border-red-100 overflow-hidden group">
        {{-- Tombol Tutup (X) --}}
        <button @click="open = false" class="absolute top-3 right-3 bg-red-600 text-white rounded-full p-1.5 shadow-lg hover:bg-slate-900 transition-colors z-20">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        {{-- Gambar Poster dari Database --}}
        <div class="overflow-hidden rounded-[2rem]">
            <img src="{{ asset('storage/' . $floating->image) }}" 
                 class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-110" 
                 alt="{{ $floating->title }}">
        </div>

        <div class="p-4 text-center">
            <span class="text-[8px] font-black text-red-600 uppercase tracking-[0.2em] animate-pulse block mb-1">Himbauan Darurat</span>
            <p class="text-[10px] font-extrabold text-slate-800 leading-tight uppercase mb-3">{{ $floating->title }}</p>
            
            {{-- Tombol Detail --}}
            <a href="{{ route('public.prosedur') }}" class="block w-full py-2 bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest rounded-xl hover:bg-red-600 transition-colors">
                Baca Selengkapnya
            </a>
        </div>
    </div>
</div>
@endif
@endsection