{{--
    Uso: @include('partials.navbar', ['active' => 'cartelera'])
    Valores: 'cartelera', 'artistas', 'perfil', 'entradas', 'admin', ''
--}}
<nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
            VENUE<span class="text-pink-500">/</span>
        </a>

        {{-- Botón hamburguesa --}}
        <button id="menu-toggle" onclick="toggleMenu()" style="display:none; flex-direction:column; gap:5px; background:none; border:none; cursor:pointer; padding:4px;">
            <span style="display:block; width:24px; height:2px; background:white;"></span>
            <span style="display:block; width:24px; height:2px; background:white;"></span>
            <span style="display:block; width:24px; height:2px; background:white;"></span>
        </button>

        {{-- Menú desktop --}}
        <div id="desktop-menu" class="flex items-center gap-6">

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

    {{-- Menú móvil --}}
    <div id="mobile-menu" style="display:none; background:black; border-top:1px solid rgba(255,255,255,0.05); padding:16px 24px; flex-direction:column; gap:16px;">

        <a href="{{ route('festivals.index') }}"
            style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; text-decoration:none; color:{{ ($active ?? '') === 'cartelera' ? '#ec4899' : '#d1d5db' }}">
            Cartelera
        </a>

        <a href="{{ route('artists.index') }}"
            style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; text-decoration:none; color:{{ ($active ?? '') === 'artistas' ? '#ec4899' : '#d1d5db' }}">
            Artistas
        </a>

        @auth
            <a href="{{ route('profile.show') }}"
                style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; text-decoration:none; color:{{ ($active ?? '') === 'perfil' ? '#ec4899' : '#d1d5db' }}">
                Mi Perfil
            </a>

            <a href="{{ route('orders.my-orders') }}"
                style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; text-decoration:none; color:{{ ($active ?? '') === 'entradas' ? '#ec4899' : '#d1d5db' }}">
                Mis Entradas
            </a>

            @if(Auth::user()->role_id == 1)
                <a href="{{ route('dashboard') }}"
                    style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; text-decoration:none; color:{{ ($active ?? '') === 'admin' ? '#ec4899' : '#d1d5db' }}">
                    Panel Admin
                </a>
            @endif

            <div style="border-top:1px solid rgba(255,255,255,0.05); padding-top:16px; display:flex; justify-content:space-between; align-items:center;">
                <span style="font-size:13px; color:#9ca3af;">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="margin:0; padding:0;">
                    @csrf
                    <button type="submit" style="background:none; border:none; font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#d1d5db; cursor:pointer;">
                        Salir
                    </button>
                </form>
            </div>

        @else
            <div style="border-top:1px solid rgba(255,255,255,0.05); padding-top:16px; display:flex; flex-direction:column; gap:12px;">
                <a href="{{ route('login') }}" style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; text-decoration:none; color:#d1d5db;">Entrar</a>
                <a href="{{ route('register') }}" style="border:1px solid #ec4899; color:#ec4899; padding:8px 16px; font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; text-decoration:none; text-align:center;">Registro</a>
            </div>
        @endauth

    </div>
</nav>

<script>
    function toggleMenu() {
        var menu = document.getElementById('mobile-menu');
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'flex';
        } else {
            menu.style.display = 'none';
        }
    }

    function checkWidth() {
        var toggle = document.getElementById('menu-toggle');
        var desktop = document.getElementById('desktop-menu');
        var mobile = document.getElementById('mobile-menu');

        if (window.innerWidth < 1024) {
            toggle.style.display = 'flex';
            desktop.style.display = 'none';
        } else {
            toggle.style.display = 'none';
            desktop.style.display = 'flex';
            mobile.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        checkWidth();
    });
    window.addEventListener('resize', checkWidth);
    </script>