<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased min-h-screen flex items-center justify-center">

    <div class="text-center px-4">
        <p class="text-pink-500 text-xs font-black uppercase tracking-[0.4em] mb-4">Error 404</p>
        <h1 class="text-[12rem] font-black leading-none tracking-tighter text-white opacity-10 select-none">404</h1>
        <h2 class="text-3xl font-black uppercase tracking-tighter -mt-8 mb-4">Página no encontrada</h2>
        <p class="text-gray-400 text-sm mb-10 max-w-sm mx-auto">La página que buscas no existe o ha sido eliminada.</p>
        <div class="flex gap-4 justify-center">
            <a href="{{ url('/') }}" class="border border-pink-500 text-pink-500 px-6 py-3 text-xs font-black uppercase tracking-widest hover:bg-pink-500 hover:text-white transition-all">
                Volver al inicio
            </a>
            <a href="{{ route('festivals.index') }}" class="bg-pink-600 text-white px-6 py-3 text-xs font-black uppercase tracking-widest hover:bg-pink-500 transition-all">
                Ver Festivales
            </a>
        </div>
    </div>

</body>
</html>