{{-- Update Berdasarkan SK Bupati No. 359 Tahun 2025 --}}
<div class="flex flex-col items-center">

    {{-- LEVEL 1: PEMBINA --}}
    <div class="org-card border-amber-500">
        <div class="org-badge bg-amber-500">PEMBINA</div>
        <h3 class="text-2xl font-black text-slate-800 uppercase">Bupati & Wakil Bupati</h3>
    </div>

    <div class="w-1 h-8 bg-slate-300"></div>

    {{-- LEVEL 2: ATASAN --}}
    <div class="org-card border-blue-600">
        <div class="org-badge bg-blue-600">ATASAN PPID</div>
        <h3 class="text-xl font-black text-slate-800 uppercase">Sekretaris Daerah</h3>
    </div>

    <div class="w-1 h-8 bg-slate-300"></div>

    {{-- LEVEL BARU: DEWAN PERTIMBANGAN --}}
    <div class="org-card border-slate-400 max-w-2xl py-6">
        <div class="org-badge bg-slate-500 text-white">DEWAN PERTIMBANGAN</div>
        <p class="text-[10px] font-bold text-slate-600 leading-relaxed uppercase">
            Para Asisten Sekda • Inspektur • Kepala BPKPD
        </p>
    </div>

    <div class="w-1 h-8 bg-slate-300"></div>

    {{-- LEVEL 3: PPID UTAMA (KETUA) --}}
    <div class="relative bg-white rounded-3xl shadow-md p-10 text-center w-full max-w-2xl border-2 border-amber-500">
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-6 py-1.5 bg-slate-800 text-white rounded-full text-xs font-black tracking-[0.2em]">
            PPID UTAMA / KETUA
        </div>
        <p class="text-slate-800 text-lg font-bold leading-relaxed uppercase">
            Kepala Dinas Komunikasi, Informatika, <br> Statistik dan Persandian
        </p>
        <p class="text-blue-600 text-[10px] mt-2 font-black uppercase tracking-widest">Sekretaris: Kabid IKP Diskominfo</p>
    </div>

    <div class="w-1 h-12 bg-slate-300 my-2"></div>

    {{-- CONTAINER BIDANG (4 BIDANG UTAMA SK 2025) --}}
    <div class="relative w-full max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $bidangSK = [
                    ["nama" => "Pelayanan Informasi & Dokumentasi", "ketua" => "Kabag Umum Setda"],
                    ["nama" => "Pengelolaan Informasi & Dokumentasi", "ketua" => "Bappelitbangda"],
                    ["nama" => "Dokumentasi & Arsip", "ketua" => "Kadin Kearsipan & Perpustakaan"],
                    ["nama" => "Pengaduan & Penyelesaian Sengketa", "ketua" => "Kabag Hukum Setda"]
                ];
            @endphp

            @foreach($bidangSK as $b)
            <div class="bg-white border-2 border-slate-100 rounded-3xl p-6 text-center shadow-sm hover:border-blue-400 transition-all">
                <div class="text-[9px] font-black text-blue-500 uppercase mb-2">Bidang</div>
                <p class="text-[11px] font-black text-slate-800 uppercase leading-tight mb-3">{{ $b['nama'] }}</p>
                <div class="pt-3 border-t border-slate-50">
                    <p class="text-[9px] font-bold text-slate-400 uppercase italic">Ketua: {{ $b['ketua'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="w-1 h-12 bg-slate-300 mt-10"></div>

    {{-- SEKRETARIAT & FUNGSIONAL --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl">
        <div class="org-card border-emerald-500 py-6">
            <div class="org-badge bg-emerald-500 text-white text-[9px]">PENDUKUNG SEKRETARIAT</div>
            <p class="text-slate-700 font-bold text-xs uppercase">Kasubag Umum & Kepegawaian Diskominfo</p>
        </div>
        <div class="org-card border-slate-800 py-6">
            <div class="org-badge bg-slate-800 text-white text-[9px]">PEJABAT FUNGSIONAL</div>
            <p class="text-slate-700 font-bold text-xs uppercase">Pranata Komputer • Arsiparis • Humas</p>
        </div>
    </div>
</div>