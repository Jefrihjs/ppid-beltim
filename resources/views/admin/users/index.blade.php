@extends('layouts.admin') 

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <div>
            <h2 class="text-lg font-bold text-slate-800">Manajemen User Admin</h2>
            <p class="text-xs text-slate-500">Daftar pengguna yang memiliki akses ke Panel Kendali PPID</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-200">
            + Tambah Admin Baru
        </a>
    </div>
    @if (session('success') || session('error'))
        <div class="px-6 py-4 border-b border-slate-50">
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-transition 
                x-init="setTimeout(() => show = false, 5000)"
                class="{{ session('success') ? 'bg-emerald-50 border-emerald-100 text-emerald-700' : 'bg-red-50 border-red-100 text-red-700' }} p-4 rounded-2xl border flex items-center shadow-sm"
            >
                <span class="mr-3">{{ session('success') ? '✅' : '⚠️' }}</span>
                <p class="text-xs font-bold uppercase tracking-widest">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50">
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Pengguna</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Hak Akses (Role)</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <span class="text-xs font-bold text-slate-700">{{ $user->name }}</span>
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-500">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter {{ $user->role === 'superadmin' ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center items-center gap-1">
                            @if($user->id !== auth()->id())
                                {{-- TOMBOL EDIT --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                class="text-slate-400 hover:text-slate-900 transition p-2" 
                                title="Edit Admin">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>

                                {{-- TOMBOL HAPUS --}}
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                        onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')"
                                        class="text-red-400 hover:text-red-600 transition p-2"
                                        title="Hapus Admin">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <span class="text-[9px] italic text-slate-400 font-bold uppercase tracking-widest">Akun Anda</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(userId, userName) {
        Swal.fire({
            title: 'Hapus Admin?',
            text: "Akun " + userName + " akan dihapus permanen dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0f172a', // Warna Slate-900 (sesuai tema Bapak)
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-xl',
                cancelButton: 'text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-xl text-slate-600'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Jalankan submit form jika user klik Ya
                document.getElementById('delete-form-' + userId).submit();
            }
        })
    }
</script>
@endsection