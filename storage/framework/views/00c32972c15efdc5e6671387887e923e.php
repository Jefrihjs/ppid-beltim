<?php $__env->startSection('content'); ?>
<div class="space-y-8 pb-20">
    
    <div>
        <h2 class="text-[28px] font-black text-slate-900 tracking-tight">Pengaturan Profil</h2>
        <p class="text-slate-400 font-medium text-sm">Kelola informasi akun dan keamanan akses Anda.</p>
    </div>

    <div class="space-y-6">
        
        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-10">
                <div class="max-w-2xl">
                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-10">
                <div class="max-w-2xl">
                    <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-[3rem] border border-red-50 shadow-sm overflow-hidden">
            <div class="p-10">
                <div class="max-w-2xl">
                    <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profile/edit.blade.php ENDPATH**/ ?>