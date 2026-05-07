<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center text-2xl font-black tracking-tighter text-gray-900">
                    <a href="{{ url('/') }}">
                        VENUE<span class="text-pink-500">/</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-pink-500 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition">
                        DASHBOARD
                    </a>
                    <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 transition">
                        MIS FESTIVALES
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                <span class="text-gray-600 text-sm font-bold uppercase">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="border border-gray-300 bg-white text-gray-700 px-4 py-2 rounded-md text-xs font-bold uppercase hover:bg-gray-50 transition">
                        Desconectar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>