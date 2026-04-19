

<?php $__env->startSection('content'); ?>

<section class="bg-slate-50 py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-20">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Kontak Kami
            </h1>
            <p class="text-slate-500 mt-4 text-lg font-medium italic">
                PPID Kabupaten Belitung Timur
            </p>
            <div class="w-20 h-1 bg-amber-500 mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-start">

            <div class="space-y-10 text-left">
                
                <div class="group">
                    <h2 class="text-xl font-bold text-slate-800 mb-4 flex items-center gap-3">
                        <span class="p-2 bg-amber-100 rounded-lg text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        Alamat Kantor
                    </h2>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Kompleks Perkantoran Pemerintah Kabupaten Belitung Timur, <br>
                        Manggar, Kabupaten Belitung Timur, Kepulauan Bangka Belitung
                    </p>
                    
                    <div class="rounded-3xl overflow-hidden shadow-2xl border border-slate-200 transition-transform duration-500 group-hover:scale-[1.01]">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15933.26252952467!2d108.2323!3d-2.8841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1716f461e71911%3A0x7c731776092045e!2sKabupaten%20Belitung%20Timur!5e0!3m2!1sid!2sid!4v1700000000000"
                            class="w-full h-[350px]"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8 mt-10">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 mb-2">Email Resmi</h2>
                        <p class="text-slate-600 hover:text-amber-600 transition">ppid@beltim.go.id</p>
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-slate-800 mb-2">Jam Pelayanan</h2>
                        <p class="text-slate-600">
                            Senin – Jumat<br>
                            <span class="font-semibold text-slate-900">08.00 – 16.00 WIB</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-10 md:p-12 rounded-[2.5rem] shadow-2xl border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full -mr-16 -mt-16 opacity-50"></div>

                <h3 class="text-2xl font-bold text-slate-900 mb-8">Kirim Pesan</h3>

                <?php if(session('success')): ?>
                    <div class="mb-8 p-4 rounded-2xl bg-green-50 text-green-700 text-sm border border-green-100 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('kontak.store')); ?>" class="space-y-6 relative z-10">
                    <?php echo csrf_field(); ?>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 ml-1">Nama Lengkap</label>
                            <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" required
                                class="mt-2 w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-amber-400/20 focus:border-amber-400 focus:outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 ml-1">Email</label>
                            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                                class="mt-2 w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-amber-400/20 focus:border-amber-400 focus:outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 ml-1">Subjek Pesan</label>
                        <input type="text" name="subjek" value="<?php echo e(old('subjek')); ?>" required
                            class="mt-2 w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-amber-400/20 focus:border-amber-400 focus:outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 ml-1">Pesan Anda</label>
                        <textarea name="pesan" rows="4" required
                            class="mt-2 w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-amber-400/20 focus:border-amber-400 focus:outline-none transition-all resize-none"><?php echo e(old('pesan')); ?></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 text-white font-bold py-5 rounded-2xl hover:bg-slate-800 transform hover:-translate-y-1 transition-all shadow-xl shadow-slate-200 active:scale-95">
                        Kirim Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/public/kontak.blade.php ENDPATH**/ ?>