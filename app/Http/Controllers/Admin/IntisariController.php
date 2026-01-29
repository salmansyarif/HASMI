<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Intisari;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IntisariController extends Controller
{
    public function index(Request $request)
    {
        $query = Intisari::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $intisaris = $query->latest()->paginate(10);

        return view('admin.intisari.index', compact('intisaris'));
    }

    public function create()
    {
        return view('admin.intisari.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        $count = 1;
        $originalSlug = $validated['slug'];
        while (Intisari::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('intisari/thumbnails', $filename, 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        }

        if ($validated['status'] == 'published' && !$request->filled('published_at')) {
            $validated['published_at'] = now();
        }

        Intisari::create($validated);

        return redirect()->route('admin.intisari.index')
                         ->with('success', 'Intisari berhasil ditambahkan!');
    }

    public function edit(Intisari $intisari)
    {
        return view('admin.intisari.edit', compact('intisari'));
    }

    public function update(Request $request, Intisari $intisari)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($validated['title'] != $intisari->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            $count = 1;
            $originalSlug = $validated['slug'];
            while (Intisari::where('slug', $validated['slug'])->where('id', '!=', $intisari->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        if ($request->hasFile('thumbnail')) {
            if ($intisari->thumbnail && file_exists(public_path($intisari->thumbnail))) {
                unlink(public_path($intisari->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('intisari/thumbnails', $filename, 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        }

        if ($validated['status'] == 'published' && $intisari->status != 'published') {
            $validated['published_at'] = now();
        }

        $intisari->update($validated);

        return redirect()->route('admin.intisari.index')
                         ->with('success', 'Intisari berhasil diupdate!');
    }

    public function destroy(Intisari $intisari)
    {
        if ($intisari->thumbnail && file_exists(public_path($intisari->thumbnail))) {
            unlink(public_path($intisari->thumbnail));
        }

        $intisari->delete();

        return redirect()->route('admin.intisari.index')
                         ->with('success', 'Intisari berhasil dihapus!');
    }
}