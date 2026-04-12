@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-12">
            <h2 class="text-4xl font-black text-slate-900 uppercase tracking-tighter">
                Galeri <span class="text-blue-600">Dokumentasi</span>
            </h2>
            <p class="text-sm text-slate-500 mt-2 font-medium italic italic">Kumpulan foto kegiatan dan sosialisasi PPID Kabupaten Belitung Timur.</p>
        </div>

        <div x-data="{ open: false, imgSrc: '', caption: '' }" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galleries as $foto)
                <div class="group aspect-square rounded-[2rem] overflow-hidden cursor-pointer bg-white border-4 border-white shadow-sm hover:shadow-xl transition-all duration-500"
                     @click="open = true; imgSrc = '{{ asset('storage/' . $foto->image_path) }}'; caption = '{{ $foto->caption }}'">
                    <img src="{{ asset('storage/' . $foto->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
            @endforeach

            {{-- MODAL ZOOM (Sama seperti di Home) --}}
            <div x-show="open" x-transition.opacity class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/95 p-6" style="display: none;" @keydown.escape.window="open = false">
                <button @click="open = false" class="absolute top-5 right-5 text-white/50 hover:text-white"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <div class="relative max-w-5xl w-full flex flex-col items-center" @click.away="open = false">
                    <img :src="imgSrc" class="max-w-full max-h-[80vh] rounded-[2.5rem] shadow-2xl">
                    <p x-text="caption" class="mt-6 text-white text-lg font-bold uppercase tracking-widest"></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection