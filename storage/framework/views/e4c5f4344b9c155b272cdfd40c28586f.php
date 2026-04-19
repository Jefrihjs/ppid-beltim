

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto space-y-8 pb-20">
    
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="<?php echo e(route('admin.pesan.index')); ?>" class="p-2 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Baca Pesan</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Kontak Masyarakat</p>
            </div>
        </div>
        <span class="px-4 py-1.5 bg-blue-100 text-blue-700 rounded-full text-[10px] font-black uppercase">
            <?php echo e($contactMessage->status); ?>

        </span>
    </div>

    
    <div class="bg-white rounded-[3rem] border border-slate-200 shadow-sm overflow-hidden">
        
        <div class="p-8 border-b border-slate-50 bg-slate-50/30 grid grid-cols-2 gap-8">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Dari</p>
                <p class="font-bold text-slate-800 text-sm"><?php echo e($contactMessage->name); ?></p>
                <p class="text-xs text-blue-600 font-medium"><?php echo e($contactMessage->email); ?></p>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Diterima Pada</p>
                <p class="font-bold text-slate-800 text-sm"><?php echo e($contactMessage->created_at->format('d F Y')); ?></p>
                <p class="text-[10px] text-slate-400 font-medium"><?php echo e($contactMessage->created_at->format('H:i')); ?> WIB</p>
            </div>
        </div>

        
        <div class="p-10">
            <h3 class="text-lg font-black text-slate-800 mb-6 uppercase tracking-tighter">Subjek: <?php echo e($contactMessage->subject); ?></h3>
            <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed italic">
                <?php echo nl2br(e($contactMessage->message)); ?>

            </div>
        </div>

        
        <div class="p-8 border-t border-slate-50 bg-slate-50/50 flex justify-end gap-4">
            <a href="mailto:<?php echo e($contactMessage->email); ?>" class="inline-flex items-center gap-2 bg-slate-900 text-white px-6 py-3 rounded-2xl text-xs font-black hover:bg-amber-500 hover:text-slate-900 transition shadow-lg shadow-slate-200">
                BALAS VIA EMAIL
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pesan/show.blade.php ENDPATH**/ ?>