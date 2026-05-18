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

    public function checkout($festival_id, $ticket_type_id)
    {
        $festival   = Festival::with('ticketTypes')->findOrFail($festival_id);
        $ticketType = TicketType::where('festival_id', $festival_id)->findOrFail($ticket_type_id);

        if (!$ticketType->isAvailable()) {
            return redirect()->route('festivals.show', $festival_id)
                ->with('error', 'Lo sentimos, este tipo de entrada está agotado.');
        }

        return view('orders.checkout', compact('festival', 'ticketType'));
    }

    public function store(Request $request, $festival_id, $ticket_type_id)
    {
        $ticketType = TicketType::where('festival_id', $festival_id)->findOrFail($ticket_type_id);

        $request->validate([
            'quantity'    => 'required|integer|min:1|max:10',
            'buyer_name'  => 'required|string|max:255',
            'buyer_email' => 'required|email|max:255',
            'buyer_phone' => 'nullable|string|max:20',
        ]);

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

    public function confirmation($order_id)
    {
        $order = Order::with(['ticketType.festival'])->findOrFail($order_id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.confirmation', compact('order'));
    }

    public function myOrders()
    {
        $orders = Order::with(['ticketType.festival'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.my-orders', compact('orders'));
    }

    public function refund($order_id)
    {
        $order = Order::findOrFail($order_id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'confirmed') {
            return back()->with('error', 'Esta entrada no puede ser devuelta.');
        }

        $order->update(['status' => 'refunded']);

        return back()->with('success', 'Entrada devuelta correctamente. El reembolso se procesará en 3-5 días hábiles.');
    }
}