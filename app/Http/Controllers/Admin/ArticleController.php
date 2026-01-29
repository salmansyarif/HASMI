<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'subCategory', 'author']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('sub_category')) {
            $query->where('sub_category_id', $request->sub_category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $articles = $query->paginate(10);
        $categories = Category::all();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        $count = 1;
        $originalSlug = $validated['slug'];
        while (Article::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articles/thumbnails', $filename, 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        }

        $validated['user_id'] = Auth::id();

        if ($validated['status'] == 'published') {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $article->category_id)->get();
        return view('admin.articles.edit', compact('article', 'categories', 'subCategories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        // Update slug hanya jika title berubah
        if ($validated['title'] != $article->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            $count = 1;
            $originalSlug = $validated['slug'];
            while (Article::where('slug', $validated['slug'])->where('id', '!=', $article->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($article->thumbnail && file_exists(public_path($article->thumbnail))) {
                @unlink(public_path($article->thumbnail));
            }

            // Upload thumbnail baru
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('articles/thumbnails', $filename, 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        }

        // Update published_at jika status berubah ke published
        if ($validated['status'] == 'published' && $article->status == 'draft') {
            $validated['published_at'] = now();
        }

        // Update artikel
        $article->update($validated);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail && file_exists(public_path($article->thumbnail))) {
            @unlink(public_path($article->thumbnail));
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil dihapus!');
    }

    public function removeThumbnail(Article $article)
    {
        if ($article->thumbnail && file_exists(public_path($article->thumbnail))) {
            @unlink(public_path($article->thumbnail));
        }

        $article->update(['thumbnail' => null]);

        return back()->with('success', 'Thumbnail berhasil dihapus!');
    }

    // AJAX: Get Sub-Categories berdasarkan Category
    public function getSubCategories($categoryId)
    {
        $subCategories = SubCategory::where('category_id', $categoryId)
                                    ->orderBy('order')
                                    ->get();
        
        return response()->json($subCategories);
    }
}