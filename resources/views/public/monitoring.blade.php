@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50 min-h-[80vh] flex items-center">
    <div class="max-w-xl mx-auto px-6 w-full">

        {{-- Header Monitoring --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-100 text-amber-600 rounded-[2rem] mb-6 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                Lacak <span class="text-blue-600 font-black">Permohonan</span>
            </h1>
            <p class="mt-4 text-slate-500 font-medium leading-relaxed">
                Masukkan kode permohonan 7 karakter Anda untuk melihat status <br class="hidden md:block"> pemrosesan secara real-time.
            </p>
        </div>

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-6 rounded-2xl animate-fade-in">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold text-red-800 text-sm italic">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white p-8 md:p-12 rounded-[3rem] shadow-2xl shadow-slate-200 border border-slate-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-slate-50 rounded-full -mr-12 -mt-12 opacity-50"></div>

            {{-- Pastikan action mengarah ke /monitoring --}}
            <form action="/monitoring" method="POST" class="space-y-8 relative z-10">
                @csrf

                <div class="group">
                    <label class="block text-sm font-black text-slate-700 mb-3 ml-1 uppercase tracking-widest">
                        Kode Permohonan
                    </label>
                    {{-- name diganti jadi kode_permohonan agar sinkron dengan Controller --}}
                    <input type="text" 
                           name="kode_permohonan" 
                           value="{{ old('kode_permohonan') }}"
                           required
                           maxlength="7"
                           class="w-full bg-slate-50 border-2 border-slate-100 p-5 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-black text-slate-800 placeholder:text-slate-300 placeholder:font-normal text-center tracking-[0.5em] uppercase text-xl"
                           placeholder="3BDE57D">
                    <p class="mt-3 text-[10px] text-slate-400 italic text-center uppercase tracking-wider font-bold">
                        * Masukkan 7 karakter kode unik Anda
                    </p>
                </div>

                <div class="group">
                    <label class="block text-sm font-black text-slate-700 mb-3 ml-1 uppercase tracking-widest">
                        NIK (16 Digit)
                    </label>
                    <input type="text" 
                           name="nik" 
                           value="{{ old('nik') }}"
                           required
                           maxlength="16"
                           class="w-full bg-slate-50 border-2 border-slate-100 p-5 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-bold text-slate-800 placeholder:text-slate-300 placeholder:font-normal"
                           placeholder="Masukkan NIK Pemohon">
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black text-lg hover:bg-blue-900 transition-all shadow-xl shadow-slate-200 transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 group">
                        <span>Lacak Status</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-10 text-center text-slate-400 text-xs font-medium italic">
            Lupa kode permohonan? Silakan cek bukti pendaftaran Anda <br> atau hubungi petugas PPID Belitung Timur.
        </p>

    </div>
</section>
@endsection