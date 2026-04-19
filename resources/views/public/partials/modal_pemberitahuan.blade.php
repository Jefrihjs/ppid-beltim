@extends('layouts.public')

@section('content')

{{-- 1. NOTIFIKASI BERHASIL --}}
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform -translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     class="max-w-4xl mx-auto px-6 mt-4 no-print">
    <div class="bg-emerald-500 text-white p-4 rounded-2xl shadow-lg shadow-emerald-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-xl">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest opacity-80">Sistem Berhasil</p>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        </div>
        <button @click="show = false" class="text-white/50 hover:text-white font-black text-xl px-4">&times;</button>
    </div>
</div>
@endif

<section class="py-24 bg-slate-50 min-h-screen" x-data="{ openDetail: false, openPemberitahuan: false, openKeberatan: false }">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- 2. HEADER --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 no-print">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Status <span class="text-blue-600">Permohonan</span></h1>
                <p class="text-slate-500 font-medium mt-1">Lacak progres permintaan informasi Anda secara transparan.</p>
            </div>
            <div class="bg-blue-600 px-6 py-2 rounded-2xl shadow-lg shadow-blue-200">
                <span class="text-[10px] font-black text-blue-100 uppercase tracking-widest block">Kode Registrasi</span>
                <span class="text-white font-black text-xl tracking-wider">#{{ $permohonan->nomor_registrasi }}</span>
            </div>
        </div>

        {{-- 3. CARD UTAMA --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden mb-8 no-print">
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row gap-10 items-start">
                    <div class="relative flex-shrink-0">
                        <div class="w-24 h-24 bg-slate-100 rounded-3xl flex items-center justify-center border-2 border-slate-50 shadow-inner">
                            @if($permohonan->kategori_pemohon == 'perorangan')
                                <svg class="w-12 h-12 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            @else
                                <svg class="w-12 h-12 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm10 12h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V9h2v2zm0-4h-2V5h2v2zm4 12h-2v-2h2v2zm0-4h-2v-2h2v2z"/></svg>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 w-full">
                        <h2 class="text-2xl font-black text-slate-900">{{ $permohonan->nama }}</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 pt-6 border-t border-slate-50 mt-4">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kategori</p>
                                <p class="text-sm font-bold text-slate-700 uppercase">{{ $permohonan->kategori_pemohon }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status Sistem</p>
                                <span class="px-3 py-1 {{ $permohonan->status == 'DITOLAK' ? 'bg-red-100 text-red-700 border-red-200' : 'bg-amber-100 text-amber-700 border-amber-200' }} text-[10px] font-black uppercase rounded-lg border">
                                    {{ str_replace('_', ' ', $permohonan->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50/80 p-6 px-12 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4 no-print">
                <div class="flex gap-3">
                    <button @click="openDetail = true" class="bg-white border border-slate-200 text-slate-700 px-6 py-2 rounded-xl text-[10px] font-black uppercase hover:bg-slate-900 hover:text-white transition-all shadow-sm tracking-widest">Lihat Data</button>
                    
                    @if($permohonan->status != 'PEMBERITAHUAN_DIKIRIM')
                        <button @click="openPemberitahuan = true" class="bg-blue-600 text-white px-6 py-2 rounded-xl text-[10px] font-black uppercase hover:bg-blue-700 shadow-lg shadow-blue-100 tracking-widest">Proses Pemberitahuan</button>
                    @else
                        <button disabled class="bg-slate-200 text-slate-400 px-6 py-2 rounded-xl text-[10px] font-black uppercase border border-slate-300">Pemberitahuan Selesai</button>
                    @endif
                </div>
            </div>
        </div>

        {{-- 4. TIMELINE UTAMA --}}
        <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 no-print mb-8">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-10 flex items-center gap-3">Alur Proses Permohonan</h3>
            <div class="space-y-12 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px before:h-full before:w-0.5 before:bg-slate-100">
                
                @if($permohonan->status != 'pending')
                <div class="relative pl-12 group">
                    <div class="absolute left-0 w-10 h-10 {{ $permohonan->status == 'DITOLAK' ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600' }} rounded-2xl flex items-center justify-center border-4 border-white shadow-sm font-black text-xs">2</div>
                    <span class="text-[9px] font-black text-slate-400 uppercase block mb-1">{{ $permohonan->updated_at->format('d M Y - H:i') }} WIB</span>
                    <h4 class="font-black text-slate-800 text-sm uppercase">{{ str_replace('_', ' ', $permohonan->status) }}</h4>
                    <p class="text-xs text-slate-500 mt-1">Status diperbarui oleh Admin IKP.</p>
                </div>
                @endif

                <div class="relative pl-12 group">
                    <div class="absolute left-0 w-10 h-10 bg-blue-50 rounded-2xl flex items-center justify-center border-4 border-white shadow-sm font-black text-blue-600 text-xs">1</div>
                    <span class="text-[9px] font-black text-slate-400 uppercase block mb-1">{{ $permohonan->created_at->format('d M Y - H:i') }} WIB</span>
                    <h4 class="font-black text-slate-800 text-sm">Permohonan Registrasi</h4>
                    <p class="text-xs text-slate-500 mt-1">Data masuk ke sistem dengan nomor #{{ $permohonan->nomor_registrasi }}.</p>
                </div>
            </div>
        </div>

        {{-- 5. DETAIL KEBERATAN --}}
        @if(isset($keberatan) && $keberatan)
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden mb-8 no-print">
            <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row justify-between items-center bg-amber-50/40 gap-4">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-500">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-800 tracking-tight">{{ $keberatan->nomor_registrasi_keberatan }}</h3>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">No. Registrasi Keberatan</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[9px] font-black text-slate-400 uppercase">Status</p>
                    <span class="text-xs font-black text-red-600 uppercase">{{ $keberatan->status }}</span>
                </div>
            </div>
            <div class="p-10">
                <div class="relative pl-12 before:absolute before:inset-0 before:ml-5 before:h-full before:w-0.5 before:bg-emerald-500">
                    <div class="absolute left-0 w-10 h-10 bg-white rounded-full flex items-center justify-center border-2 border-emerald-500 z-10 font-black text-emerald-600 text-xs">1</div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                        <p class="text-xs font-bold text-slate-400 uppercase mb-2">Kronologi Ajuan:</p>
                        <p class="text-sm text-slate-600 italic">"{{ $keberatan->kronologi }}"</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- 6. MODAL PEMBERITAHUAN LENGKAP --}}
        <div x-show="openPemberitahuan" x-data="{ pemenuhan: 'Dapat Dipenuhi' }" class="fixed inset-0 z-[999999] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-sm" x-cloak x-transition>
            <div @click.stop class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden flex flex-col relative" style="max-height: 90vh;">
                <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-white">
                    <h3 class="text-sm font-black text-blue-600 uppercase tracking-widest ml-4">Formulir Pemberitahuan Tertulis</h3>
                    <button @click="openPemberitahuan = false" class="text-slate-400 hover:text-red-500 text-2xl px-4">&times;</button>
                </div>

                <div class="p-10 overflow-y-auto custom-scrollbar flex-1 bg-white">
                    <form action="{{ route('admin.permohonan.pemberitahuan', $permohonan->id) }}" method="POST" id="formPemberitahuanActual">
                        @csrf
                        <div class="space-y-8">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">A. Status Pemenuhan</label>
                                <select x-model="pemenuhan" name="pemenuhan" class="w-full border-2 border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold text-slate-700 focus:border-blue-500 outline-none">
                                    <option value="Dapat Dipenuhi">Dapat Dipenuhi</option>
                                    <option value="Ditolak">Ditolak / Tidak Dapat Dipenuhi</option>
                                </select>
                            </div>

                            {{-- BAGIAN DITERIMA --}}
                            <div x-show="pemenuhan == 'Dapat Dipenuhi'" x-transition class="space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="space-y-4">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">B. Penguasaan Informasi</label>
                                        <div class="space-y-3">
                                            <label class="flex items-center gap-3 p-4 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50"><input type="radio" name="kuasa" value="Kami" checked class="w-4 h-4 text-blue-600"><span class="text-sm font-bold">Kami (Diskominfo)</span></label>
                                            <label class="flex items-center gap-3 p-4 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50"><input type="radio" name="kuasa" value="Lainnya" class="w-4 h-4 text-blue-600"><span class="text-sm font-bold">Badan Publik Lain</span></label>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">C. Bentuk Fisik</label>
                                        <div class="space-y-3">
                                            <label class="flex items-center gap-3 p-4 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50"><input type="radio" name="fisik" value="Softcopy" checked class="w-4 h-4 text-blue-600"><span class="text-sm font-bold">Softcopy / Digital</span></label>
                                            <label class="flex items-center gap-3 p-4 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50"><input type="radio" name="fisik" value="Hardcopy" class="w-4 h-4 text-blue-600"><span class="text-sm font-bold">Hardcopy / Cetak</span></label>
                                        </div>
                                    </div>
                                </div>

                                {{-- TABEL BIAYA --}}
                                <div class="space-y-4" x-data="{ rows: [{item: '', satuan: '', harga: ''}] }">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">D. Rincian Biaya (Jika Ada)</label>
                                    <div class="overflow-hidden rounded-2xl border border-slate-100">
                                        <table class="w-full text-left text-sm">
                                            <thead class="bg-slate-50 text-[9px] font-black uppercase text-slate-400">
                                                <tr><th class="p-4">Item Informasi</th><th class="p-4">Satuan</th><th class="p-4">Harga (Rp)</th></tr>
                                            </thead>
                                            <tbody>
                                                <template x-for="(row, index) in rows" :key="index">
                                                    <tr class="border-t border-slate-50">
                                                        <td class="p-2"><input type="text" :name="'item['+index+']'" x-model="row.item" class="w-full px-4 py-2 bg-slate-50 rounded-xl outline-none focus:bg-white transition-all"></td>
                                                        <td class="p-2"><input type="text" :name="'satuan['+index+']'" x-model="row.satuan" class="w-full px-4 py-2 bg-slate-50 rounded-xl outline-none focus:bg-white transition-all"></td>
                                                        <td class="p-2"><input type="number" :name="'harga['+index+']'" x-model="row.harga" class="w-full px-4 py-2 bg-slate-50 rounded-xl outline-none focus:bg-white transition-all"></td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                        <div class="p-4 bg-slate-50/50 flex gap-2">
                                            <button type="button" @click="rows.push({item: '', satuan: '', harga: ''})" class="px-4 py-1 border border-blue-400 text-blue-500 text-[10px] font-bold uppercase rounded-md">tambah</button>
                                            <button type="button" @click="if(rows.length > 1) rows.pop()" class="px-4 py-1 border border-red-400 text-red-500 text-[10px] font-bold uppercase rounded-md">hapus</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="space-y-4">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">E. Waktu Penyediaan (Hari)</label>
                                        <input type="number" name="waktu" value="3" class="w-full border-2 border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold text-slate-700 outline-none focus:border-blue-500 transition-all">
                                    </div>
                                    <div class="space-y-4">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">F. Penjelasan Penghitaman</label>
                                        <textarea name="penjelasan" rows="2" class="w-full border-2 border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold text-slate-700 outline-none focus:border-blue-500 transition-all" placeholder="Ketik jika ada..."></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- BAGIAN DITOLAK --}}
                            <div x-show="pemenuhan == 'Ditolak'" x-transition class="space-y-6">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block text-red-500">Alasan Penolakan:</label>
                                <div class="space-y-3">
                                    <label class="flex items-center gap-3 p-4 border border-red-100 rounded-2xl cursor-pointer hover:bg-red-50 transition-all"><input type="radio" name="alasan_tolak" value="belum_dikuasai" class="w-4 h-4 text-red-600"><span class="text-sm font-bold text-slate-700">Informasi belum dikuasai/didokumentasikan</span></label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-8 border-t border-slate-100 flex justify-end gap-3 bg-slate-50/30">
                    <button @click="openPemberitahuan = false" class="px-8 py-3 text-[10px] font-black uppercase text-slate-400 tracking-widest">Batal</button>
                    <button type="submit" form="formPemberitahuanActual" class="px-12 py-3 bg-blue-600 text-white text-[10px] font-black uppercase rounded-2xl shadow-lg shadow-blue-100 tracking-widest hover:bg-blue-700 transition-all">Simpan & Kirim</button>
                </div>
            </div>
        </div>

        {{-- 7. MODAL DETAIL DATA --}}
        <div x-show="openDetail" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
            <div @click.away="openDetail = false" class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden max-h-[95vh] flex flex-col border border-white/20">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-[11px] font-black text-slate-800 uppercase tracking-[0.2em] ml-4">Data Lengkap Permohonan</h3>
                    <button @click="openDetail = false" class="text-slate-400 hover:text-red-500 transition-all font-black text-xl px-4">&times;</button>
                </div>
                <div class="p-8 overflow-y-auto custom-scrollbar">
                   <div class="rounded-3xl border border-slate-100 overflow-hidden shadow-sm bg-white">
                       @php
                           $detil = [
                               'Nama' => $permohonan->nama,
                               'NIK' => $permohonan->nik,
                               'Alamat' => $permohonan->alamat,
                               'Rincian Informasi' => $permohonan->rincian_informasi,
                               'Tujuan Penggunaan' => $permohonan->tujuan_penggunaan
                           ];
                       @endphp
                       @foreach($detil as $label => $val)
                       <div class="grid grid-cols-3 border-b border-slate-50 last:border-0">
                           <div class="p-4 text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-50/30">{{ $label }}</div>
                           <div class="p-4 text-xs font-bold text-slate-700 col-span-2">{{ $val ?? '-' }}</div>
                       </div>
                       @endforeach
                   </div>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
</style>
@endsection