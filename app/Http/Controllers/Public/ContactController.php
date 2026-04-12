<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'nullable|string|max:20',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string'
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
