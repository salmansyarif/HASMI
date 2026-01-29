<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Intisari extends Model
{
    use HasFactory;

    protected $fillable = [
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

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($intisari) {
            if (empty($intisari->slug)) {
                $intisari->slug = Str::slug($intisari->title);
            }
        });
    }

    // Polymorphic relationship: Intisari punya banyak Comment
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Get approved comments count
    public function approvedCommentsCount()
    {
        return $this->comments()->where('status', 'approved')->count();
    }

    // Scope: Only published
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