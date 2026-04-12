@extends('layouts.public')

@section('content')
<section class="py-24 bg-white min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- HEADER HALAMAN --}}
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black text-slate-900 uppercase tracking-tighter">
                Pengumuman <span class="text-blue-600">Terbaru</span>
            </h2>
            <div class="w-20 h-1.5 bg-amber-500 mx-auto mt-4 rounded-full"></div>
            <p class="text-slate-500 mt-6 font-medium italic text-sm">
                Informasi terkini mengenai layanan informasi publik dan kebijakan PPID Belitung Timur.
            </p>
        </div>

        {{-- DAFTAR PENGUMUMAN --}}
        <div class="bg-slate-50 rounded-[3rem] p-8 md:p-12 border border-slate-100 shadow-sm min-h-[500px]">
            <div class="space-y-6">
                @forelse($announcements as $info)
                    <div class="group p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-blue-100 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full">
                            {{ $info->created_at->format('d M Y') }}
                        </span>
                        <div class="h-px flex-1 bg-slate-100"></div>
                    </div>

                    <h4 class="text-xl font-black text-slate-800 uppercase leading-tight group-hover:text-blue-600 transition-colors">
                        {{ $info->title }}
                    </h4>

                    {{-- TAMBAHKAN BAGIAN GAMBAR DI SINI --}}
                    @if($info->image)
                        <div class="mt-6 overflow-hidden rounded-3xl border border-slate-50">
                            <img src="{{ asset('storage/' . $info->image) }}" 
                                alt="{{ $info->title }}" 
                                class="w-full h-auto object-cover max-h-[500px] group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @endif

                    <div class="text-sm text-slate-500 mt-4 leading-loose font-medium">
                        {!! nl2br(e($info->content)) !!}
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-slate-50 flex justify-end">
                        <div class="text-[10px] font-black text-slate-300 uppercase tracking-widest">
                            PPID Kab. Belitung Timur
                        </div>
                    </div>
                </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum ada pengumuman untuk saat ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- NAVIGASI HALAMAN (PAGINATION) --}}
            <div class="mt-12">
                {{ $announcements->links() }}
            </div>
        </div>

        {{-- FOOTER INFO --}}
        <div class="mt-12 text-center">
            <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.4em]">
                Halaman ini diperbarui secara berkala
            </p>
        </div>
    </div>
</section>
@endsection