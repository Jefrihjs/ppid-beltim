<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index() {
        $videos = Video::latest()->get();
        return view('admin.video.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'youtube_id' => 'required',
            'is_main' => 'nullable'
        ]);

        
        if ($request->has('is_main')) {
            Video::where('is_main', true)->update(['is_main' => false]);
            $data['is_main'] = true;
        }

        
        Video::create($data);

        return back()->with('success', 'Video berhasil disimpan!');
    }

    
    public function destroy(Video $video)
    {
        $video->delete();
        
        return back()->with('success', 'Video berhasil dihapus!');
    }
}
