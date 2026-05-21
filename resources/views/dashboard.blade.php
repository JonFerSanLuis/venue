<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Panel de administrador</h1>
                <p class="text-sm text-gray-500 mt-1">Resumen general y gestión de la plataforma</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Festivales</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $festivalesCount }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
                    <div class="p-3 rounded-full bg-indigo-50 text-indigo-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Promotores</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $promotersCount }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
                    <div class="p-3 rounded-full bg-purple-50 text-purple-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Artistas</p>
                        <p class="text-2xl font-bold text="gray-900">{{ $artistsCount }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
                    <div class="p-3 rounded-full bg-pink-50 text-pink-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Eventos Próximos</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $upcomingCount }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
                    <div class="p-3 rounded-full bg-green-50 text-green-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Ingresos Totales</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalIngresos, 0, ',', '.') }}€</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center">
                    <div class="p-3 rounded-full bg-yellow-50 text-yellow-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Entradas Vendidas</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $entradasVendidas }}</p>
                    </div>
                </div>

            </div>

            {{-- FESTIVALES --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Listado de Festivales</h2>
                    <a href="{{ route('festivals.create') }}" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-sm shadow-sm text-sm font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                        Añadir Festival
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap text-left text-sm text-gray-600">
                        <thead class="bg-white border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-gray-900">Evento</th>
                                <th class="px-6 py-4 font-semibold text-gray-900">Ubicación</th>
                                <th class="px-6 py-4 font-semibold text-gray-900">Fecha</th>
                                <th class="px-6 py-4 font-semibold text-gray-900 text-center">Gestión</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($festivals as $festival)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ $festival->image }}" class="w-12 h-12 rounded object-cover border border-gray-200 shadow-sm">                                            <div>
                                                <div class="font-semibold text-gray-900 text-base">{{ $festival->name }}</div>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 mt-1">{{ $festival->style }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">{{ $festival->location }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($festival->date)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('festivals.lineup', $festival->id) }}" class="inline-flex items-center px-3 py-1.5 shadow-sm text-xs font-bold uppercase rounded-sm text-white bg-gray-900 hover:bg-black transition-colors mr-2">LINEUP</a>
                                            <a href="{{ route('festivals.edit', $festival->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">Editar</a>
                                            <form action="{{ route('festivals.destroy', $festival->id) }}" method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmarEliminar(this.closest('form'), '¿Eliminar este festival?', 'Se borrará {{ addslashes($festival->name) }} y todas sus actuaciones. Esta acción no se puede deshacer.')"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent shadow-sm text-xs font-medium rounded text-red-700 bg-red-50 hover:bg-red-100 transition-colors">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-12 text-center"><p class="text-sm text-gray-500">Empieza registrando tu primer festival en el sistema.</p></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($festivals->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $festivals->links() }}
                    </div>
                @endif
            </div>

            {{-- ARTISTAS --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Listado de Artistas</h2>
                    <a href="{{ route('artists.create') }}" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-sm shadow-sm text-sm font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                        Añadir Artista
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap text-left text-sm text-gray-600">
                        <thead class="bg-white border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-gray-900">Artista</th>
                                <th class="px-6 py-4 font-semibold text-gray-900">Género / Estilo</th>
                                <th class="px-6 py-4 font-semibold text-gray-900">País</th>
                                <th class="px-6 py-4 font-semibold text-gray-900 text-center">Gestión</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($artists as $artist)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ $artist->image }}" class="w-12 h-12 rounded object-cover border border-gray-200 shadow-sm">                                            <div>
                                                <div class="font-semibold text-gray-900 text-base">{{ $artist->name }}</div>
                                                <span class="text-xs text-gray-500">ID: #{{ str_pad($artist->id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-50 text-purple-700 border border-purple-100">{{ $artist->genre ?? 'Sin definir' }}</span>
                                    </td>
                                    <td class="px-6 py-4">{{ $artist->country ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('artists.edit', $artist->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">Editar</a>
                                            <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmarEliminar(this.closest('form'), '¿Eliminar este artista?', 'Se borrará {{ addslashes($artist->name) }} de la base de datos. Esta acción no se puede deshacer.')"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent shadow-sm text-xs font-medium rounded text-red-700 bg-red-50 hover:bg-red-100 transition-colors">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-12 text-center"><p class="text-sm text-gray-500">No hay artistas registrados todavía.</p></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($artists->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $artists->links() }}
                    </div>
                @endif
            </div>

            {{-- RECINTOS --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Recintos</h2>
                    <a href="{{ route('locations.index') }}" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-sm shadow-sm text-sm font-medium transition-colors">
                        Gestionar Recintos
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL DE CONFIRMACIÓN --}}
    <div id="modal-confirm" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
        <div class="bg-gray-950 border border-gray-700 max-w-sm w-full p-8 shadow-2xl rounded-sm">
            <div class="w-12 h-12 rounded-full bg-red-500/10 border border-red-500/30 flex items-center justify-center mb-5">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <h3 id="modal-title" class="text-white font-black uppercase tracking-tight text-lg mb-2"></h3>
            <p id="modal-desc" class="text-gray-400 text-sm mb-8"></p>
            <div class="flex gap-3">
                <button onclick="cerrarModalConfirm()"
                    class="flex-1 border border-gray-600 text-gray-300 text-xs font-black uppercase py-3 tracking-widest hover:border-white hover:text-white transition-all"
                    style="background:none!important;border-radius:0!important;box-shadow:none!important;">
                    Cancelar
                </button>
                <button id="modal-confirm-btn"
                    class="flex-1 bg-red-600 hover:bg-red-500 text-white text-xs font-black uppercase py-3 tracking-widest transition-all"
                    style="border-radius:0!important;box-shadow:none!important;border:none!important;">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        let pendingForm = null;

        function confirmarEliminar(form, titulo, descripcion) {
            pendingForm = form;
            document.getElementById('modal-title').textContent = titulo;
            document.getElementById('modal-desc').textContent = descripcion;
            document.getElementById('modal-confirm').classList.remove('hidden');
        }

        function cerrarModalConfirm() {
            document.getElementById('modal-confirm').classList.add('hidden');
            pendingForm = null;
        }

        document.getElementById('modal-confirm-btn').addEventListener('click', function () {
            if (pendingForm) pendingForm.submit();
        });

        document.getElementById('modal-confirm').addEventListener('click', function(e) {
            if (e.target === this) cerrarModalConfirm();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') cerrarModalConfirm();
        });
    </script>
</x-app-layout>