@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Video Panduan PPID</h2>
            <p class="text-[10px] text-slate-500 mt-1 font-black uppercase tracking-widest italic">Kelola Video Edukasi Tata Cara Permohonan Informasi.</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">
        {{-- FORM INPUT VIDEO --}}
        <div class="space-y-6">
            <div class="p-6 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                <form action="{{ route('admin.video.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Judul Video</label>
                            <input type="text" name="title" required class="w-full mt-1 p-4 rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-blue-500 font-bold text-sm" placeholder="Misal: Cara Cek Status Permohonan">
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">YouTube ID</label>
                            <input type="text" name="youtube_id" required class="w-full mt-1 p-4 rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-blue-500 font-mono text-sm" placeholder="Contoh: dQw4w9WgXcQ">
                            <p class="text-[9px] text-slate-400 mt-2 px-2 italic">Ambil kode unik setelah <b>v=</b> di link YouTube.</p>
                        </div>
                        <div class="flex items-center gap-3 px-2">
                            <input type="checkbox" name="is_main" value="1" id="is_main" class="rounded text-blue-600">
                            <label for="is_main" class="text-[10px] font-black uppercase text-slate-600">Set sebagai Video Utama</label>
                        </div>
                        <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-xs shadow-xl hover:bg-emerald-600 transition-all">
                            Simpan Video
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- DAFTAR VIDEO --}}
        <div class="lg:col-span-2">
            <div class="space-y-4">
                @forelse($videos as $v)
                <div class="flex items-center justify-between p-4 bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-4">
                        <div class="w-20 aspect-video bg-slate-900 rounded-lg overflow-hidden">
                            <img src="https://img.youtube.com/vi/{{ $v->youtube_id }}/default.jpg" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-800">{{ $v->title }}</h4>
                            <span class="text-[9px] font-mono text-slate-400 uppercase tracking-widest">{{ $v->youtube_id }}</span>
                            @if($v->is_main)
                                <span class="ml-2 px-2 py-0.5 bg-emerald-100 text-emerald-600 text-[8px] font-black uppercase rounded-full">Utama</span>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('admin.video.destroy', $v->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 p-2 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
                @empty
                <div class="py-20 text-center bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Belum ada daftar video</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection