<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artist->name }} - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    @include('partials.navbar', ['active' => 'artistas'])

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
                                        <span class="text-pink-500 font-black text-sm shrink-0">{{ \Carbon\Carbon::parse($festival->pivot->performance_start)->format('H:i') }}</span>
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
                        <a href="{{ $artist->spotify_url }}" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-5 bg-gray-950 border border-gray-800 hover:border-green-500/50 p-6 transition-all duration-300 group">
                            {{-- Logo Spotify --}}
                            <div class="w-14 h-14 rounded-full bg-green-500/10 border border-green-500/30 flex items-center justify-center shrink-0 group-hover:bg-green-500/20 transition-colors">
                                <svg class="w-7 h-7 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-white font-black uppercase tracking-tight text-base leading-none group-hover:text-green-400 transition-colors">{{ $artist->name }}</p>
                                <p class="text-gray-500 text-xs uppercase tracking-widest mt-1">Abrir en Spotify</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-green-400 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                @endif

                <a href="{{ route('artists.index') }}"
                    class="block text-center border border-gray-700 text-gray-400 text-xs font-black uppercase py-3 tracking-widest hover:border-white hover:text-white transition-all">
                    ← Ver todos los artistas
                </a>

            </div>
        </div>
    </div>

    @include('partials.footer')

</body>
</html>