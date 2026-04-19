<div class="h-1.5 bg-gradient-to-r from-amber-500 via-emerald-500 to-blue-600"></div>

<footer class="bg-slate-950 text-slate-400">
    <div class="max-w-7xl mx-auto px-6 py-20">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <img src="<?php echo e(asset('images/logo-ppid-beltim.png')); ?>" class="h-12 w-auto brightness-0 invert">
                    <div class="border-l border-slate-700 pl-3">
                        <h2 class="text-white text-sm font-black uppercase tracking-tighter leading-tight">
                            KABUPATEN<br>BELITUNG TIMUR
                        </h2>
                    </div>
                </div>
                <p class="text-xs leading-relaxed opacity-80">
                    Layanan informasi publik yang transparan, cepat, dan akuntabel berdasarkan UU No. 14/2008 tentang Keterbukaan Informasi Publik.
                </p>
                <a href="https://survei.beltim.go.id/view/SKM2207274439" target="_blank" 
                class="inline-flex items-center gap-2 px-3 py-1 bg-slate-800 rounded-full border border-slate-700 hover:border-emerald-500 hover:bg-slate-700 transition-all group">
                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest group-hover:text-emerald-400 transition-colors">
                        Isi Survei Kepuasan (SKM)
                    </span>
                </a>
            </div>

            <div>
                <h3 class="text-white font-bold mb-6 uppercase tracking-widest text-xs border-b border-amber-500/50 pb-2 inline-block">Hubungi Kami</h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex gap-3">
                        <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Jl. Raya Manggar - Gantung, Manggarawan, Belitung Timur 33511</span>
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>(0719) 92200007</span>
                    </li>
                    <li class="flex gap-3 text-amber-500 font-bold hover:underline">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:ppid@beltim.go.id">ppid@beltim.go.id</a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-bold mb-6 uppercase tracking-widest text-xs border-b border-amber-500/50 pb-2 inline-block">Navigasi</h3>
                <ul class="space-y-3 text-sm">
                    
                    <li>
                        <a href="<?php echo e(route('profil.tentang')); ?>" class="hover:text-amber-500 transition-colors flex items-center gap-2">
                            <span>&rsaquo;</span> Profil PPID
                        </a>
                    </li>

                    
                    <li>
                        <a href="<?php echo e(route('permohonan.informasi')); ?>" class="hover:text-amber-500 transition-colors flex items-center gap-2">
                            <span>&rsaquo;</span> Alur Permohonan
                        </a>
                    </li>

                    
                    <li>
                        <a href="<?php echo e(route('informasi.utama')); ?>" class="hover:text-amber-500 transition-colors flex items-center gap-2">
                            <span>&rsaquo;</span> Informasi Publik
                        </a>
                    </li>

                    
                    <li>
                        <a href="<?php echo e(route('terms.conditions')); ?>" class="hover:text-amber-500 transition-colors flex items-center gap-2">
                            <span>&rsaquo;</span> Regulasi & Hukum
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-bold mb-6 uppercase tracking-widest text-xs border-b border-amber-500/50 pb-2 inline-block">Media Sosial</h3>
                <div class="flex flex-wrap gap-3 mb-8">
                    <?php
                        $socials = [
                            ['icon' => 'facebook', 'link' => 'https://www.facebook.com/DiskominfoBeltim'],
                            ['icon' => 'instagram', 'link' => 'https://www.instagram.com/diskominfobeltim/'],
                            ['icon' => 'youtube', 'link' => 'https://www.youtube.com/channel/UC_Fda9zOCryl9j2rz2OhLZA'],
                        ];
                    ?>

                    <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($soc['link']); ?>" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 text-slate-300 hover:bg-amber-500 hover:text-slate-900 transition-all duration-300 shadow-lg">
                        <?php if($soc['icon'] == 'facebook'): ?>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.5 9.9v-7H8v-3h2.5V9.5c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.3c-1.3 0-1.7.8-1.7 1.6V12H17l-.4 3h-3.1v7A10 10 0 0022 12z"/></svg>
                        <?php elseif($soc['icon'] == 'instagram'): ?>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm5 5a5 5 0 110 10 5 5 0 010-10zm6-1.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                        <?php else: ?>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a2.997 2.997 0 00-2.11-2.12C19.505 3.5 12 3.5 12 3.5s-7.505 0-9.388.566a2.997 2.997 0 00-2.11 2.12A31.05 31.05 0 000 12a31.05 31.05 0 00.502 5.814 2.997 2.997 0 002.11 2.12C4.495 20.5 12 20.5 12 20.5s7.505 0 9.388-.566a2.997 2.997 0 002.11-2.12A31.05 31.05 0 0024 12a31.05 31.05 0 00-.502-5.814zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/></svg>
                        <?php endif; ?>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="space-y-3 pt-4 border-t border-slate-900">
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Hari Ini</span>
                        <span class="text-xs font-black text-slate-300 tracking-tighter"><?php echo e(number_format($todayVisitors ?? 0)); ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Total Hits</span>
                        <span class="text-xs font-black text-slate-300 tracking-tighter"><?php echo e(number_format($totalVisitors ?? 0)); ?></span>
                    </div>
                    <div class="flex items-center gap-2 pt-1">
                        <div class="w-1 h-1 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-[8px] font-bold text-slate-600 uppercase tracking-[0.2em]">Live Tracking</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="border-t border-slate-800 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500">
            <p>&copy; <?php echo e(date('Y')); ?> PEMKAB BELITUNG TIMUR. ALL RIGHTS RESERVED.</p>
            <div class="flex gap-6">
                <a href="<?php echo e(route('privacy.policy')); ?>" class="hover:text-amber-500 transition-colors">Kebijakan Privasi</a>
                <a href="<?php echo e(route('terms.conditions')); ?>" class="hover:text-amber-500 transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>

    </div>
</footer><?php /**PATH /var/www/html/resources/views/public/partials/footer.blade.php ENDPATH**/ ?>