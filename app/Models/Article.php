<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id', // TAMBAHAN BARU
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Auto generate slug dari title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    // Relationship: Article belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: Article belongs to SubCategory (TAMBAHAN BARU)
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // Relationship: Article belongs to User (Author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: Article punya banyak Comment (Polymorphic)
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Get approved comments count
    public function approvedCommentsCount()
    {
        return $this->comments()->where('status', 'approved')->count();
    }

    // Scope: Only published articles
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Get excerpt (auto dari content kalau kosong)
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return Str::limit(strip_tags($this->content), 150);
    }

    // Get thumbnail URL or null
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail && file_exists(public_path($this->thumbnail))) {
            return asset($this->thumbnail);
        }
        return null;
    }
}