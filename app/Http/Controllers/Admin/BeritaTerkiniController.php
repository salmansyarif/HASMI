<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeritaTerkini;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaTerkiniController extends Controller
{
    public function index()
    {
        $beritas = BeritaTerkini::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.berita_terkini.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita_terkini.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|string',
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

        while (BeritaTerkini::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        $validated['is_active'] = $request->has('is_active');

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                                              ->store('berita_terkini/thumbnails', 'public');
        }

        // Upload multiple photos
        if ($request->hasFile('photos')) {
            $photoPaths = [];
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('berita_terkini/photos', 'public');
            }
            $validated['photos'] = $photoPaths;
        }

        // Handle video
        if ($request->hasFile('video_file')) {
            $validated['video_url'] = $request->file('video_file')
                                              ->store('berita_terkini/videos', 'public');
        } elseif ($request->filled('video_url')) {
            $validated['video_url'] = $request->video_url;
        }

        unset($validated['video_file']);

        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($request->content), 150);
        }

        BeritaTerkini::create($validated);

        return redirect()->route('admin.berita-terkini.index')
                         ->with('success', 'Berita Terkini berhasil ditambahkan!');
    }

    public function edit(BeritaTerkini $beritaTerkini)
    {
        return view('admin.berita_terkini.edit', compact('beritaTerkini'));
    }

    public function update(Request $request, BeritaTerkini $beritaTerkini)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:102400',
            'video_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validated['title'] !== $beritaTerkini->title) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = 1;
            $originalSlug = $validated['slug'];

            while (BeritaTerkini::where('slug', $validated['slug'])->where('id', '!=', $beritaTerkini->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count++;
            }
        }

        $validated['is_active'] = $request->has('is_active');
        
        // Ensure photos array is initialized if not present
        if (!isset($beritaTerkini->photos)) {
            $beritaTerkini->photos = [];
        }

        // Update thumbnail
        if ($request->hasFile('thumbnail')) {
            if ($beritaTerkini->thumbnail && Storage::disk('public')->exists($beritaTerkini->thumbnail)) {
                Storage::disk('public')->delete($beritaTerkini->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')
                                              ->store('berita_terkini/thumbnails', 'public');
        }

        // Update photos (Append new ones)
        if ($request->hasFile('photos')) {
            $existingPhotos = $beritaTerkini->photos ?? [];
            if (!is_array($existingPhotos)) $existingPhotos = [];
            
            $photoPaths = $existingPhotos;

            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('berita_terkini/photos', 'public');
            }
            $validated['photos'] = $photoPaths;
        }

        // Update video
        if ($request->hasFile('video_file')) {
            if ($beritaTerkini->video_url && !filter_var($beritaTerkini->video_url, FILTER_VALIDATE_URL)) {
                if (Storage::disk('public')->exists($beritaTerkini->video_url)) {
                    Storage::disk('public')->delete($beritaTerkini->video_url);
                }
            }
            $validated['video_url'] = $request->file('video_file')
                                              ->store('berita_terkini/videos', 'public');
        } elseif ($request->filled('video_url')) {
            $validated['video_url'] = $request->video_url;
        }

        unset($validated['video_file']);

        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($request->content), 150);
        }

        $beritaTerkini->update($validated);

        return redirect()->route('admin.berita-terkini.index')
                         ->with('success', 'Berita Terkini berhasil diupdate!');
    }

    public function destroy(BeritaTerkini $beritaTerkini)
    {
        $beritaTerkini->delete();
        return redirect()->route('admin.berita-terkini.index')
                         ->with('success', 'Berita Terkini berhasil dihapus!');
    }

    public function deletePhoto(Request $request, BeritaTerkini $beritaTerkini)
    {
        $photoPath = $request->input('photo');
        
        if ($beritaTerkini->hasPhotos()) {
            $photos = $beritaTerkini->photos;
            $key = array_search($photoPath, $photos);
            
            if ($key !== false) {
                if (Storage::disk('public')->exists($photoPath)) {
                    Storage::disk('public')->delete($photoPath);
                }
                
                unset($photos[$key]);
                $beritaTerkini->photos = array_values($photos); // Re-index array
                $beritaTerkini->save();
                
                return response()->json(['success' => true]);
            }
        }
        
        return response()->json(['success' => false, 'message' => 'Photo not found'], 404);
    }
}
