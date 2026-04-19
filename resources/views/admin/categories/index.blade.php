@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tight">Manajemen Sub-Judul</h2>
            <p class="text-xs text-slate-500 font-medium italic">Kelola kelompok informasi untuk Daftar Informasi Publik</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Tabel Daftar (2 Bagian) --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="p-4 text-[10px] font-black uppercase text-slate-400 w-12 text-center">#</th>
                            <th class="p-4 text-[10px] font-black uppercase text-slate-400">Nama Kelompok</th>
                            <th class="p-4 text-[10px] font-black uppercase text-slate-400 text-center">Akses</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($categories as $index => $cat)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="p-4 text-xs font-bold text-slate-400 text-center">{{ $index + 1 }}</td>
                            <td class="p-4">
                                <span class="text-sm font-bold text-slate-700 group-hover:text-blue-600 transition-colors">{{ $cat->name }}</span>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="editCategory({{ $cat->id }}, '{{ $cat->name }}')" 
                                            class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </button>
                                    
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kelompok ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-10 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Kolom Kanan: Form Tambah/Edit (1 Bagian) --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 sticky top-24">
                <h3 id="formTitle" class="text-sm font-black text-slate-800 uppercase tracking-widest mb-6">Tambah Sub-Judul</h3>
                
                <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div id="methodField"></div>
                    
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Nama Kelompok</label>
                        <input type="text" name="name" id="categoryName" required
                               class="w-full px-4 py-3 bg-slate-50 border-none ring-1 ring-slate-100 rounded-xl focus:ring-2 focus:ring-slate-900 font-bold text-sm transition-all"
                               placeholder="Input Nama Kelompok...">
                    </div>

                    <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg shadow-slate-200">
                        Simpan Data
                    </button>
                    
                    <button type="button" id="cancelBtn" onclick="resetForm()" 
                            class="w-full py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-200 transition-all hidden">
                        Batal Edit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function editCategory(id, name) {
        document.getElementById('formTitle').innerText = 'Edit Sub-Judul';
        document.getElementById('categoryName').value = name;
        document.getElementById('categoryForm').action = '/admin/categories/' + id;
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('cancelBtn').classList.remove('hidden');
        document.getElementById('categoryName').focus();
    }

    function resetForm() {
        document.getElementById('formTitle').innerText = 'Tambah Sub-Judul';
        document.getElementById('categoryName').value = '';
        document.getElementById('categoryForm').action = '{{ route("admin.categories.store") }}';
        document.getElementById('methodField').innerHTML = '';
        document.getElementById('cancelBtn').classList.add('hidden');
    }
</script>
@endsection