@extends('layouts.admin')

@section('content')
@if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-xl font-bold text-sm">
        <p>Gagal menyimpan! Periksa kembali:</p>
        <ul class="list-disc ml-5 font-medium">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="max-w-4xl mx-auto bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
    <h2 class="text-2xl font-black text-slate-900 uppercase mb-8">Edit Pengumuman</h2>

    <form action="{{ route('admin.announcement.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="space-y-6">
            <div>
                <label class="text-[10px] font-black uppercase text-slate-400">Judul</label>
                <input type="text" name="title" value="{{ $announcement->title }}" class="w-full mt-2 p-4 rounded-2xl ring-1 ring-slate-200 focus:ring-amber-500 border-none font-bold">
            </div>

            <div>
                <label class="text-[10px] font-black uppercase text-slate-400">Kategori Informasi</label>
                <select name="category" required class="w-full mt-2 p-4 rounded-2xl ring-1 ring-slate-200 focus:ring-amber-500 border-none font-bold text-sm appearance-none bg-white">
                    <option value="Informasi Berkala" {{ $announcement->category == 'Informasi Berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                    <option value="Informasi Serta Merta" {{ $announcement->category == 'Informasi Serta Merta' ? 'selected' : '' }}>Informasi Serta Merta (Darurat/Bencana)</option>
                    <option value="Informasi Setiap Saat" {{ $announcement->category == 'Informasi Setiap Saat' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                </select>
            </div>

            <div>
                <label class="text-[10px] font-black uppercase text-slate-400">Isi Pengumuman</label>
                <textarea name="content" rows="6" class="w-full mt-2 p-4 rounded-2xl ring-1 ring-slate-200 focus:ring-amber-500 border-none font-medium">{{ $announcement->content }}</textarea>
            </div>

            {{-- Menampilkan Preview Gambar Lama --}}
            @if($announcement->image)
                <div class="p-4 bg-slate-50 rounded-2xl">
                    <p class="text-[8px] font-black text-slate-400 uppercase mb-2">Poster Saat Ini:</p>
                    <img src="{{ asset('storage/' . $announcement->image) }}" class="w-32 h-auto rounded-xl shadow-md">
                </div>
            @endif

            <div>
                <label class="text-[10px] font-black uppercase text-blue-600">Ganti Poster (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="image" class="w-full mt-2 text-xs">
            </div>

            <div class="flex items-center justify-between p-4 bg-amber-50 rounded-2xl">
                <span class="text-[10px] font-black uppercase text-amber-700">Aktifkan Floating?</span>
                <input type="checkbox" name="is_floating" value="1" {{ $announcement->is_floating ? 'checked' : '' }}>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-xs hover:bg-amber-600 transition-all">Update Pengumuman</button>
                <a href="{{ route('admin.announcement.index') }}" class="py-4 px-8 bg-slate-100 text-slate-400 rounded-2xl font-black uppercase text-xs">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection