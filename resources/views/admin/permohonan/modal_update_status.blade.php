<div x-show="openUpdateStatus" class="fixed inset-0 z-[999] overflow-y-auto" x-cloak>
    <div class="flex items-center justify-center min-h-screen px-4 text-center">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openUpdateStatus = false"></div>

        <div class="inline-block bg-white rounded-[2.5rem] shadow-2xl transition-all transform sm:max-w-lg sm:w-full overflow-hidden">
            <form action="{{ route('admin.permohonan.update', $permohonan->id) }}" method="POST">
                @csrf
                <div class="p-10">
                    <h3 class="text-xl font-black text-slate-800 mb-2">Update Status Manual</h3>
                    <p class="text-xs text-slate-500 mb-8">Ubah status permohonan milik <strong>{{ $permohonan->nama }}</strong> secara langsung.</p>

                    <div class="text-left space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Status</label>
                        <select name="status" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500 outline-none">
                            <option value="pending" {{ $permohonan->status == 'pending' ? 'selected' : '' }}>PENDING (Menunggu)</option>
                            <option value="diproses" {{ $permohonan->status == 'diproses' ? 'selected' : '' }}>DIPROSES (Verifikasi)</option>
                            <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>SELESAI (Disetujui)</option>
                            <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>DITOLAK</option>
                        </select>
                    </div>

                    <div class="mt-10 flex gap-4">
                        {{-- Tombol Batal --}}
                        <button type="button" @click="openUpdateStatus = false" 
                            style="flex: 1; padding: 1rem; background-color: #f1f5f9; color: #64748b; border: none; border-radius: 1rem; font-weight: 900; font-size: 10px; text-transform: uppercase; cursor: pointer;">
                            Batal
                        </button>
                        
                        {{-- Tombol Simpan Perubahan (Warna Indigo/Ungu Tua) --}}
                        <button type="submit" 
                            style="flex: 1; padding: 1rem; background-color: #4f46e5 !important; color: #ffffff !important; border: none; border-radius: 1rem; font-weight: 900; font-size: 10px; text-transform: uppercase; cursor: pointer; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>