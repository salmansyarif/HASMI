<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Intisari;
use App\Models\Program;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Articles
        $articles = Article::with('category')
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
        $programs = Program::with('category')
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
        $intisari = Intisari::where('status', 'published')
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
        $kegiatan = Kegiatan::where('status', 'published')
            ->latest('event_date')
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
        $homePrograms = Program::with('category')->where('is_active', true)->orderBy('position')->take(4)->get();
        $homeArticles = Article::with('category')->published()->latest('published_at')->take(4)->get();
        $homeIntisari = Intisari::where('status', 'published')->latest('created_at')->take(4)->get();
        $homeKegiatan = Kegiatan::where('status', 'published')->latest('event_date')->take(4)->get();

        // Counts for statistics
        $materiCount = Article::published()->count();
        $programCount = Program::where('is_active', true)->count();
        $intisariCount = Intisari::where('status', 'published')->count();
        $kegiatanCount = Kegiatan::where('status', 'published')->count();

        return view('home', compact(
            'latestUpdates',
            'homePrograms',
            'homeArticles',
            'homeIntisari',
            'homeKegiatan',
            'materiCount',
            'programCount',
            'intisariCount',
            'kegiatanCount'
        ));
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function intisari()
    {
        $intisaris = Intisari::where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        return view('intisari.index', compact('intisaris'));
    }

    public function kegiatan()
    {
        $kegiatans = Kegiatan::where('status', 'published')
            ->latest('event_date')
            ->paginate(12);

        return view('kegiatan.index', compact('kegiatans'));
    }
}