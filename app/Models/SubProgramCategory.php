<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubProgramCategory extends Model
{
    use HasFactory;

    protected $table = 'program_subcategories'; // sesuaikan dengan migration

    protected $fillable = [
        'program_category_id',
        'name',
        'slug',
        'sort_order',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subcategory) {
            if (empty($subcategory->slug)) {
                $subcategory->slug = Str::slug($subcategory->name);
            }
        });
    }

    // ================= RELATIONSHIPS =================

    /**
     * Subcategory belongs to Category
     */
    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'program_category_id');
    }

    /**
     * Subcategory has many Programs
     */
    public function programs()
    {
        return $this->hasMany(Program::class, 'program_subcategory_id');
    }

    // ================= HELPERS =================

    /**
     * Hitung jumlah program aktif
     */
    public function activeProgramsCount()
    {
        return $this->programs()
                    ->where('is_active', true)
                    ->count();
    }
}   