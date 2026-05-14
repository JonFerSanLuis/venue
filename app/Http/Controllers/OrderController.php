<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TicketType;
use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar el checkout para un tipo de entrada
    public function checkout($festival_id, $ticket_type_id)
    {
        $festival = Festival::with('ticketTypes')->findOrFail($festival_id);
        $ticketType = TicketType::where('festival_id', $festival_id)
            ->findOrFail($ticket_type_id);

        if (!$ticketType->isAvailable()) {
            return redirect()->route('festivals.show', $festival_id)
                ->with('error', 'Lo sentimos, este tipo de entrada está agotado.');
        }

        return view('orders.checkout', compact('festival', 'ticketType'));
    }

    // Procesar la compra
    public function store(Request $request, $festival_id, $ticket_type_id)
    {
        $ticketType = TicketType::where('festival_id', $festival_id)
            ->findOrFail($ticket_type_id);

        $request->validate([
            'quantity'    => 'required|integer|min:1|max:10',
            'buyer_name'  => 'required|string|max:255',
            'buyer_email' => 'required|email|max:255',
            'buyer_phone' => 'nullable|string|max:20',
        ]);

        // Comprobar disponibilidad con la cantidad solicitada
        if ($ticketType->availableCount() < $request->quantity) {
            return back()->withErrors([
                'quantity' => "Solo quedan {$ticketType->availableCount()} entradas disponibles."
            ])->withInput();
        }

        $order = Order::create([
            'user_id'        => Auth::id(),
            'ticket_type_id' => $ticketType->id,
            'quantity'       => $request->quantity,
            'total_price'    => $ticketType->price * $request->quantity,
            'buyer_name'     => $request->buyer_name,
            'buyer_email'    => $request->buyer_email,
            'buyer_phone'    => $request->buyer_phone,
            'status'         => 'confirmed',
        ]);

        return redirect()->route('orders.confirmation', $order->id);
    }

    // Página de confirmación
    public function confirmation($order_id)
    {
        $order = Order::with(['ticketType.festival'])->findOrFail($order_id);

        // Solo el propietario puede ver su confirmación
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.confirmation', compact('order'));
    }

    // Historial de pedidos del usuario
    public function myOrders()
    {
        $orders = Order::with(['ticketType.festival'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.my-orders', compact('orders'));
    }
}
