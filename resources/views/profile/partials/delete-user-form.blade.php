<section class="bg-white p-8 rounded-[2.5rem] border border-red-100 shadow-sm mt-8">
    <header class="mb-8">
        <h2 class="text-xl font-black text-red-600 tracking-tight">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-xs font-medium text-slate-400 uppercase tracking-widest leading-relaxed">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi apa pun yang ingin Anda pertahankan.') }}
        </p>
    </header>

    {{-- Tombol Pemicu Modal --}}
    <button 
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-500 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase hover:bg-red-700 transition shadow-lg shadow-red-100"
    >
        {{ __('Hapus Akun Saya') }}
    </button>

    {{-- Modal Konfirmasi --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 bg-white rounded-[3rem]">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-slate-900 tracking-tight mb-4">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h2>

            <p class="text-sm text-slate-500 leading-relaxed mb-8">
                {{ __('Tindakan ini tidak dapat dibatalkan. Harap masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun ini secara permanen.') }}
            </p>

            <div class="space-y-2">
                <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Kata Sandi Konfirmasi') }}</label>
                <input 
                    id="password"
                    name="password"
                    type="password"
                    class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold p-3 focus:ring-red-500 focus:border-red-500 transition"
                    placeholder="{{ __('Ketik password Anda...') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 rounded-xl text-[10px] font-black uppercase text-slate-400 hover:text-slate-900 transition">
                    {{ __('Batal') }}
                </button>

                <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase hover:bg-red-800 transition shadow-lg shadow-red-200">
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>