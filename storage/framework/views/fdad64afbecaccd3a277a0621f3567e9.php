<?php $__env->startSection('content'); ?>
<div class="p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-slate-900">Manajemen Informasi Publik</h1>
            <p class="text-slate-500 text-sm">Kelola daftar 162+ data informasi publik PPID.</p>
        </div>
        <a href="<?php echo e(route('admin.informasi.create')); ?>" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-sm shadow-xl hover:bg-amber-500 transition-all">
            + Tambah Dokumen
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
            <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Total Data</div>
            <div class="text-2xl font-black text-slate-900"><?php echo e($informations->total()); ?> Dokumen</div>
        </div>
    </div>
        
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm mb-6">
            <form action="<?php echo e(route('admin.informasi.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4">
                
                <div class="flex-1 relative">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                        placeholder="Cari judul atau OPD..." 
                        class="w-full pl-12 pr-4 py-3 rounded-xl bg-slate-50 border-none ring-1 ring-slate-100 focus:ring-2 focus:ring-slate-900 font-medium text-sm">
                    <div class="absolute left-4 top-3 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                
                <select name="category" class="md:w-48 py-3 px-4 rounded-xl bg-slate-50 border-none ring-1 ring-slate-100 focus:ring-2 focus:ring-slate-900 font-bold text-xs text-slate-600 uppercase">
                    <option value="">Semua Kategori</option>
                    <option value="berkala" <?php echo e(request('category') == 'berkala' ? 'selected' : ''); ?>>Berkala</option>
                    <option value="serta merta" <?php echo e(request('category') == 'serta merta' ? 'selected' : ''); ?>>Serta Merta</option>
                    <option value="setiap saat" <?php echo e(request('category') == 'setiap saat' ? 'selected' : ''); ?>>Setiap Saat</option>
                    <option value="dikecualikan" <?php echo e(request('category') == 'dikecualikan' ? 'selected' : ''); ?>>Dikecualikan</option>
                </select>

                <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold text-xs uppercase hover:bg-amber-500 transition-all">
                    Filter
                </button>
                
                <?php if(request()->anyFilled(['search', 'category'])): ?>
                    <a href="<?php echo e(route('admin.informasi.index')); ?>" class="py-3 px-4 text-slate-400 hover:text-red-500 text-xs font-bold uppercase">Reset</a>
                <?php endif; ?>
            </form>
        </div>
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="p-6 text-[10px] font-black uppercase text-slate-400">Judul Informasi</th>
                    <th class="p-6 text-[10px] font-black uppercase text-slate-400">Kategori</th>
                    <th class="p-6 text-[10px] font-black uppercase text-slate-400">OPD</th>
                    <th class="p-6 text-[10px] font-black uppercase text-slate-400 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php $__currentLoopData = $informations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-6">
                        <div class="text-sm font-bold text-slate-800 line-clamp-1"><?php echo e($info->title); ?></div>
                    </td>
                    <td class="p-6">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase">
                            <?php echo e($info->category); ?>

                        </span>
                    </td>
                    <td class="p-6">
                        <div class="text-xs font-bold text-slate-500 uppercase"><?php echo e($info->opd_name); ?></div>
                    </td>
                    <td class="p-6 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="<?php echo e(route('admin.informasi.edit', $info->id)); ?>" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="<?php echo e(route('admin.informasi.destroy', $info->id)); ?>" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="p-6 border-t border-slate-50">
            <?php echo e($informations->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/informasi/index.blade.php ENDPATH**/ ?>