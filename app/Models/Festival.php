<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'style',
        'date',
        'image_url',
    ];

    public function artists()
    {
        // Un festival tiene muchos artistas, y nos traemos sus horas de actuación
        return $this->belongsToMany(Artist::class)->withPivot('performance_start', 'performance_end')->withTimestamps();
    }
}