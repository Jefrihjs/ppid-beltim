@extends('layouts.public')

@section('content')

{{-- Hero Section: Menggunakan gradasi yang lebih dalam agar teks putih menonjol --}}
<section class="relative bg-slate-950 py-28 overflow-hidden">
    {{-- Aksen Dekorasi Latar --}}
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
    
    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <span class="inline-block px-4 py-1.5 mb-6 text-xs font-black tracking-[0.2em] text-amber-400 bg-amber-400/10 rounded-full uppercase">
            Legalitas & Privasi
        </span>
        <h1 class="text-4xl md:text-6xl font-black mb-6 text-white tracking-tight">
            Kebijakan <span class="text-amber-500">Privasi</span>
        </h1>
        <p class="text-slate-400 max-w-2xl leading-relaxed text-lg font-medium">
            Komitmen PPID Kabupaten Belitung Timur dalam menjaga dan melindungi kedaulatan data serta informasi setiap pengguna layanan informasi publik.
        </p>
    </div>
</section>

{{-- Content Section: Menggunakan sistem kartu agar teks panjang lebih mudah dibaca --}}
<section class="py-24 bg-slate-50">
    <div class="max-w-5xl mx-auto px-6">
        
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 p-10 md:p-20 space-y-16">
            
            {{-- Pendahuluan --}}
            <div class="group">
                <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-4">
                    <span class="w-2 h-8 bg-amber-500 rounded-full group-hover:scale-y-110 transition-transform"></span>
                    Pendahuluan
                </h2>
                <p class="text-slate-600 leading-relaxed text-lg text-justify font-medium">
                    Website ini dikelola secara resmi oleh <span class="text-slate-900 font-bold">Pejabat Pengelola Informasi dan Dokumentasi (PPID) Kabupaten Belitung Timur</span>. Kami memahami bahwa data pribadi adalah aset berharga, oleh karena itu perlindungan privasi merupakan pilar utama dalam mewujudkan pelayanan informasi yang transparan, akuntabel, dan bertanggung jawab.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                {{-- Informasi yang Dikumpulkan --}}
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100">
                    <h2 class="text-xl font-black text-slate-900 mb-6 uppercase tracking-tight">Data Kolektif</h2>
                    <ul class="space-y-4">
                        @php
                            $items = [
                                'Identitas lengkap pemohon (NIK/KTP)',
                                'Kontak aktif (Email & WhatsApp)',
                                'Dokumen permohonan informasi',
                                'Data teknis (IP Address & Log sistem)'
                            ];
                        @endphp
                        @foreach($items as $item)
                        <li class="flex items-start gap-3 text-slate-600 font-medium">
                            <svg class="w-5 h-5 text-amber-500 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Hak Pengguna --}}
                <div class="bg-slate-900 p-10 rounded-[2.5rem] text-white">
                    <h2 class="text-xl font-black text-amber-500 mb-6 uppercase tracking-tight">Hak Anda</h2>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 opacity-90">
                            <span class="font-bold text-amber-500">&rsaquo;</span>
                            <span>Meminta koreksi data yang tidak akurat.</span>
                        </li>
                        <li class="flex items-start gap-3 opacity-90">
                            <span class="font-bold text-amber-500">&rsaquo;</span>
                            <span>Mengajukan penghapusan data sesuai hukum.</span>
                        </li>
                        <li class="flex items-start gap-3 opacity-90">
                            <span class="font-bold text-amber-500">&rsaquo;</span>
                            <span>Mendapatkan rincian penggunaan data.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Dasar Hukum --}}
            <div class="pt-10 border-t border-slate-100">
                <h2 class="text-2xl font-black text-slate-900 mb-6">Landasan Regulasi</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="p-6 border-2 border-slate-50 rounded-2xl hover:border-amber-500 transition-colors duration-300 group">
                        <p class="text-sm font-black text-slate-400 group-hover:text-amber-600 uppercase tracking-widest mb-2 text-xs">Regulasi 01</p>
                        <p class="text-slate-800 font-bold">Undang-Undang Nomor 14 Tahun 2008</p>
                        <p class="text-xs text-slate-500 mt-1 italic">Tentang Keterbukaan Informasi Publik</p>
                    </div>
                    <div class="p-6 border-2 border-slate-50 rounded-2xl hover:border-amber-500 transition-colors duration-300 group">
                        <p class="text-sm font-black text-slate-400 group-hover:text-amber-600 uppercase tracking-widest mb-2 text-xs">Regulasi 02</p>
                        <p class="text-slate-800 font-bold">Undang-Undang Nomor 27 Tahun 2022</p>
                        <p class="text-xs text-slate-500 mt-1 italic">Tentang Perlindungan Data Pribadi</p>
                    </div>
                </div>
            </div>

            {{-- Penutup --}}
            <div class="bg-amber-50 p-8 rounded-[2rem] border border-amber-100 flex flex-col md:flex-row items-center gap-6">
                <div class="w-16 h-16 bg-amber-500 rounded-2xl flex items-center justify-center text-white text-2xl shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 uppercase text-sm tracking-wide">Pembaruan Kebijakan</h4>
                    <p class="text-slate-600 text-sm mt-1 leading-relaxed">
                        Kami dapat memperbarui kebijakan ini sewaktu-waktu sesuai kebutuhan regulasi. Perubahan akan selalu kami tampilkan secara transparan di halaman ini. 
                        <span class="block mt-2 font-bold text-slate-400 text-[10px] tracking-widest">TERAKHIR DIPERBARUI: {{ date('d F Y') }}</span>
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection