@extends('layouts.admin')

@section('content')
<div class="space-y-8 pb-20">
    {{-- Header Halaman --}}
    <div>
        <h2 class="text-[28px] font-black text-slate-900 tracking-tight">Pengaturan Profil</h2>
        <p class="text-slate-400 font-medium text-sm">Kelola informasi akun dan keamanan akses Anda.</p>
    </div>

    <div class="space-y-6">
        {{-- Bagian Update Informasi Profil --}}
        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-10">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        {{-- Bagian Update Password --}}
        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-10">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        {{-- Bagian Hapus Akun (Hanya jika diperlukan) --}}
        <div class="bg-white rounded-[3rem] border border-red-50 shadow-sm overflow-hidden">
            <div class="p-10">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection