<section class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm">
    <header class="mb-8">
        <h2 class="text-xl font-black text-slate-900 tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-xs font-medium text-slate-400 uppercase tracking-widest">
            {{ __("Perbarui informasi akun dan alamat email Anda.") }}
        </p>
    </header>

    {{-- FORM KHUSUS KIRIM VERIFIKASI --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- FORM UPDATE PROFILE --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                {{ __('Nama Lengkap') }}
            </label>

            <input id="name" name="name" type="text"
                class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold p-3"
                value="{{ old('name', $user->name) }}" required autofocus />
        </div>

        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                {{ __('Alamat Email') }}
            </label>

            <input id="email" name="email" type="email"
                class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold p-3"
                value="{{ old('email', $user->email) }}" required />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                    <p class="text-xs font-medium text-amber-800">
                        {{ __('Email Anda belum diverifikasi.') }}

                        <button type="submit" form="send-verification"
                            class="ml-2 underline text-amber-600 hover:text-amber-900 font-bold">
                            {{ __('Klik di sini untuk kirim ulang.') }}
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <button type="submit"
            class="bg-slate-900 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase">
            {{ __('Simpan Perubahan') }}
        </button>
        {{-- Notifikasi Berhasil --}}
        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 4000)"
                class="mt-4 text-xs font-bold text-emerald-600 bg-emerald-50 p-3 rounded-xl border border-emerald-100 flex items-center"
            >
                <span class="mr-2 text-base">✅</span> {{ __('Profil berhasil diperbarui.') }}
            </p>
        @endif
    </form>
</section>