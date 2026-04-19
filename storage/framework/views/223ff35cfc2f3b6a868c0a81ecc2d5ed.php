<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin PPID - Kabupaten Belitung Timur</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-100 flex flex-col min-h-screen">

    
    <nav class="bg-slate-900 text-white px-6 py-4 flex justify-between sticky top-0 z-50 shadow-md">
        <div class="flex items-center">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 group">
                <img src="<?php echo e(asset('images/logo-ppid-beltim.png')); ?>" alt="Logo PPID" class="h-8 w-auto transform group-hover:scale-105 transition duration-200">
                <div class="h-6 w-[1px] bg-slate-700 mx-2"></div>
                <span class="text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase">Panel Kendali</span>
            </a>
        </div>

        <div class="flex items-center gap-6">
            <span class="text-sm font-medium text-slate-300 italic"><?php echo e(auth()->user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="bg-red-500/20 text-red-400 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-red-500 hover:text-white transition uppercase">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="flex flex-1 bg-slate-100">
        
        <aside class="w-64 bg-white border-r border-slate-200 sticky top-[68px] h-[calc(100vh-68px)] p-6 hidden md:block overflow-y-auto custom-scrollbar">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Navigasi Utama</p>
            
            <nav class="space-y-2">
                
                <a href="<?php echo e(route('admin.dashboard')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <span class="text-xs font-bold">Dashboard Utama</span>
                </a>

                
                <div x-data="{ openPPID: <?php echo e(request()->routeIs('admin.permohonan.*', 'admin.keberatan.*', 'admin.laporan.*') ? 'true' : 'false'); ?> }" class="space-y-1">
                    <button @click="openPPID = !openPPID" 
                            class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('admin.permohonan.*', 'admin.keberatan.*', 'admin.laporan.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-600 hover:bg-slate-50'); ?>">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span class="text-xs font-bold uppercase tracking-wider">Layanan Informasi</span>
                        </div>
                        <svg :class="openPPID ? 'rotate-180' : ''" class="w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="openPPID" x-cloak class="pl-4 space-y-1 mt-1">
                        <a href="<?php echo e(route('admin.permohonan.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('admin.permohonan.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900'); ?>">
                            <div class="w-1.5 h-1.5 rounded-full <?php echo e(request()->routeIs('admin.permohonan.*') ? 'bg-blue-400' : 'bg-slate-300'); ?>"></div>
                            <span class="text-[11px] font-bold">Permohonan Informasi</span>
                        </a>
                        <a href="<?php echo e(route('admin.keberatan.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('admin.keberatan.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900'); ?>">
                            <div class="w-1.5 h-1.5 rounded-full <?php echo e(request()->routeIs('admin.keberatan.*') ? 'bg-red-400' : 'bg-slate-300'); ?>"></div>
                            <span class="text-[11px] font-bold">Keberatan Informasi</span>
                        </a>
                        <a href="<?php echo e(route('admin.laporan.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('admin.laporan.*') ? 'bg-slate-900 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900'); ?>">
                            <div class="w-1.5 h-1.5 rounded-full <?php echo e(request()->routeIs('admin.laporan.*') ? 'bg-emerald-400' : 'bg-slate-300'); ?>"></div>
                            <span class="text-[11px] font-bold">Laporan PPID</span>
                        </a>
                    </div>
                </div>

                
                <a href="<?php echo e(route('admin.informasi.index')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.informasi.*') ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                    <span class="text-xs font-bold">Informasi Publik</span>
                </a>

                
                <a href="<?php echo e(route('admin.categories.index')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    <span class="text-xs font-bold">Sub-Judul (Kelompok)</span>
                </a>

                
                <a href="<?php echo e(route('admin.opd.index')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.opd.*') ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21h18"></path><path d="M3 7v1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7H3"></path><path d="M19 21v-4a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v4"></path></svg>
                    <div class="flex items-center justify-between w-full">
                        <span class="text-xs font-bold">Daftar OPD</span>
                        <span class="text-[9px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full <?php echo e(request()->routeIs('admin.opd.*') ? 'bg-slate-800 text-white' : ''); ?>">41</span>
                    </div>
                </a>

                
                <a href="<?php echo e(route('admin.pesan.index')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.pesan.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span class="text-xs font-bold">Pesan & Kontak</span>
                </a>

                
                <a href="<?php echo e(route('admin.gallery.index')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.gallery.*', 'admin.video.*') ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span class="text-xs font-bold">Galeri Dokumentasi</span>
                </a>

                
                <a href="<?php echo e(route('admin.announcement.index')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.announcement.*') ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 8a3 3 0 0 0-3-3H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a3 3 0 0 0 3-3V8L22 4"></path><path d="M15 12h.01"></path></svg>
                    <span class="text-xs font-bold">Manajemen Pengumuman</span>
                </a>

                
                <a href="<?php echo e(route('admin.visitors.index')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.visitors.*') ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    <span class="text-xs font-bold italic font-black">Statistik Pengunjung</span>
                </a>
            </nav>

            <div class="mt-10 pt-6 border-t border-slate-100 pb-10">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Pengaturan</p>
                <a href="<?php echo e(route('admin.hero.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.hero.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M8 21V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v16"></path></svg>
                    <span class="text-xs font-bold">Slider Hero</span>
                </a>
                <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('profile.edit') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50'); ?>">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span class="text-xs font-bold">Profil Saya</span>
                </a>
            </div>
        </aside>

        
        <main class="flex-1 p-8 overflow-y-auto">
            <?php if(session('success')): ?>
                <div class="mb-6 p-4 bg-emerald-100 text-emerald-700 rounded-2xl font-bold text-[10px] uppercase tracking-widest shadow-sm">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?> 
        </main>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</body>
</html><?php /**PATH /var/www/html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>