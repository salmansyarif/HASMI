<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Intisari;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function tentang()
    {
        return view('tentang');
    }

    // Intisari index (list)
    public function intisari()
    {
        $intisaris = Intisari::where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        return view('intisari.index', compact('intisaris'));
    }

    // Kegiatan index (list)
    public function kegiatan()
    {
        $kegiatans = Kegiatan::where('status', 'published')
            ->latest('event_date')
            ->paginate(12);

        return view('kegiatan.index', compact('kegiatans'));
    }
}
