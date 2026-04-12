@extends('layouts.admin')

@section('content')
<section class="py-6 px-4">
    <div class="flex items-center gap-2 text-xs font-bold text-blue-600 mb-6 uppercase tracking-widest">
        <a href="{{ route('admin.dashboard') }}">Beranda</a>
        <span class="text-slate-300">/</span>
        <a href="{{ route('admin.permohonan.index') }}">Permohonan Informasi</a>
        <span class="text-slate-300">/</span>
        <span class="text-slate-400">Detail Permohonan</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- KOLOM KIRI: DATA PERMOHONAN --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                    <h2 class="text-lg font-bold text-slate-800">Detail Permohonan Informasi</h2>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-y-1">
                        {{-- Row Item --}}
                        <div class="py-3 px-2 text-sm font-bold text-slate-700">Kode Permohonan</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600 flex items-center gap-2">
                            {{ $permohonan->nomor_registrasi }} 
                            <span class="bg-blue-500 text-white text-[10px] px-2 py-0.5 rounded-full uppercase">baru</span>
                        </div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700 bg-slate-50">Nomor Pendaftaran</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600 bg-slate-50 font-mono">001/PPID/IV/2026</div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700">Kategori Pemohon</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600 uppercase">{{ $permohonan->kategori_pemohon }}</div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700">Nama Lengkap</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600">{{ $permohonan->nama }}</div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700">Alamat</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600">{{ $permohonan->alamat }}</div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700 font-mono">NIK</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600">{{ $permohonan->nik }}</div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700">Nomor Ponsel</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600">{{ $permohonan->no_hp }}</div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700 italic">e-Mail</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-blue-500 underline">{{ $permohonan->email }}</div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700 border-t border-slate-50 mt-4 pt-6">Rincian Informasi</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600 border-t border-slate-50 mt-4 pt-6 italic">"{{ $permohonan->rincian_informasi }}"</div>

                        <div class="py-3 px-2 text-sm font-bold text-slate-700">Tujuan Penggunaan</div>
                        <div class="py-3 px-2 md:col-span-2 text-sm text-slate-600">{{ $permohonan->tujuan_penggunaan }}</div>

                        {{-- Section Cara Memperoleh --}}
                        <div class="py-6 px-2 md:col-span-3">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs font-bold text-slate-800 mb-3">Cara Memperoleh Informasi</p>
                                    <div class="space-y-2 text-xs">
                                        <label class="flex items-center gap-2">
                                            <input type="radio" {{ $permohonan->cara_memperoleh == 'melihat' ? 'checked' : '' }} disabled class="text-blue-500"> Melihat
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="radio" {{ $permohonan->cara_memperoleh == 'membaca' ? 'checked' : '' }} disabled class="text-blue-500"> Membaca
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 mb-3">Salinan Informasi</p>
                                    <div class="space-y-2 text-xs">
                                        <label class="flex items-center gap-2">
                                            <input type="radio" {{ $permohonan->jenis_salinan == 'softcopy' ? 'checked' : '' }} disabled class="text-blue-500"> Softcopy
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="radio" {{ $permohonan->jenis_salinan == 'hardcopy' ? 'checked' : '' }} disabled class="text-blue-500"> Hardcopy
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Lampiran KTP --}}
                    <div class="mt-8 border-t pt-8">
                        <div class="max-w-xs mx-auto text-center">
                            <div class="bg-slate-100 rounded-lg overflow-hidden border-2 border-dashed border-slate-200 p-2">
                                <img src="https://via.placeholder.com/400x250" class="w-full object-cover rounded shadow-sm" alt="KTP">
                            </div>
                            <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-widest">File KTP Pemohon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: TINDAK LANJUT --}}
        <div class="space-y-6">
            {{-- Box Tindak Lanjut --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-4 border-b border-slate-50 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-700">Tindak Lanjut</h3>
                </div>
                <div class="p-6 space-y-3">
                    <form action="/admin/permohonan/{{ $permohonan->id }}/update-status" method="POST" class="space-y-3">
                        @csrf
                        <div x-data="{ openPemberitahuan: false }">
                            <button @click="openPemberitahuan = true" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Pemberitahuan
                            </button>

                            {{-- MODAL DATA PEMBERITAHUAN TERTULIS --}}
                            @include('public.partials.modal_pemberitahuan')
                        </div>
                        <button name="status" value="ditolak" class="w-full py-3 bg-red-600 text-white rounded-lg text-xs font-bold hover:bg-red-700 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/></svg>
                            Tidak Lengkap
                        </button>
                        <button name="status" value="selesai" class="w-full py-3 bg-slate-100 text-slate-500 rounded-lg text-xs font-bold hover:bg-slate-200 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Selesaikan Permohonan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Box Riwayat --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-4 border-b border-slate-50 bg-slate-50/50">
                    <h3 class="text-sm font-bold text-slate-700">Riwayat Permohonan</h3>
                </div>
                <div class="p-6">
                    <div class="relative pl-8 border-l-2 border-emerald-500">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 bg-white border-2 border-emerald-500 rounded-full flex items-center justify-center">
                            <span class="text-[8px] font-bold text-emerald-500">1</span>
                        </div>
                        <p class="text-[11px] font-bold text-slate-800">{{ $permohonan->created_at->translatedFormat('l, d/M/Y - H:i') }} WIB</p>
                        <p class="text-[10px] text-slate-500 mt-1">{{ $permohonan->nama }}</p>
                        <p class="text-[10px] text-slate-400">Melakukan pengajuan permohonan informasi publik</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection