<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Entradas - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    <nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
                VENUE<span class="text-pink-500">/</span>
            </a>
            <div class="flex items-center gap-6">
                <a href="{{ route('festivals.index') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Cartelera</a>
                <span class="text-gray-600">|</span>
                <span class="text-sm text-gray-400">Hola, <strong class="text-white">{{ Auth::user()->name }}</strong></span>
                <form method="POST" action="{{ route('logout') }}" class="inline m-0">
                    @csrf
                    <button type="submit" style="background:none!important;padding:0!important;margin:0!important;border:none!important;box-shadow:none!important;" class="text-sm font-bold uppercase tracking-widest text-gray-500 hover:text-red-400 transition-colors">Salir</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="min-h-screen pt-28 pb-16 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-12">
                <span class="text-pink-500 text-xs font-black uppercase tracking-[0.4em]">Mi cuenta</span>
                <h1 class="text-5xl font-black uppercase tracking-tighter mt-2">Mis Entradas</h1>
                <p class="text-gray-400 text-sm mt-2">{{ $orders->count() }} pedido{{ $orders->count() != 1 ? 's' : '' }} registrado{{ $orders->count() != 1 ? 's' : '' }}</p>
            </div>

            @if($orders->isEmpty())
                <div class="text-center py-24 border border-gray-800 bg-gray-950">
                    <svg class="w-16 h-16 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <p class="text-gray-500 uppercase tracking-widest text-sm mb-6">No tienes entradas todavía</p>
                    <a href="{{ route('festivals.index') }}" class="bg-gradient-to-r from-pink-600 to-red-600 text-white text-xs font-black uppercase px-8 py-3 tracking-widest hover:from-pink-500 hover:to-red-500 transition-all">
                        Ver Festivales
                    </a>
                </div>
            @else
                <div class="space-y-5">
                    @foreach($orders as $order)
                        <div class="bg-gray-950 border border-gray-800 hover:border-pink-600/40 transition-colors overflow-hidden">
                            <div class="flex">
                                {{-- Imagen lateral --}}
                                <div class="w-32 shrink-0 hidden sm:block">
                                    <img src="{{ asset('storage/' . $order->ticketType->festival->image_url) }}" class="w-full h-full object-cover opacity-60">
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 p-5">
                                    <div class="flex justify-between items-start flex-wrap gap-3">
                                        <div>
                                            <h3 class="font-black text-white uppercase tracking-tight text-xl leading-none">
                                                {{ $order->ticketType->festival->name }}
                                            </h3>
                                            <p class="text-gray-400 text-xs uppercase tracking-widest mt-1">
                                                {{ $order->ticketType->festival->location }} · {{ \Carbon\Carbon::parse($order->ticketType->festival->date)->format('d M Y') }}
                                            </p>
                                        </div>
                                        <span class="bg-green-500/10 border border-green-500/30 text-green-400 text-[10px] font-black uppercase px-3 py-1 tracking-widest">
                                            Confirmado
                                        </span>
                                    </div>

                                    <div class="mt-4 flex flex-wrap gap-6 text-sm border-t border-gray-800 pt-4">
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Tipo</p>
                                            <p class="text-pink-500 font-black uppercase text-sm mt-0.5">{{ $order->ticketType->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Cantidad</p>
                                            <p class="text-white font-bold mt-0.5">{{ $order->quantity }} entrada{{ $order->quantity > 1 ? 's' : '' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Total</p>
                                            <p class="text-white font-bold mt-0.5">{{ number_format($order->total_price, 2) }}€</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Nº Pedido</p>
                                            <p class="text-gray-400 font-bold mt-0.5">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Fecha compra</p>
                                            <p class="text-gray-400 font-bold mt-0.5">{{ $order->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</body>
</html>
