<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'icon',
        'order',
    ];

    // Auto generate slug dari name
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subCategory) {
            if (empty($subCategory->slug)) {
                $subCategory->slug = Str::slug($subCategory->name);
            }
        });
    }

    // Relationship: SubCategory belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: SubCategory punya banyak Article
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Get published articles count
    public function publishedArticlesCount()
    {
        return $this->articles()->where('status', 'published')->count();
    }
}