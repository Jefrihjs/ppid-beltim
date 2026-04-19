@extends('layouts.public')

@section('content')
{{-- Satukan semua variabel di sini Jef --}}
<section class="py-24 bg-slate-50" x-data="{ kategori: '{{ old('kategori_pemohon') }}', setuju: false, nik: '{{ old('nik') }}' }">
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

        {{-- Error handling --}}
        @if ($errors->any())
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-6 rounded-2xl shadow-sm">
                <ul class="list-disc ml-10 text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/permohonan" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

             {{-- Informasi Pelindungan Data Pribadi --}}
            <div class="mt-20 max-w-3xl mx-auto p-6 bg-amber-50 rounded-[2rem] border border-amber-100 flex gap-4 items-start text-left">
                <div class="flex-shrink-0 w-12 h-12 bg-amber-500 text-white rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-black text-amber-700 uppercase tracking-widest mb-1">Pemberitahuan Keamanan Data</h4>
                    <p class="text-[11px] md:text-xs text-slate-600 leading-relaxed font-medium">
                        Pemerintah Kabupaten Belitung Timur menjamin kerahasiaan identitas (KTP) yang Anda unggah. Data ini hanya digunakan untuk keperluan verifikasi permohonan informasi publik sesuai **UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi** dan tidak akan dipublikasikan.
                    </p>
                </div>
            </div>
            
            {{-- SECTION 1: IDENTITAS PEMOHON --}}
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h2 class="text-xl font-black text-slate-800 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">01</span>
                    Identitas Pemohon
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Kategori Select --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Kategori Pemohon</label>
                        <select name="kategori_pemohon" 
                                x-model="kategori"
                                class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-medium">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="perorangan">Perorangan</option>
                            <option value="lembaga">Lembaga / Organisasi</option>
                        </select>
                    </div>

                    {{-- NIK  --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">
                            Nomor Identitas / NIK <span x-text="kategori === 'lembaga' ? 'Pimpinan' : 'Pribadi'">Pribadi</span>
                        </label>
                        <input type="text" 
                            name="nik" 
                            x-model="nik"
                            maxlength="16"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                            placeholder="Masukkan 16 digit NIK"
                            class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-blue-500 font-bold"
                            :class="nik.length > 0 && nik.length < 16 ? 'border-red-500 ring-4 ring-red-500/10' : ''">
                        
                        {{-- Pesan Peringatan --}}
                        <p x-show="nik.length > 0 && nik.length < 16" 
                        class="mt-2 text-[10px] text-red-500 font-bold animate-pulse">
                            ⚠️ NIK harus 16 digit! (Saat ini: <span x-text="nik.length"></span> digit)
                        </p>
                    </div>

                    {{-- Nama (Label Berubah Dinamis) --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">
                            Nama Lengkap <span x-text="kategori === 'lembaga' ? 'Pimpinan' : ''"></span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-blue-500">
                    </div>

                    {{-- Upload KTP --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">
                            Upload KTP <span x-text="kategori === 'lembaga' ? 'Pimpinan' : 'Pribadi'">Pribadi</span>*
                        </label>
                        <input type="file" name="file_ktp" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-2 text-[10px] text-slate-400 italic">*Format .jpg/.jpeg/.png (Maks 1 MB)</p>
                    </div>

                    {{-- Field Khusus Lembaga (Muncul hanya jika kategori === 'lembaga') --}}
                    <div class="md:col-span-1" x-show="kategori === 'lembaga'" x-cloak x-transition>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Upload Akta Notaris Lembaga*</label>
                        <input type="file" name="file_akta" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                        <p class="mt-2 text-[10px] text-slate-400 italic">*Format .jpg/.jpeg/.png (Maks 1 MB)</p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Alamat</label>
                        <textarea name="alamat" rows="2" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-blue-500 resize-none">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Email (Opsional)</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-blue-500">
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nomor Ponsel / WA</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>

            {{-- SECTION 2: DATA PERMOHONAN --}}
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h2 class="text-xl font-black text-slate-800 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-sm">02</span>
                    Data Permohonan
                </h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Rincian Informasi</label>
                        <textarea name="rincian_informasi" rows="3" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-amber-500 resize-none">{{ old('rincian_informasi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Tujuan Penggunaan Informasi</label>
                        <textarea name="tujuan_penggunaan" rows="2" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-amber-500 resize-none">{{ old('tujuan_penggunaan') }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Cara Memperoleh --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Cara Memperoleh Informasi</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(['Melihat', 'Membaca', 'Mendengarkan', 'Mencatat'] as $cara)
                                <label class="flex items-center gap-2 p-3 bg-slate-50 rounded-xl border border-slate-100 hover:bg-white hover:border-blue-500 transition cursor-pointer text-xs font-bold text-slate-600">
                                    <input type="radio" name="cara_memperoleh" value="{{ strtolower($cara) }}" class="text-blue-600"> {{ $cara }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Mendapatkan Salinan --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Mendapatkan Salinan Informasi</label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex items-center gap-2 p-3 bg-slate-50 rounded-xl border border-slate-100 hover:bg-white hover:border-blue-500 transition cursor-pointer text-xs font-bold text-slate-600">
                                    <input type="radio" name="jenis_salinan" value="softcopy" class="text-blue-600"> Softcopy
                                </label>
                                <label class="flex items-center gap-2 p-3 bg-slate-50 rounded-xl border border-slate-100 hover:bg-white hover:border-blue-500 transition cursor-pointer text-xs font-bold text-slate-600">
                                    <input type="radio" name="jenis_salinan" value="hardcopy" class="text-blue-600"> Hardcopy
                                </label>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ caraKirim: '{{ old('cara_pengiriman') }}' }">
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Cara Mendapatkan Salinan Informasi</label>
                            <select name="cara_pengiriman" 
                                    x-model="caraKirim"
                                    class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:border-amber-500 font-medium transition-all">
                                <option value="">-- Pilih Cara Pengiriman --</option>
                                <option value="diambil">Mengambil Langsung</option>
                                <option value="email">Melalui E-Mail</option>
                                <option value="whatsapp">WhatsApp (Fast Response)</option>
                            </select>
                        </div>

                        <div x-show="caraKirim === 'whatsapp'" 
                            x-cloak 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            class="mb-6">
                            <label class="block text-[10px] font-black text-blue-600 uppercase tracking-widest mb-2 ml-1">Konfirmasi Nomor WhatsApp Aktif</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-400 font-bold text-sm">+62</span>
                                </div>
                                <input type="text" 
                                    name="no_wa" 
                                    value="{{ old('no_wa') }}" 
                                    placeholder="812xxxxxxx"
                                    class="w-full bg-blue-50/50 border border-blue-200 pl-12 p-4 rounded-2xl outline-none focus:border-blue-500 font-bold text-slate-700 placeholder:font-normal">
                            </div>
                            <p class="mt-2 text-[10px] text-blue-400 italic font-medium">*Pastikan nomor terhubung dengan aplikasi WhatsApp untuk pengiriman file.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ setuju: false }" class="space-y-6">
                
                <div class="mt-6 p-4 bg-blue-50 rounded-2xl border border-blue-100">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" x-model="setuju" class="mt-1 rounded text-blue-600 focus:ring-blue-500">
                        <span class="text-[10px] text-slate-600 leading-relaxed font-medium">
                            Saya menyatakan bahwa data yang saya berikan adalah benar. Saya memahami bahwa dokumen ini akan diproses secara digital di lingkungan **Pemerintah Kabupaten Belitung Timur** 
                        </span>
                    </label>
                </div>
                
                <div class="text-center pt-6">
                    <button type="submit" 
                            :disabled="!setuju || nik.length !== 16"
                            :class="(!setuju || nik.length !== 16) 
                                    ? 'bg-slate-200 text-slate-400 cursor-not-allowed shadow-none' 
                                    : 'bg-slate-900 text-white hover:bg-blue-900 shadow-2xl shadow-slate-300 transform hover:-translate-y-1 active:scale-95'"
                            class="inline-flex items-center gap-3 px-12 py-5 rounded-3xl font-black text-lg transition-all duration-300">
                        Kirim Permohonan
                    </button>
                </div>
                
            </div>
        </form>
    </div>
</section>
@endsection