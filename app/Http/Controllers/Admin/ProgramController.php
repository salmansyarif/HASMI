<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramCategory;
use App\Models\SubProgramCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::with(['category', 'subcategory']);

        // Filter by category
        if ($request->filled('category')) {
            $query->where('program_category_id', $request->category);
        }

        // Filter by subcategory
        if ($request->filled('subcategory')) {
            $query->where('program_subcategory_id', $request->subcategory);
        }

        $programs = $query->orderBy('position')
                         ->orderBy('created_at', 'desc')
                         ->paginate(15);

        // Get categories for filter
        $categories = ProgramCategory::where('is_creatable', true)
                                    ->orderBy('sort_order')
                                    ->get();

        return view('admin.programs.index', compact('programs', 'categories'));
    }

    public function create()
    {
        // Ambil categories yang bisa di-create (is_creatable = true)
        $categories = ProgramCategory::where('is_creatable', true)
                                    ->orderBy('sort_order')
                                    ->get();

        return view('admin.programs.create', compact('categories'));
    }

    /**
     * AJAX: Get subcategories berdasarkan category
     */
    public function getSubcategories(Request $request)
    {
        $categoryId = $request->category_id;
        
        $subcategories = SubProgramCategory::where('program_category_id', $categoryId)
                                          ->orderBy('sort_order')
                                          ->get();

        return response()->json($subcategories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_category_id' => 'required|exists:program_categories,id',
            'program_subcategory_id' => 'nullable|exists:program_subcategories,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'nullable',
            'media_type' => 'required|in:image,video',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:102400',
            'video_url' => 'nullable|url',
            'media_position' => 'required|in:top,left,right,bottom',
            'position' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Generate unique slug
        $validated['slug'] = Str::slug($validated['title']);
        $count = 1;
        $originalSlug = $validated['slug'];

        while (Program::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                                              ->store('programs/thumbnails', 'public');
        }

        // Upload multiple photos
        if ($request->hasFile('photos')) {
            $photoPaths = [];
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('programs/photos', 'public');
            }
            $validated['photos'] = $photoPaths;
        }

        // Handle video
        if ($validated['media_type'] === 'video') {
            if ($request->hasFile('video_file')) {
                $validated['video_url'] = $request->file('video_file')
                                                  ->store('programs/videos', 'public');
            } elseif ($request->filled('video_url')) {
                // YouTube URL atau external URL
                $validated['video_url'] = $request->video_url;
            }
        }

        unset($validated['video_file']);

        Program::create($validated);

        return redirect()->route('admin.programs.index')
                         ->with('success', 'Program berhasil ditambahkan!');
    }

    public function edit(Program $program)
    {
        // Ambil categories yang bisa di-create
        $categories = ProgramCategory::where('is_creatable', true)
                                    ->orderBy('sort_order')
                                    ->get();

        // Ambil subcategories dari category program ini
        $subcategories = [];
        if ($program->program_category_id) {
            $subcategories = SubProgramCategory::where('program_category_id', $program->program_category_id)
                                              ->orderBy('sort_order')
                                              ->get();
        }

        return view('admin.programs.edit', compact('program', 'categories', 'subcategories'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'program_category_id' => 'required|exists:program_categories,id',
            'program_subcategory_id' => 'nullable|exists:program_subcategories,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'nullable',
            'media_type' => 'required|in:image,video',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:102400',
            'video_url' => 'nullable|url',
            'media_position' => 'required|in:top,left,right,bottom',
            'position' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Update slug if title changed
        if ($validated['title'] !== $program->title) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = 1;
            $originalSlug = $validated['slug'];

            while (
                Program::where('slug', $validated['slug'])
                    ->where('id', '!=', $program->id)
                    ->exists()
            ) {
                $validated['slug'] = $originalSlug . '-' . $count++;
            }
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;

        // Update thumbnail
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($program->thumbnail && Storage::disk('public')->exists($program->thumbnail)) {
                Storage::disk('public')->delete($program->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')
                                              ->store('programs/thumbnails', 'public');
        }

        // Update photos
        if ($request->hasFile('photos')) {
            $existingPhotos = $program->photos ?? [];
            $photoPaths = $existingPhotos;

            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('programs/photos', 'public');
            }

            $validated['photos'] = $photoPaths;
        }

        // Update video
        if ($validated['media_type'] === 'video') {
            if ($request->hasFile('video_file')) {
                // Delete old video if exists
                if ($program->video_url && !filter_var($program->video_url, FILTER_VALIDATE_URL)) {
                    if (Storage::disk('public')->exists($program->video_url)) {
                        Storage::disk('public')->delete($program->video_url);
                    }
                }

                $validated['video_url'] = $request->file('video_file')
                                                  ->store('programs/videos', 'public');
            } elseif ($request->filled('video_url')) {
                $validated['video_url'] = $request->video_url;
            }
        }

        unset($validated['video_file']);

        $program->update($validated);

        return redirect()->route('admin.programs.index')
                         ->with('success', 'Program berhasil diupdate!');
    }

    public function destroy(Program $program)
    {
        // Program akan auto-delete files lewat model boot method
        $program->delete();

        return redirect()->route('admin.programs.index')
                         ->with('success', 'Program berhasil dihapus!');
    }

    /**
     * Delete a specific photo from program
     */
    public function deletePhoto(Request $request, Program $program)
    {
        $photoPath = $request->input('photo');
        
        if ($program->hasPhotos()) {
            $photos = $program->photos;
            $key = array_search($photoPath, $photos);
            
            if ($key !== false) {
                // Delete file from storage
                if (Storage::disk('public')->exists($photoPath)) {
                    Storage::disk('public')->delete($photoPath);
                }
                
                // Remove from array
                unset($photos[$key]);
                $program->photos = array_values($photos);
                $program->save();
                
                return response()->json(['success' => true]);
            }
        }
        
        return response()->json(['success' => false, 'message' => 'Photo not found'], 404);
    }

    /**
     * Delete video from program
     */
    public function deleteVideo(Program $program)
    {
        if ($program->video_url && !filter_var($program->video_url, FILTER_VALIDATE_URL)) {
            if (Storage::disk('public')->exists($program->video_url)) {
                Storage::disk('public')->delete($program->video_url);
            }
        }
        
        $program->video_url = null;
        $program->save();
        
        return redirect()->back()->with('success', 'Video berhasil dihapus!');
    }

    /**
     * Update position/order programs (drag & drop)
     */
    public function updatePosition(Request $request)
    {
        $positions = $request->input('positions');

        foreach ($positions as $position) {
            Program::where('id', $position['id'])
                   ->update(['position' => $position['position']]);
        }

        return response()->json(['success' => true]);
    }
}