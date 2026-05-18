<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artist->name }} - VENUE/</title>
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
                <a href="{{ route('artists.index') }}" class="text-sm font-bold uppercase tracking-widest text-pink-500">Artistas</a>
                @auth
                    <a href="{{ route('profile.show') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Mi Perfil</a>
                    <a href="{{ route('orders.my-orders') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Mis Entradas</a>
                    @if(Auth::user()->role_id == 1)
                        <a href="{{ route('dashboard') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Panel Admin</a>
                    @endif
                    <span class="text-gray-700">|</span>
                    <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                        @csrf
                        <button type="submit" style="background:none!important;border:none!important;box-shadow:none!important;padding:0!important;margin:0!important;"
                            class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-red-400 transition-colors leading-none">Salir</button>
                    </form>
                @else
                    <span class="text-gray-700">|</span>
                    <a href="{{ route('login') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Entrar</a>
                    <a href="{{ route('register') }}" class="border border-pink-500 text-pink-500 px-4 py-1.5 text-sm font-bold uppercase tracking-widest hover:bg-pink-500 hover:text-white transition-all">Registro</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <div class="relative h-[50vh] overflow-hidden">
        <img src="{{ asset('storage/' . ($artist->image_url ?? 'default.jpg')) }}" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-10 max-w-7xl mx-auto">
            @if($artist->genre)
                <span class="text-pink-500 text-xs font-black uppercase tracking-[0.4em]">{{ $artist->genre }}</span>
            @endif
            <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mt-2 leading-none">{{ $artist->name }}</h1>
            @if($artist->country)
                <p class="text-gray-400 text-sm uppercase tracking-widest mt-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    {{ $artist->country }}
                </p>
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- IZQUIERDA: Bio + YouTube + Festivales --}}
            <div class="lg:col-span-2 space-y-10">

                @if($artist->bio)
                    <div>
                        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-4">Sobre el artista</h2>
                        <p class="text-gray-300 text-base leading-relaxed">{{ $artist->bio }}</p>
                    </div>
                @endif

                @if($artist->youtube_url)
                    <div>
                        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-4">En directo</h2>
                        <div class="relative w-full" style="padding-bottom: 56.25%;">
                            <iframe
                                src="{{ preg_replace('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', 'https://www.youtube.com/embed/$1', $artist->youtube_url) }}"
                                class="absolute inset-0 w-full h-full border border-gray-800"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                @endif

                @if($artist->festivals->count() > 0)
                    <div>
                        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-4">Próximas actuaciones</h2>
                        <div class="space-y-3">
                            @foreach($artist->festivals as $festival)
                                <a href="{{ route('festivals.show', $festival->id) }}"
                                    class="flex items-center gap-4 bg-gray-950 border border-gray-800 p-4 hover:border-pink-600/50 transition-colors group">
                                    <img src="{{ asset('storage/' . $festival->image_url) }}" class="w-14 h-14 object-cover border border-gray-700 shrink-0">
                                    <div class="flex-1">
                                        <h3 class="font-black text-white uppercase tracking-tight group-hover:text-pink-400 transition-colors">{{ $festival->name }}</h3>
                                        <p class="text-gray-500 text-xs uppercase tracking-widest mt-0.5">{{ $festival->location }} · {{ \Carbon\Carbon::parse($festival->date)->format('d M Y') }}</p>
                                    </div>
                                    @if($festival->pivot->performance_start)
                                        <span class="text-pink-500 font-black text-sm shrink-0">
                                            {{ \Carbon\Carbon::parse($festival->pivot->performance_start)->format('H:i') }}
                                        </span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            {{-- DERECHA: Spotify + volver --}}
            <div class="space-y-6">

                @if($artist->spotify_url)
                    <div>
                        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-4">Escúchalo en Spotify</h2>
                        @php
                            $spotifyEmbed = preg_replace(
                                '/https:\/\/open\.spotify\.com\/(artist|album|track|playlist)\/([a-zA-Z0-9]+).*/',
                                'https://open.spotify.com/embed/$1/$2',
                                $artist->spotify_url
                            );
                        @endphp
                        <iframe
                            src="{{ $spotifyEmbed }}"
                            width="100%"
                            height="380"
                            frameborder="0"
                            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                            loading="lazy"
                            class="border border-gray-800">
                        </iframe>
                    </div>
                @endif

                <a href="{{ route('artists.index') }}"
                    class="block text-center border border-gray-700 text-gray-400 text-xs font-black uppercase py-3 tracking-widest hover:border-white hover:text-white transition-all">
                    ← Ver todos los artistas
                </a>

            </div>
        </div>
    </div>

</body>
</html>
