<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPID Kabupaten Belitung Timur</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Efek Filter Aksesibilitas */
        body.mode-grayscale { filter: grayscale(100%); }
        body.mode-contrast { background-color: #000 !important; color: #ffff00 !important; }
        body.mode-contrast * { 
            background-color: #000 !important; 
            color: #ffff00 !important; 
            border-color: #ffff00 !important; 
        }
        /* Animasi transisi smooth untuk seluruh elemen */
        body { transition: background-color 0.3s, color 0.3s, filter 0.3s; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased">

    @include('public.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('public.partials.footer')

    <div x-data="{ open: false }" class="fixed bottom-24 right-8 z-[9999]">
        
        <button @click="open = !open" 
                class="bg-blue-600 text-white w-16 h-16 rounded-full shadow-2xl hover:scale-110 active:scale-95 transition-all flex items-center justify-center border-2 border-white/20">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 1200 1200" xmlns="http://www.w3.org/2000/svg">
                <path d="M476.721,0c-65.602,0.471-117.577,50.855-120.375,119.094c0.477,66.402,51.395,117.868,120.375,120.406
                    c61.426-0.832,115.989-51.475,119.094-120.406C595.349,52.962,544.73,3.015,476.721,0z M510.002,266.375
                    c-27.32,0-50.372,9.175-69.156,27.531c-15.261,15.317-32.347,49.101-26.875,76.219h-1.281L483.127,709.5
                    c7.265,38.873,39.258,63.938,81.969,66.594c98.116-0.27,204.507-2.497,304.781-1.281l169.062,294.563
                    c19.023,40.147,67.734,48.603,103.095,19.219c16.965-16.834,23.826-45.475,12.155-70.438L958.252,677.469
                    c-14.117-29.208-41.97-45.662-76.844-47.375H663.689l-25.594-125.5h170.313c36.818,2.724,63.343-25.375,55.719-64.031
                    c-5.602-18.888-25.174-36.278-48.031-37.155H616.314c-10.068-51.463-8.466-82.573-48.03-117.813
                    C551.635,272.787,532.2,266.375,510.002,266.375z M326.283,411.625c-5.259,0.071-10.663,0.73-16.063,2.031
                    c-75.444,29.355-143.317,79.801-195.938,149.844c-46.369,65.387-72.293,144.095-74.28,230.531
                    c0.772,102.442,44.761,207.567,123.594,286.875c76.408,72.772,182.465,116.699,296.469,119.094
                    c83.152-0.458,166.274-25.016,242.063-73.625c68.07-46.237,121.414-112.588,153.656-195.312
                    c5.977-14.516,11.105-30.759,15.375-48.688c6.25-28.186-9.57-51.084-39.688-60.188c-27.394-6.069-51.893,9.046-61.469,38.438
                    c-2.562,12.807-6.408,25.172-11.531,37.125c-21.749,57.507-62.231,107.283-115.906,146c-52.185,35.487-114.684,54.813-182.5,56.344
                    c-80.649-0.573-158.332-31.315-223.469-89.625c-55.969-54.264-90.982-131.912-92.844-216.438
                    c0.358-60.255,19.762-119.715,56.344-173.531c35.875-49.807,86.096-88.272,147.281-113.344c25.783-8.456,39.673-35.15,30.719-64.031
                    C369.447,422.364,349.072,411.317,326.283,411.625z"/>
            </svg>
        </button>

        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="absolute bottom-20 right-0 bg-white border border-slate-200 rounded-2xl shadow-2xl w-64 p-5 text-slate-800">
            <h3 class="font-black text-xs uppercase tracking-widest text-slate-400 mb-4 border-b pb-2">Opsi Aksesibilitas</h3>
            
            <div class="space-y-3">
                <button onclick="changeFontSize(2)" class="w-full text-left bg-slate-50 hover:bg-blue-50 p-3 rounded-xl text-xs font-bold uppercase transition">➕ Perbesar Teks</button>
                <button onclick="changeFontSize(-2)" class="w-full text-left bg-slate-50 hover:bg-blue-50 p-3 rounded-xl text-xs font-bold uppercase transition">➖ Perkecil Teks</button>
                
                <button onclick="toggleSpeech()" id="speech-btn" class="w-full text-left bg-slate-50 hover:bg-blue-50 p-3 rounded-xl text-xs font-bold uppercase transition flex justify-between items-center">
                    <span>🔊 Moda Suara</span>
                    <span id="speech-status" class="text-[8px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full hidden">AKTIF</span>
                </button>
                
                <button onclick="toggleGrayscale()" class="w-full text-left bg-slate-50 hover:bg-blue-50 p-3 rounded-xl text-xs font-bold uppercase transition">🌓 Skala Abu-abu</button>
                <button onclick="toggleContrast()" class="w-full text-left bg-slate-50 hover:bg-blue-50 p-3 rounded-xl text-xs font-bold uppercase transition">👁️ Kontras Tinggi</button>
                
                <hr class="border-slate-100 my-2">
                <button onclick="resetAccess()" class="w-full text-center bg-red-50 text-red-600 p-3 rounded-xl text-xs font-black uppercase transition hover:bg-red-100">Atur Ulang</button>
            </div>
        </div>
    </div>

    {{-- TOMBOL WA --}}
    <a href="https://wa.me/6281279985667" target="_blank" class="fixed bottom-8 right-8 bg-emerald-500 text-white w-16 h-16 rounded-full shadow-2xl hover:scale-110 active:scale-95 transition-all flex items-center justify-center z-[9999]">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 0 5.414 0 12.05c0 2.123.552 4.197 1.602 6.034L0 24l6.135-1.61a11.81 11.81 0 005.904 1.592h.004c6.637 0 12.05-5.414 12.05-12.05a11.782 11.782 0 00-3.483-8.52z"/>
        </svg>
    </a>

    <script>
        let fontSize = 16;
        const synth = window.speechSynthesis;

        function changeFontSize(s) { 
            fontSize += s; 
            document.body.style.fontSize = fontSize + 'px'; 
        }

        function toggleGrayscale() { document.body.classList.toggle('mode-grayscale'); }
        function toggleContrast() { document.body.classList.toggle('mode-contrast'); }

        function toggleSpeech() {
            const statusTag = document.getElementById('speech-status');
            if (synth.speaking) {
                synth.cancel();
                statusTag.classList.add('hidden');
                return;
            }

            let textToRead = window.getSelection().toString() || document.querySelector('main').innerText;
            const utterance = new SpeechSynthesisUtterance(textToRead);
            utterance.lang = 'id-ID';
            
            utterance.onstart = () => statusTag.classList.remove('hidden');
            utterance.onend = () => statusTag.classList.add('hidden');
            
            synth.speak(utterance);
        }

        function resetAccess() { 
            fontSize = 16; 
            document.body.style.fontSize = '16px'; 
            document.body.classList.remove('mode-grayscale', 'mode-contrast'); 
            synth.cancel();
            document.getElementById('speech-status').classList.add('hidden');
        }
    </script>

</body>
</html>