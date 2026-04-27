{{-- Isian untuk modal_pemberitahuan.blade.php --}}
<div x-show="openPemberitahuan" 
    x-data="{ 
        pemenuhan: '', 
        alasanTolak: '', 
        biayaSalinan: 0,
        biayaKirim: 0,
        biayaLain: 0,
        get totalBiaya() {
            return Number(this.biayaSalinan) + Number(this.biayaKirim) + Number(this.biayaLain)
        }
    }"
     class="fixed inset-0 z-[999999] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-sm" 
     x-cloak 
     x-transition>
    
    <div @click.stop class="bg-white w-full max-w-4xl rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col relative border border-white/20" style="max-height: 90vh;">
        
        {{-- Header --}}
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
            <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest ml-4">Formulir Pemberitahuan Tertulis</h3>
            <button @click="openPemberitahuan = false" class="text-slate-400 hover:text-red-500 transition-colors text-2xl px-4">&times;</button>
        </div>

        {{-- Body Modal --}}
        <div class="p-10 overflow-y-auto custom-scrollbar flex-1 bg-white">
            <form id="formPemberitahuanActual" action="{{ route('admin.permohonan.store_tindak_lanjut', $permohonan->id) }}" method="POST">
                @csrf
                <input type="hidden" name="total_biaya" :value="totalBiaya">
                <div class="space-y-8">
                    
                    {{-- DROPDOWN UTAMA --}}
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Pemberitahuan Informasi</label>
                        <select x-model="pemenuhan" name="pemenuhan" 
                                class="w-full border-2 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-100 transition-all outline-none appearance-none bg-slate-50">
                            <option value="">-- Pilih Status Informasi --</option>
                            <option value="Dapat Dipenuhi">Dapat Diberikan</option>
                            <option value="Ditolak">Tidak Dapat Diberikan</option>
                        </select>
                    </div>

                    {{-- JIKA DAPAT DIPENUHI --}}
                    <div x-show="pemenuhan == 'Dapat Dipenuhi'" x-transition class="space-y-8 border-t pt-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penguasaan Informasi</label>
                                {{-- Bungkus bagian penguasaan dengan x-data --}}
                                <div x-data="{ penguasaan: '{{ $pemberitahuan->penguasaan ?? 'kami' }}' }" class="space-y-4">
                                    <div class="flex flex-col md:flex-row gap-4">
                                        {{-- Opsi: Kami (Internal) --}}
                                        <label class="flex-1 flex items-center gap-3 p-4 border-2 rounded-2xl cursor-pointer transition-all"
                                            :class="penguasaan == 'kami' ? 'border-indigo-500 bg-indigo-50' : 'border-slate-100'">
                                            <input type="radio" name="penguasaan_informasi" value="kami" x-model="penguasaan" ...>
                                            <span ...>Kami (PPID Beltim)</span>
                                        </label>

                                        {{-- Opsi: Badan Publik Lain --}}
                                        <label class="flex-1 flex items-center gap-3 p-4 border-2 rounded-2xl cursor-pointer transition-all"
                                            :class="penguasaan == 'opd_lain' ? 'border-amber-500 bg-amber-50' : 'border-slate-100'">
                                            <input type="radio" name="penguasaan_informasi" value="opd_lain" x-model="penguasaan" ...>
                                            <span ...>Badan Publik Lain</span>
                                        </label>
                                    </div>

                                    {{-- INPUT SEARCH (Hanya muncul jika memilih Badan Publik Lain) --}}
                                    <div x-show="penguasaan == 'opd_lain'" 
                                        x-cloak 
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                        class="mt-4 p-6 bg-amber-50 rounded-3xl border-2 border-dashed border-amber-200 animate__animated animate__fadeIn">
                                        
                                        <label class="text-[10px] font-black text-amber-600 uppercase tracking-widest block mb-2">
                                            Cari & Ketik Nama Badan Publik / Instansi:
                                        </label>
                                        
                                        <input 
                                            list="list-opd-lain" 
                                            name="nama_opd" 
                                            value="{{ $pemberitahuan->nama_opd ?? '' }}"
                                            class="w-full p-4 bg-white border-2 border-amber-100 rounded-2xl text-sm font-bold outline-none focus:border-amber-400"
                                            placeholder="Ketik nama instansi di sini..."
                                            autocomplete="off"
                                        >

                                        <datalist id="list-opd-lain">
                                            @foreach($opds as $opd)
                                                <option value="{{ $opd->nama_opd }}">
                                            @endforeach
                                        </datalist>
                                        
                                        <p class="text-[9px] text-amber-600 mt-2 italic">*Nama ini akan otomatis tercetak di PDF Pemberitahuan Bagian A poin 1.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bentuk Fisik</label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-3 p-4 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="bentuk_fisik" value="Softcopy" checked class="w-4 h-4 text-blue-600">
                                        <span class="text-sm font-bold text-slate-700">Softcopy</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-4 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="bentuk_fisik" value="Hardcopy" class="w-4 h-4 text-blue-600">
                                        <span class="text-sm font-bold text-slate-700">Hardcopy</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Tabel Biaya --}}
                        <div class="space-y-4 bg-slate-50 p-6 rounded-[2rem] border border-slate-100">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Detail Biaya (Sesuai PERKI)</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                {{-- Biaya Penyalinan --}}
                                <div class="space-y-2">
                                    <label class="text-[9px] font-bold text-slate-500 uppercase">1. Penyalinan</label>
                                    <input type="number" name="biaya_salinan" x-model="biayaSalinan" class="w-full p-4 rounded-2xl border-2 border-white focus:border-blue-400 outline-none transition-all" placeholder="Rp 0">
                                </div>

                                {{-- Biaya Pengiriman --}}
                                <div class="space-y-2">
                                    <label class="text-[9px] font-bold text-slate-500 uppercase">2. Pengiriman</label>
                                    <input type="number" name="biaya_kirim" x-model="biayaKirim" class="w-full p-4 rounded-2xl border-2 border-white focus:border-blue-400 outline-none transition-all" placeholder="Rp 0">
                                </div>

                                {{-- Biaya Lain-lain --}}
                                <div class="space-y-2">
                                    <label class="text-[9px] font-bold text-slate-500 uppercase">3. Lain-lain</label>
                                    <input type="number" name="biaya_lain" x-model="biayaLain" class="w-full p-4 rounded-2xl border-2 border-white focus:border-blue-400 outline-none transition-all" placeholder="Rp 0">
                                </div>
                            </div>

                            {{-- Total Otomatis --}}
                            <div class="mt-4 pt-4 border-t border-slate-200 flex justify-between items-center">
                                <span class="text-xs font-black text-slate-500">TOTAL KESELURUHAN:</span>
                                <div class="text-lg font-black text-blue-600">
                                    Rp <span x-text="totalBiaya.toLocaleString('id-ID')"></span>
                                </div>
                                {{-- Input hidden untuk total_biaya agar tetap masuk ke kolom lama --}}
                                <input type="hidden" name="total_biaya" :value="totalBiaya">
                            </div>
                        </div>

                        {{-- 4. WAKTU PENYEDIAAN & PENGHITAMAN --}}
                        <div class="space-y-6">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">4. Waktu Penyediaan (Hari Kerja)</label>
                                <input type="number" name="waktu_penyediaan" value="{{ $pemberitahuan->waktu_penyediaan ?? '' }}" class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold outline-none" placeholder="Contoh: 3">
                            </div>

                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">5. Penjelasan Penghitaman / Pengaburan</label>
                                <textarea name="penjelasan_penghitaman" rows="3" class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-medium outline-none focus:border-indigo-400" placeholder="Jelaskan bagian mana yang dikaburkan dan alasannya (kosongkan jika tidak ada)...">{{ $pemberitahuan->penjelasan_penghitaman ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- JIKA DITOLAK --}}
                    <div x-show="pemenuhan == 'Ditolak'" x-transition class="space-y-6 border-t pt-8">
                        <label class="text-[10px] font-black text-red-500 uppercase tracking-widest block">Alasan Penolakan</label>
                        
                        <div class="grid grid-cols-1 gap-4">
                            
                            {{-- OPSI 1: BELUM DIKUASAI --}}
                            <label class="flex items-center gap-4 p-5 border-2 rounded-3xl cursor-pointer transition-all"
                                :class="alasanTolak == 'Informasi belum dikuasai' ? 'border-red-500 bg-red-50' : 'border-red-50'">
                                <input type="radio" x-model="alasanTolak" name="alasan_tolak" value="Informasi belum dikuasai" class="w-5 h-5 text-red-600">
                                <span class="text-sm font-black text-slate-800">Informasi belum dikuasai</span>
                            </label>

                            {{-- OPSI 2: BELUM DIDOKUMENTASIKAN + INPUT JANGKA WAKTU --}}
                            <div class="space-y-3">
                                <label class="flex items-center gap-4 p-5 border-2 rounded-3xl cursor-pointer transition-all"
                                    :class="alasanTolak == 'Informasi belum didokumentasikan' ? 'border-red-500 bg-red-50' : 'border-red-50'">
                                    <input type="radio" x-model="alasanTolak" name="alasan_tolak" value="Informasi belum didokumentasikan" class="w-5 h-5 text-red-600">
                                    <span class="text-sm font-black text-slate-800">Informasi belum didokumentasikan</span>
                                </label>

                                {{-- Input Jangka Waktu (Menempel ke Opsi 2) --}}
                                <div x-show="alasanTolak == 'Informasi belum didokumentasikan'" 
                                    x-transition 
                                    class="ml-8 p-6 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-2">Jangka Waktu Penyediaan (Hari Kerja)</label>
                                    <input type="number" name="jangka_waktu_dokumentasi" class="w-full p-4 rounded-2xl border-2 border-slate-100 outline-none focus:border-red-400" placeholder="Contoh: 10">
                                </div>
                            </div>

                            {{-- OPSI 3: DIKECUALIKAN + FORM PASAL 17 --}}
                            <div class="space-y-3">
                                <label class="flex items-center gap-4 p-5 border-2 rounded-3xl cursor-pointer transition-all"
                                    :class="alasanTolak == 'Dikecualikan' ? 'border-orange-500 bg-orange-50' : 'border-orange-100'">
                                    <input type="radio" x-model="alasanTolak" name="alasan_tolak" value="Dikecualikan" class="w-5 h-5 text-orange-600">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-slate-800">Informasi Dikecualikan (Pasal 17)</span>
                                        <span class="text-[10px] text-orange-600 font-bold uppercase">Format: SK Penolakan</span>
                                    </div>
                                </label>

                                {{-- FORM KHUSUS PENOLAKAN (Menempel ke Opsi 3) --}}
                                <div x-show="alasanTolak == 'Dikecualikan'" 
                                    x-transition 
                                    class="ml-8 p-6 bg-orange-50 rounded-3xl border-2 border-orange-200 space-y-5">
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Pasal 17 UU KIP (Huruf)</label>
                                            <select name="pasal_17" class="w-full p-4 bg-white border-2 border-orange-100 rounded-2xl text-sm font-bold outline-none focus:border-orange-500">
                                                <option value="">-- Pilih Huruf --</option>
                                                <option value="a">Huruf a (Proses Penegakan Hukum)</option>
                                                <option value="b">Huruf b (HAKI / Persaingan Usaha)</option>
                                                <option value="c">Huruf c (Pertahanan & Keamanan)</option>
                                                <option value="d">Huruf d (Kekayaan Alam)</option>
                                                <option value="e">Huruf e (Ketahanan Ekonomi)</option>
                                                <option value="f">Huruf f (Hubungan Luar Negeri)</option>
                                                <option value="g">Huruf g (Akta Otentik Pribadi)</option>
                                                <option value="h">Huruf h (Rahasia Pribadi / Riwayat Kesehatan)</option>
                                                <option value="i">Huruf i (Memorandum / Surat Internal)</option>
                                                <option value="j">Huruf j (Dikecualikan UU Lainnya)</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Pasal & UU Lainnya (Jika Ada)</label>
                                            <input type="text" name="uu_lain" class="w-full p-4 bg-white border-2 border-orange-100 rounded-2xl text-sm font-bold outline-none focus:border-orange-500" placeholder="Contoh: Pasal 20 UU No. ...">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Rincian Informasi yang Ditolak</label>
                                        <textarea name="rincian_ditolak" rows="2" class="w-full p-4 bg-white border-2 border-orange-100 rounded-2xl text-sm font-medium outline-none focus:border-orange-500" placeholder="Sebutkan dokumen apa saja yang tidak boleh diberikan..."></textarea>
                                    </div>

                                    <div>
                                        <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Hasil Uji Konsekuensi (Alasan Bahaya)</label>
                                        <textarea name="konsekuensi" rows="3" class="w-full p-4 bg-white border-2 border-orange-100 rounded-2xl text-sm font-medium outline-none focus:border-orange-500" placeholder="Menjelaskan bahwa membuka informasi dapat mengakibatkan..."></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <div class="p-8 border-t border-slate-100 flex justify-end gap-3 bg-slate-50/30">
            <button type="button" @click="openPemberitahuan = false" class="px-8 py-4 text-[10px] font-black uppercase text-slate-400">Batal</button>
            {{-- Tombol ini sudah TERHUBUNG dengan ID form di atas --}}
            <button type="submit" form="formPemberitahuanActual" class="px-12 py-4 bg-blue-600 text-white text-[10px] font-black uppercase rounded-2xl shadow-xl hover:bg-blue-700 transition-all">
                Simpan & Kirim
            </button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Ganti '#modalPemberitahuan' dengan ID Modal Bapak
        $('#select-opd').select2({
            placeholder: '-- Cari & Pilih Instansi --',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalPemberitahuan') 
        });
    });
</script>