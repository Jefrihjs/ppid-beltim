<nav x-data="{ open: false }" class="bg-white border-b border-slate-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo-ppid-beltim.png') }}" class="h-10 w-auto transition-transform group-hover:scale-105">
                        <div class="hidden lg:block leading-tight">
                            <span class="block text-sm font-black text-slate-800 tracking-tight">ADMIN PANEL</span>
                            <span class="block text-[10px] font-bold text-amber-600 uppercase">PPID Beltim</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="font-bold text-slate-600">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.hero.index')" :active="request()->routeIs('admin.hero.*')">
                        {{ __('Slider Hero') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.gallery.index')" :active="request()->routeIs('admin.gallery.*')">
                        {{ __('Galeri Kegiatan') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.video.index')" :active="request()->routeIs('admin.video.*')">
                        {{ __('Video Panduan') }}
                    </x-nav-link>
                    <x-nav-link href="#" :active="false" class="font-bold text-slate-600">
                        Permohonan Masuk
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-slate-200 text-sm leading-4 font-bold rounded-xl text-slate-600 bg-slate-50 hover:text-slate-900 hover:bg-slate-100 transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-slate-400 font-bold uppercase tracking-widest border-b border-slate-50">
                            Akun Saya
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="font-semibold text-slate-700">
                            {{ __('Profile Settings') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    class="text-red-600 font-bold"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            
            </div>
    </div>
</nav>