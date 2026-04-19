<div x-show="openUploadSelesai" 
     class="fixed inset-0 z-[999999] flex items-center justify-center p-6 bg-slate-900/90 backdrop-blur-sm" 
     x-cloak x-transition>
    
    <div @click.stop class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden flex flex-col border border-white/20" style="max-height: 90vh;">
        
        {{-- Header --}}
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-white">
            <h3 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em] ml-4">Upload Bukti Penyelesaian</h3>
            <button @click="openUploadSelesai = false" class="text-slate-400 hover:text-red-500 transition-colors text-3xl px-4">&times;</button>
        </div>

        {{-- Body --}}
        <div class="p-12 overflow-y-auto bg-white flex-1 custom-scrollbar">
            <form action="{{ route('admin.permohonan.upload_selesai', $permohonan->id) }}" 
                  method="POST" enctype="multipart/form-data" id="formUploadSelesai">
                @csrf
                <div class="space-y-10">
                    
                    {{-- AREA UPLOAD (Dibuat Lega & Klik-able) --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Berkas Bukti (PDF/JPG)</label>
                        
                        <div class="relative h-48 w-full border-2 border-dashed border-slate-200 rounded-[2.5rem] bg-slate-50 hover:bg-slate-100 hover:border-blue-400 transition-all group">
                            {{-- INPUT ASLI (Ditaruh paling atas/z-20 tapi transparan) --}}
                            <input type="file" name="file_penyelesaian" required
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                            
                            {{-- TAMPILAN VISUAL (Di bawah input) --}}
                            <div class="absolute inset-0 flex flex-col items-center justify-center z-10 pointer-events-none">
                                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <p class="text-[11px] font-black text-slate-800 uppercase tracking-widest">Klik atau Tarik Berkas</p>
                                <p class="text-[9px] text-slate-400 font-bold mt-1 uppercase">Maksimal 5MB (PDF/JPG)</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Keterangan --}}
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Keterangan Tambahan (Opsional)</label>
                        <textarea name="keterangan" rows="3" 
                                  class="w-full border-2 border-slate-100 rounded-2xl px-8 py-6 text-sm font-bold text-slate-700 outline-none focus:border-blue-500 bg-slate-50 shadow-inner" 
                                  placeholder="Contoh: Berkas telah diserahkan langsung..."></textarea>
                    </div>
                </div>
            </form>
        </div>

        {{-- Footer (Tombol SIMPAN BUKTI yang diperbaiki) --}}
        <div class="p-10 border-t border-slate-100 flex justify-end items-center gap-6 bg-slate-50/30">
            <button @click="openUploadSelesai = false" class="px-8 py-4 text-[11px] font-black uppercase text-slate-400 tracking-[0.2em] hover:text-slate-600 transition-colors">
                Batal
            </button>
            <button type="submit" form="formUploadSelesai" 
                    class="px-12 py-4 bg-slate-900 text-white text-[11px] font-black uppercase rounded-2xl shadow-xl hover:bg-blue-600 transition-all hover:-translate-y-1">
                Simpan Bukti
            </button>
        </div>
    </div>
</div>