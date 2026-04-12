@extends('layouts.admin')

@section('content')
<div class="max-w-4xl">
    {{-- Header Section --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Tambah Slide Baru</h2>
            <p class="text-slate-500 font-medium">Buat pengumuman atau visual baru untuk banner halaman depan.</p>
        </div>
        <a href="{{ route('admin.hero.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition-all text-sm shadow-sm">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] p-8 border border-slate-100">
        
        <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            {{-- Input Gambar dengan Preview --}}
            <div class="space-y-4">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Upload Visual Slide</label>
                
                <div class="relative group">
                    {{-- Container Preview (Muncul otomatis setelah pilih file) --}}
                    <div id="image-preview" class="hidden mb-6 overflow-hidden rounded-3xl border-4 border-slate-50 shadow-xl bg-slate-100">
                        <img id="preview-img" src="#" alt="Preview" class="w-full h-72 object-cover">
                    </div>
                    
                    <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-slate-200 rounded-3xl cursor-pointer bg-slate-50 hover:bg-blue-50 hover:border-blue-400 transition-all group/upload">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <div class="p-4 bg-white rounded-2xl shadow-sm mb-3 group-hover/upload:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" />
                                </svg>
                            </div>
                            <p class="text-sm text-slate-600 font-black uppercase tracking-wider">Pilih File Foto</p>
                            <p class="text-[10px] text-slate-400 mt-1 font-medium">PNG, JPG (Max. 10MB)</p>
                        </div>
                        <input type="file" name="hero_image" id="hero_image" class="hidden" onchange="previewImage(this)" required />
                    </label>
                </div>
                @error('hero_image') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-6">
                {{-- Judul Hero --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Judul Utama (HTML Aktif)</label>
                    <input type="text" name="hero_title" placeholder="Contoh: Akses Informasi <span class='text-amber-400'>Terbuka</span>"
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-slate-900/5 focus:border-slate-900 outline-none transition-all font-bold text-slate-800 placeholder:text-slate-300">
                    <p class="text-[10px] text-slate-400 font-bold uppercase italic tracking-tight">Gunakan &lt;span class="text-amber-400"&gt;teks&lt;/span&gt; untuk aksen warna emas.</p>
                    @error('hero_title') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center gap-3 mt-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="show_title" value="1" class="sr-only peer" {{ ($hero->show_title ?? true) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Tampilkan Judul di Slider</span>
                </div>

                {{-- Subtitle --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Sub-Judul / Deskripsi</label>
                    <textarea name="hero_subtitle" rows="3" placeholder="Tuliskan deskripsi singkat yang akan muncul di bawah judul..."
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-slate-900/5 focus:border-slate-900 outline-none transition-all font-medium text-slate-600 placeholder:text-slate-300"></textarea>
                </div>
                <div class="flex items-center gap-3 mt-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="show_subtitle" value="1" class="sr-only peer" {{ ($hero->show_subtitle ?? true) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Tampilkan Sub-judul di Slider</span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                <a href="{{ route('admin.hero.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-all">Batal</a>
                <button type="submit" class="px-12 py-4 bg-slate-900 text-white rounded-2xl font-black hover:bg-blue-600 shadow-xl shadow-slate-200 transition-all active:scale-95 uppercase text-xs tracking-widest">
                    Simpan Slide
                </button>
            </div>
        </form>

    </div>
</div>

{{-- Script Preview Gambar --}}
<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const img = document.getElementById('preview-img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection