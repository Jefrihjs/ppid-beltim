<div x-show="openTidakLengkap" 
     class="fixed inset-0 z-[999999] flex items-center justify-center p-6 bg-slate-900/90 backdrop-blur-sm" 
     x-cloak x-transition>
    
    <div @click.stop class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden flex flex-col relative border border-white/20">
        
        
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <h3 class="text-sm font-black text-red-600 uppercase tracking-[0.2em] ml-4">Tindak Lanjut Permohonan Informasi</h3>
            <button @click="openTidakLengkap = false" class="text-slate-400 hover:text-red-500 transition-colors text-3xl px-4">&times;</button>
        </div>

        
        <div class="p-12 overflow-y-auto bg-white">
            <form action="<?php echo e(route('admin.permohonan.tidak_lengkap', $permohonan->id)); ?>" method="POST" id="formTidakLengkap">
                <?php echo csrf_field(); ?>
                <div class="space-y-6">
                    <p class="text-sm font-bold text-slate-600 leading-relaxed">
                        Permohonan tidak dapat diproses karena informasi tidak lengkap dengan rincian berikut:
                    </p>
                    
                    <textarea name="rincian_ketidaklengkapan" rows="6" 
                              class="w-full border-2 border-slate-100 rounded-[2rem] px-8 py-6 text-sm font-bold text-slate-700 outline-none focus:border-red-500 bg-slate-50 transition-all shadow-inner"
                              placeholder="Contoh: Lampiran KTP kurang jelas, rincian informasi yang diminta terlalu luas, atau tujuan penggunaan belum spesifik..."></textarea>
                </div>
            </form>
        </div>

        
        <div class="p-10 border-t border-slate-100 flex justify-end gap-4 bg-slate-50/30">
            <button @click="openTidakLengkap = false" class="px-8 py-4 text-[11px] font-black uppercase text-slate-400 tracking-[0.2em]">Batal</button>
            <button type="submit" form="formTidakLengkap" 
                    class="min-w-[160px] px-10 py-4 bg-red-600 text-white text-[11px] font-black uppercase rounded-2xl shadow-2xl shadow-red-200 hover:bg-red-700 transition-all flex items-center justify-center">
                Kirim Sekarang
            </button>
        </div>
    </div>
</div><?php /**PATH /var/www/html/resources/views/admin/permohonan/modal_tidak_lengkap.blade.php ENDPATH**/ ?>