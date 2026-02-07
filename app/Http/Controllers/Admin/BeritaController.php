<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'nullable|max:255', // Optional short description
            'content' => 'nullable',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:102400',
            'video_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $count = 1;
        $originalSlug = $validated['slug'];

        while (Berita::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                                              ->store('berita/thumbnails', 'public');
        }

        // Upload multiple photos
        if ($request->hasFile('photos')) {
            $photoPaths = [];
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('berita/photos', 'public');
            }
            $validated['photos'] = $photoPaths;
        }

        // Handle video
        if ($request->hasFile('video_file')) {
            $validated['video_url'] = $request->file('video_file')
                                              ->store('berita/videos', 'public');
        } elseif ($request->filled('video_url')) {
            $validated['video_url'] = $request->video_url;
        }

        unset($validated['video_file']);

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'nullable|max:255', // Optional short description
            'content' => 'nullable',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:102400',
            'video_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validated['title'] !== $berita->title) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = 1;
            $originalSlug = $validated['slug'];

            while (Berita::where('slug', $validated['slug'])->where('id', '!=', $berita->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count++;
            }
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        
        // Ensure photos array is initialized if not present
        if (!isset($berita->photos)) {
            $berita->photos = [];
        }

        // Update thumbnail
        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')
                                              ->store('berita/thumbnails', 'public');
        }

        // Update photos (Append new ones)
        if ($request->hasFile('photos')) {
            $existingPhotos = $berita->photos ?? [];
            if (!is_array($existingPhotos)) $existingPhotos = [];
            
            $photoPaths = $existingPhotos;

            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('berita/photos', 'public');
            }
            $validated['photos'] = $photoPaths;
        }

        // Update video
        if ($request->hasFile('video_file')) {
            if ($berita->video_url && !filter_var($berita->video_url, FILTER_VALIDATE_URL)) {
                if (Storage::disk('public')->exists($berita->video_url)) {
                    Storage::disk('public')->delete($berita->video_url);
                }
            }
            $validated['video_url'] = $request->file('video_file')
                                              ->store('berita/videos', 'public');
        } elseif ($request->filled('video_url')) {
            $validated['video_url'] = $request->video_url;
        }

        unset($validated['video_file']);

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil dihapus!');
    }

    public function deletePhoto(Request $request, Berita $berita)
    {
        $photoPath = $request->input('photo');
        
        if ($berita->hasPhotos()) {
            $photos = $berita->photos;
            $key = array_search($photoPath, $photos);
            
            if ($key !== false) {
                if (Storage::disk('public')->exists($photoPath)) {
                    Storage::disk('public')->delete($photoPath);
                }
                
                unset($photos[$key]);
                $berita->photos = array_values($photos); // Re-index array
                $berita->save();
                
                return response()->json(['success' => true]);
            }
        }
        
        return response()->json(['success' => false, 'message' => 'Photo not found'], 404);
    }
}
