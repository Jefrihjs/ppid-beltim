<?php $__env->startSection('content'); ?>
<div x-data="{ tab: 'foto' }" class="py-12 px-6">
    <div class="max-w-7xl mx-auto">
        
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tighter">
                    Manajemen <span class="text-blue-600">Galeri & Dokumentasi</span>
                </h2>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">PPID Kabupaten Belitung Timur</p>
            </div>

            <div class="flex bg-white p-1.5 rounded-2xl shadow-sm border border-slate-100">
                <button @click="tab = 'foto'" 
                    :class="tab === 'foto' ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-500 hover:bg-slate-50'"
                    class="px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                    📸 Koleksi Foto
                </button>
                <button @click="tab = 'video'" 
                    :class="tab === 'video' ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-500 hover:bg-slate-50'"
                    class="px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                    🎥 Video YouTube
                </button>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            
            
            <div class="h-fit sticky top-24">
                
                
                <div x-show="tab === 'foto'" x-transition class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <h3 class="text-lg font-black text-slate-800 uppercase mb-6 leading-tight">Unggah Foto <br><span class="text-blue-600 text-sm">Kegiatan Baru</span></h3>
                    <form action="<?php echo e(route('admin.gallery.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="space-y-6">
                            <div>
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Keterangan Foto</label>
                                <input type="text" name="caption" required class="w-full mt-2 p-4 rounded-2xl bg-slate-50 border-none font-bold text-sm focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Rapat Koordinasi...">
                            </div>
                            <div>
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">File Gambar</label>
                                <input type="file" name="image" required class="w-full mt-2 text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                            <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">Simpan Foto</button>
                        </div>
                    </form>
                </div>

                
                <div x-show="tab === 'video'" x-transition style="display: none;" class="bg-slate-900 p-8 rounded-[2.5rem] shadow-xl">
                    <h3 class="text-lg font-black text-white uppercase mb-6 leading-tight">Tambah Video <br><span class="text-blue-400 text-sm">YouTube</span></h3>
                    <form action="<?php echo e(route('admin.gallery.storeVideo')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="space-y-6">
                            <div>
                                <label class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Judul Video</label>
                                <input type="text" name="title" required class="w-full mt-2 p-4 rounded-2xl bg-slate-800 border-none text-white font-bold text-sm focus:ring-2 focus:ring-blue-400" placeholder="Contoh: Panduan Permohonan...">
                            </div>
                            <div>
                                <label class="text-[10px] font-black uppercase text-slate-500 tracking-widest">URL YouTube</label>
                                <input type="url" name="youtube_url" required class="w-full mt-2 p-4 rounded-2xl bg-slate-800 border-none text-white font-bold text-sm focus:ring-2 focus:ring-blue-400" placeholder="https://youtube.com/watch?v=...">
                            </div>
                            <div class="flex items-center gap-3 bg-slate-800 p-4 rounded-2xl border border-slate-700">
                                <input type="checkbox" name="is_main" id="is_main" class="rounded-md text-blue-500 bg-slate-700 border-none focus:ring-0">
                                <label for="is_main" class="text-[10px] font-black uppercase text-slate-300 cursor-pointer">Set sebagai Video Utama</label>
                            </div>
                            <button type="submit" class="w-full py-4 bg-blue-500 text-white rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg shadow-blue-900/50 hover:bg-blue-400 transition-all">Simpan Video</button>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="lg:col-span-2">
                
                
                <div x-show="tab === 'foto'" x-transition class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative group aspect-square rounded-[2rem] overflow-hidden bg-white shadow-sm border border-white">
                        <img src="<?php echo e(asset('storage/'.$g->image_path)); ?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-slate-900/70 opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center justify-center p-4">
                            <p class="text-[10px] text-white font-bold uppercase text-center mb-4 leading-tight"><?php echo e($g->caption); ?></p>
                            <form action="<?php echo e(route('admin.gallery.destroy', $g->id)); ?>" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="bg-white/20 hover:bg-red-500 text-white p-3 rounded-xl transition-colors backdrop-blur-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div x-show="tab === 'video'" x-transition style="display: none;" class="space-y-4">
                    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white p-4 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-6 group hover:shadow-xl transition-all">
                        <div class="w-32 aspect-video rounded-2xl bg-slate-900 overflow-hidden shrink-0 shadow-md">
                            <img src="https://img.youtube.com/vi/<?php echo e($v->youtube_id); ?>/mqdefault.jpg" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-black text-slate-800 text-xs uppercase"><?php echo e($v->title); ?></h4>
                                <?php if($v->is_main): ?>
                                    <span class="bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full text-[8px] font-black uppercase">Utama</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">ID: <?php echo e($v->youtube_id); ?></p>
                        </div>
                        <form action="<?php echo e(route('admin.gallery.destroyVideo', $v->id)); ?>" method="POST" onsubmit="return confirm('Hapus video ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="bg-slate-50 text-slate-300 hover:bg-red-50 hover:text-red-500 p-3 rounded-xl transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/gallery/index.blade.php ENDPATH**/ ?>