

<?php $__env->startSection('content'); ?>
<div class="space-y-10">
    
    
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-[32px] font-black text-slate-900 tracking-tight leading-tight">Dashboard Utama</h2>
            <p class="text-slate-400 font-medium mt-1">Selamat datang kembali di panel kendali PPID Kabupaten Belitung Timur.</p>
        </div>
        <div class="hidden md:block">
            <span class="px-4 py-2 bg-slate-100 text-slate-500 rounded-xl text-xs font-bold uppercase tracking-widest">
                <?php echo e(now()->translatedFormat('l, d F Y')); ?>

            </span>
        </div>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col justify-between">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Informasi Publik</p>
            <div class="my-2">
                <h3 class="text-4xl font-black text-slate-900 leading-none"><?php echo e($stats['total_informasi'] ?? 0); ?></h3>
            </div>
            <div class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Total Dokumen</div>
        </div>

        
        <a href="<?php echo e(route('admin.permohonan.index')); ?>" class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col justify-between hover:border-amber-500 transition-all">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Permohonan Baru</p>
            <div class="my-2">
                <h3 class="text-4xl font-black text-amber-500 leading-none"><?php echo e($stats['permohonan_baru'] ?? 0); ?></h3>
            </div>
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Belum Diproses</div>
        </a>

        
        <a href="<?php echo e(route('admin.pesan.index')); ?>" class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col justify-between hover:border-slate-900 transition-all">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pesan Masuk</p>
            <div class="my-2">
                <h3 class="text-4xl font-black text-slate-900 leading-none"><?php echo e($stats['pesan_masuk'] ?? 0); ?></h3>
            </div>
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kontak Masyarakat</div>
        </a>

        
        <div class="bg-slate-900 p-6 rounded-[2rem] shadow-xl shadow-slate-200 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-16 h-16 bg-white/5 rounded-full"></div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Visitor</p>
            <div class="my-2">
                <h3 class="text-4xl font-black text-white leading-none"><?php echo e(number_format($totalVisitors ?? 0)); ?></h3>
            </div>
            <div class="text-[10px] font-black text-emerald-400 uppercase tracking-widest italic">All Time Records</div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 relative">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h3 class="font-black text-slate-800 uppercase text-xs tracking-[0.2em]">Analisis Kunjungan</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Tren 7 Hari Terakhir</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Live Monitor</span>
                </div>
            </div>
            <div class="h-[300px]">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>

        
        <div class="bg-white border border-slate-100 p-10 rounded-[3rem] shadow-sm flex flex-col justify-center items-center text-center relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="relative z-10">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-[2rem] flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">Pengunjung Hari Ini</p>
                <h4 class="text-7xl font-black text-slate-900 mb-2"><?php echo e($todayVisitors ?? 0); ?></h4>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">People Online</p>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-black text-slate-800 uppercase tracking-widest text-xs">Permohonan Informasi Terbaru</h3>
            <div class="flex gap-4 items-center">
                
                <a href="<?php echo e(route('admin.permohonan.cetak')); ?>" target="_blank" class="flex items-center gap-2 bg-emerald-100 text-emerald-700 px-4 py-2 rounded-xl text-[10px] font-black hover:bg-emerald-600 hover:text-white transition uppercase tracking-widest">
                    
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Cetak Laporan (PDF)</span>
                </a>
                <a href="<?php echo e(route('admin.permohonan.index')); ?>" class="text-[10px] font-black text-blue-600 hover:text-blue-800 transition uppercase tracking-widest">Lihat Semua Data</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-10 py-5">Nama Pemohon</th>
                        <th class="px-10 py-5">Tujuan</th>
                        <th class="px-10 py-5">Status</th>
                        <th class="px-10 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php $__empty_1 = true; $__currentLoopData = $recent_permohonan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50/80 transition group">
                        <td class="px-10 py-7">
                            <span class="font-black text-slate-800 text-sm block"><?php echo e($p->nama); ?></span>
                            <span class="text-[10px] font-bold text-slate-400 tracking-wider"><?php echo e($p->nik); ?></span>
                        </td>
                        <td class="px-10 py-7 text-xs text-slate-500 max-w-xs truncate font-medium"><?php echo e($p->tujuan_penggunaan); ?></td>
                        <td class="px-10 py-7">
                            <?php
                                $statusClasses = [
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'proses'  => 'bg-blue-100 text-blue-700',
                                    'selesai' => 'bg-emerald-100 text-emerald-700',
                                    'ditolak' => 'bg-red-100 text-red-700'
                                ];
                                $class = $statusClasses[strtolower($p->status)] ?? 'bg-slate-100 text-slate-700';
                            ?>
                            <span class="px-4 py-1.5 <?php echo e($class); ?> rounded-full text-[10px] font-black uppercase tracking-tighter">
                                <?php echo e($p->status); ?>

                            </span>
                        </td>
                        <td class="px-10 py-7 text-right">
                            <a href="<?php echo e(route('admin.permohonan.show', $p->id)); ?>" class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[10px] font-black hover:bg-blue-600 transition shadow-sm uppercase tracking-widest">
                                Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-8 py-24 text-center">
                            <div class="flex flex-col items-center">
                                <p class="text-slate-400 italic text-sm font-bold">Belum ada data permohonan masuk.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('visitorChart').getContext('2d');
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($days ?? []); ?>,
                datasets: [{
                    label: 'Pengunjung',
                    data: <?php echo json_encode($visitorCounts ?? []); ?>,
                    borderColor: '#0f172a',
                    backgroundColor: gradient,
                    borderWidth: 4,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0f172a',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 9
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 14, weight: 'black' },
                        padding: 15,
                        displayColors: false,
                        cornerRadius: 12
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [8, 8], color: '#f1f5f9', drawBorder: false },
                        ticks: { font: { weight: 'bold', size: 11 }, color: '#94a3b8', padding: 10 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold', size: 11 }, color: '#94a3b8', padding: 10 }
                    }
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>