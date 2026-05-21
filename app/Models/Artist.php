<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    public function getImageAttribute(): string
    {
        if (str_starts_with($this->image_url ?? '', 'http')) {
            return $this->image_url;
        }
        return asset('storage/' . ($this->image_url ?? 'default.jpg'));
    }

    protected $fillable = [
        'name',
        'genre',
        'country',
        'image_url',
        'bio',
        'spotify_url',
        'youtube_url',
    ];

    public function festivals()
    {
        return $this->belongsToMany(Festival::class)
            ->withPivot('performance_start', 'performance_end')
            ->withTimestamps();
    }
}