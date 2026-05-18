<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue - Plataforma de Festivales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn ease 1.5s; }
        @keyframes fadeIn { 0% {opacity:0;} 100% {opacity:1;} }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans antialiased overflow-hidden selection:bg-pink-500 selection:text-white h-screen relative">

    <div id="slideshow" class="absolute inset-0 w-full h-full z-0 pointer-events-none">
        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-100" style="background-image: url('https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&q=80&w=2000');"></div>
        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0" style="background-image: url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=2000');"></div>
        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0" style="background-image: url('https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&q=80&w=2000');"></div>
    </div>

    <div class="absolute inset-0 bg-gradient-to-br from-black via-black/70 to-pink-900/50 mix-blend-multiply z-10 pointer-events-none"></div>

    {{-- NAVBAR --}}
    <nav class="absolute top-0 w-full z-50 p-6 pointer-events-auto">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-3xl font-black tracking-tighter text-white">VENUE<span class="text-pink-500">/</span></div>
            <div class="flex items-center gap-6">
                @auth
                    @if(Auth::user()->role_id == 1)
                        <a href="{{ route('dashboard') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition">Panel Admin</a>
                    @else
                        <a href="{{ route('profile.show') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition">Mi Perfil</a>
                        <a href="{{ route('orders.my-orders') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition">Mis Entradas</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                        @csrf
                        <button type="submit"
                            class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-red-400 transition leading-none"
                            style="background:none!important;border:none!important;box-shadow:none!important;padding:0!important;margin:0!important;">
                            Salir
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition">Login</a>
                    <a href="{{ route('register') }}" class="border-2 border-pink-500 text-pink-500 px-6 py-2 text-sm font-bold uppercase tracking-widest hover:bg-pink-500 hover:text-white transition-all">Registro</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <div class="relative h-full flex items-center justify-center z-20 pointer-events-none">
        <div class="text-center px-4 max-w-5xl mx-auto mt-16 pointer-events-auto">

            <span class="block text-pink-500 font-bold uppercase tracking-[0.4em] mb-4 text-sm md:text-base">Festivales · Música en directo · 2026</span>

            <h1 class="text-6xl md:text-8xl lg:text-9xl font-black uppercase tracking-tighter mb-4 leading-none">
                Vive la <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500">
                    Música
                </span>
            </h1>

            <p class="text-lg md:text-xl text-gray-300 font-medium mb-10 max-w-2xl mx-auto tracking-wide">
                Descubre los mejores festivales, consulta el lineup completo y hazte con tus entradas antes de que se agoten.
            </p>

            {{-- Solo el botón de ver festivales en el centro --}}
            <div class="flex justify-center mt-8">
                <a href="{{ url('/festivales') }}" class="group relative px-8 py-4 bg-gradient-to-r from-pink-600 to-red-600 text-white font-black uppercase tracking-widest text-lg transition-all hover:scale-[1.02] shadow-[0_0_15px_rgba(236,72,153,0.3)] hover:shadow-[0_0_25px_rgba(236,72,153,0.5)]">
                    Ver Festivales
                    <div class="absolute inset-0 border border-white/10 group-hover:border-white/30 transition-colors"></div>
                </a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('#slideshow .slide');
            let currentSlide = 0;

            function nextSlide() {
                slides[currentSlide].classList.remove('opacity-100');
                slides[currentSlide].classList.add('opacity-0');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.remove('opacity-0');
                slides[currentSlide].classList.add('opacity-100');
            }

            setInterval(nextSlide, 5000);
        });
    </script>

</body>
</html>