@extends('layouts.public')

@section('content')
<section class="py-24 bg-slate-50">
    <div class="max-w-4xl mx-auto px-6">

        {{-- Header Form --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                Permohonan <span class="text-blue-600 font-black">Informasi</span>
            </h1>
            <p class="mt-4 text-slate-500 font-medium italic">
                Sesuai UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
            </p>
            <div class="w-16 h-1.5 bg-amber-500 mx-auto mt-6 rounded-full"></div>
        </div>

        @if ($errors->any())
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-6 rounded-2xl shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    <span class="font-bold text-red-800 uppercase text-xs tracking-widest">Ada Kesalahan Input</span>
                </div>
                <ul class="list-disc ml-10 text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/permohonan" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- SECTION 1: IDENTITAS --}}
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h2 class="text-xl font-black text-slate-800 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">01</span>
                    Identitas Pemohon
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Kategori Pemohon</label>
                        <select name="kategori_pemohon" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-medium">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="perorangan" {{ old('kategori_pemohon') == 'perorangan' ? 'selected' : '' }}>Perorangan</option>
                            <option value="lembaga" {{ old('kategori_pemohon') == 'lembaga' ? 'selected' : '' }}>Lembaga / Organisasi</option>
                        </select>
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">NIK (Sesuai KTP)</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Alamat Domisili</label>
                        <textarea name="alamat" rows="3" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all resize-none">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Email Aktif</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nomor HP / WhatsApp</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                    </div>
                </div>
            </div>

            {{-- SECTION 2: DETAIL PERMOHONAN --}}
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h2 class="text-xl font-black text-slate-800 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-sm">02</span>
                    Detail Informasi
                </h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Rincian Informasi yang Diminta</label>
                        <textarea name="rincian_informasi" rows="4" placeholder="Sebutkan secara spesifik data/dokumen yang anda perlukan..." class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all resize-none">{{ old('rincian_informasi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Tujuan Penggunaan Informasi</label>
                        <textarea name="tujuan_penggunaan" rows="3" placeholder="Contoh: Skripsi / Penelitian / Berita..." class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all resize-none">{{ old('tujuan_penggunaan') }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Cara Memperoleh</label>
                            <select name="cara_memperoleh" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-medium text-sm">
                                <option value="">-- Pilih --</option>
                                <option value="melihat">Melihat</option>
                                <option value="membaca">Membaca</option>
                                <option value="mencatat">Mencatat</option>
                                <option value="hardcopy">Salinan Fisik</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Jenis Salinan</label>
                            <select name="jenis_salinan" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-medium text-sm">
                                <option value="">-- Pilih --</option>
                                <option value="softcopy">Softcopy (Digital)</option>
                                <option value="hardcopy">Hardcopy (Kertas)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Cara Pengiriman</label>
                            <select name="cara_pengiriman" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-medium text-sm">
                                <option value="">-- Pilih --</option>
                                <option value="email">E-Mail</option>
                                <option value="diambil">Ambil Langsung</option>
                                <option value="ekspedisi">Pos / Kurir</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOMBOL SUBMIT --}}
            <div class="text-center pt-6">
                <button type="submit"
                    class="inline-flex items-center gap-3 bg-slate-900 text-white px-12 py-5 rounded-3xl font-black text-lg hover:bg-blue-900 transition shadow-2xl shadow-slate-300 transform hover:-translate-y-1 active:scale-95">
                    <span>Kirim Permohonan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
                <p class="mt-6 text-sm text-slate-400 font-medium italic">
                    Data anda terenkripsi dan hanya digunakan untuk verifikasi PPID.
                </p>
            </div>

        </form>

    </div>
</section>
@endsection