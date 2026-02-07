<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BeritaTerkini;
use Illuminate\Http\Request;

class BeritaTerkiniController extends Controller
{
    public function index()
    {
        // Filter: Berita Hari Ini
        $todayNews = BeritaTerkini::active()
            ->today()
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter: Berita Minggu Lalu (Older than today)
        $olderNews = BeritaTerkini::active()
            ->older()
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Pagination for older news

        return view('berita_terkini.index', compact('todayNews', 'olderNews'));
    }

    public function show($slug)
    {
        $berita = BeritaTerkini::active()->where('slug', $slug)->firstOrFail();
        
        // Count view
        $berita->increment('views');

        return view('berita_terkini.show', compact('berita'));
    }
}
