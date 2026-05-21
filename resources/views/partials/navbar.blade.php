{{--
    Uso: @include('partials.navbar', ['active' => 'cartelera'])
    Valores: 'cartelera', 'artistas', 'perfil', 'entradas', 'admin', ''
--}}
<nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
            VENUE<span class="text-pink-500">/</span>
        </a>

        {{-- Botón hamburguesa (solo móvil) --}}
        <button id="menu-toggle" class="lg:hidden flex flex-col gap-1.5 p-1" onclick="toggleMenu()">
            <span class="block w-6 h-0.5 bg-white transition-all"></span>
            <span class="block w-6 h-0.5 bg-white transition-all"></span>
            <span class="block w-6 h-0.5 bg-white transition-all"></span>
        </button>

        {{-- Menú desktop --}}
        <div class="hidden lg:flex items-center gap-6">

            <a href="{{ route('festivals.index') }}"
                class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'cartelera' ? 'text-pink-500' : 'text-gray-300 hover:text-pink-400' }}">
                Cartelera
            </a>

            <a href="{{ route('artists.index') }}"
                class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'artistas' ? 'text-pink-500' : 'text-gray-300 hover:text-pink-400' }}">
                Artistas
            </a>

            @auth
                <a href="{{ route('profile.show') }}"
                    class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'perfil' ? 'text-pink-500' : 'text-gray-300 hover:text-pink-400' }}">
                    Mi Perfil
                </a>

                <a href="{{ route('orders.my-orders') }}"
                    class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'entradas' ? 'text-pink-500' : 'text-gray-300 hover:text-pink-400' }}">
                    Mis Entradas
                </a>

                @if(Auth::user()->role_id == 1)
                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'admin' ? 'text-pink-500' : 'text-gray-300 hover:text-pink-400' }}">
                        Panel Admin
                    </a>
                @endif

                <span class="text-gray-700">|</span>
                <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                    @csrf
                    <button type="submit"
                        style="background:none!important;border:none!important;box-shadow:none!important;padding:0!important;margin:0!important;"
                        class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-red-400 transition-colors leading-none">
                        Salir
                    </button>
                </form>

            @else
                <span class="text-gray-700">|</span>
                <a href="{{ route('login') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Entrar</a>
                <a href="{{ route('register') }}" class="border border-pink-500 text-pink-500 px-4 py-1.5 text-sm font-bold uppercase tracking-widest hover:bg-pink-500 hover:text-white transition-all">Registro</a>
            @endauth

        </div>
    </div>

    {{-- Menú móvil (oculto por defecto) --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-black border-t border-white/5 px-6 py-4 flex flex-col gap-4">

        <a href="{{ route('festivals.index') }}"
            class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'cartelera' ? 'text-pink-500' : 'text-gray-300' }}">
            Cartelera
        </a>

        <a href="{{ route('artists.index') }}"
            class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'artistas' ? 'text-pink-500' : 'text-gray-300' }}">
            Artistas
        </a>

        @auth
            <a href="{{ route('profile.show') }}"
                class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'perfil' ? 'text-pink-500' : 'text-gray-300' }}">
                Mi Perfil
            </a>

            <a href="{{ route('orders.my-orders') }}"
                class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'entradas' ? 'text-pink-500' : 'text-gray-300' }}">
                Mis Entradas
            </a>

            @if(Auth::user()->role_id == 1)
                <a href="{{ route('dashboard') }}"
                    class="text-sm font-bold uppercase tracking-widest transition-colors {{ ($active ?? '') === 'admin' ? 'text-pink-500' : 'text-gray-300' }}">
                    Panel Admin
                </a>
            @endif

            <div class="border-t border-white/5 pt-4 flex items-center justify-between">
                <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                    @csrf
                    <button type="submit"
                        style="background:none!important;border:none!important;box-shadow:none!important;padding:0!important;margin:0!important;"
                        class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-red-400 transition-colors">
                        Salir
                    </button>
                </form>
            </div>

        @else
            <div class="border-t border-white/5 pt-4 flex flex-col gap-3">
                <a href="{{ route('login') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300">Entrar</a>
                <a href="{{ route('register') }}" class="border border-pink-500 text-pink-500 px-4 py-2 text-sm font-bold uppercase tracking-widest text-center">Registro</a>
            </div>
        @endauth

    </div>
</nav>

<script>
function toggleMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
}
</script>