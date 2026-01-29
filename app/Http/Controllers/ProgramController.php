<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramCategory;
use App\Models\SubProgramCategory;

class ProgramController extends Controller
{
    /**
     * Halaman index semua programs
     */
    /**
     * Halaman index semua programs
     */
    public function index()
    {
        // Ambil semua program yang kategorinya is_creatable = true
        $programs = Program::whereHas('category', function($q) {
                                $q->where('is_creatable', true);
                            })
                            ->where('is_active', true)
                            ->with(['category', 'subcategory'])
                            ->orderBy('position')
                            ->orderBy('created_at', 'desc')
                            ->paginate(9);

        // Ambil list kategori untuk filter buttons
        $categories = ProgramCategory::where('is_creatable', true)
                                    ->orderBy('sort_order')
                                    ->get();

        return view('program.index', compact('programs', 'categories'));
    }

    /**
     * Show programs by category
     */
    public function category($categorySlug)
    {
        $category = ProgramCategory::where('slug', $categorySlug)->firstOrFail();

        // Cek apakah harus redirect
        if ($category->shouldRedirect()) {
            return redirect()->away($category->getRedirectUrl());
        }

        // Ambil subcategories
        $subcategories = $category->subcategories;

        // Ambil programs
        $programs = $category->programs()
                            ->where('is_active', true)
                            ->with(['subcategory'])
                            ->orderBy('position')
                            ->orderBy('created_at', 'desc')
                            ->paginate(9);

        return view('program.category', compact('category', 'subcategories', 'programs'));
    }

    /**
     * Show programs by subcategory
     */
    public function subcategory($categorySlug, $subcategorySlug)
    {
        $category = ProgramCategory::where('slug', $categorySlug)->firstOrFail();
        $subcategory = SubProgramCategory::where('program_category_id', $category->id)
                                        ->where('slug', $subcategorySlug)
                                        ->firstOrFail();

        $programs = $subcategory->programs()
                               ->where('is_active', true)
                               ->orderBy('position')
                               ->orderBy('created_at', 'desc')
                               ->paginate(9);

        return view('program.subcategory', compact('category', 'subcategory', 'programs'));
    }

    /**
     * Show single program detail
     */
    public function show($slug)
    {
        $program = Program::where('slug', $slug)
                         ->where('is_active', true)
                         ->with(['category', 'subcategory', 'comments' => function($query) {
                            $query->where('status', 'approved')->latest();
                         }])
                         ->firstOrFail();

        // Get related programs (same category or subcategory)
        if ($program->program_subcategory_id) {
            $relatedPrograms = Program::where('program_subcategory_id', $program->program_subcategory_id)
                                     ->where('id', '!=', $program->id)
                                     ->where('is_active', true)
                                     ->orderBy('position')
                                     ->limit(3)
                                     ->get();
        } else {
            $relatedPrograms = Program::where('program_category_id', $program->program_category_id)
                                     ->where('id', '!=', $program->id)
                                     ->where('is_active', true)
                                     ->orderBy('position')
                                     ->limit(3)
                                     ->get();
        }

        return view('program.show', compact('program', 'relatedPrograms'));
    }
}