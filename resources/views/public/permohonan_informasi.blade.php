@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center max-w-3xl mx-auto mb-20">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Prosedur Permohonan
            </h1>
            <p class="mt-6 text-lg text-slate-600 leading-relaxed font-medium italic">
                Tata cara pengajuan permohonan informasi publik pada PPID Kabupaten Belitung Timur.
            </p>
            <div class="w-20 h-1 bg-amber-500 mx-auto mt-8 rounded-full"></div>
        </div>

        {{-- Tata Cara - List Gaya Modern --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-10 md:p-16">
            <h2 class="text-2xl font-bold text-slate-800 mb-10 flex items-center gap-3">
                <span class="w-2 h-8 bg-amber-500 rounded-full"></span>
                Tahapan Pengajuan
            </h2>
            
            <div class="grid gap-8">
                @php
                    $steps = [
                        "Pemohon mengisi formulir permohonan informasi secara online melalui website resmi PPID Kabupaten Belitung Timur.",
                        "Pemohon wajib melampirkan identitas diri yang sah (KTP/SIM/Paspor) dalam format digital pada formulir yang tersedia.",
                        "Petugas PPID akan melakukan verifikasi terhadap kelengkapan berkas dan kejelasan tujuan permohonan informasi.",
                        "Jawaban diberikan paling lambat 10 (sepuluh) hari kerja dan dapat diperpanjang 7 (tujuh) hari kerja sesuai ketentuan UU KIP.",
                        "Apabila pemohon tidak puas terhadap jawaban atau tanggapan, pemohon berhak mengajukan keberatan sesuai prosedur."
                    ];
                @endphp

                @foreach($steps as $i => $step)
                <div class="flex gap-6 group">
                    <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-slate-900 text-amber-400 flex items-center justify-center font-black shadow-lg">
                        {{ $i + 1 }}
                    </div>
                    <p class="text-slate-700 leading-relaxed pt-1 font-medium group-hover:text-slate-900 transition-colors">
                        {{ $step }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Alur Visual - Horizontal --}}
        <div class="mt-32">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900">Alur Permohonan</h2>
                <p class="mt-2 text-slate-500">Visualisasi proses layanan informasi publik</p>
            </div>

            <div class="relative">
                {{-- Progress Line --}}
                <div class="hidden md:block absolute top-12 left-0 right-0 h-1 bg-slate-200"></div>

                <div class="grid md:grid-cols-4 gap-10 relative">
                    {{-- Loop Alur --}}
                    @php
                        $alur = [
                            ['label' => 'Ajukan', 'desc' => 'Isi Form & Identitas', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2-2V5a2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                            ['label' => 'Verifikasi', 'desc' => 'Pemeriksaan Berkas', 'icon' => 'M9 12l2 2l4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['label' => 'Jawaban', 'desc' => 'Maks. 10+7 Hari', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['label' => 'Selesai', 'desc' => 'Informasi Diterima', 'icon' => 'M5 13l4 4L19 7'],
                        ];
                    @endphp

                    @foreach($alur as $item)
                    <div class="text-center relative group">
                        <div class="relative z-10 w-20 h-20 mx-auto flex items-center justify-center rounded-3xl bg-white border-2 border-slate-100 shadow-sm text-slate-900 group-hover:bg-slate-900 group-hover:text-amber-400 transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="mt-6 font-bold text-slate-900 uppercase tracking-wide text-sm">{{ $item['label'] }}</h3>
                        <p class="mt-2 text-xs text-slate-500 font-medium">{{ $item['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
                <h3 class="text-3xl font-extrabold text-slate-900">Jika Tidak Puas Dengan Jawaban?</h3>
        </div>

        {{-- Kondisi Khusus / Sengketa --}}
        <div class="mt-12 grid md:grid-cols-3 gap-8">

            
            <div class="bg-amber-50 p-8 rounded-[2rem] border border-amber-100 text-center hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-amber-500 text-white rounded-2xl mx-auto flex items-center justify-center font-black text-xl mb-6">!</div>
                <h4 class="font-bold text-slate-800 mb-2">Keberatan</h4>
                <p class="text-sm text-slate-600">Pemohon dapat mengajukan keberatan kepada Atasan PPID.</p>
            </div>

            <div class="bg-slate-900 p-8 rounded-[2rem] text-center shadow-xl">
                <div class="w-12 h-12 bg-amber-500 text-slate-900 rounded-2xl mx-auto flex items-center justify-center font-black text-xl mb-6">✔</div>
                <h4 class="font-bold text-white mb-2">Tanggapan</h4>
                <p class="text-sm text-slate-300">Atasan PPID memberikan tanggapan resmi secara tertulis.</p>
            </div>

            <div class="bg-amber-50 p-8 rounded-[2rem] border border-amber-100 text-center hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-amber-500 text-white rounded-2xl mx-auto flex items-center justify-center font-black text-xl mb-6">⚖</div>
                <h4 class="font-bold text-slate-800 mb-2">Sengketa</h4>
                <p class="text-sm text-slate-600">Penyelesaian melalui Komisi Informasi jika mediasi gagal.</p>
            </div>
        </div>

        {{-- Call to Action --}}
        <div class="mt-12 text-center">
            <a href="{{ url('/permohonan') }}" 
               class="inline-flex items-center gap-3 bg-slate-900 text-white px-10 py-5 rounded-2xl font-bold hover:bg-slate-800 transition transform hover:-translate-y-1 shadow-2xl shadow-slate-200">
                <span>Buka Formulir Online</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            <p class="mt-6 text-sm text-slate-400 font-medium italic">
                Layanan ini gratis dan terenkripsi secara aman.
            </p>
        </div>

    </div>
</section>
@endsection