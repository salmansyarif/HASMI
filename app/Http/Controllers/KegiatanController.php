<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // Halaman list kegiatan (public)
    public function index(Request $request)
    {
        $query = Kegiatan::where('status', 'published');

        // Opsional: Jika ada fitur search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $kegiatans = $query->latest('event_date')
                           ->latest('created_at')
                           ->paginate(9);

        return view('kegiatan.index', compact('kegiatans'));
    }

    // Detail kegiatan
    public function show($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)
                           ->where('status', 'published')
                           ->firstOrFail();

        // Load comments
        $kegiatan->load(['comments' => function($query) {
            $query->where('status', 'approved')->latest();
        }]);

        return view('kegiatan.show', compact('kegiatan'));
    }
}