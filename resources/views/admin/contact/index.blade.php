@extends('layouts.admin')

@section('admin_content')
<div class="space-y-8">
    <div>
        <h2 class="text-[28px] font-black text-slate-900 tracking-tight">Pesan & Kontak</h2>
        <p class="text-slate-400 font-medium">Daftar pertanyaan dan pesan dari masyarakat via portal PPID.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <th class="px-8 py-5">Pengirim</th>
                        <th class="px-8 py-5">Subjek & Pesan</th>
                        <th class="px-8 py-5">Tanggal</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-8 py-6">
                            <p class="font-bold text-slate-900 text-sm">{{ $msg->name }}</p>
                            <p class="text-[10px] text-slate-400 font-medium italic">{{ $msg->email }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-bold text-slate-800 text-xs mb-1">{{ $msg->subject }}</p>
                            <p class="text-xs text-slate-500 max-w-xs truncate">{{ $msg->message }}</p>
                        </td>
                        <td class="px-8 py-6 text-[11px] font-bold text-slate-400 uppercase">
                            {{ $msg->created_at->format('d M Y') }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($msg->status === 'baru')
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase tracking-tighter animate-pulse">Baru</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-400 rounded-full text-[10px] font-black uppercase tracking-tighter">Dibaca</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('admin.pesan.show', $msg->id) }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[10px] font-black hover:bg-amber-500 hover:text-slate-900 transition shadow-sm">
                                BUKA PESAN
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-slate-400 italic font-medium">Belum ada pesan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 bg-slate-50">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection