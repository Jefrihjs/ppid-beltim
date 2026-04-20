<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="<?php echo e(route('admin.users.index')); ?>" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-2">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <h2 class="text-lg font-bold text-slate-800 mb-6">Tambah Admin Baru</h2>
        
        
        <?php if(session('success')): ?>
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-transition 
                x-init="setTimeout(() => show = false, 4000)"
                class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center shadow-sm"
            >
                <span class="mr-3 text-lg">✅</span>
                <div>
                    <p class="text-xs font-bold text-emerald-800 uppercase tracking-widest">Berhasil!</p>
                    <p class="text-[11px] text-emerald-600 font-medium"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        <?php endif; ?>

        
        <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="space-y-4">
                
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required class="w-full rounded-xl border-slate-200 text-sm focus:ring-slate-900 focus:border-slate-900">
                </div>

                
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email Dinas</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required class="w-full rounded-xl border-slate-200 text-sm focus:ring-slate-900 focus:border-slate-900">
                </div>

                
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Hak Akses (Role)</label>
                    <select name="role" required class="w-full rounded-xl border-slate-200 text-sm focus:ring-slate-900 focus:border-slate-900">
                        <option value="admin">Admin (Layanan PPID)</option>
                        <option value="superadmin">Superadmin (Akses Penuh)</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                    
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Password</label>
                        <input type="password" name="password" required class="w-full rounded-xl border-slate-200 text-sm focus:ring-slate-900 focus:border-slate-900">
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ulangi Password</label>
                        <input type="password" name="password_confirmation" required class="w-full rounded-xl border-slate-200 text-sm focus:ring-slate-900 focus:border-slate-900">
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-slate-900 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-slate-800 transition">
                    Simpan Akun Admin
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/users/create.blade.php ENDPATH**/ ?>