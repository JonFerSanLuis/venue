{{-- Uso: @include('partials.footer') --}}
<footer class="border-t border-gray-900 bg-black">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-start">

            {{-- Logo y eslogan --}}
            <div>
                <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
                    VENUE<span class="text-pink-500">/</span>
                </a>
                <p class="text-gray-500 text-xs uppercase tracking-widest mt-2">
                    Festivales · Música en directo · 2026
                </p>
            </div>

            {{-- Navegación --}}
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600 mb-4">Explorar</p>
                <div class="space-y-2">
                    <a href="{{ route('festivals.index') }}" class="block text-sm text-gray-400 hover:text-pink-400 transition-colors uppercase tracking-widest font-bold">Cartelera</a>
                    <a href="{{ route('artists.index') }}" class="block text-sm text-gray-400 hover:text-pink-400 transition-colors uppercase tracking-widest font-bold">Artistas</a>
                </div>
            </div>

            {{-- Contacto --}}
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600 mb-4">Contacto</p>
                <div class="space-y-2">
                    <a href="mailto:hola@venue.es" class="block text-sm text-gray-400 hover:text-pink-400 transition-colors">asistencia@venue.es</a>
                    <p class="text-sm text-gray-600">Madrid, España</p>
                </div>
            </div>

        </div>

        <div class="border-t border-gray-900 mt-10 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3">
            <p class="text-xs text-gray-700 uppercase tracking-widest">© 2026 VENUE. Todos los derechos reservados.</p>
            <p class="text-xs text-gray-700 uppercase tracking-widest">Plataforma de demostración</p>
        </div>
    </div>
</footer>
