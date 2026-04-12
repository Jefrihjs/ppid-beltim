@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center max-w-3xl mx-auto mb-20">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Layanan Informasi Publik
            </h1>
            <p class="mt-6 text-lg text-slate-600 leading-relaxed font-medium">
                PPID Kabupaten Belitung Timur menyediakan akses informasi yang transparan, akuntabel, dan cepat sesuai standar layanan informasi publik nasional.
            </p>
            <div class="w-20 h-1 bg-amber-500 mx-auto mt-8 rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- 1 Permohonan Informasi --}}
            <a href="{{ url('/permohonan-informasi') }}"
               class="group bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-slate-200/60 hover:-translate-y-2 transition-all duration-500">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="font-bold text-xl text-slate-800">Permohonan Informasi</h3>
                <p class="mt-4 text-slate-500 leading-relaxed text-sm">
                    Ajukan permintaan data atau dokumen publik. Proses verifikasi maksimal 10 hari kerja.
                </p>
            </a>

            {{-- 2 Pengajuan Keberatan --}}
            <a href="{{ url('/pengajuan-keberatan') }}"
               class="group bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-slate-200/60 hover:-translate-y-2 transition-all duration-500">
                <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-8 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="font-bold text-xl text-slate-800">Pengajuan Keberatan</h3>
                <p class="mt-4 text-slate-500 leading-relaxed text-sm">
                    Sampaikan keberatan atas pelayanan informasi yang tidak sesuai ketentuan.
                </p>
            </a>

            {{-- 3 Penyelesaian Sengketa --}}
            <a href="{{ url('/penyelesaian-sengketa') }}"
               class="group bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-slate-200/60 hover:-translate-y-2 transition-all duration-500">
                <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 mb-8 group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <h3 class="font-bold text-xl text-slate-800">Penyelesaian Sengketa</h3>
                <p class="mt-4 text-slate-500 leading-relaxed text-sm">
                    Informasi mengenai tata cara mediasi dan ajudikasi melalui Komisi Informasi.
                </p>
            </a>

            {{-- 4 Daftar Informasi Publik --}}
            <a href="#"
               class="group bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-slate-200/60 hover:-translate-y-2 transition-all duration-500">
                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-600 mb-8 group-hover:bg-slate-900 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="font-bold text-xl text-slate-800">Daftar Informasi Publik</h3>
                <p class="mt-4 text-slate-500 leading-relaxed text-sm">
                    Kumpulan data yang wajib diumumkan secara berkala, serta merta, dan setiap saat.
                </p>
            </a>

            {{-- 5 Cek Status --}}
            <a href="{{ url('/monitoring') }}"
               class="group bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-slate-200/60 hover:-translate-y-2 transition-all duration-500">
               <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-8 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="font-bold text-xl text-slate-800">Lacak Permohonan</h3>
                <p class="mt-4 text-slate-500 leading-relaxed text-sm">
                    Gunakan kode registrasi Anda untuk memantau progres permohonan secara real-time.
                </p>
            </a>

        </div>

        <div class="mt-24 p-10 bg-white border border-slate-100 rounded-[3rem] shadow-sm text-center">
             <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-700 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                Informasi Biaya
             </div>
             <p class="text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Seluruh layanan informasi publik <strong>tidak dipungut biaya</strong>, kecuali biaya penggandaan atau pengiriman jika pemohon meminta dokumen dalam bentuk fisik.
             </p>
        </div>

    </div>
</section>
@endsection