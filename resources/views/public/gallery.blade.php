@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- HEADER --}}
        <div class="mb-12 text-center md:text-left">
            <h2 class="text-4xl font-black text-slate-900 uppercase tracking-tighter">
                Galeri <span class="text-blue-600">Dokumentasi</span>
            </h2>
            <p class="text-sm text-slate-500 mt-2 font-medium italic">Kumpulan dokumentasi kegiatan dan sosialisasi PPID Kabupaten Belitung Timur.</p>
        </div>

        {{-- SISTEM TAB (Alpine.js) --}}
        <div x-data="{ tab: 'foto', open: false, imgSrc: '', caption: '' }">
            
            {{-- TOMBOL NAVIGASI TAB --}}
            <div class="flex justify-center md:justify-start gap-3 mb-12">
                <button @click="tab = 'foto'" 
                    :class="tab === 'foto' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-slate-500 hover:bg-slate-100'"
                    class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">
                    📷 Foto Kegiatan
                </button>
                <button @click="tab = 'video'" 
                    :class="tab === 'video' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-slate-500 hover:bg-slate-100'"
                    class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">
                    🎥 Video Dokumentasi
                </button>
            </div>

            {{-- TAB FOTO --}}
            <div x-show="tab === 'foto'" x-transition:enter="transition ease-out duration-300" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($galleries as $foto)
                    <div class="group aspect-square rounded-[2rem] overflow-hidden cursor-pointer bg-white border-4 border-white shadow-sm hover:shadow-xl transition-all duration-500"
                         @click="open = true; imgSrc = '{{ asset('storage/' . $foto->image_path) }}'; caption = '{{ $foto->caption }}'">
                        <img src="{{ asset('storage/' . $foto->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                @endforeach
            </div>

            {{-- TAB VIDEO --}}
            <div x-show="tab === 'video'" x-transition:enter="transition ease-out duration-300" class="grid grid-cols-1 md:grid-cols-2 gap-8" style="display: none;">
                @forelse($videos ?? [] as $video)
                    <div class="group bg-white p-4 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-500">
                        <div class="aspect-video rounded-[1.8rem] overflow-hidden bg-slate-900 relative">
                            {{-- Menggunakan Iframe YouTube --}}
                            <iframe class="w-full h-full" 
                                    src="https://www.youtube.com/embed/{{ $video->youtube_id }}" 
                                    title="{{ $video->title }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                        <div class="mt-6 px-4 pb-2">
                            <h4 class="text-lg font-black text-slate-800 uppercase leading-tight group-hover:text-blue-600 transition-colors">
                                {{ $video->title }}
                            </h4>
                            <p class="text-xs text-slate-400 mt-2 font-medium italic">PPID Kabupaten Belitung Timur</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum ada dokumentasi video.</p>
                    </div>
                @endforelse
            </div>

            {{-- MODAL ZOOM FOTO --}}
            <div x-show="open" x-transition.opacity class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/95 p-6" style="display: none;" @keydown.escape.window="open = false">
                <button @click="open = false" class="absolute top-5 right-5 text-white/50 hover:text-white">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <div class="relative max-w-5xl w-full flex flex-col items-center" @click.away="open = false">
                    <img :src="imgSrc" class="max-w-full max-h-[80vh] rounded-[2.5rem] shadow-2xl">
                    <p x-text="caption" class="mt-6 text-white text-lg font-bold uppercase tracking-widest text-center"></p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection