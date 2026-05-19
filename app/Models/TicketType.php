<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = ['festival_id', 'name', 'price', 'quantity'];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function soldCount()
    {
        return $this->orders()->where('status', 'confirmed')->sum('quantity');
    }

    // Entradas disponibles
    public function availableCount()
    {
        return $this->quantity - $this->soldCount();
    }

    public function isAvailable()
    {
        return $this->availableCount() > 0;
    }
}
