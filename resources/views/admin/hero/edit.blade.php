@extends('layouts.admin')

@section('content')
<div class="max-w-4xl">
    {{-- Header Halaman --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Slide Slider</h2>
            <p class="text-slate-500 font-medium">Perbarui gambar atau teks informasi pada slide terpilih.</p>
        </div>
        <a href="{{ route('admin.hero.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition-all text-sm shadow-sm">
            &larr; Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-100 font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] p-8 border border-slate-100">
        
        <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')
            
            {{-- Preview & Input Gambar --}}
            <div class="space-y-4">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Gambar Slide Sekarang</label>
                
                <div class="relative group">
                    <div id="image-preview" class="overflow-hidden rounded-3xl border-4 border-slate-50 shadow-xl bg-slate-100">
                        {{-- Menampilkan gambar lama sebagai default --}}
                        <img id="preview-img" src="{{ asset('storage/images/' . $hero->image) }}" alt="Preview" class="w-full h-72 object-cover">
                    </div>
                </div>

                <div class="bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-200">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Ganti Gambar Baru</label>
                    <input type="file" name="hero_image" id="hero_image" 
                           class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-blue-600 transition-all cursor-pointer" 
                           onchange="previewImage(this)" />
                    <p class="mt-2 text-[10px] text-slate-400 font-medium italic">*Kosongkan jika tidak ingin mengubah gambar.</p>
                </div>
                
                @error('hero_image') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-6">
                {{-- Judul Hero --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Judul Utama (HTML OK)</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $hero->title) }}"
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-slate-900/5 focus:border-slate-900 outline-none transition-all font-bold text-slate-800">
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
                    <textarea name="hero_subtitle" rows="3" 
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-slate-900/5 focus:border-slate-900 outline-none transition-all font-medium text-slate-600">{{ old('hero_subtitle', $hero->subtitle) }}</textarea>
                </div>
                <div class="flex items-center gap-3 mt-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="show_subtitle" value="1" class="sr-only peer" {{ ($hero->show_subtitle ?? true) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Tampilkan Sub-judul di Slider</span>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                <a href="{{ route('admin.hero.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-all">Batal</a>
                <button type="submit" class="px-12 py-4 bg-slate-900 text-white rounded-2xl font-black hover:bg-blue-600 shadow-xl shadow-slate-200 transition-all active:scale-95 uppercase text-xs tracking-widest">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function previewImage(input) {
        const img = document.getElementById('preview-img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection