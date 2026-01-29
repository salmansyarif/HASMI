<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    // Relationship: Category punya banyak Article
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Relationship: Category punya banyak SubCategory
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class)->orderBy('order');
    }

    // Check apakah category punya sub-category
    public function hasSubCategories()
    {
        return $this->subCategories()->count() > 0;
    }

    // Get published articles count
    public function publishedArticlesCount()
    {
        return $this->articles()->where('status', 'published')->count();
    }
}