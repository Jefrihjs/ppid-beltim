<?php $__env->startSection('content'); ?>
<section class="py-24 bg-white min-h-screen">
    <div class="max-w-6xl mx-auto px-6">
        
        
        <div class="text-center mb-12">
            <h2 class="text-4xl font-black text-slate-900 uppercase tracking-tighter">
                PENGUMUMAN & <span class="text-blue-600">Prosedur</span>
            </h2>
            <div class="w-20 h-1.5 bg-amber-500 mx-auto mt-4 rounded-full"></div>
        </div>

        
        <div x-data="{ tab: 'pengumuman' }" class="relative">
            
            
            <div class="flex flex-wrap justify-center gap-3 mb-10">
                <button @click="tab = 'pengumuman'" :class="tab === 'pengumuman' ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200'" class="px-6 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">Pengumuman</button>
                <button @click="tab = 'wewenang'" :class="tab === 'wewenang' ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200'" class="px-6 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">Pengaduan Wewenang</button>
                <button @click="tab = 'keberatan'" :class="tab === 'keberatan' ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200'" class="px-6 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">Keberatan & Sengketa</button>
            </div>

            
            <div class="bg-slate-50 rounded-[3rem] p-8 md:p-12 border border-slate-100 shadow-sm min-h-[600px]">
                
                
                <div x-show="tab === 'pengumuman'" x-transition>
                    <div class="space-y-6">
                        <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm transition-all hover:shadow-md">
                                <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full"><?php echo e($info->created_at->format('d M Y')); ?></span>
                                <h4 class="text-xl font-black text-slate-800 mt-4 uppercase"><?php echo e($info->title); ?></h4>
                                <?php if($info->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $info->image)); ?>" class="mt-6 rounded-3xl w-full h-auto border border-slate-50">
                                <?php endif; ?>
                                <p class="text-sm text-slate-500 mt-4 leading-loose italic"><?php echo nl2br(e($info->content)); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-center py-20 text-slate-400 font-bold uppercase text-xs">Belum ada pengumuman.</p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div x-show="tab === 'wewenang'" x-transition style="display: none;">
                    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100">
                        <h3 class="text-2xl font-black text-slate-900 uppercase mb-8 border-l-8 border-blue-600 pl-6">Penyalahgunaan Wewenang / Pelanggaran ASN</h3>
                        
                        <div class="prose prose-slate max-w-none text-slate-600 text-sm leading-relaxed font-medium italic">
                            <h4 class="text-blue-600 font-black uppercase text-xs tracking-widest mb-4">Prosedur Pengaduan:</h4>
                            <ul class="list-disc pl-5 mb-8 space-y-2">
                                <li>Datang langsung ke Inspektorat atau instansi tempat bekerja terlapor.</li>
                                <li>Secara tertulis melalui situs resmi: <a href="https://inspektorat.beltim.go.id" class="text-blue-600 underline">inspektorat.beltim.go.id</a></li>
                                <li>Saluran lainnya: SP4N LAPOR!, Form WBS Inspektorat, Media Sosial (FB/IG), dan Email PPID (ppidbelitungtimur@gmail.com).</li>
                            </ul>

                            <h4 class="text-blue-600 font-black uppercase text-xs tracking-widest mb-4">Unsur Pengaduan:</h4>
                            <p class="mb-4">Laporan harus memuat identitas terlapor (jabatan/satker), perbuatan yang dilaporkan, serta bukti pendukung awal.</p>
                            
                            <div class="grid md:grid-cols-2 gap-4 mt-6">
                                <div class="p-5 bg-red-50 rounded-2xl border border-red-100">
                                    <h5 class="font-black text-red-800 text-[10px] uppercase mb-2">Kerahasiaan Identitas</h5>
                                    <p class="text-[11px] leading-relaxed">Pelapor berhak mendapatkan perlindungan kerahasiaan identitas, memberikan keterangan tanpa paksaan, dan perlakuan adil dalam pemeriksaan.</p>
                                </div>
                                <div class="p-5 bg-amber-50 rounded-2xl border border-amber-100">
                                    <h5 class="font-black text-amber-800 text-[10px] uppercase mb-2">Penanganan Laporan</h5>
                                    <p class="text-[11px] leading-relaxed">Setiap laporan akan diverifikasi dan ditelaah. Jika terbukti, terlapor akan dijatuhi sanksi disiplin sesuai ketentuan berlaku.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div x-show="tab === 'keberatan'" x-transition style="display: none;">
                    <div class="grid md:grid-cols-2 gap-8">
                        
                        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                            <h4 class="font-black text-slate-900 uppercase text-lg mb-6 tracking-tighter">Pelaksanaan Keputusan Komisi Informasi</h4>
                            <ul class="space-y-4 text-xs font-medium text-slate-500 italic leading-loose">
                                <li class="flex gap-3"><span class="w-6 h-6 bg-blue-600 text-white rounded-lg flex items-center justify-center shrink-0">1</span> Pengajuan sengketa max 14 hari kerja setelah penolakan keberatan.</li>
                                <li class="flex gap-3"><span class="w-6 h-6 bg-blue-600 text-white rounded-lg flex items-center justify-center shrink-0">2</span> KI memiliki 100 hari kerja untuk mediasi/ajudikasi.</li>
                                <li class="flex gap-3"><span class="w-6 h-6 bg-blue-600 text-white rounded-lg flex items-center justify-center shrink-0">3</span> Jika tidak puas dengan Ajudikasi, dapat mengajukan gugatan ke pengadilan max 14 hari kerja.</li>
                            </ul>
                        </div>

                        
                        <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white">
                            <h4 class="font-black uppercase text-lg mb-6 tracking-tighter">Alasan Mengajukan Keberatan</h4>
                            <ul class="space-y-3 text-[11px] font-medium text-slate-300 italic">
                                <li>• Penolakan atas alasan pengecualian informasi.</li>
                                <li>• Tidak disediakannya informasi berkala.</li>
                                <li>• Tidak ditanggapinya permintaan informasi.</li>
                                <li>• Permintaan ditanggapi tidak sebagaimana mestinya.</li>
                                <li>• Pengenaan biaya yang tidak wajar.</li>
                                <li>• Penyampaian informasi melebihi batas waktu (UU 14/2008).</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="mt-12 text-center">
            <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.4em]">Sistem Informasi Layanan PPID Kabupaten Belitung Timur</p>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/public/prosedur.blade.php ENDPATH**/ ?>