<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_type_id',
        'quantity',
        'total_price',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    // Acceso rápido al festival a través del tipo de entrada
    public function festival()
    {
        return $this->ticketType->festival;
    }
}
