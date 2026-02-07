<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaTerkini extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'video_url',
        'photos',
        'is_active',
        'views'
    ];

    protected $casts = [
        'photos' => 'array',
        'is_active' => 'boolean',
        'views' => 'integer'
    ];

    // ================= SCOPES =================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeOlder($query)
    {
        return $query->whereDate('created_at', '<', today());
    }

    // ================= HELPERS =================

    public function hasPhotos()
    {
        return is_array($this->photos) && count($this->photos) > 0;
    }

    public function getThumbnailUrl()
    {
        if ($this->thumbnail && Storage::disk('public')->exists($this->thumbnail)) {
             return Storage::url($this->thumbnail);
        }
        return asset('img/default-news.jpg');
    }

    public function getPhotosUrls()
    {
        if (!$this->hasPhotos()) {
            return [];
        }

        return array_map(function($photo) {
             return Storage::url($photo);
        }, $this->photos);
    }
    
    // ================= BOOT =================

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->title);
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('title') && empty($berita->slug)) {
                $berita->slug = Str::slug($berita->title);
            }
        });
        
        static::deleting(function ($berita) {
            // Delete thumbnail
            if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
                Storage::disk('public')->delete($berita->thumbnail);
            }

            // Delete photos
            if ($berita->hasPhotos()) {
                foreach ($berita->photos as $photo) {
                    if (Storage::disk('public')->exists($photo)) {
                        Storage::disk('public')->delete($photo);
                    }
                }
            }
            
            // Delete video if it's a file path (not URL)
            if ($berita->video_url && !filter_var($berita->video_url, FILTER_VALIDATE_URL)) {
                if (Storage::disk('public')->exists($berita->video_url)) {
                    Storage::disk('public')->delete($berita->video_url);
                }
            }
        });
    }}
