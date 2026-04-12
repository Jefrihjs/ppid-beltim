@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50">
    <div class="max-w-6xl mx-auto px-8 lg:px-12">

        {{-- Header --}}
        <div class="text-center max-w-3xl mx-auto mb-20">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Penyelesaian Sengketa
            </h1>
            <p class="mt-6 text-lg text-slate-600 leading-relaxed font-medium">
                Penyelesaian sengketa informasi publik dilakukan melalui Komisi Informasi apabila pemohon tidak puas terhadap tanggapan atas keberatan.
            </p>
            <div class="w-20 h-1 bg-blue-600 mx-auto mt-8 rounded-full"></div>
        </div>

        {{-- ================= 2 KOLOM ================= --}}
        <div class="grid md:grid-cols-2 gap-16 items-start">

            {{-- KIRI : TATA CARA --}}
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h2 class="text-2xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                    <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                    Tata Cara Penyelesaian
                </h2>

                <div class="space-y-8">
                    @php
                        $tahapan = [
                            ['t' => 'Pengajuan Permohonan', 'd' => 'Pemohon mengajukan sengketa ke Komisi Informasi paling lambat 14 hari kerja setelah tanggapan keberatan diterima.'],
                            ['t' => 'Registrasi & Pemeriksaan', 'd' => 'Komisi Informasi melakukan registrasi dan pemeriksaan awal terhadap kelengkapan dokumen permohonan.'],
                            ['t' => 'Mediasi / Ajudikasi', 'd' => 'Sengketa diselesaikan melalui jalur mediasi atau ajudikasi non-litigasi sesuai peraturan perundang-undangan.'],
                            ['t' => 'Putusan Akhir', 'd' => 'Komisi Informasi mengeluarkan putusan yang bersifat final dan mengikat bagi para pihak yang bersengketa.']
                        ];
                    @endphp

                    @foreach($tahapan as $i => $item)
                    <div class="group flex gap-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-black group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                            {{ $i + 1 }}
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800 tracking-tight">{{ $item['t'] }}</h3>
                            <p class="mt-1 text-sm text-slate-500 leading-relaxed">{{ $item['d'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- KANAN : GAMBAR (Sticky) --}}
            <div class="md:sticky md:top-28">
                <div class="bg-white p-4 rounded-[2.5rem] shadow-xl border border-slate-100 group">
                    <img src="{{ asset('img/sengketa.png') }}"
                         alt="Alur Penyelesaian Sengketa"
                         class="w-full h-auto rounded-[1.5rem] transition duration-700 group-hover:scale-[1.02]">
                    <div class="mt-4 p-4 bg-blue-50 rounded-xl border border-dashed border-blue-200">
                        <p class="text-[10px] text-blue-700 text-center font-bold uppercase tracking-widest">
                            Infografis Alur Sengketa Informasi
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ================= PDF SECTION ================= --}}
        <div class="mt-32">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-slate-900">Peraturan Terkait</h2>
                <p class="text-slate-500 mt-2 italic">Peraturan Komisi Informasi Nomor 1 Tahun 2013 Tentang Prosedur Penyelesaian Sengketa Informasi Publik</p>
            </div>

            <div class="rounded-[2.5rem] overflow-hidden shadow-2xl border border-slate-200 bg-white p-2">
                <iframe 
                    src="https://drive.google.com/file/d/1TUd4_LtXbqx6H28J3PIIA7SHHwxhqHCr/preview"
                    class="w-full h-[600px] md:h-[900px] lg:h-[1100px] rounded-[1.8rem]"
                    style="border: none; display: block;"
                    allow="autoplay">
                </iframe>
            </div>

            <div class="mt-8 text-center">
                <a href="https://drive.google.com/file/d/1TUd4_LtXbqx6H28J3PIIA7SHHwxhqHCr/view?usp=sharing" 
                   target="_blank" 
                   class="inline-flex items-center gap-3 bg-white border-2 border-slate-200 px-6 py-3 rounded-2xl text-slate-700 font-bold hover:bg-slate-50 hover:border-blue-500 hover:text-blue-600 transition-all group shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Buka PDF di Tab Baru
                </a>
            </div>
        </div>

    </div>
</section>
@endsection