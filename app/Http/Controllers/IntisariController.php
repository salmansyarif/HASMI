<?php

namespace App\Http\Controllers;

use App\Models\Intisari;
use Illuminate\Http\Request;

class IntisariController extends Controller
{
    // Halaman list intisari
    public function index()
    {
        $intisaris = Intisari::where('status', 'published')
            ->latest()
            ->paginate(10);

        return view('intisari.index', compact('intisaris'));
    }

    // Detail intisari
    public function show($slug)
    {
        $intisari = Intisari::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Load comments
        $intisari->load(['comments' => function ($query) {
            $query->where('status', 'approved')->latest();
        }]);

        return view('intisari.show', compact('intisari'));
    }
}
