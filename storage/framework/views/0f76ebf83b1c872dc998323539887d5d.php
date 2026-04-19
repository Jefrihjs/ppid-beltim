
<div x-show="openPemberitahuan" 
     x-data="{ pemenuhan: '', rows: [{item: '', satuan: '', harga: ''}] }" 
     class="fixed inset-0 z-[999999] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-sm" 
     x-cloak 
     x-transition>
    
    <div @click.stop class="bg-white w-full max-w-4xl rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col relative border border-white/20" style="max-height: 90vh;">
        
        
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest ml-4">Formulir Pemberitahuan Tertulis</h3>
            <button @click="openPemberitahuan = false" class="text-slate-400 hover:text-red-500 transition-colors text-2xl px-4">&times;</button>
        </div>

        
        <div class="p-10 overflow-y-auto custom-scrollbar flex-1 bg-white">
            <form action="<?php echo e(route('admin.permohonan.pemberitahuan', $permohonan->id)); ?>" method="POST" id="formPemberitahuanActual">
                <?php echo csrf_field(); ?>
                <div class="space-y-8">
                    
                    
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Pemenuhan Informasi</label>
                        <select x-model="pemenuhan" name="pemenuhan" 
                                class="w-full border-2 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-100 transition-all outline-none appearance-none bg-slate-50">
                            
                            <option value="">-- Pilih Status Pemenuhan --</option>
                            <option value="Dapat Dipenuhi">Dapat Dipenuhi</option>
                            <option value="Ditolak">Tidak Dapat Dipenuhi</option>
                        </select>
                    </div>

                    

                    <div x-show="pemenuhan == 'Dapat Dipenuhi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" class="space-y-8 border-t pt-8">
                        
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penguasaan Informasi</label>
                                <div x-data="{ penguasaan: 'diskominfo', selectedOpd: '' }">
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <label class="flex items-center gap-3 p-4 border rounded-2xl cursor-pointer" :class="penguasaan == 'diskominfo' ? 'border-blue-600 bg-blue-50' : 'border-slate-100'">
                                            <input type="radio" name="penguasaan_informasi" value="diskominfo" x-model="penguasaan" class="hidden">
                                            <span class="text-sm font-bold">Kami (Diskominfo)</span>
                                        </label>

                                        <label class="flex items-center gap-3 p-4 border rounded-2xl cursor-pointer" :class="penguasaan == 'opd_lain' ? 'border-blue-600 bg-blue-50' : 'border-slate-100'">
                                            <input type="radio" name="penguasaan_informasi" value="opd_lain" x-model="penguasaan" class="hidden">
                                            <span class="text-sm font-bold">Badan Publik Lain</span>
                                        </label>
                                    </div>

                                    <div x-show="penguasaan == 'opd_lain'" x-transition class="space-y-4">
                                        <div>
                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Pilih OPD / Badan Publik</label>
                                            <select name="opd_tujuan" x-model="selectedOpd" class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm outline-none focus:border-blue-500">
                                                <option value="">-- Pilih Instansi --</option>
                                                <?php $__currentLoopData = $opds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($opd->nama_opd); ?>"><?php echo e($opd->nama_opd); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <option value="LAINNYA">INSTANSI LAINNYA (KETIK MANUAL)</option>
                                            </select>
                                        </div>

                                        <div x-show="selectedOpd == 'LAINNYA'" x-transition>
                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Nama Instansi Manual</label>
                                            <input type="text" name="nama_opd_manual" class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm" placeholder="Ketik nama badan publik di sini...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bentuk Fisik</label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-3 p-4 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all">
                                        <input type="radio" name="fisik" value="Softcopy" checked class="w-4 h-4 text-blue-600">
                                        <span class="text-sm font-bold text-slate-700">Softcopy</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-4 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all">
                                        <input type="radio" name="fisik" value="Hardcopy" class="w-4 h-4 text-blue-600">
                                        <span class="text-sm font-bold text-slate-700">Hardcopy</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Rincian Biaya</label>
                            <div class="overflow-hidden rounded-3xl border border-slate-100 shadow-sm">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-slate-50 text-[9px] font-black uppercase text-slate-400">
                                        <tr><th class="p-4">Item</th><th class="p-4">Satuan</th><th class="p-4">Harga</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-for="(row, index) in rows" :key="index">
                                            <tr>
                                                <td class="p-2"><input type="text" :name="'item['+index+']'" x-model="row.item" class="w-full px-4 py-3 bg-slate-50 rounded-xl outline-none text-sm font-bold border-2 border-transparent focus:border-blue-100 transition-all"></td>
                                                <td class="p-2"><input type="text" :name="'satuan['+index+']'" x-model="row.satuan" class="w-full px-4 py-3 bg-slate-50 rounded-xl outline-none text-sm font-bold border-2 border-transparent focus:border-blue-100 transition-all"></td>
                                                <td class="p-2"><input type="number" :name="'harga['+index+']'" x-model="row.harga" class="w-full px-4 py-3 bg-slate-50 rounded-xl outline-none text-sm font-bold border-2 border-transparent focus:border-blue-100 transition-all"></td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="p-4 bg-slate-50/50 flex gap-3 border-t border-slate-100">
                                    <button type="button" @click="rows.push({item: '', satuan: '', harga: ''})" class="px-5 py-2 bg-white border border-blue-200 text-blue-600 text-[10px] font-black uppercase rounded-xl">Tambah Biaya</button>
                                    <button type="button" @click="if(rows.length > 1) rows.pop()" class="px-5 py-2 bg-white border border-red-200 text-red-500 text-[10px] font-black uppercase rounded-xl">Hapus</button>
                                </div>
                            </div>
                        </div>

                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Penyediaan (Hari)</label>
                                <div class="relative">
                                    <input type="number" name="waktu_penyediaan" value="3" 
                                        class="w-full border-2 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 outline-none focus:border-blue-500 transition-all bg-slate-50">
                                    <span class="absolute right-5 top-4 text-xs font-bold text-slate-400 uppercase">Hari</span>
                                </div>
                                <p class="text-[9px] text-slate-400 font-medium italic">* Standar pelayanan adalah 10+7 hari kerja.</p>
                            </div>
                            
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjelasan Penghitaman / Pengaburan</label>
                                <textarea name="penjelasan_penghitaman" rows="3" 
                                        class="w-full border-2 border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold text-slate-700 outline-none focus:border-blue-500 transition-all bg-slate-50"
                                        placeholder="Contoh: Nama NIK dan tanda tangan pada dokumen disamarkan karena termasuk informasi dikecualikan..."></textarea>
                            </div>
                        </div>

                    </div>

                    
                    <div x-show="pemenuhan == 'Ditolak'" x-transition class="space-y-6 border-t pt-8">
                        <label class="text-[10px] font-black text-red-500 uppercase tracking-widest block">Alasan Penolakan</label>
                        <div class="space-y-3">
                            <label class="flex items-center gap-4 p-5 border-2 border-red-50 rounded-3xl cursor-pointer hover:bg-red-50">
                                <input type="radio" name="alasan_tolak" value="Informasi belum dikuasai" class="w-5 h-5 text-red-600">
                                <span class="text-sm font-black text-slate-800">Informasi belum dikuasai</span>
                            </label>
                            <label class="flex items-center gap-4 p-5 border-2 border-red-50 rounded-3xl cursor-pointer hover:bg-red-50">
                                <input type="radio" name="alasan_tolak" value="Informasi belum didokumentasikan" class="w-5 h-5 text-red-600">
                                <span class="text-sm font-black text-slate-800">Informasi belum didokumentasikan</span>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        
        <div class="p-8 border-t border-slate-100 flex justify-end gap-3 bg-slate-50/30">
            <button @click="openPemberitahuan = false" class="px-8 py-4 text-[10px] font-black uppercase text-slate-400">Batal</button>
            <button type="submit" form="formPemberitahuanActual" class="px-12 py-4 bg-blue-600 text-white text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-blue-100 hover:bg-blue-700 transition-all">
                Simpan & Kirim
            </button>
        </div>
    </div>
</div><?php /**PATH /var/www/html/resources/views/admin/permohonan/modal_pemberitahuan.blade.php ENDPATH**/ ?>