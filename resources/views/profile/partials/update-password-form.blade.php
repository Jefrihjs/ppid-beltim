<section class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm mt-8">
    <header class="mb-8">
        <h2 class="text-xl font-black text-slate-900 tracking-tight">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-1 text-xs font-medium text-slate-400 uppercase tracking-widest leading-relaxed">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanan.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        {{-- Password Saat Ini --}}
        <div>
            <label for="update_password_current_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ __('Kata Sandi Saat Ini') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold p-3 focus:ring-slate-900 focus:border-slate-900 transition" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- Password Baru --}}
        <div>
            <label for="update_password_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ __('Kata Sandi Baru') }}</label>
            <input id="update_password_password" name="password" type="password" 
                class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold p-3 focus:ring-slate-900 focus:border-slate-900 transition" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="update_password_password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ __('Konfirmasi Kata Sandi Baru') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold p-3 focus:ring-slate-900 focus:border-slate-900 transition" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase hover:bg-amber-500 hover:text-slate-900 transition shadow-lg shadow-slate-200">
                {{ __('Simpan Kata Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-emerald-600"
                >{{ __('Berhasil Diperbarui.') }}</p>
            @endif
        </div>
    </form>
</section>