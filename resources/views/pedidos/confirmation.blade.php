<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>¡Pedido Confirmado! - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    <nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
                VENUE<span class="text-pink-500">/</span>
            </a>
            <a href="{{ route('orders.my-orders') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">
                Mis Entradas
            </a>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-4 pt-20">
        <div class="max-w-lg w-full text-center">

            {{-- Icono check --}}
            <div class="w-24 h-24 rounded-full bg-green-500/10 border border-green-500/30 flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <span class="text-green-400 text-xs font-black uppercase tracking-[0.4em]">Pedido Confirmado</span>
            <h1 class="text-4xl font-black uppercase tracking-tighter mt-3 mb-2">¡Todo listo!</h1>
            <p class="text-gray-400 text-sm mb-10">
                Tu entrada para <strong class="text-white">{{ $order->ticketType->festival->name }}</strong> está confirmada. Te hemos enviado un resumen a <strong class="text-white">{{ $order->buyer_email }}</strong>.
            </p>

            {{-- Ticket visual --}}
            <div class="bg-gray-950 border border-gray-800 text-left overflow-hidden mb-8">
                {{-- Imagen cabecera --}}
                <img src="{{ asset('storage/' . $order->ticketType->festival->image_url) }}" class="w-full h-32 object-cover opacity-60">

                {{-- Línea perforada --}}
                <div class="flex items-center px-6 py-3 border-b border-dashed border-gray-700">
                    <div class="w-4 h-4 rounded-full bg-black border border-gray-700 -ml-8 mr-auto"></div>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-600">Entrada válida</span>
                    <div class="w-4 h-4 rounded-full bg-black border border-gray-700 -mr-8 ml-auto"></div>
                </div>

                <div class="p-6 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Evento</p>
                        <p class="text-white font-black uppercase text-sm mt-1">{{ $order->ticketType->festival->name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Tipo</p>
                        <p class="text-pink-500 font-black uppercase text-sm mt-1">{{ $order->ticketType->name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Fecha</p>
                        <p class="text-white font-bold text-sm mt-1">{{ \Carbon\Carbon::parse($order->ticketType->festival->date)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Recinto</p>
                        <p class="text-white font-bold text-sm mt-1">{{ $order->ticketType->festival->location }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Titular</p>
                        <p class="text-white font-bold text-sm mt-1">{{ $order->buyer_name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Cantidad</p>
                        <p class="text-white font-bold text-sm mt-1">{{ $order->quantity }} entrada{{ $order->quantity > 1 ? 's' : '' }}</p>
                    </div>
                </div>

                {{-- Total --}}
                <div class="border-t border-dashed border-gray-700 px-6 py-4 flex justify-between items-center">
                    <span class="text-xs font-black uppercase tracking-widest text-gray-500">Total Pagado</span>
                    <span class="text-2xl font-black text-pink-500">{{ number_format($order->total_price, 2) }}€</span>
                </div>

                {{-- Código de pedido --}}
                <div class="bg-gray-900 px-6 py-3 text-center">
                    <span class="text-[10px] text-gray-600 uppercase tracking-widest">Nº Pedido: </span>
                    <span class="text-gray-400 font-black tracking-widest text-xs">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>

            <div class="flex gap-4 justify-center">
                <a href="{{ route('festivals.index') }}"
                    class="border border-gray-700 text-gray-300 text-xs font-black uppercase px-6 py-3 tracking-widest hover:border-white hover:text-white transition-all">
                    Ver más Festivales
                </a>
                <a href="{{ route('orders.my-orders') }}"
                    class="bg-gradient-to-r from-pink-600 to-red-600 text-white text-xs font-black uppercase px-6 py-3 tracking-widest hover:from-pink-500 hover:to-red-500 transition-all">
                    Mis Entradas
                </a>
            </div>

        </div>
    </div>

</body>
</html>
