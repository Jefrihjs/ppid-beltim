<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function tentang()
    {
        return view('public.profil', [
            'view' => 'public.profil_content.tentang'
        ]);
    }

    public function maklumat()
    {
        return view('public.profil', [
            'view' => 'public.profil_content.maklumat'
        ]);
    }

    public function struktur()
    {
        return view('public.profil', [
            'view' => 'public.profil_content.struktur'
        ]);
    }

    public function visi()
    {
        return view('public.profil', [
            'view' => 'public.profil_content.visi'
        ]);
    }
}