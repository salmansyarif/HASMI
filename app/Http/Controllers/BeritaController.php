<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // Berita Hari Ini (Created today)
        $todayNews = Berita::active()
                           ->today()
                           ->orderBy('created_at', 'desc')
                           ->get();

        // Berita Lama (Older than today)
        $oldNews = Berita::active()
                         ->older()
                         ->orderBy('created_at', 'desc')
                         ->paginate(12);

        return view('berita.index', compact('todayNews', 'oldNews'));
    }

    public function show($slug)
    {
        $berita = Berita::active()->where('slug', $slug)->firstOrFail();
        
        // Increment views
        $berita->increment('views');

        // Load comments
        $comments = $berita->comments()
                          ->where('status', 'approved')
                          ->orderBy('created_at', 'desc')
                          ->get();

        // Berita Terbaru lainnya untuk sidebar/related
        $recentNews = Berita::active()
                            ->where('id', '!=', $berita->id)
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('berita.show', compact('berita', 'recentNews', 'comments'));
    }
}
