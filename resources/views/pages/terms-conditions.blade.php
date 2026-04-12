@extends('layouts.public')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-slate-950 py-28 overflow-hidden">
    {{-- Aksen Dekorasi --}}
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
    
    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <span class="inline-block px-4 py-1.5 mb-6 text-xs font-black tracking-[0.2em] text-amber-400 bg-amber-400/10 rounded-full uppercase">
            Legalitas & Prosedur
        </span>
        <h1 class="text-4xl md:text-6xl font-black mb-6 text-white tracking-tight">
            Syarat & <span class="text-amber-500">Ketentuan</span>
        </h1>
        <p class="text-slate-400 max-w-2xl leading-relaxed text-lg font-medium">
            Ketentuan penggunaan layanan informasi publik pada portal PPID Kabupaten Belitung Timur guna mewujudkan tata kelola informasi yang tertib.
        </p>
    </div>
</section>

{{-- Content Section --}}
<section class="py-24 bg-slate-50">
    <div class="max-w-5xl mx-auto px-6">
        
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 p-10 md:p-20 space-y-16">
            
            {{-- Ketentuan Umum --}}
            <div class="group">
                <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-4">
                    <span class="w-2 h-8 bg-amber-500 rounded-full group-hover:scale-y-110 transition-transform"></span>
                    Ketentuan Umum
                </h2>
                <p class="text-slate-600 leading-relaxed text-lg text-justify font-medium">
                    Layanan ini merupakan sarana resmi pelayanan informasi publik yang dikelola oleh <span class="text-slate-900 font-bold">PPID Kabupaten Belitung Timur</span> sesuai dengan amanat UU No. 14 Tahun 2008. Dengan mengakses portal ini, Anda dianggap telah memahami dan menyetujui seluruh ketentuan yang berlaku.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-10">
                {{-- Ruang Lingkup --}}
                <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900 mb-6 uppercase tracking-tight">Ruang Lingkup</h3>
                    <ul class="space-y-4">
                        @php
                            $scopes = ['Permohonan Informasi Publik', 'Pengajuan Keberatan Layanan', 'Monitoring Status Real-time', 'Korespondensi Kontak Resmi'];
                        @endphp
                        @foreach($scopes as $scope)
                        <li class="flex items-center gap-3 text-sm text-slate-600 font-bold">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            {{ $scope }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kewajiban Pengguna --}}
                <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white shadow-xl">
                    <h3 class="text-lg font-black text-amber-500 mb-6 uppercase tracking-tight">Kewajiban Anda</h3>
                    <ul class="space-y-4 text-sm font-medium opacity-90">
                        <li class="flex gap-3"><span class="text-amber-500 font-black">01.</span> Mengisi data secara jujur & valid.</li>
                        <li class="flex gap-3"><span class="text-amber-500 font-black">02.</span> Tidak menyalahgunakan informasi.</li>
                        <li class="flex gap-3"><span class="text-amber-500 font-black">03.</span> Menjaga etika berkomunikasi.</li>
                    </ul>
                </div>
            </div>

            {{-- Informasi Dikecualikan - Penting --}}
            <div class="pt-10 border-t border-slate-100">
                <h2 class="text-2xl font-black text-slate-900 mb-6">Informasi yang Dikecualikan</h2>
                <div class="bg-red-50 border-l-4 border-red-500 p-8 rounded-2xl flex flex-col md:flex-row gap-6 items-center">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0-6V9m0-6a9 9 0 110 18 9 9 0 010-18z"/></svg>
                    </div>
                    <p class="text-red-900 font-medium leading-relaxed">
                        Perlu dipahami bahwa tidak semua informasi dapat diberikan kepada publik. Kami berhak menolak permohonan apabila informasi tersebut termasuk dalam kategori <span class="font-black underline">Informasi Dikecualikan</span> sesuai dengan Pasal 17 UU No. 14 Tahun 2008.
                    </p>
                </div>
            </div>

            {{-- Hak PPID --}}
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Kewenangan PPID</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Kami berhak melakukan verifikasi identitas, meminta klarifikasi tambahan, serta menolak permohonan yang tidak sesuai dengan prosedur hukum yang berlaku di Kabupaten Belitung Timur.
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Batasan Tanggung Jawab</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        PPID tidak bertanggung jawab atas kerugian yang timbul akibat kesalahan pengisian data oleh pengguna atau penyalahgunaan informasi publik oleh pihak pemohon.
                    </p>
                </div>
            </div>

            {{-- Penutup --}}
            <div class="bg-amber-50 p-8 rounded-[2rem] border border-amber-100 flex flex-col md:flex-row items-center gap-6">
                <div class="w-16 h-16 bg-amber-500 rounded-2xl flex items-center justify-center text-white text-2xl shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 uppercase text-xs tracking-widest">Pembaruan Ketentuan</h4>
                    <p class="text-slate-600 text-sm mt-1 leading-relaxed font-medium">
                        Syarat dan ketentuan ini bersifat dinamis dan dapat diperbarui sewaktu-waktu mengikuti dinamika regulasi di Kabupaten Belitung Timur. 
                        <span class="block mt-2 font-bold text-slate-400 text-[10px] tracking-widest uppercase italic">Update: {{ date('d F Y') }}</span>
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection