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

            <a href="{{ route('festivals.create') }}" class="bg-gradient-to-br from-pink-900/40 to-black border border-pink-900 p-6 rounded-xl flex flex-col justify-center items-center text-center cursor-pointer hover:shadow-[0_0_30px_rgba(236,72,153,0.2)] hover:border-pink-500 transition-all group">
                <div class="w-12 h-12 rounded-full bg-pink-600 group-hover:bg-pink-500 transition-colors flex items-center justify-center mb-4 text-white font-black text-2xl shadow-[0_0_15px_rgba(236,72,153,0.5)]">+</div>
                <h3 class="text-white font-bold uppercase tracking-widest text-sm">Crear Nuevo Festival</h3>
            </a>

        </div>

        <!-- SECCIÓN DE LA TABLA DE FESTIVALES -->
        <div class="mt-12 bg-gray-900/80 backdrop-blur border border-gray-800 rounded-2xl p-8 shadow-[0_0_30px_rgba(236,72,153,0.05)]">
            <h3 class="text-white font-black text-xl uppercase tracking-widest mb-6">Tus Festivales <span class="text-pink-500">Registrados</span></h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-800 text-gray-400 text-xs uppercase tracking-widest">
                            <th class="pb-4 font-bold">Cartel</th>
                            <th class="pb-4 font-bold">Nombre</th>
                            <th class="pb-4 font-bold">Ubicación</th>
                            <th class="pb-4 font-bold">Fecha</th>
                            <th class="pb-4 font-bold text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300 text-sm">

                        <!-- Bucle Mágico de Laravel: Recorre todos los festivales -->
                        @forelse($festivals as $festival)
                            <tr class="border-b border-gray-800/50 hover:bg-white/[0.02] transition-colors">
                                <td class="py-4">
                                    <img src="{{ asset('storage/' . $festival->image_url) }}" class="w-14 h-14 object-cover rounded-lg border border-gray-700 shadow-lg">
                                </td>
                                <td class="py-4 font-bold text-white">{{ $festival->name }}</td>
                                <td class="py-4">{{ $festival->location }}</td>
                                <td class="py-4">{{ $festival->date }}</td>
                                <td class="py-4 text-right space-x-4">

                                    <!-- Botón Editar (Aún sin ruta) -->
                                    <a href="#" class="text-gray-500 hover:text-white transition uppercase tracking-widest text-xs font-bold cursor-pointer">Editar</a>

                                    <!-- Botón Eliminar (Funcional) -->
                                    <form action="{{ route('festivals.destroy', $festival->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-pink-600 hover:text-red-500 transition uppercase tracking-widest text-xs font-bold" onclick="return confirm('¿Seguro que quieres borrar este festival? Esta acción no se puede deshacer.')">
                                            Eliminar
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <!-- Si la base de datos está vacía, mostramos esto -->
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500 font-medium">
                                    Aún no has registrado ningún festival. ¡Empieza creando uno arriba!
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>