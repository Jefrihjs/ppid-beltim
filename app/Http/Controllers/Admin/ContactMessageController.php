<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        // Pastikan view mengarah ke folder yang benar
        return view('admin.pesan.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if ($contactMessage->status === 'baru') {
            $contactMessage->update(['status' => 'dibaca', 'dibaca_pada' => now()]);
        }
        return view('admin.pesan.show', compact('contactMessage'));
    }

    public function destroy($id)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Pesan spam berhasil dihapus!');
    }
}
