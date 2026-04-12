<button @click="openPemberitahuan = true" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-blue-700 transition shadow-lg">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    Pemberitahuan
</button>

<div x-show="openPemberitahuan" 
     class="fixed inset-0 z-[10000] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-cloak>
    
    <div @click.stop 
         class="bg-white w-full max-w-3xl rounded-[2.5rem] shadow-2xl overflow-hidden max-h-[90vh] flex flex-col border border-white/20">
        
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="text-xs font-black text-purple-600 uppercase tracking-[0.2em] ml-4">Data Pemberitahuan Tertulis</h3>
            <button @click="openPemberitahuan = false" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-red-50 text-slate-400 hover:text-red-500 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="p-8 overflow-y-auto custom-scrollbar">
            <form action="#" method="POST" @submit.prevent="console.log('Form Ready')">
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pemenuhan Informasi</label>
                        <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:ring-2 focus:ring-purple-500">
                            <option>Dapat Dipenuhi</option>
                            <option>Ditolak</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-4 border-y border-slate-50">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Penguasaan Informasi</label>
                            <div class="flex flex-col gap-2">
                                <label class="flex items-center gap-3 cursor-pointer"><input type="radio" name="kuasa" class="w-4 h-4 text-purple-600"> <span class="text-xs font-bold text-slate-600">Kami</span></label>
                                <label class="flex items-center gap-3 cursor-pointer"><input type="radio" name="kuasa" class="w-4 h-4 text-purple-600"> <span class="text-xs font-bold text-slate-600">Badan Publik Lain</span></label>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Bentuk Fisik</label>
                            <div class="flex flex-col gap-2">
                                <label class="flex items-center gap-3 cursor-pointer"><input type="radio" name="fisik" class="w-4 h-4 text-purple-600"> <span class="text-xs font-bold text-slate-600">Softcopy</span></label>
                                <label class="flex items-center gap-3 cursor-pointer"><input type="radio" name="fisik" class="w-4 h-4 text-purple-600"> <span class="text-xs font-bold text-slate-600">Hardcopy</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Biaya yang dibutuhkan</label>
                            <div class="flex gap-2">
                                <button type="button" class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase rounded-lg border border-blue-100">Tambah</button>
                                <button type="button" class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase rounded-lg border border-red-100">Hapus</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <input type="text" placeholder="item" class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold">
                            <input type="text" placeholder="satuan" class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold">
                            <input type="text" placeholder="harga" class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs font-bold">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Penyediaan (Hari)</label>
                        <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjelasan Penghitaman</label>
                        <textarea rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <div class="p-8 border-t border-slate-100 bg-slate-50/50 flex justify-end">
            <button type="submit" class="px-12 py-4 bg-purple-600 text-white text-[11px] font-black uppercase rounded-2xl shadow-xl shadow-purple-100 hover:scale-105 transition-all tracking-widest">
                Kirim Data
            </button>
        </div>
    </div>
</div>