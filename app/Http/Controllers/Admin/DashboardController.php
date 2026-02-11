<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Program;
use App\Models\BeritaTerkini;
use App\Models\Kegiatan;
use App\Models\Intisari;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'programs' => Program::count(),
            'berita' => BeritaTerkini::count(),
            'kegiatan' => Kegiatan::count(),
            'intisari' => Intisari::count(),
            'comments_pending' => Comment::where('status', 'pending')->count(),
            'admins' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
