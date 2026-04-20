<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPID Kabupaten Belitung Timur</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* PERBAIKAN: Gunakan html untuk grayscale agar posisi fixed tombol tidak berantakan */
        html.mode-grayscale { 
            filter: grayscale(100%); 
        }

        /* Mode Kontras tetap di body tidak apa-apa */
        body.mode-contrast { 
            background-color: #000 !important; 
            color: #ffff00 !important; 
        }
        
        body.mode-contrast * { 
            background-color: #000 !important; 
            color: #ffff00 !important; 
            border-color: #ffff00 !important; 
        }

        /* Animasi transisi smooth */
        body { 
            transition: background-color 0.3s, color 0.3s, filter 0.3s; 
            min-height: 100vh;
        }

        /* Trik Alpine agar menu tidak muncul sekilas saat refresh */
        [x-cloak] { display: none !important; }
    </style>
    
</head>
<body class="bg-slate-100 text-slate-800 antialiased">

    <?php echo $__env->make('public.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('public.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div x-data="{ open: false }" class="fixed bottom-6 left-6 z-[99999]">
        <div class="relative">
            <button @click="open = !open"
                class="bg-blue-600 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition-all border-4 border-white relative z-[100001]">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />
                </svg>
            </button>

            
            <div x-show="open" @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-10"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-cloak
                
                class="fixed bottom-24 left-6 bg-white rounded-2xl shadow-2xl w-60 p-5 border border-slate-100 z-[100000]">
                
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 border-b pb-2 text-left">Opsi Aksesibilitas</h4>
                <div class="space-y-2 text-xs font-bold text-slate-700 text-left">
                    <button onclick="changeFontSize(2)" class="w-full text-left p-2.5 rounded-xl hover:bg-blue-50 transition">➕ Perbesar Teks</button>
                    <button onclick="changeFontSize(-2)" class="w-full text-left p-2.5 rounded-xl hover:bg-blue-50 transition">➖ Perkecil Teks</button>
                    <button onclick="toggleSpeech()" class="w-full text-left p-2.5 rounded-xl hover:bg-blue-50 transition">🔊 Moda Suara</button>
                    <button onclick="toggleGrayscale()" class="w-full text-left p-2.5 rounded-xl hover:bg-blue-50 transition">🌓 Grayscale</button>
                    <button onclick="toggleContrast()" class="w-full text-left p-2.5 rounded-xl hover:bg-blue-50 transition">👁️ Kontras Tinggi</button>
                    <hr class="border-slate-50 my-2">
                    <button onclick="resetAccess()" class="w-full text-center p-2.5 rounded-xl bg-red-50 text-red-600 font-black uppercase tracking-widest">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="fixed bottom-6 right-6 z-[99999]">
        <a href="https://wa.me/6281279985667" target="_blank"
            class="bg-emerald-500 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center hover:scale-110 hover:rotate-12 transition-all duration-300 border-4 border-white">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 0 5.414 0 12.05c0 2.123.552 4.197 1.602 6.034L0 24l6.135-1.61a11.81 11.81 0 005.904 1.592h.004c6.637 0 12.05-5.414 12.05-12.05a11.782 11.782 0 00-3.483-8.52z" />
            </svg>
        </a>
    </div>


<script>
    let fontSize = 16;
    const synth = window.speechSynthesis;

    function changeFontSize(s) {
        fontSize += s;
        document.body.style.fontSize = fontSize + 'px';
    }

    // GANTI BAGIAN INI: Targetkan documentElement (tag HTML)
    function toggleGrayscale() { 
        document.documentElement.classList.toggle('mode-grayscale'); 
    }
    
    function toggleContrast() { 
        document.body.classList.toggle('mode-contrast'); 
    }

    function toggleSpeech() {
        if (synth.speaking) {
            synth.cancel();
            return;
        }
        let textToRead = window.getSelection().toString() || document.querySelector('main').innerText;
        const utterance = new SpeechSynthesisUtterance(textToRead);
        utterance.lang = 'id-ID';
        synth.speak(utterance);
    }

    // GANTI JUGA BAGIAN INI: Biar resetnya bersih di HTML dan Body
    function resetAccess() {
        fontSize = 16;
        document.body.style.fontSize = '16px';
        document.documentElement.classList.remove('mode-grayscale'); // Hapus di HTML
        document.body.classList.remove('mode-contrast');             // Hapus di Body
        synth.cancel();
    }
</script>
</body>
</html><?php /**PATH /var/www/html/resources/views/layouts/public.blade.php ENDPATH**/ ?>