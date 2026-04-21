

<?php $__env->startSection('content'); ?>

<div class="p-6" x-data="{ openPemberitahuan: false, openTidakLengkap: false, openUploadSelesai: false }">
    
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Detil Permohonan Informasi</h1>
            <p class="text-slate-500 text-sm font-medium">Kelola dan tindak lanjuti permintaan informasi publik secara transparan.</p>
        </div>
        <a href="<?php echo e(route('admin.permohonan.index')); ?>" class="bg-white border border-slate-200 text-slate-600 px-5 py-2.5 rounded-2xl font-bold hover:bg-slate-50 transition-all text-sm shadow-sm">
            &larr; Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="bg-slate-900 px-10 py-5 flex justify-between items-center">
                    <span class="text-slate-400 font-black tracking-[0.2em] text-[10px] uppercase">Data Identitas Pemohon</span>
                    <span class="px-4 py-1.5 <?php echo e($permohonan->status == 'pending' ? 'bg-amber-500' : 'bg-emerald-500'); ?> text-white text-[10px] font-black rounded-full uppercase tracking-widest shadow-lg shadow-black/20">
                        <?php echo e(str_replace('_', ' ', strtoupper($permohonan->status))); ?>

                    </span>
                </div>
                
                <div class="p-12 space-y-10">
                    
                    <?php
                        $infoFields = [
                            'Kode Permohonan' => ['val' => $permohonan->kode_tracking, 'class' => 'font-mono font-black text-blue-600 tracking-wider text-lg'],
                            'Nomor Pendaftaran' => ['val' => $permohonan->nomor_registrasi, 'class' => 'font-black text-slate-800'],
                            'Nama Lengkap Pemohon' => ['val' => $permohonan->nama . ' (' . strtoupper($permohonan->kategori_pemohon) . ')', 'class' => 'font-black text-slate-900 text-xl tracking-tight'],
                            'NIK / No. Identitas' => ['val' => $permohonan->nik, 'class' => 'font-bold text-slate-700'],
                            'Alamat Domisili' => ['val' => $permohonan->alamat, 'class' => 'font-semibold text-slate-600 italic leading-relaxed bg-slate-50 p-5 rounded-2xl border border-slate-100'],
                            'Kontak' => ['val' => $permohonan->email . ' / ' . $permohonan->no_hp, 'class' => 'font-bold text-slate-700'],
                        ];
                    ?>

                    <?php $__currentLoopData = $infoFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-full pb-8 border-b border-slate-50 last:border-0 last:pb-0">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.25em] mb-3"><?php echo e($label); ?></label>
                            <div class="<?php echo e($data['class']); ?>"><?php echo e($data['val']); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mt-6">
                <h3 class="text-sm font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    Rincian Permohonan Informasi
                </h3>

                <div class="space-y-6">
                    
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Rincian Informasi yang Dibutuhkan</label>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-sm text-slate-700 leading-relaxed">
                            <?php echo e($permohonan->rincian_informasi ?? '-'); ?>

                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tujuan Penggunaan Informasi</label>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-sm text-slate-700 leading-relaxed">
                            <?php echo e($permohonan->tujuan_penggunaan ?? '-'); ?>

                        </div>
                    </div>

                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Cara Memperoleh</label>
                            <p class="text-sm font-bold text-slate-700 capitalize"><?php echo e($permohonan->cara_memperoleh ?? '-'); ?></p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jenis Salinan</label>
                            <p class="text-sm font-bold text-slate-700 capitalize"><?php echo e($permohonan->jenis_salinan ?? '-'); ?></p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Cara Pengiriman</label>
                            <p class="text-sm font-bold text-slate-700 capitalize"><?php echo e($permohonan->cara_pengiriman ?? '-'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="space-y-8">
            
            
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Berkas Identitas</h3>
                <?php if($permohonan->file_ktp): ?>
                    <a href="<?php echo e(asset('storage/' . $permohonan->file_ktp)); ?>" target="_blank" class="flex items-center gap-4 p-5 bg-slate-50 rounded-2xl hover:bg-blue-600 hover:text-white transition-all group border border-slate-100 shadow-sm">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-blue-600 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black uppercase tracking-tight">KTP Pemohon</p>
                            <p class="text-[9px] font-bold uppercase opacity-60">Lihat Lampiran &rarr;</p>
                        </div>
                    </a>
                <?php else: ?>
                    <div class="p-6 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 text-center">
                        <p class="text-[10px] text-slate-400 font-black uppercase italic tracking-widest">KTP Belum Diunggah</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php
                // Definisikan status yang dianggap "Sudah Ditindaklanjuti"
                $sudahDitindak = in_array(strtoupper($permohonan->status), ['DIPROSES', 'DITOLAK', 'TIDAK_LENGKAP', 'SELESAI']);
            ?>

            
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Panel Tindak Lanjut</h3>
                
                <div class="space-y-4">
                    
                    <?php if(strtoupper($permohonan->status) == 'PENDING'): ?>
                        <button @click="openPemberitahuan = true" 
                            class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                            Buat Pemberitahuan
                        </button>
                        
                        <button @click="openTidakLengkap = true" 
                            class="w-full py-4 bg-white border-2 border-slate-200 text-slate-600 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-slate-50 transition-all mt-4">
                            Informasi Tidak Lengkap
                        </button>
                    <?php else: ?>
                        
                        <div class="space-y-3">
                            <button disabled class="w-full py-4 bg-slate-100 text-slate-400 border border-slate-200 rounded-2xl font-black text-[11px] uppercase tracking-widest cursor-not-allowed flex items-center justify-center gap-2 opacity-60">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"/></svg>
                                Pemberitahuan Terkirim
                            </button>
                            
                            <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                                <p class="text-[10px] font-bold text-emerald-700 text-center uppercase tracking-tight">
                                    Aksi Terkunci: Permohonan telah diproses
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    
                    <div class="relative py-4 flex items-center">
                        <div class="flex-grow border-t border-slate-100"></div>
                        <span class="flex-shrink mx-4 text-[9px] font-black text-slate-300 uppercase italic tracking-widest">Next Step</span>
                        <div class="flex-grow border-t border-slate-100"></div>
                    </div>

                    
                    <?php if(strtoupper($permohonan->status) == 'DIPROSES' && !$permohonan->file_penyelesaian): ?>
                        <button @click="openUploadSelesai = true" 
                            class="w-full py-4 bg-slate-800 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-black transition-all">
                            + Upload Bukti Selesai
                        </button>
                    <?php else: ?>
                        <button disabled class="w-full py-4 bg-slate-50 text-slate-300 border border-slate-100 rounded-2xl font-black text-[11px] uppercase tracking-widest cursor-not-allowed">
                            Upload Terkunci
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bg-slate-50/50 p-8 rounded-[2.5rem] border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Status Dokumen Keluar</h3>
                <div class="space-y-4">
                    <?php
                        $docs = [
                            ['title' => 'Pemberitahuan Tertulis', 'status' => $permohonan->status, 'route' => ($permohonan->status == 'DITOLAK' || $permohonan->status == 'TIDAK_LENGKAP') ? route('admin.permohonan.cetak_penolakan', $permohonan->id) : route('admin.permohonan.cetak_pemberitahuan', $permohonan->id)],
                            ['title' => 'Bukti Penyelesaian', 'file' => $permohonan->file_penyelesaian, 'route' => $permohonan->file_penyelesaian ? asset('storage/' . $permohonan->file_penyelesaian) : null],
                        ];
                    ?>

                    <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="p-2.5 <?php echo e($permohonan->status != 'pending' ? 'bg-blue-50 text-blue-600' : 'bg-slate-50 text-slate-300'); ?> rounded-xl">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-800 uppercase tracking-tight"><?php echo e($doc['title']); ?></p>
                                    <p class="text-[9px] font-bold <?php echo e($permohonan->status != 'pending' ? 'text-emerald-500' : 'text-slate-400'); ?>">
                                        <?php echo e($permohonan->status != 'pending' ? 'Tersedia' : 'Pending'); ?>

                                    </p>
                                </div>
                            </div>
                            <?php if($permohonan->status != 'pending' && isset($doc['route'])): ?>
                                <a href="<?php echo e($doc['route']); ?>" target="_blank" class="px-4 py-2 bg-slate-800 text-white text-[9px] font-black uppercase rounded-xl hover:bg-blue-600 transition-all shadow-sm">Lihat</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    
    <?php echo $__env->make('admin.permohonan.modal_pemberitahuan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('admin.permohonan.modal_tidak_lengkap', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('admin.permohonan.modal_upload_selesai', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/permohonan/show.blade.php ENDPATH**/ ?>