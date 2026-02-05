<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $kegiatans = $query->latest()->paginate(10);

        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'content' => 'nullable',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'show_thumbnail_in_list' => 'boolean',
            'photo_position' => 'required|in:top,bottom,none',
            // 'event_date' => 'nullable|date', // Removed
            // 'location' => 'nullable|max:255', // Removed
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        $count = 1;
        $originalSlug = $validated['slug'];
        while (Kegiatan::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Upload photos
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $photoName = time() . '_' . $index . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $photoPath = $photo->storeAs('kegiatan/photos', $photoName, 'public');
                $photoPaths[] = 'storage/' . $photoPath;
            }
        }
        $validated['photos'] = $photoPaths;
        $validated['thumbnail'] = $photoPaths[0] ?? null;
        
        $validated['show_thumbnail_in_list'] = $request->has('show_thumbnail_in_list');

        Kegiatan::create($validated);

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'content' => 'nullable',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'show_thumbnail_in_list' => 'boolean',
            'photo_position' => 'required|in:top,bottom,none',
            // 'event_date' => 'nullable|date', // Removed
            // 'location' => 'nullable|max:255', // Removed
            'status' => 'required|in:draft,published',
        ]);

        if ($validated['title'] != $kegiatan->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            $count = 1;
            $originalSlug = $validated['slug'];
            while (Kegiatan::where('slug', $validated['slug'])->where('id', '!=', $kegiatan->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Upload photos baru
        $existingPhotos = $kegiatan->photos ?? [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $photoName = time() . '_' . $index . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $photoPath = $photo->storeAs('kegiatan/photos', $photoName, 'public');
                $existingPhotos[] = 'storage/' . $photoPath;
            }
        }
        $validated['photos'] = $existingPhotos;
        
        if (!empty($existingPhotos)) {
            $validated['thumbnail'] = $existingPhotos[0];
        }
        
        $validated['show_thumbnail_in_list'] = $request->has('show_thumbnail_in_list');

        $kegiatan->update($validated);

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', 'Kegiatan berhasil diupdate!');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        // Hapus semua photos
        if ($kegiatan->photos) {
            foreach ($kegiatan->photos as $photo) {
                if (file_exists(public_path($photo))) {
                    unlink(public_path($photo));
                }
            }
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', 'Kegiatan berhasil dihapus!');
    }

    public function deletePhoto(Request $request, Kegiatan $kegiatan)
    {
        $photoPath = $request->input('photo');
        
        if ($kegiatan->photos && in_array($photoPath, $kegiatan->photos)) {
            // Hapus file
            if (file_exists(public_path($photoPath))) {
                unlink(public_path($photoPath));
            }

            // Hapus dari array
            $photos = $kegiatan->photos;
            $photos = array_filter($photos, function($p) use ($photoPath) {
                return $p !== $photoPath;
            });
            $photos = array_values($photos);

            // Update thumbnail jika foto yang dihapus adalah foto pertama
            $thumbnail = !empty($photos) ? $photos[0] : null;

            $kegiatan->update([
                'photos' => $photos,
                'thumbnail' => $thumbnail
            ]);

            return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus!']);
        }

        return response()->json(['success' => false, 'message' => 'Foto tidak ditemukan!'], 400);
    }
    public function setThumbnail(Request $request, Kegiatan $kegiatan)
    {
        $photoPath = $request->input('photo');
        
        if ($kegiatan->photos && in_array($photoPath, $kegiatan->photos)) {
            // Reorder photos array: Move selected photo to index 0
            $photos = $kegiatan->photos;
            
            // Remove from current position
            $photos = array_filter($photos, function($p) use ($photoPath) {
                return $p !== $photoPath;
            });
            
            // Prepend to start
            array_unshift($photos, $photoPath);
            $photos = array_values($photos); // Reindex

            $kegiatan->update([
                'photos' => $photos,
                'thumbnail' => $photoPath
            ]);

            return response()->json(['success' => true, 'message' => 'Thumbnail berhasil diupdate!']);
        }

        return response()->json(['success' => false, 'message' => 'Foto tidak ditemukan!'], 400);
    }
}