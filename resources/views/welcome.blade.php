<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue - Plataforma de Festivales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Definimos la animación de fundido (fade) */
        .fade-in {
            animation: fadeIn ease 1.5s;
            -webkit-animation: fadeIn ease 1.5s;
        }
        @keyframes fadeIn {
            0% {opacity:0;}
            100% {opacity:1;}
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans antialiased overflow-hidden selection:bg-pink-500 selection:text-white">

    <div id="slideshow" class="absolute inset-0 w-full h-full z-0">
        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-100" style="background-image: url('https://images.unsplash.com/photo-1540039155732-d688d01d4a3b?auto=format&fit=crop&q=80&w=2000');"></div>
        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0" style="background-image: url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&q=80&w=2000');"></div>
        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0" style="background-image: url('https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&q=80&w=2000');"></div>
    </div>

    <div class="absolute inset-0 bg-gradient-to-br from-black via-black/70 to-pink-900/50 mix-blend-multiply z-10"></div>

    <nav class="absolute top-0 w-full z-20 p-6">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-3xl font-black tracking-tighter text-white">VENUE<span class="text-pink-500">/</span></div>
            <div class="space-x-6">
                <a href="#" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition">Login</a>
                <a href="#" class="bg-transparent border-2 border-pink-500 text-pink-500 px-6 py-2 text-sm font-bold uppercase tracking-widest hover:bg-pink-500 hover:text-white transition-all">Registro</a>
            </div>
        </div>
    </nav>

    <div class="relative h-screen flex items-center justify-center z-20">
        <div class="text-center px-4 max-w-5xl mx-auto mt-16">

            <span class="block text-pink-500 font-bold uppercase tracking-[0.4em] mb-4 text-sm md:text-base">Tu próxima experiencia en directo</span>

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
                    Ver Carteleras
                    <div class="absolute inset-0 border-2 border-white/20 group-hover:border-white/50 transition-colors"></div>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('#slideshow .slide');
            let currentSlide = 0;
            const slideInterval = 5000; // Tiempo en milisegundos (5 segundos)

            function nextSlide() {
                // Ocultar imagen actual
                slides[currentSlide].classList.remove('opacity-100');
                slides[currentSlide].classList.add('opacity-0');

                // Calcular índice de la siguiente imagen
                currentSlide = (currentSlide + 1) % slides.length;

                // Mostrar siguiente imagen
                slides[currentSlide].classList.remove('opacity-0');
                slides[currentSlide].classList.add('opacity-100');
            }

            // Iniciar el ciclo
            setInterval(nextSlide, slideInterval);
        });
    </script>

</body>
</html>