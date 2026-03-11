<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue - Plataforma de Gestión de Eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased overflow-hidden selection:bg-pink-500 selection:text-white">

    <nav class="absolute top-0 w-full z-50 p-6">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-3xl font-black tracking-tighter text-white">
                VENUE<span class="text-pink-500">/</span>
            </div>
            <div class="space-x-6">
                <a href="#" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition">Login</a>
                <a href="#" class="bg-transparent border-2 border-pink-500 text-pink-500 px-6 py-2 text-sm font-bold uppercase tracking-widest hover:bg-pink-500 hover:text-white transition-all">Registro</a>
            </div>
        </div>
    </nav>

    <div class="relative h-screen flex items-center justify-center">
        <div class="absolute inset-0 bg-cover bg-center opacity-50" style="background-image: url('https://images.unsplash.com/photo-1470229722913-7c090b3329b1?q=80&w=2000&auto=format&fit=crop');"></div>

        <div class="absolute inset-0 bg-gradient-to-br from-black via-black/80 to-pink-900/40 mix-blend-multiply"></div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16">

            <span class="block text-pink-500 font-bold uppercase tracking-[0.4em] mb-4 text-sm md:text-base">
                Directorio Oficial de Eventos
            </span>

            <h1 class="text-6xl md:text-8xl lg:text-9xl font-black uppercase tracking-tighter mb-4 leading-none">
                El Cartel <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500">
                    Definitivo
                </span>
            </h1>

            <p class="text-lg md:text-xl text-gray-300 font-medium mb-10 max-w-2xl mx-auto tracking-wide">
                Explora fechas oficiales, planifica tus horarios para evitar solapamientos y gestiona tus accesos desde una única plataforma.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mt-8">
                <a href="{{ url('/festivales') }}" class="group relative px-8 py-4 bg-gradient-to-r from-pink-600 to-red-600 text-white font-black uppercase tracking-widest text-lg transition-all hover:scale-105 shadow-[0_0_20px_rgba(236,72,153,0.5)] hover:shadow-[0_0_40px_rgba(236,72,153,0.8)]">
                    Explorar Festivales
                    <div class="absolute inset-0 border-2 border-white/20 group-hover:border-white/50 transition-colors"></div>
                </a>
            </div>
        </div>
    </div>

</body>
</html>