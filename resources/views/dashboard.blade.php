<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-white uppercase tracking-widest leading-tight">
            Panel de <span class="text-pink-500">Control</span>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-gray-900/80 backdrop-blur border border-gray-800 overflow-hidden shadow-[0_0_20px_rgba(236,72,153,0.05)] sm:rounded-xl mb-8">
            <div class="p-6 border-l-4 border-pink-500">
                <p class="text-gray-300 font-mono text-sm tracking-wider uppercase">
                    > Acceso autorizado. Bienvenido al sistema, <span class="text-pink-500 font-bold">{{ Auth::user()->name }}</span>.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-gray-900/50 border border-gray-800 p-6 rounded-xl hover:border-pink-500/50 transition-colors group">
                <div class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-2">Festivales Activos</div>
                <div class="text-4xl font-black text-white group-hover:text-pink-400 transition-colors">0</div>
                <div class="mt-4 text-xs text-gray-500 font-mono">ESTADO: ESPERANDO DATOS</div>
            </div>

            <div class="bg-gray-900/50 border border-gray-800 p-6 rounded-xl hover:border-pink-500/50 transition-colors group">
                <div class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-2">Entradas Vendidas</div>
                <div class="text-4xl font-black text-white group-hover:text-pink-400 transition-colors">0</div>
                <div class="mt-4 text-xs text-gray-500 font-mono">INGRESOS: 0.00 €</div>
            </div>

            <div class="bg-gradient-to-br from-pink-900/40 to-black border border-pink-900 p-6 rounded-xl flex flex-col justify-center items-center text-center cursor-pointer hover:shadow-[0_0_30px_rgba(236,72,153,0.2)] transition-all">
                <div class="w-12 h-12 rounded-full bg-pink-600 flex items-center justify-center mb-4 text-white font-black text-2xl">+</div>
                <h3 class="text-white font-bold uppercase tracking-widest text-sm">Crear Nuevo Festival</h3>
            </div>

        </div>

    </div>
</x-app-layout>