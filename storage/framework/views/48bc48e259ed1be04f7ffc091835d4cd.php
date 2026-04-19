

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
                            <div class="flex items-center justify-end gap-2">
                                
                                <a href="<?php echo e(route('admin.pesan.show', $m->id)); ?>" class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[10px] font-black hover:bg-amber-500 hover:text-slate-900 transition shadow-sm">
                                    BACA PESAN
                                </a>

                                
                                <form action="<?php echo e(route('admin.pesan.destroy', $m->id)); ?>" method="POST" class="form-delete">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="button" class="btn-delete bg-red-50 text-red-500 p-2.5 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
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

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.form-delete');
            
            Swal.fire({
                title: 'Hapus Pesan?',
                text: "Pesan yang dihapus (spam) tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', // warna merah tailwind
                cancelButtonColor: '#64748b', // warna slate tailwind
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                borderRadius: '2rem', // biar melengkung seperti desain Bapak
                customClass: {
                    title: 'font-black uppercase tracking-tight',
                    confirmButton: 'rounded-xl font-bold uppercase text-xs px-6 py-3',
                    cancelButton: 'rounded-xl font-bold uppercase text-xs px-6 py-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    });

    // Notifikasi sukses (Jika ada session success)
    <?php if(session('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'BERHASIL!',
            text: "<?php echo e(session('success')); ?>",
            showConfirmButton: false,
            timer: 2000,
            borderRadius: '2rem'
        });
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pesan/index.blade.php ENDPATH**/ ?>