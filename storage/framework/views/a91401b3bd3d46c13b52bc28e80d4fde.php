<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="<?php echo e(route('admin.users.index')); ?>" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-2">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <h2 class="text-lg font-bold text-slate-800 mb-6">Edit Data Admin</h2>
        
        <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> 
            
            <div class="space-y-4">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required class="w-full rounded-xl border-slate-200 text-sm">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email Dinas</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required class="w-full rounded-xl border-slate-200 text-sm">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Hak Akses (Role)</label>
                    <select name="role" required class="w-full rounded-xl border-slate-200 text-sm">
                        <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin (Layanan PPID)</option>
                        <option value="superadmin" <?php echo e($user->role == 'superadmin' ? 'selected' : ''); ?>>Superadmin (Akses Penuh)</option>
                    </select>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <p class="text-[10px] text-amber-600 font-bold uppercase mb-4 italic">Kosongkan password jika tidak ingin mengubahnya.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Password Baru</label>
                            <input type="password" name="password" class="w-full rounded-xl border-slate-200 text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="w-full rounded-xl border-slate-200 text-sm">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-slate-900 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-slate-800 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>