@extends('layouts.public')

@section('content')
<section class="pt-32 pb-20 px-6 bg-slate-50">
    <div class="max-w-4xl mx-auto">
        {{-- Header Halaman --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-full mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2l4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 5.04c-.233.63-.382 1.303-.382 2.016 0 5.523 4.477 10 10 10s10-4.477 10-10c0-.713-.149-1.386-.382-2.016z" />
                </svg>
                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Regulasi Publik</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 leading-tight">Uji Konsekuensi Informasi</h1>
            <p class="text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Transparansi dan akuntabilitas dalam pengujian informasi publik yang dikecualikan sesuai dengan amanat UU No. 14 Tahun 2008.
            </p>
        </div>

        {{-- Konten Utama --}}
        <div class="space-y-8">
            {{-- Kartu Definisi --}}
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-slate-100 leading-relaxed text-slate-600">
                <p class="mb-6">
                    <span class="font-bold text-slate-900">Uji Konsekuensi Informasi</span> adalah proses pengujian yang wajib dilakukan oleh badan publik terhadap informasi yang dihasilkan, disimpan, dikelola, dikirim, dan/atau diterima sebelum menolak permohonan informasi publik dari pemohon informasi publik atas dasar pengecualian karena bersifat rahasia sesuai undang – undang, kapatutan, dan kepentingan umum sebagaimana diatur dalam <span class="text-blue-600 font-bold">Undang – Undang Nomor 14 Tahun 2008</span>.
                </p>
                <p>
                    Pejabat Pengelola Informasi dan Dokumentasi (PPID) di setiap Badan Publik wajib melakukan pengujian tentang konsekuensi sebagaimana diatur pada pasal 17 UU Nomor 14 Tahun 2008 dengan seksama dan penuh ketelitian sebelum menyatakan informasi publik tertentu dikecualikan untuk diakses oleh setiap orang sebagaimana yang diatur pada pasal 19 UU Nomor 14 Tahun 2008.
                </p>
            </div>

            {{-- Kartu Mekanisme --}}
            <div class="bg-blue-600 p-8 md:p-12 rounded-[2.5rem] text-white shadow-xl shadow-blue-200">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black mb-4 uppercase tracking-tight">Koordinasi & Klasifikasi</h2>
                        <p class="text-blue-50/80 leading-relaxed font-medium">
                            Dalam melakukan Uji Konsekuensi, PPID berkoordinasi dengan pejabat pada unit kerja yang menguasai dan mengelola informasi tertentu untuk melakukan pengklasifikasian informasi publik. Koordinasi tersebut sebagai dasar pembuatan pertimbangan tertulis yang dilakukan secara seksama dan teliti.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Link Dokumen --}}
            <div class="grid md:grid-cols-2 gap-6 mt-12">
                <a href="#" class="group bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-red-500/10 hover:border-red-100 transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-red-600 uppercase tracking-widest leading-none mb-1">Daftar Dokumen</p>
                            <h3 class="font-bold text-slate-900 group-hover:text-red-600 transition-colors">Informasi Dikecualikan</h3>
                        </div>
                    </div>
                </a>

                <a href="#" class="group bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 hover:border-emerald-100 transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest leading-none mb-1">Jangka Waktu</p>
                            <h3 class="font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">Habis Masa Pengecualian</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection