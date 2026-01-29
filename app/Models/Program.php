<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_category_id',
        'program_subcategory_id',
        'title',
        'slug',
        'description',
        'content',
        'media_type',
        'thumbnail',
        'photos',
        'video_url',
        'media_position',
        'position',
        'is_active'
    ];

    protected $casts = [
        'photos' => 'array',
        'is_active' => 'boolean',
    ];

    // ================= RELATIONSHIPS =================

    /**
     * Program belongs to Category
     */
    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'program_category_id');
    }

    /**
     * Program belongs to Subcategory (optional)
     */
    public function subcategory()
    {
        return $this->belongsTo(SubProgramCategory::class, 'program_subcategory_id');
    }

    /**
     * Program has many children (related programs in same category)
     */
    public function children()
    {
        return $this->hasMany(Program::class, 'program_category_id', 'program_category_id');
    }

    /**
     * Program has many Comments (Polymorphic)
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // ================= QUERY SCOPES =================

    /**
     * Get parent programs (programs without a parent, ordered by sort_order)
     */
    public function scopeParents($query)
    {
        return $query->whereNull('program_subcategory_id');
    }

    // ================= HELPERS =================

    /**
     * Cek apakah program ini punya photos
     */
    public function hasPhotos()
    {
        return is_array($this->photos) && count($this->photos) > 0;
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrl()
    {
        if ($this->thumbnail) {
            return Storage::url($this->thumbnail);
        }
        return asset('images/default-program.jpg');
    }

    /**
     * Get all photos URLs
     */
    public function getPhotosUrls()
    {
        if (!$this->hasPhotos()) {
            return [];
        }

        return array_map(function($photo) {
            return Storage::url($photo);
        }, $this->photos);
    }

    /**
     * Cek apakah media type video
     */
    public function isVideo()
    {
        return $this->media_type === 'video';
    }

    /**
     * Cek apakah media type image
     */
    public function isImage()
    {
        return $this->media_type === 'image';
    }

    // ================= BOOT =================

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            // Auto-generate slug
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }

            // Set default position
            if (is_null($program->position)) {
                $maxPosition = static::where('program_category_id', $program->program_category_id)
                    ->when($program->program_subcategory_id, function ($q) use ($program) {
                        return $q->where('program_subcategory_id', $program->program_subcategory_id);
                    })
                    ->max('position');
                
                $program->position = ($maxPosition ?? 0) + 1;
            }
        });

        static::updating(function ($program) {
            // Update slug if title changed
            if ($program->isDirty('title') && empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });

        // Hapus file saat program dihapus
        static::deleting(function ($program) {
            // Hapus thumbnail
            if ($program->thumbnail && Storage::exists($program->thumbnail)) {
                Storage::delete($program->thumbnail);
            }

            // Hapus photos
            if ($program->hasPhotos()) {
                foreach ($program->photos as $photo) {
                    if (Storage::exists($photo)) {
                        Storage::delete($photo);
                    }
                }
            }
        });
    }
}