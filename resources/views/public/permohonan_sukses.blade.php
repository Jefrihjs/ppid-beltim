@extends('layouts.public')

@section('content')
<section class="py-20 px-4 max-w-2xl mx-auto text-center">
    {{-- Ikon Sukses --}}
    <div class="mb-8 flex justify-center">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-inner">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    </div>

    <h1 class="text-3xl font-black text-slate-900 mb-4">
        Permohonan Berhasil Disampaikan
    </h1>

    <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-8 mb-8 relative overflow-hidden">
        {{-- Label Biru di pojok --}}
        <div class="absolute top-0 right-0 p-2 bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest rounded-bl-xl">
            KODE MONITORING
        </div>
        
        <p class="text-sm text-slate-500 font-bold uppercase tracking-widest mb-2">KODE PERMOHONAN :</p>
        
        {{-- Menampilkan Kode --}}
        <div class="text-4xl font-black text-blue-600 tracking-wider font-mono">
            {{ Session::get('kode') }}
        </div>
    </div>

    <div class="space-y-6 text-slate-600 leading-relaxed text-sm">
        <p>
            Mohon dicatat / disimpan dengan baik <span class="font-bold text-slate-900">kode permohonan</span> ini untuk melakukan proses monitoring ataupun pengajuan keberatan terhadap permohonan yang telah disampaikan.
        </p>
        
        <p>
            Anda juga dapat melakukan unduh bukti pengajuan permohonan melalui tautan di bawah ini.
        </p>
    </div>

    {{-- Banner SKM - Selipkan di Sini --}}
    <div class="mt-12 mb-10 p-8 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 relative group transition-all hover:shadow-xl hover:shadow-emerald-900/5">
        {{-- Aksen Dekorasi --}}
        <div class="absolute -top-4 -right-4 w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg rotate-12 group-hover:rotate-0 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>

        <div class="text-left">
            <h3 class="text-lg font-black text-slate-900 mb-2">Bantu Kami Menjadi Lebih Baik!</h3>
            <p class="text-xs text-slate-600 leading-relaxed font-medium mb-6">
                Mohon kesediaan Anda untuk mengisi **Survei Kepuasan Masyarakat (SKM)** guna meningkatkan kualitas layanan informasi publik di Pemerintah Kabupaten Belitung Timur.
            </p>
            
            <a href="https://survei.beltim.go.id/view/SKM2207274439" target="_blank" 
               class="inline-flex items-center gap-3 bg-emerald-600 text-white px-8 py-3.5 rounded-xl font-black text-[10px] uppercase tracking-[0.15em] hover:bg-emerald-700 transition shadow-lg shadow-emerald-200">
                <span>Mulai Survei Kepuasan</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </div>

    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
        {{-- Tombol Monitoring --}}
        <a href="{{ route('monitoring.form') }}"
           class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-100 flex items-center justify-center gap-2 text-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            Monitoring Status
        </a>

        {{-- Tombol Cetak Bukti --}}
        @if(session('kode'))
            <a href="{{ route('permohonan.cetak_bukti', ['kode' => session('kode')]) }}" 
            class="bg-white text-slate-900 border-2 border-slate-900 px-8 py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition flex items-center justify-center gap-2 text-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2v4"></path>
                </svg>
                Unduh Bukti
            </a>
        @else
            {{-- Jika session habis, arahkan balik ke form atau beri pesan --}}
            <a href="{{ route('permohonan.create') }}" 
            class="bg-slate-100 text-slate-400 px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs cursor-not-allowed">
                Sesi Berakhir (Isi Ulang)
            </a>
        @endif
    </div>
</section>
@endsection