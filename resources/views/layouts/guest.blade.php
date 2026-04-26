<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VENUE/ - Portal de Acceso</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Separación y color de las etiquetas (Name, Email...) */
        label {
            color: #e5e7eb !important;
            font-weight: 600 !important;
            display: block !important;
            margin-bottom: 0.25rem !important;
            margin-top: 1rem !important;
        }
        /* DISEÑO DE LAS CAJAS DE TEXTO */
        input[type="text"], input[type="email"], input[type="password"] {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(236, 72, 153, 0.3) !important;
            color: white !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem 1rem !important;
            width: 100% !important;
            transition: all 0.3s ease !important;
        }
        /* Brillo rosa intenso al hacer clic en la caja */
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            border-color: #ec4899 !important;
            box-shadow: 0 0 10px rgba(236,72,153,0.5) !important;
            outline: none !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        /* Arregla el enlace de "¿Olvidaste tu contraseña?" */
        a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s;
        }
        a:hover {
            color: #ec4899 !important;
        }
        /* Botón principal */
        button {
            background-color: #db2777 !important;
            color: white !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            font-weight: bold !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 0.5rem !important;
            margin-top: 1.5rem !important;
            transition: all 0.3s !important;
        }
        button:hover {
            background-color: #be185d !important;
            box-shadow: 0 0 15px rgba(236,72,153,0.6) !important;
        }
    </style>
</head>
<body class="bg-black text-white font-sans antialiased overflow-x-hidden selection:bg-pink-500 selection:text-white">

    <div class="fixed inset-0 bg-cover bg-center opacity-30" style="background-image: url('https://images.unsplash.com/photo-1470229722913-7c090b3329b1?q=80&w=2000&auto=format&fit=crop');"></div>
    <div class="fixed inset-0 bg-gradient-to-br from-black via-black/80 to-pink-900/40 mix-blend-multiply"></div>

    <div class="absolute top-12 left-10 z-50">
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al Index
        </a>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center py-20 relative z-10">

        <div class="mb-10 text-center">
            <a href="{{ url('/') }}" class="text-5xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
                VENUE<span class="text-pink-500">/</span>
            </a>
            <p class="text-pink-500 font-bold uppercase tracking-[0.3em] text-xs mt-3">Portal de Acceso</p>
        </div>

        <div class="w-full sm:max-w-md px-10 py-10 bg-black/60 backdrop-blur-xl border border-gray-800 shadow-[0_0_50px_rgba(236,72,153,0.15)] sm:rounded-2xl relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-pink-600 to-yellow-500 shadow-[0_0_10px_rgba(236,72,153,0.8)]"></div>

            <div class="w-full">
                {{ $slot }}
            </div>

        </div>
    </div>

</body>
</html>