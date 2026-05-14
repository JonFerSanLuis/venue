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
        return $this->belongsToMany(Artist::class)
            ->withPivot('performance_start', 'performance_end')
            ->withTimestamps();
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }
}
