@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Manajemen Pengumuman</h2>
            <p class="text-[10px] text-slate-500 mt-1 font-black uppercase tracking-widest italic">Input informasi terbaru untuk muncul di tab "Informasi Terbaru".</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-xl font-bold text-sm animate-bounce">
            <span class="mr-2">✅</span> {{ session('success') }}
        </div>
    @endif
    
    <div class="grid lg:grid-cols-3 gap-10">
        {{-- FORM INPUT --}}
        <div class="space-y-6">
            <div class="p-6 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                <form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-5">
                        
                        {{-- 1. INPUT JUDUL --}}
                        <div>
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Judul Pengumuman</label>
                            <input type="text" name="title" required class="w-full mt-1 p-4 rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-amber-500 font-bold text-sm" placeholder="Contoh: [PENTING] WASPADA KARHUTLA">
                        </div>

                        {{-- 2. INPUT KATEGORI --}}
                        <div>
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Kategori Informasi</label>
                            <select name="category" required class="w-full mt-1 p-4 rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-amber-500 font-bold text-sm appearance-none bg-white">
                                <option value="Informasi Berkala">Informasi Berkala</option>
                                <option value="Informasi Serta Merta">Informasi Serta Merta (Darurat/Bencana)</option>
                                <option value="Informasi Setiap Saat">Informasi Setiap Saat</option>
                            </select>
                        </div>

                        {{-- 3. INPUT ISI TEXT --}}
                        <div>
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Isi Pengumuman</label>
                            <textarea name="content" rows="4" required class="w-full mt-1 p-4 rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-amber-500 font-medium text-sm" placeholder="Tulis rincian larangan membakar hutan di sini..."></textarea>
                        </div>

                        {{-- 4. INPUT UPLOAD GAMBAR/POSTER --}}
                        <div class="p-4 bg-white rounded-2xl border-2 border-dashed border-slate-200 hover:border-amber-400 transition-colors">
                            <label class="text-[10px] font-black uppercase text-blue-600 mb-2 block text-center">Upload Poster BPBD (JPG/PNG)</label>
                            <input type="file" name="image" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        {{-- 5. FITUR FLOATING (MELAYANG DI DEPAN) --}}
                        <div class="flex items-center justify-between p-4 bg-amber-50 rounded-2xl border border-amber-100">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black uppercase text-amber-700 leading-tight">Aktifkan Floating?</span>
                                <span class="text-[8px] font-bold text-amber-500 uppercase">Muncul di pojok layar utama</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_floating" value="1" class="sr-only peer">
                                <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-amber-500"></div>
                            </label>
                        </div>

                        <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-xs shadow-xl hover:bg-amber-600 transition-all flex items-center justify-center gap-2">
                            <span>🚀</span> TAYANGKAN SEKARANG
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- DAFTAR PENGUMUMAN --}}
        <div class="lg:col-span-2">
            <div class="space-y-4">
                @forelse($announcements as $item)
                <div class="p-5 bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition flex justify-between items-start">
                    <div class="max-w-[85%]">
                        <span class="text-[9px] font-black text-amber-600 uppercase tracking-widest">{{ $item->created_at->format('d M Y') }}</span>
                        <h4 class="text-sm font-black text-slate-800 uppercase mt-1">{{ $item->title }}</h4>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-2">{{ $item->content }}</p>
                    </div>
                    <a href="{{ route('admin.announcement.edit', $item->id) }}" class="text-amber-500 hover:text-amber-700 p-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>
                    <form action="{{ route('admin.announcement.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 p-2 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
                @empty
                <div class="py-20 text-center bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Belum ada pengumuman tersimpan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection