@extends('layouts.public')

@section('content')

<section class="pt-28 pb-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col md:flex-row gap-6">

            <!-- SIDEBAR -->
            <aside class="md:w-64 w-full bg-white rounded-xl shadow-sm p-6">

                <h3 class="font-semibold text-lg mb-6 text-slate-800">
                    Profil PPID
                </h3>

                <nav class="space-y-2 text-slate-700">

                    <a href="{{ route('profil.tentang') }}"
                       class="block px-4 py-2 rounded
                       {{ request()->routeIs('profil.tentang') ? 'bg-blue-100 text-blue-800 font-semibold' : 'hover:bg-slate-100' }}">
                        Profil PPID Beltim
                    </a>

                    <a href="{{ route('profil.maklumat') }}"
                       class="block px-4 py-2 rounded
                       {{ request()->routeIs('profil.maklumat') ? 'bg-blue-100 text-blue-800 font-semibold' : 'hover:bg-slate-100' }}">
                        Maklumat
                    </a>

                    <a href="{{ route('profil.struktur') }}"
                       class="block px-4 py-2 rounded
                       {{ request()->routeIs('profil.struktur') ? 'bg-blue-100 text-blue-800 font-semibold' : 'hover:bg-slate-100' }}">
                        Struktur Organisasi
                    </a>

                    <a href="{{ route('profil.visi') }}"
                       class="block px-4 py-2 rounded
                       {{ request()->routeIs('profil.visi') ? 'bg-blue-100 text-blue-800 font-semibold' : 'hover:bg-slate-100' }}">
                        Visi Misi
                    </a>

                </nav>

            </aside>

            <!-- CONTENT -->
            <div class="flex-1 bg-white rounded-xl shadow-sm p-8">
                @include($view)
            </div>

        </div>

    </div>
</section>

@endsection