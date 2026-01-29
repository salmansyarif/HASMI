<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'comment' => 'required|max:1000',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'comment.required' => 'Komentar harus diisi',
        ]);

        // Langsung approved agar semua orang bisa lihat
        $validated['status'] = 'approved';

        Comment::create($validated);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}