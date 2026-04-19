<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Manajemen Slider Hero</h2>
            <p class="text-slate-500 font-medium mt-1">Kelola gambar dan informasi yang muncul pada banner utama halaman depan.</p>
        </div>
        
        <a href="<?php echo e(route('admin.hero.create')); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-slate-900 text-white rounded-2xl font-black hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 active:scale-95 text-sm uppercase tracking-widest">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Slide
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 font-bold flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="py-5 px-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Gambar</th>
                        <th class="py-5 px-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Informasi Slide</th>
                        <th class="py-5 px-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Urutan</th>
                        <th class="py-5 px-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php $__empty_1 = true; $__currentLoopData = $heroes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="group hover:bg-slate-50/50 transition-all">
                        <td class="py-6 px-6">
                            <div class="relative w-48 h-28 overflow-hidden rounded-2xl shadow-sm border-2 border-white group-hover:shadow-md transition-all">
                                <img src="<?php echo e(asset('storage/images/' . $hero->image)); ?>" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-6 px-6">
                            <div class="font-black text-slate-800 text-lg leading-tight mb-1"><?php echo $hero->title; ?></div>
                            <div class="text-sm text-slate-500 font-medium italic line-clamp-2 max-w-md"><?php echo e($hero->subtitle); ?></div>
                        </td>
                        <td class="py-6 px-6 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-600 rounded-lg font-black text-xs">
                                <?php echo e($hero->order ?? '-'); ?>

                            </span>
                        </td>
                        <td class="py-6 px-6">
                            <div class="flex justify-center gap-3">
                                
                                <a href="<?php echo e(route('admin.hero.edit', $hero->id)); ?>" class="p-3 bg-slate-100 text-slate-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm group/btn">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                
                                <form action="<?php echo e(route('admin.hero.destroy', $hero->id)); ?>" method="POST" onsubmit="return confirm('Apakah Bapak yakin ingin menghapus slide ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-3 bg-slate-100 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="p-4 bg-slate-50 rounded-full mb-4">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" />
                                    </svg>
                                </div>
                                <p class="text-slate-400 font-bold tracking-tight">Belum ada slide hero yang aktif.</p>
                                <p class="text-slate-400 text-xs mt-1">Klik tombol "+ Tambah Slide" di pojok kanan atas.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/hero/index.blade.php ENDPATH**/ ?>