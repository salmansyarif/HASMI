<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Intisari;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Articles
        $articles = \App\Models\Article::with('category')
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Materi';
                $item->route_name = 'materi.detail';
                $item->route_params = [$item->category->slug, $item->slug];
                $item->date = $item->published_at;
                return $item;
            });

        // 2. Programs
        $programs = \App\Models\Program::with('category')
            ->where('is_active', true)
            ->latest('created_at')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Program';
                $item->route_name = 'program.show';
                $item->route_params = [$item->slug];
                $item->date = $item->created_at;
                return $item;
            });

        // 3. Intisari
        $intisari = \App\Models\Intisari::where('status', 'published') // Assuming status exists, or check model
            ->latest('created_at')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Intisari';
                $item->route_name = 'intisari.show';
                $item->route_params = [$item->slug];
                $item->date = $item->created_at;
                return $item;
            });

        // 4. Kegiatan
        $kegiatan = \App\Models\Kegiatan::where('status', 'published') // Assuming status exists
            ->latest('event_date') // Or created_at
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Kegiatan';
                $item->route_name = 'kegiatan.show';
                $item->route_params = [$item->slug];
                $item->date = $item->event_date ?? $item->created_at;
                return $item;
            });

        // Merge and Sort
        $latestUpdates = $articles->concat($programs)
            ->concat($intisari)
            ->concat($kegiatan)
            ->sortByDesc('date')
            ->take(10);

        // Data for Sections
        $homePrograms = \App\Models\Program::with('category')->where('is_active', true)->orderBy('position')->take(4)->get(); // Limit 4 for grid consistency
        $homeArticles = \App\Models\Article::with('category')->published()->latest('published_at')->take(4)->get();
        $homeIntisari = \App\Models\Intisari::where('status', 'published')->latest('created_at')->take(4)->get();
        $homeKegiatan = \App\Models\Kegiatan::where('status', 'published')->latest('event_date')->take(4)->get();

        return view('home', compact('latestUpdates', 'homePrograms', 'homeArticles', 'homeIntisari', 'homeKegiatan'));
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
