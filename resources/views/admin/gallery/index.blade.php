@extends('layouts.admin')

@section('content')
<div class="py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-black text-slate-900 mb-8 uppercase tracking-tight">Manajemen Galeri PPID</h2>

        <div class="grid lg:grid-cols-3 gap-8">
            {{-- FORM UPLOAD --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 h-fit">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black uppercase text-slate-400">Keterangan Foto</label>
                            <input type="text" name="caption" class="w-full mt-2 p-4 rounded-2xl bg-slate-50 border-none font-bold" placeholder="Contoh: Sosialisasi PPID...">
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase text-slate-400">Pilih Foto</label>
                            <input type="file" name="image" class="w-full mt-2 text-sm">
                        </div>
                        <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black uppercase shadow-lg shadow-blue-200">Simpan Foto</button>
                    </div>
                </form>
            </div>

            {{-- DAFTAR FOTO --}}
            <div class="lg:col-span-2 grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($galleries as $g)
                <div class="relative group aspect-square rounded-[2rem] overflow-hidden bg-white shadow-sm border border-slate-100">
                    <img src="{{ asset('storage/'.$g->image_path) }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                        <form action="{{ route('admin.gallery.destroy', $g->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white p-3 rounded-xl hover:bg-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection