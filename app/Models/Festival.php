<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class);
    }

    public function getImageAttribute(): string
    {
        if (str_starts_with($this->image_url ?? '', 'http')) {
            return $this->image_url;
        }
        return asset('storage/' . $this->image_url);
    }

    protected $fillable = [
        'name',
        'location',
        'location_id',
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
