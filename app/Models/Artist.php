<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    // Le decimos a Laravel qué campos se pueden rellenar desde el formulario
    protected $fillable = [
        'name',
        'genre',
        'country',
        'image_url',
    ];
}