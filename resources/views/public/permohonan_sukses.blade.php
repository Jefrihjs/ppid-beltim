@extends('layouts.public')

@section('content')
<section class="py-20 text-center">
    <h1 class="text-3xl font-bold text-green-600">
        Permohonan Berhasil Dikirim
    </h1>

    <p class="mt-6">
        Nomor Registrasi Anda:
    </p>

    <div class="mt-4 text-2xl font-bold">
        {{ session('nomor') }}
    </div>

    <p class="mt-6 text-slate-600">
        Simpan nomor ini untuk cek status permohonan.
    </p>

    <a href="/monitoring"
       class="mt-8 inline-block bg-blue-900 text-white px-6 py-3 rounded-lg">
        Cek Status Permohonan
    </a>
</section>
@endsection