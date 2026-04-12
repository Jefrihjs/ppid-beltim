<section class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm">
    <header class="mb-8">
        <h2 class="text-xl font-black text-slate-900 tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-xs font-medium text-slate-400 uppercase tracking-widest">
            {{ __("Perbarui informasi akun dan alamat email Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        {{-- Input Nama --}}
        <div>
            <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ __('Nama Lengkap') }}</label>
            <input id="name" name="name" type="text" 
                class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold p-3 focus:ring-slate-900 focus:border-slate-900 transition" 
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Input Email --}}
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">{{ __('Alamat Email') }}</label>
            <input id="email" name="email" type="email" 
                class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold p-3 focus:ring-slate-900 focus:border-slate-900 transition" 
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                    <p class="text-xs font-medium text-amber-800">
                        {{ __('Email Anda belum diverifikasi.') }}
                        <button form="send-verification" class="ml-2 underline text-amber-600 hover:text-amber-900 font-bold">
                            {{ __('Klik di sini untuk kirim ulang.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-emerald-600">
                            {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase hover:bg-amber-500 hover:text-slate-900 transition shadow-lg shadow-slate-200">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-emerald-600"
                >{{ __('Berhasil Disimpan.') }}</p>
            @endif
        </div>
    </form>
</section>