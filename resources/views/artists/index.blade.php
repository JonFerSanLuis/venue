<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artistas - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn ease 1s; }
        @keyframes fadeIn { 0%{opacity:0;transform:translateY(10px);} 100%{opacity:1;transform:translateY(0);} }
    </style>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    @include('partials.navbar', ['active' => 'artistas'])

    <div class="pt-32 pb-16 text-center px-4 relative">
        <div class="absolute inset-0 bg-gradient-to-b from-pink-900/10 to-transparent pointer-events-none"></div>
        <span class="block text-pink-500 font-bold uppercase tracking-[0.4em] text-xs mb-3">Talento en directo</span>
        <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter leading-none">
            Nuestros <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500">Artistas</span>
        </h1>
        <p class="text-gray-400 mt-4 text-sm uppercase tracking-widest">{{ $artists->count() }} artistas · Temporada 2026</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <input type="text" id="search-name" placeholder="Buscar por nombre..."
                class="bg-gray-950 border border-gray-800 text-white px-4 py-2.5 text-sm focus:border-pink-500 focus:outline-none transition-colors w-full sm:w-80">
            <select id="filter-genre"
                class="bg-gray-950 border border-gray-800 text-white px-4 py-2.5 text-sm focus:border-pink-500 focus:outline-none transition-colors w-full sm:w-60">
                <option value="">Todos los géneros</option>
                @foreach($artists->pluck('genre')->filter()->unique()->sort() as $genre)
                    <option value="{{ strtolower($genre) }}">{{ $genre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 fade-in">
            @forelse($artists as $artist)
                <a href="{{ route('artists.show', $artist->id) }}"
                    class="artist-card group bg-gray-950 border border-gray-800 hover:border-pink-600 transition-all duration-300 overflow-hidden block"
                    data-name="{{ strtolower($artist->name) }}"
                    data-genre="{{ strtolower($artist->genre ?? '') }}">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $artist->image }}" alt="{{ $artist->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent"></div>
                        @if($artist->genre)
                            <span class="absolute top-3 right-3 bg-black/60 text-pink-400 text-[10px] font-black uppercase px-2 py-1 tracking-widest border border-pink-500/30">{{ $artist->genre }}</span>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-black text-white uppercase tracking-tight text-lg leading-none group-hover:text-pink-400 transition-colors">{{ $artist->name }}</h3>
                        @if($artist->country)
                            <p class="text-gray-500 text-xs uppercase tracking-widest mt-1">{{ $artist->country }}</p>
                        @endif
                        @if($artist->bio)
                            <p class="text-gray-400 text-sm mt-3 leading-relaxed line-clamp-2">{{ $artist->bio }}</p>
                        @endif
                        <div class="flex items-center gap-3 mt-4">
                            @if($artist->spotify_url)
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
                            @endif
                            @if($artist->youtube_url)
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-4 text-center py-24">
                    <p class="text-gray-500 uppercase tracking-widest text-sm">No hay artistas registrados aún.</p>
                </div>
            @endforelse
        </div>
        <div id="no-results" class="hidden text-center py-24">
            <p class="text-gray-500 uppercase tracking-widest text-sm">No se encontraron artistas con ese filtro.</p>
        </div>
    </div>

    @include('partials.footer')

    <script>
        const searchInput = document.getElementById('search-name');
        const genreSelect = document.getElementById('filter-genre');
        const cards = document.querySelectorAll('.artist-card');
        const noResults = document.getElementById('no-results');
        function filtrar() {
            const nombre = searchInput.value.toLowerCase();
            const genero = genreSelect.value.toLowerCase();
            let visibles = 0;
            cards.forEach(card => {
                const matchNombre = card.dataset.name.includes(nombre);
                const matchGenero = genero === '' || card.dataset.genre === genero;
                if (matchNombre && matchGenero) { card.style.display = ''; visibles++; }
                else { card.style.display = 'none'; }
            });
            noResults.classList.toggle('hidden', visibles > 0);
        }
        searchInput.addEventListener('input', filtrar);
        genreSelect.addEventListener('change', filtrar);
    </script>
</body>
</html>