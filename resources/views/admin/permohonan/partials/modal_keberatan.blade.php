<div x-show="openKeberatan" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
    <div @click.away="openKeberatan = false" class="bg-white rounded-[2.5rem] w-full max-w-2xl overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h3 class="text-xl font-black text-slate-900 uppercase">Form Keberatan Informasi</h3>
            <button @click="openKeberatan = false" class="text-slate-400 hover:text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.permohonan.keberatan.store', $permohonan->id) }}" method="POST" class="p-8">
            @csrf
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 text-center">Pilih Alasan Keberatan (Pasal 35 UU KIP)</p>
            
            <div class="grid grid-cols-1 gap-3 mb-6">
                @foreach([
                    'A' => 'Permohonan informasi ditolak',
                    'B' => 'Informasi berkala tidak disediakan',
                    'C' => 'Permohonan informasi tidak ditanggapi',
                    'D' => 'Permohonan ditanggapi tidak sebagaimana yang diminta',
                    'E' => 'Permohonan informasi tidak dipenuhi',
                    'F' => 'Pengenaan biaya yang tidak wajar',
                    'G' => 'Penyampaian informasi melebihi waktu yang ditentukan'
                ] as $key => $val)
                <label class="flex items-start gap-3 p-4 rounded-2xl border border-slate-100 hover:bg-blue-50 cursor-pointer transition group">
                    <input type="radio" name="alasan_keberatan" value="{{ $key }}" class="mt-1" required>
                    <div class="text-xs">
                        <span class="font-black text-blue-600 mr-1">{{ $key }}.</span>
                        <span class="text-slate-600 font-bold">{{ $val }}</span>
                    </div>
                </label>
                @endforeach
            </div>

            <div class="mb-6">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Kronologi / Penjelasan (Opsional)</label>
                <textarea name="kronologi" rows="3" class="w-full rounded-2xl border-slate-200 text-sm focus:ring-blue-500" placeholder="Jelaskan alasan keberatan lebih rinci..."></textarea>
            </div>

            <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-blue-600 transition shadow-lg shadow-blue-100">
                Simpan Keberatan
            </button>
        </form>
    </div>
</div>