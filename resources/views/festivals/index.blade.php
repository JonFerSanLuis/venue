<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VENUE/ - Cartelera de Eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    <nav class="bg-black/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <a href="{{ url('/') }}" class="text-3xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
                VENUE<span class="text-pink-500">/</span>
            </a>

            <div class="space-x-6 flex items-center">
                <a href="{{ url('/') }}" class="hidden sm:block text-sm font-bold uppercase tracking-widest text-gray-400 hover:text-pink-400 transition">Inicio</a>
                <span class="hidden sm:block text-gray-800">|</span>

                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold uppercase tracking-widest text-pink-500 hover:text-white transition">Mi Panel</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-transparent border border-pink-500 text-pink-500 px-5 py-2 text-xs font-bold uppercase tracking-widest hover:bg-pink-500 hover:text-white transition-all rounded">Registro</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-12 max-w-7xl">

        <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-gray-800 pb-6">
            <div>
                <span class="text-pink-500 font-bold uppercase tracking-[0.3em] text-xs block mb-2">Directorio Global</span>
                <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">Próximos <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-yellow-500">Eventos</span></h1>
            </div>

            <div class="mt-6 md:mt-0 w-full md:w-auto">
                <div class="relative">
                    <input type="text" placeholder="BUSCAR FESTIVAL..." class="w-full md:w-72 bg-gray-900 border border-gray-700 text-white px-4 py-3 rounded-lg text-sm font-mono focus:border-pink-500 focus:outline-none focus:ring-1 focus:ring-pink-500 transition">
                    <div class="absolute right-3 top-3 text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($festivals as $festival)
            <div class="group bg-gray-900/40 border border-gray-800 rounded-2xl overflow-hidden hover:border-pink-500/50 hover:shadow-[0_0_30px_rgba(236,72,153,0.15)] transition-all duration-300">

                <div class="relative h-64 overflow-hidden">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                    <img src="{{ $festival['image'] }}" alt="{{ $festival['name'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

                    <div class="absolute top-4 right-4 z-20 bg-black/80 backdrop-blur-md border border-gray-700 text-pink-400 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded">
                        {{ $festival['style'] }}
                    </div>
                </div>

                <div class="p-6 relative">
                    <div class="absolute top-0 left-6 right-6 h-px bg-gradient-to-r from-transparent via-gray-700 group-hover:via-pink-500 to-transparent transition-colors"></div>

                    <div class="flex items-center text-pink-500 text-xs font-mono font-bold mb-3 uppercase tracking-widest">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $festival['date'] }}
                    </div>

                    <h3 class="text-2xl font-black text-white mb-2 uppercase tracking-tight group-hover:text-pink-400 transition-colors">{{ $festival['name'] }}</h3>

                    <div class="flex items-center text-gray-400 text-sm mb-8 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $festival['location'] }}
                    </div>

                    <button class="w-full bg-transparent border border-gray-700 text-white py-3 rounded-lg group-hover:bg-pink-600 group-hover:border-pink-600 uppercase tracking-widest font-bold text-xs transition-all">
                        Ver Cartelera / Entradas
                    </button>
                </div>
            </div>
            @endforeach

        </div>
    </main>
</body>
</html>