<header
    x-data="{ scrolled: false, open: false }"
    x-init="
        @if(request()->is('/'))
            const hero = document.getElementById('hero');
            window.addEventListener('scroll', () => {
                scrolled = window.scrollY > 50; // Lebih responsif daripada menunggu offsetHeight
            })
        @else
            scrolled = true;
        @endif
    "
    :class="scrolled 
        ? 'bg-white/95 backdrop-blur-md py-3 shadow-sm' 
        : 'bg-transparent py-6'"
    class="fixed top-0 left-0 w-full z-[999] transition-all duration-500 ease-in-out"
>
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">

        <a href="/" class="flex items-center gap-4 group">
            <div :class="scrolled ? 'scale-90' : 'bg-white p-2 rounded-2xl shadow-lg'" 
                 class="transition-all duration-500 transform">
                <img src="{{ asset('images/logo-ppid-beltim.png') }}" 
                     class="h-10 md:h-12 w-auto object-contain">
            </div>

            <div class="hidden md:block leading-tight transition-colors duration-500"
                :class="scrolled ? 'text-slate-800' : 'text-white'">
                
                <h1 class="font-black text-lg md:text-xl tracking-tight">
                    Kabupaten Belitung Timur
                </h1>
                
                <p class="text-[10px] md:text-xs opacity-80 font-medium uppercase tracking-widest">
                    Pejabat Pengelola Informasi dan Dokumentasi
                </p>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-10 font-bold transition-colors duration-500"
            :class="scrolled ? 'text-slate-700' : 'text-white/90'">
            
            <a href="/" class="relative py-2 hover:text-amber-500 transition-colors group">
                Beranda
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-500 transform {{ request()->is('/') ? 'scale-x-100' : 'scale-x-0' }} group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
            </a>

            {{-- Menu Profil & Layanan --}}
            @foreach(['profil' => 'Profil', 'layanan' => 'Layanan'] as $path => $label)
                <a href="{{ url($path) }}" class="relative py-2 hover:text-amber-500 transition-colors group">
                    {{ $label }}
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-500 transform {{ request()->is($path.'*') ? 'scale-x-100' : 'scale-x-0' }} group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
            @endforeach

            {{-- Dropdown Informasi Publik --}}
            <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative group">
                <button class="flex items-center gap-1 py-2 hover:text-amber-500 transition-colors uppercase font-black text-[11px] tracking-widest">
                    Informasi
                    <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div x-show="open" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-cloak
                    class="absolute left-0 mt-0 w-72 bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden py-4 text-slate-800 shadow-amber-900/10">
                    
                    {{-- Link untuk Kelompok DIP --}}
                    <div class="px-6 py-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">Daftar Informasi (DIP)</div>
                    <a href="{{ route('informasi.utama') }}" class="block px-4 py-2 text-sm hover:bg-slate-100">
                        DIP Utama
                    </a>
                    <a href="{{ route('informasi.pembantu') }}" class="block px-4 py-2 text-sm hover:bg-slate-100">
                        DIP Pembantu
                    </a>

                    <div class="my-2 border-t border-slate-50"></div>

                    {{-- Link untuk Kategori Informasi --}}
                    <div class="px-6 py-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori</div>
                    <a href="{{ route('public.informasi.index', ['category' => 'berkala']) }}" class="block px-6 py-3 text-sm hover:bg-slate-50 hover:text-amber-600 transition-all font-bold">
                        Informasi Berkala
                    </a>
                    <a href="{{ route('public.informasi.index', ['category' => 'setiap saat']) }}" class="block px-6 py-3 text-sm hover:bg-slate-50 hover:text-amber-600 transition-all font-bold">
                        Informasi Setiap Saat
                    </a>
                    <a href="{{ route('public.informasi.index', ['category' => 'serta merta']) }}" class="block px-6 py-3 text-sm hover:bg-slate-50 hover:text-amber-600 transition-all font-bold">
                        Informasi Serta Merta
                    </a>
                </div>
            </div>
            
            <a href="/kontak" class="relative py-2 hover:text-amber-500 transition-colors group">
                Kontak
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-500 transform {{ request()->is('kontak*') ? 'scale-x-100' : 'scale-x-0' }} group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
            </a>

              {{-- Link Menu Pengumuman & Prosedur --}}
            <div class="ml-4">
                <a href="{{ route('public.prosedur') }}" 
                class="inline-flex items-center gap-2 px-6 py-2.5 {{ request()->routeIs('public.prosedur') ? 'bg-amber-500 text-white' : 'bg-emerald-600 hover:bg-emerald-700 text-white' }} rounded-full text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-emerald-900/20 group">
                    
                    {{-- Ikon Animasi --}}
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                    </span>

                    PENGUMUMAN
                </a>
            </div>
        </nav>

    <div x-show="open" x-cloak class="md:hidden absolute top-full left-0 w-full bg-white border-t border-slate-100 shadow-2xl overflow-y-auto max-h-screen">
        <div class="flex flex-col p-6 gap-2 text-slate-800 font-bold uppercase tracking-wider text-sm">
            <a href="/" class="py-3 border-b border-slate-50 hover:text-amber-600">Beranda</a>
            <a href="/profil" class="py-3 border-b border-slate-50 hover:text-amber-600">Profil</a>
            <a href="/layanan" class="py-3 border-b border-slate-50 hover:text-amber-600">Layanan</a>
            
            <div class="py-3 text-slate-400 text-xs">Informasi Publik:</div>
            <div class="pl-4 flex flex-col gap-3 border-l-2 border-amber-500">
                <a href="{{ route('informasi.utama') }}" class="py-1 hover:text-amber-600 text-[12px]">DIP Utama</a>
                <a href="{{ route('informasi.pembantu') }}" class="py-1 hover:text-amber-600 text-[12px]">DIP Pembantu</a>
                <a href="{{ route('informasi.berkala') }}" class="py-1 hover:text-amber-600 text-[12px]">Berkala</a>
                <a href="{{ route('informasi.setiap_saat') }}" class="py-1 hover:text-amber-600 text-[12px]">Setiap Saat</a>
                <a href="{{ route('informasi.serta_merta') }}" class="py-1 hover:text-amber-600 text-[12px]">Serta Merta</a>
            </div>
            
            <a href="/kontak" class="py-3 hover:text-amber-600">Kontak</a>
        </div>
    </div>
</header>