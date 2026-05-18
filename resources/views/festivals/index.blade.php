<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cartelera 2026 - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn ease 1s; }
        @keyframes fadeIn { 0% { opacity: 0; transform: translateY(10px); } 100% { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    @include('partials.navbar', ['active' => 'cartelera'])

    <div class="pt-32 pb-16 text-center px-4 relative">
        <div class="absolute inset-0 bg-gradient-to-b from-pink-900/10 to-transparent pointer-events-none"></div>
        <span class="block text-pink-500 font-bold uppercase tracking-[0.4em] text-xs mb-3">Próximos Eventos</span>
        <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter leading-none">
            Cartelera <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500">2026/</span>
        </h1>
        <p class="text-gray-400 mt-4 text-sm uppercase tracking-widest">{{ $festivals->count() }} eventos · Temporada oficial</p>
    </div>

    {{-- FILTROS --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <input type="text" id="search-name" placeholder="Buscar por nombre..."
                class="bg-gray-950 border border-gray-800 text-white px-4 py-2.5 text-sm focus:border-pink-500 focus:outline-none transition-colors w-full sm:w-80">
            <select id="filter-style"
                class="bg-gray-950 border border-gray-800 text-white px-4 py-2.5 text-sm focus:border-pink-500 focus:outline-none transition-colors w-full sm:w-60">
                <option value="">Todos los estilos</option>
                @foreach($festivals->pluck('style')->filter()->unique()->sort() as $style)
                    <option value="{{ strtolower($style) }}">{{ $style }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- GRID --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 fade-in">
            @forelse ($festivals as $festival)
                <div class="festival-card bg-gray-950 border border-gray-800 rounded-sm overflow-hidden group hover:border-pink-600 transition-all duration-500 shadow-2xl"
                     data-name="{{ strtolower($festival->name) }}"
                     data-style="{{ strtolower($festival->style ?? '') }}">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $festival->image_url) }}" alt="{{ $festival->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-75 group-hover:opacity-100">
                        <div class="absolute top-4 left-4 bg-pink-600 text-white text-[10px] font-black uppercase px-3 py-1 tracking-widest shadow-lg">
                            {{ \Carbon\Carbon::parse($festival->date)->format('d M Y') }}
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-black text-white uppercase tracking-tight leading-tight mb-2">{{ $festival->name }}</h3>
                        <div class="flex items-center gap-3 mb-5">
                            <span class="text-gray-400 text-xs uppercase tracking-widest flex items-center gap-1">
                                <svg class="w-3 h-3 text-pink-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                {{ $festival->location }}
                            </span>
                            <span class="text-gray-600">·</span>
                            <span class="text-pink-500 text-xs font-bold uppercase tracking-widest">{{ $festival->style }}</span>
                        </div>

                        @if($festival->artists->count() > 0)
                            <div class="mb-5 border-t border-gray-800 pt-4">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Lineup</p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($festival->artists->take(4) as $artist)
                                        <span class="text-[10px] bg-gray-800 text-gray-300 px-2 py-1 font-bold uppercase tracking-wide">{{ $artist->name }}</span>
                                    @endforeach
                                    @if($festival->artists->count() > 4)
                                        <span class="text-[10px] bg-pink-600/20 text-pink-400 border border-pink-600/30 px-2 py-1 font-bold uppercase tracking-wide">+{{ $festival->artists->count() - 4 }} más</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="abrirModal('{{ asset('storage/' . $festival->image_url) }}', '{{ addslashes($festival->name) }}')"
                                class="w-full bg-transparent border border-gray-700 text-white text-[10px] font-black uppercase py-3 tracking-widest hover:border-white hover:bg-white hover:text-black transition-all">
                                Ver Cartelera
                            </button>
                            <a href="{{ route('festivals.show', $festival->id) }}"
                                class="w-full bg-gradient-to-r from-pink-600 to-red-600 text-white text-[10px] font-black uppercase py-3 tracking-widest text-center hover:from-pink-500 hover:to-red-500 transition-all shadow-lg shadow-pink-900/30 flex items-center justify-center">
                                Comprar Entradas
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-24">
                    <p class="text-gray-500 uppercase tracking-widest text-sm">No hay festivales disponibles aún.</p>
                </div>
            @endforelse
        </div>

        <div id="no-results" class="hidden text-center py-24">
            <p class="text-gray-500 uppercase tracking-widest text-sm">No se encontraron festivales con ese filtro.</p>
        </div>
    </div>

    @include('partials.footer')

    {{-- MODAL --}}
    <div id="modalCartelera" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/95">
        <button onclick="cerrarModal()" class="absolute top-6 right-6 text-white hover:text-pink-500 transition-colors z-50">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="absolute top-6 left-1/2 -translate-x-1/2 pointer-events-none">
            <span id="modalTitulo" class="text-white font-black uppercase tracking-widest text-sm"></span>
        </div>
        <div id="modalContenido" class="max-w-4xl w-full relative">
            <img id="imagenAmpliada" src="" class="w-full h-auto max-h-[85vh] object-contain shadow-2xl border border-gray-800">
        </div>
    </div>

    <script>
        // Filtros
        const searchInput = document.getElementById('search-name');
        const styleSelect = document.getElementById('filter-style');
        const cards = document.querySelectorAll('.festival-card');
        const noResults = document.getElementById('no-results');

        function filtrar() {
            const nombre = searchInput.value.toLowerCase();
            const estilo = styleSelect.value.toLowerCase();
            let visibles = 0;

            cards.forEach(card => {
                const matchNombre = card.dataset.name.includes(nombre);
                const matchEstilo = estilo === '' || card.dataset.style === estilo;
                if (matchNombre && matchEstilo) { card.style.display = ''; visibles++; }
                else { card.style.display = 'none'; }
            });

            noResults.classList.toggle('hidden', visibles > 0);
        }

        searchInput.addEventListener('input', filtrar);
        styleSelect.addEventListener('change', filtrar);

        // Modal
        const modal = document.getElementById('modalCartelera');
        const imagen = document.getElementById('imagenAmpliada');
        const titulo = document.getElementById('modalTitulo');
        const contenido = document.getElementById('modalContenido');
        function abrirModal(url, nombre) { imagen.src = url; titulo.textContent = nombre; modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        function cerrarModal() { modal.classList.add('hidden'); imagen.src = ''; document.body.style.overflow = 'auto'; }
        modal.addEventListener('click', function(e) { if (!contenido.contains(e.target)) cerrarModal(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') cerrarModal(); });
    </script>
</body>
</html>