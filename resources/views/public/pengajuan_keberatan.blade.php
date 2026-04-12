@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center max-w-3xl mx-auto mb-20">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Pengajuan Keberatan
            </h1>
            <p class="mt-6 text-lg text-slate-600 leading-relaxed font-medium">
                Sesuai Pasal 35 UU No. 14 Tahun 2008, pemohon informasi publik dapat mengajukan keberatan secara tertulis kepada Atasan PPID.
            </p>
            <div class="w-20 h-1 bg-red-500 mx-auto mt-8 rounded-full"></div>
        </div>

        {{-- Main Content --}}
        <div class="grid md:grid-cols-2 gap-16 items-start">

            {{-- KOLOM KIRI : ALASAN --}}
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h2 class="text-2xl font-bold text-slate-800 leading-tight mb-8">
                    Alasan Pengajuan Keberatan
                </h2>

                <div class="space-y-4">
                    @php
                        $reasons = [
                            "Penolakan atas permintaan informasi berdasarkan alasan pengecualian.",
                            "Tidak tersedianya informasi berkala yang wajib diumumkan.",
                            "Tidak ditanggapinya permintaan informasi publik oleh petugas.",
                            "Informasi diberikan tidak sebagaimana yang diminta.",
                            "Permintaan informasi publik tidak dikabulkan tanpa alasan sah.",
                            "Pengenaan biaya yang tidak wajar/tidak sesuai ketentuan.",
                            "Penyampaian informasi melebihi batas waktu yang diatur UU KIP."
                        ];
                    @endphp

                    @foreach($reasons as $i => $reason)
                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-slate-100 text-slate-900 flex items-center justify-center font-bold text-sm group-hover:bg-red-600 group-hover:text-white transition-colors">
                            {{ $i + 1 }}
                        </div>
                        <p class="text-slate-600 leading-relaxed font-medium pt-0.5">
                            {{ $reason }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- KOLOM KANAN : GAMBAR/ALUR --}}
            <div class="sticky top-28">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-amber-500 rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative bg-white p-4 rounded-[2.5rem] shadow-xl border border-slate-100">
                        <img src="{{ asset('img/keberatan.png') }}"
                             alt="Tata Cara Pengajuan Keberatan"
                             class="w-full h-auto rounded-[1.5rem] transition duration-700 group-hover:scale-[1.02]">
                        
                        <div class="mt-6 p-6 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <p class="text-xs text-slate-500 text-center italic">
                                Pastikan Anda telah menerima nomor registrasi permohonan sebelum mengajukan keberatan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer Info --}}
        <div class="mt-24 max-w-4xl mx-auto">
            <div class="bg-red-50 border-l-4 border-red-500 p-8 rounded-2xl">
                <div class="flex gap-6 items-center">
                    <div class="hidden md:flex flex-shrink-0 w-12 h-12 bg-red-100 text-red-600 items-center justify-center rounded-full text-2xl font-black">
                        !
                    </div>
                    <p class="text-red-900 leading-relaxed font-medium">
                        Keberatan harus diajukan paling lambat <span class="font-bold underline text-red-700">30 hari kerja</span> setelah ditemukannya alasan keberatan atau setelah menerima tanggapan dari PPID yang dianggap tidak memuaskan.
                    </p>
                </div>
            </div>
        </div>

        {{-- CTA Button --}}
        <div class="mt-16 text-center">
            <a href="{{ url('/monitoring') }}"
               class="inline-flex items-center gap-4 bg-red-600 text-white px-10 py-5 rounded-2xl font-black text-lg hover:bg-red-700 transition shadow-2xl shadow-red-200 transform hover:-translate-y-2 group">
                <span>Buka Formulir Keberatan</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            <p class="mt-6 text-sm text-slate-400 font-medium italic">
                Layanan ini merupakan bagian dari hak Anda sebagai warga negara.
            </p>
        </div>

    </div>
</section>
@endsection