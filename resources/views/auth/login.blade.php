<x-guest-layout>
    <div class="mb-8 text-center">
        <img src="{{ asset('images/logo-ppid-beltim.png') }}" class="h-16 mx-auto mb-4" alt="Logo PPID Beltim">
        <h2 class="text-2xl font-black text-slate-800 tracking-tight">Login Administrator</h2>
        <p class="text-sm text-slate-500 font-medium">Sistem Pengelolaan Informasi & Dokumentasi</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1 block">Alamat Email</label>
            <x-text-input id="email" class="block w-full rounded-2xl border-slate-200 focus:border-amber-500 focus:ring-amber-500/10" 
                          type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1 block">Kata Sandi</label>
            <x-text-input id="password" class="block w-full rounded-2xl border-slate-200 focus:border-amber-500 focus:ring-amber-500/10"
                            type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-lg border-gray-300 text-amber-600 shadow-sm focus:ring-amber-500" name="remember">
                <span class="ms-2 text-sm text-gray-600 font-medium">Ingat Saya</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-amber-600 hover:text-amber-700 font-bold" href="{{ route('password.request') }}">
                    Lupa Sandi?
                </a>
            @endif
        </div>

        <button class="w-full bg-slate-900 text-amber-400 py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-slate-800 transition shadow-xl shadow-slate-200">
            Masuk ke Dashboard
        </button>
    </form>
</x-guest-layout>