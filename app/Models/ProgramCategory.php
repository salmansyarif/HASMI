<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'has_subcategories',
        'is_creatable',
        'redirect_type',
        'redirect_url',
        'sort_order'
    ];

    protected $casts = [
        'has_subcategories' => 'boolean',
        'is_creatable' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // ================= RELATIONSHIPS =================

    /**
     * Category has many subcategories
     */
    public function subcategories()
    {
        return $this->hasMany(SubProgramCategory::class, 'program_category_id')
                    ->orderBy('sort_order');
    }

    /**
     * Category has many programs (direct)
     */
    public function programs()
    {
        return $this->hasMany(Program::class, 'program_category_id');
    }

    // ================= HELPERS =================

    /**
     * Cek apakah bisa redirect
     */
    public function shouldRedirect()
    {
        return !empty($this->redirect_type) && !empty($this->redirect_url);
    }

    /**
     * Get redirect URL
     */
    public function getRedirectUrl()
    {
        if ($this->redirect_type === 'youtube') {
            return $this->redirect_url;
        }
        
        if ($this->redirect_type === 'static') {
            return url($this->redirect_url);
        }

        return null;
    }
}