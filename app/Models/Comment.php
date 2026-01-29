<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentable_id',
        'commentable_type',
        'name',
        'email',
        'comment',
        'status',
    ];

    // Polymorphic relationship (bisa untuk Article, Program, Intisari, Kegiatan)
    public function commentable()
    {
        return $this->morphTo();
    }

    // Scope: Hanya komentar approved
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Get inisial nama untuk avatar
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->name, 0, 2));
    }
    public function program()
{
    return $this->belongsTo(Program::class);
}

}