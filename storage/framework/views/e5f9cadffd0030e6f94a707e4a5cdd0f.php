 

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <div>
            <h2 class="text-lg font-bold text-slate-800">Manajemen User Admin</h2>
            <p class="text-xs text-slate-500">Daftar pengguna yang memiliki akses ke Panel Kendali PPID</p>
        </div>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-200">
            + Tambah Admin Baru
        </a>
    </div>
    <?php if(session('success') || session('error')): ?>
        <div class="px-6 py-4 border-b border-slate-50">
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-transition 
                x-init="setTimeout(() => show = false, 5000)"
                class="<?php echo e(session('success') ? 'bg-emerald-50 border-emerald-100 text-emerald-700' : 'bg-red-50 border-red-100 text-red-700'); ?> p-4 rounded-2xl border flex items-center shadow-sm"
            >
                <span class="mr-3"><?php echo e(session('success') ? '✅' : '⚠️'); ?></span>
                <p class="text-xs font-bold uppercase tracking-widest">
                    <?php echo e(session('success') ?? session('error')); ?>

                </p>
            </div>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50">
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Pengguna</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Hak Akses (Role)</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <span class="text-xs font-bold text-slate-700"><?php echo e($user->name); ?></span>
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-500"><?php echo e($user->email); ?></td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter <?php echo e($user->role === 'superadmin' ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600'); ?>">
                            <?php echo e($user->role); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center items-center gap-1">
                            <?php if($user->id !== auth()->id()): ?>
                                
                                <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" 
                                class="text-slate-400 hover:text-slate-900 transition p-2" 
                                title="Edit Admin">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>

                                
                                <form id="delete-form-<?php echo e($user->id); ?>" action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="button" 
                                        onclick="confirmDelete('<?php echo e($user->id); ?>', '<?php echo e($user->name); ?>')"
                                        class="text-red-400 hover:text-red-600 transition p-2"
                                        title="Hapus Admin">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-[9px] italic text-slate-400 font-bold uppercase tracking-widest">Akun Anda</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(userId, userName) {
        Swal.fire({
            title: 'Hapus Admin?',
            text: "Akun " + userName + " akan dihapus permanen dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0f172a', // Warna Slate-900 (sesuai tema Bapak)
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-xl',
                cancelButton: 'text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-xl text-slate-600'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Jalankan submit form jika user klik Ya
                document.getElementById('delete-form-' + userId).submit();
            }
        })
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/users/index.blade.php ENDPATH**/ ?>