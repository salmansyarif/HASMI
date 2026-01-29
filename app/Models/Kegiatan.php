<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'thumbnail',
        'photos',
        'show_thumbnail_in_list',  // ← TAMBAH INI
        'photo_position',           // ← TAMBAH INI
        'event_date',
        'location',
        'status',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'photos' => 'array',
        'show_thumbnail_in_list' => 'boolean',  // ← TAMBAH INI
    ];

    // Auto generate slug dari title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kegiatan) {
            if (empty($kegiatan->slug)) {
                $kegiatan->slug = Str::slug($kegiatan->title);
            }
        });

        static::updating(function ($kegiatan) {
            if ($kegiatan->isDirty('title') && empty($kegiatan->slug)) {
                $kegiatan->slug = Str::slug($kegiatan->title);
            }
        });
    }

    // Relasi polymorphic ke Comment
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Hitung jumlah komentar yang approved
    public function approvedCommentsCount()
    {
        return $this->comments()->approved()->count();
    }

    // Scope: Only published kegiatan
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Helper: Cek apakah kegiatan punya photos
    public function hasPhotos()
    {
        return !empty($this->photos) && is_array($this->photos) && count($this->photos) > 0;
    }

    // Helper: Get thumbnail URL or default
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail && file_exists(public_path($this->thumbnail))) {
            return asset($this->thumbnail);
        }
        return asset('images/default-kegiatan.jpg');
    }

    // Helper: Format event date
    public function getFormattedEventDateAttribute()
    {
        return $this->event_date ? $this->event_date->locale('id')->isoFormat('dddd, D MMMM YYYY') : null;
    }
}