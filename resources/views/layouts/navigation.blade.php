<nav class="bg-white border-b border-gray-200 py-4 px-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <div>
            <a href="{{ url('/') }}" class="text-2xl font-black uppercase italic tracking-tighter">
                VENUE<span class="text-pink-600">/</span>
            </a>
        </div>

        <div class="flex items-center gap-6">

            <a href="{{ route('festivals.index') }}" class="text-sm font-bold text-gray-600 hover:text-black uppercase">
                Cartelera
            </a>

            @auth
                @if(Auth::user()->role_id == 1)
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-black uppercase">
                        Panel Admin
                    </a>
                @endif

                <span class="text-sm text-gray-400">|</span>

                <span class="text-sm text-gray-800">
                    Hola, <strong>{{ Auth::user()->name }}</strong>
                </span>

                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-bold uppercase">
                        Salir
                    </button>
                </form>
            @endauth

            @guest
                <span class="text-sm text-gray-400">|</span>

                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-black uppercase">
                    Entrar
                </a>

                <a href="{{ route('register') }}" class="text-sm font-bold bg-black text-white px-4 py-2 hover:bg-gray-800 uppercase transition-colors">
                    Registro
                </a>
            @endguest

        </div>
    </div>
</nav>