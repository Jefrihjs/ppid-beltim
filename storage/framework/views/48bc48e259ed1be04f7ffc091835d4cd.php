

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-[28px] font-black text-slate-900 tracking-tight">Pesan & Kontak</h2>
            <p class="text-slate-400 font-medium text-sm">Daftar aspirasi dan pertanyaan dari masyarakat melalui formulir kontak.</p>
        </div>
    </div>

    
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-black text-slate-800 uppercase tracking-widest text-xs">Kotak Masuk</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Tanggal</th>
                        <th class="px-8 py-4">Pengirim</th>
                        <th class="px-8 py-4">Subjek & Pesan</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50/80 transition group">
                        <td class="px-8 py-6 text-xs font-bold text-slate-400">
                            <?php echo e($m->created_at->format('d/m/Y')); ?>

                            <span class="block text-[10px] font-medium"><?php echo e($m->created_at->diffForHumans()); ?></span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-bold text-slate-800 text-sm block"><?php echo e($m->name); ?></span>
                            <span class="text-[10px] text-slate-400 font-black"><?php echo e($m->email); ?></span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="font-bold text-slate-700 text-xs block mb-1 uppercase tracking-tighter"><?php echo e($m->subject); ?></span>
                            <p class="text-xs text-slate-500 max-w-xs truncate italic">"<?php echo e($m->message); ?>"</p>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="<?php echo e(route('admin.pesan.show', $m->id)); ?>" class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[10px] font-black hover:bg-amber-500 hover:text-slate-900 transition shadow-sm">
                                BACA PESAN
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-slate-400 italic text-sm">
                            Kotak masuk masih kosong. Belum ada pesan dari masyarakat.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="p-8 bg-slate-50/50 border-t border-slate-50">
            <?php echo e($messages->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pesan/index.blade.php ENDPATH**/ ?>