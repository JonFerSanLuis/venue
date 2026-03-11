<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VENUE/ - Panel de Control</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-black">

        <nav class="bg-black/50 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ url('/dashboard') }}" class="text-3xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
                            VENUE<span class="text-pink-500">/</span>
                        </a>
                        <div class="hidden sm:-my-px sm:ml-10 sm:flex sm:space-x-8">
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-pink-500 text-sm font-bold uppercase tracking-widest text-white">
                                Dashboard
                            </a>
                            <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold uppercase tracking-widest text-gray-400 hover:text-gray-200 hover:border-gray-500 transition">
                                Mis Festivales
                            </a>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                        <span class="text-gray-400 text-sm font-mono">{{ Auth::user()->name }}</span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-transparent border border-gray-700 text-gray-300 px-4 py-2 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 hover:text-white hover:border-gray-500 transition-all rounded">
                                Desconectar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        @if (isset($header))
            <header class="bg-gray-900/50 border-b border-gray-800 shadow-[0_4px_30px_rgba(0,0,0,0.5)]">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="py-10">
            {{ $slot }}
        </main>

    </div>
</body>
</html>