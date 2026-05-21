<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $festival->name }} - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    @include('partials.navbar', ['active' => 'cartelera'])

    <div class="relative h-[60vh] overflow-hidden">
        <img src="{{ $festival->image }}" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-10 max-w-7xl mx-auto">
            <span class="text-pink-500 text-xs font-black uppercase tracking-[0.4em]">{{ $festival->style }}</span>
            <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mt-2 leading-none">{{ $festival->name }}</h1>
            <div class="flex items-center gap-6 mt-4 text-gray-400 text-sm">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                    {{ \Carbon\Carbon::parse($festival->date)->format('d \d\e F \d\e Y') }}
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    {{ $festival->location }}
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-3 gap-12">

        <div class="lg:col-span-2">
            <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-6">Lineup Oficial</h2>
            @if($festival->artists->isEmpty())
                <p class="text-gray-500 uppercase tracking-widest text-sm">Cartel por confirmar.</p>
            @else
                <div class="space-y-3">
                    @foreach($festival->artists as $artist)
                        <div class="flex items-center gap-5 bg-gray-950 border border-gray-800 p-4 hover:border-pink-600/50 transition-colors">
                            <div class="text-center w-20 shrink-0">
                                <span class="block font-black text-2xl text-white leading-none">{{ \Carbon\Carbon::parse($artist->pivot->performance_start)->format('H:i') }}</span>
                                <span class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">a {{ \Carbon\Carbon::parse($artist->pivot->performance_end)->format('H:i') }}</span>
                            </div>
                            <div class="w-px h-12 bg-gray-800 shrink-0"></div>
                            <img src="{{ $artist->image }}" class="w-14 h-14 object-cover rounded-sm border border-gray-700 shrink-0">                            <div>
                                <h3 class="font-black text-white uppercase tracking-tight text-lg leading-none">{{ $artist->name }}</h3>
                                <p class="text-pink-500 text-xs font-bold uppercase tracking-widest mt-1">{{ $artist->genre ?? 'Artista' }}</p>
                                <p class="text-gray-500 text-xs uppercase tracking-widest">{{ $artist->country ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if($festival->location_id && $festival->location instanceof \App\Models\Location)
                <div class="mt-10">
                    <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-6">El Recinto</h2>
                    <div class="bg-gray-950 border border-gray-800 p-6 space-y-4">
                        <div>
                            <h3 class="font-black text-white uppercase tracking-tight text-2xl leading-none">{{ $festival->location->name }}</h3>
                            <p class="text-gray-400 text-sm mt-2">{{ $festival->location->description }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-800">
                            <div>
                                <p class="text-[10px] text-gray-600 uppercase tracking-widest font-bold">Dirección</p>
                                <p class="text-white text-sm mt-1">{{ $festival->location->address }}</p>
                                <p class="text-gray-400 text-xs">{{ $festival->location->city }}, {{ $festival->location->country }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-600 uppercase tracking-widest font-bold">Aforo Máximo</p>
                                <p class="text-white font-black text-2xl mt-1">{{ number_format($festival->location->capacity) }}</p>
                                <p class="text-gray-500 text-xs">personas</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div>
            <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-6">Entradas</h2>
            @if(session('error'))
                <div class="mb-4 bg-red-900/30 border border-red-500/30 text-red-400 p-3 text-xs font-bold uppercase tracking-wide">{{ session('error') }}</div>
            @endif
            @if($festival->ticketTypes->isEmpty())
                <p class="text-gray-500 text-sm uppercase tracking-widest">Entradas próximamente.</p>
            @elseif(\Carbon\Carbon::parse($festival->date)->isPast())
                <div class="bg-gray-950 border border-gray-800 p-5">
                    <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Este festival ya ha tenido lugar. Las entradas no están disponibles.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($festival->ticketTypes as $type)
                        <div class="bg-gray-950 border {{ $type->isAvailable() ? 'border-gray-800 hover:border-pink-600/50' : 'border-gray-900 opacity-50' }} p-5 transition-colors">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-black text-white uppercase tracking-tight text-lg">{{ $type->name }}</h3>
                                    <p class="text-gray-500 text-xs uppercase tracking-widest mt-1">
                                        @if($type->isAvailable()) {{ $type->availableCount() }} disponibles @else Agotado @endif
                                    </p>
                                </div>
                                <span class="text-2xl font-black text-pink-500">{{ number_format($type->price, 2) }}€</span>
                            </div>
                            @if($type->isAvailable())
                                @auth
                                    <a href="{{ route('orders.checkout', [$festival->id, $type->id]) }}"
                                        class="block w-full text-center bg-gradient-to-r from-pink-600 to-red-600 text-white text-xs font-black uppercase py-3 tracking-widest hover:from-pink-500 hover:to-red-500 transition-all">
                                        Comprar Entrada
                                    </a>
                                @else
                                    <a href="{{ route('login') }}?redirect={{ urlencode('/festivales/' . $festival->id . '/comprar/' . $type->id) }}"
                                        class="block w-full text-center border border-pink-500 text-pink-500 text-xs font-black uppercase py-3 tracking-widest hover:bg-pink-500 hover:text-white transition-all">
                                        Inicia sesión para comprar
                                    </a>
                                @endauth
                            @else
                                <span class="block w-full text-center bg-gray-800 text-gray-500 text-xs font-black uppercase py-3 tracking-widest cursor-not-allowed">Agotado</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @include('partials.footer')

</body>
</html>