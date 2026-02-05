<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Article;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    // SEMUA ARTIKEL dari SEMUA CATEGORY
    public function index()
    {
        $articles = Article::with(['category', 'subCategory', 'author'])
                          ->published()
                          ->orderBy('published_at', 'desc')
                          ->paginate(10);

        return view('materi.index', compact('articles'));
    }

    // ARTIKEL dari CATEGORY TERTENTU
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $articles = Article::with(['subCategory', 'author'])
                          ->where('category_id', $category->id)
                          ->published()
                          ->orderBy('published_at', 'desc')
                          ->paginate(10);

        return view('materi.show', compact('category', 'articles'));
    }

    // ARTIKEL dari SUB-CATEGORY TERTENTU (BARU)
    public function showSubCategory($categorySlug, $subCategorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $subCategory = SubCategory::where('slug', $subCategorySlug)
                                  ->where('category_id', $category->id)
                                  ->firstOrFail();
        
        $articles = Article::with('author')
                          ->where('category_id', $category->id)
                          ->where('sub_category_id', $subCategory->id)
                          ->published()
                          ->orderBy('published_at', 'desc')
                          ->paginate(10);

        return view('materi.sub-category', compact('category', 'subCategory', 'articles'));
    }

    // DETAIL ARTIKEL
    public function detail($categorySlug, $articleSlug)
    {
        $article = Article::with(['category', 'subCategory', 'author', 'comments' => function($query) {
                        $query->where('status', 'approved')->latest();
                    }])
                     ->where('slug', $articleSlug)
                     ->published()
                     ->firstOrFail();

        $relatedArticles = Article::where('category_id', $article->category_id)
                                 ->where('id', '!=', $article->id)
                                 ->published()
                                 ->limit(3)
                                 ->get();

        return view('materi.detail', compact('article', 'relatedArticles'));
    }
}