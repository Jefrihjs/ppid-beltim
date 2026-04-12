<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin PPID - Kabupaten Belitung Timur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 flex flex-col min-h-screen">

    <nav class="bg-slate-900 text-white px-6 py-4 flex justify-between sticky top-0 z-50 shadow-md">
        <div class="flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                {{-- Pastikan file logo-ppid.png sudah ada di folder public/images --}}
                <img src="{{ asset('images/logo-ppid-beltim.png') }}" alt="Logo PPID" class="h-8 w-auto transform group-hover:scale-105 transition duration-200">
                <div class="h-6 w-[1px] bg-slate-700 mx-2"></div>
                <span class="text-[10px] font-black tracking-[0.3em] text-slate-400 uppercase">Panel Kendali</span>
            </a>
        </div>

        <div class="flex items-center gap-6">
            <span class="text-sm font-medium text-slate-300 italic">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500/20 text-red-400 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-red-500 hover:text-white transition uppercase">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="flex flex-1">
        <aside class="w-64 bg-white border-r border-slate-200 sticky top-[68px] h-[calc(100vh-68px)] p-6 hidden md:block">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Navigasi Utama</p>
            
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="text-xs font-bold">Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.permohonan.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.permohonan.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="text-xs font-bold">Permohonan Informasi</span>
                </a>

                <a href="{{ route('admin.informasi.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.informasi.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="text-xs font-bold">Informasi Publik</span>
                </a>

                <a href="{{ route('admin.opd.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.opd.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50' }}">
                    <div class="flex items-center justify-between w-full">
                        <span class="text-xs font-bold">Daftar OPD</span>
                        {{-- Badge Jumlah OPD (Opsional) --}}
                        <span class="text-[9px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full {{ request()->routeIs('admin.opd.*') ? 'bg-slate-800 text-white' : '' }}">
                            41
                        </span>
                    </div>
                </a>

                <a href="{{ route('admin.pesan.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.pesan.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="text-xs font-bold">Pesan & Kontak</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.gallery.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="text-xs font-bold">Galeri Kegiatan</span>
                </a>

                <a href="{{ route('admin.announcement.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.announcement.*') ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="text-xs font-bold">Manajemen Pengumuman</span>
                </a>
            </nav>

            <div class="mt-10 pt-6 border-t border-slate-100">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Pengaturan</p>
                <a href="{{ route('admin.hero.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.hero.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="text-xs font-bold">Slider Hero</span>
                </a>

                <a href="{{ route('admin.video.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.video.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="text-xs font-bold">Video Panduan</span>
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                    <span class="text-xs font-bold">Profil Saya</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>