<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 uppercase tracking-tight">Editar Festival</h1>
                    <p class="text-sm text-gray-500 mt-1">Actualiza la información técnica del evento.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 uppercase tracking-widest transition">
                    ← Volver al Panel
                </a>
            </div>

            <form action="{{ route('festivals.update', $festival->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- DATOS DEL FESTIVAL --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-sm font-bold uppercase text-gray-700 tracking-widest">Datos del Festival</h2>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Nombre del Festival</label>
                                <input type="text" name="name" value="{{ $festival->name }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Ciudad / Recinto</label>
                                <input type="text" name="location" value="{{ $festival->location }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Estilo Principal</label>
                                <input type="text" name="style" value="{{ $festival->style }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Fecha del Evento</label>
                                <input type="date" name="start_date" value="{{ $festival->date }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Actualizar Cartel (Opcional)</label>
                                <input type="file" name="image" accept="image/*" class="w-full border-gray-300 py-2 px-4 rounded-sm text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-bold file:uppercase file:bg-gray-900 file:text-white hover:file:bg-black cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TIPOS DE ENTRADA --}}
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-sm font-bold uppercase text-gray-700 tracking-widest">Tipos de Entrada</h2>
                        <button type="button" id="add-ticket"
                            class="flex items-center gap-2 text-xs font-bold uppercase bg-gray-900 text-white px-3 py-2 hover:bg-black transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Añadir tipo
                        </button>
                    </div>
                    <div class="p-6">
                        <div id="ticket-types-container" class="space-y-4">
                            @forelse($festival->ticketTypes as $type)
                                <div class="ticket-row grid grid-cols-12 gap-3 items-end p-4 bg-gray-50 border border-gray-200 rounded-sm">
                                    <div class="col-span-5">
                                        <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Nombre</label>
                                        <input type="text" name="ticket_names[]" value="{{ $type->name }}" class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                                    </div>
                                    <div class="col-span-3">
                                        <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Precio (€)</label>
                                        <input type="number" name="ticket_prices[]" step="0.01" min="0" value="{{ $type->price }}" class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                                    </div>
                                    <div class="col-span-3">
                                        <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Aforo</label>
                                        <input type="number" name="ticket_quantities[]" min="1" value="{{ $type->quantity }}" class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                                    </div>
                                    <div class="col-span-1 flex justify-center pb-1">
                                        <button type="button" onclick="removeTicket(this)" class="text-red-400 hover:text-red-600 transition-colors p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="ticket-row grid grid-cols-12 gap-3 items-end p-4 bg-gray-50 border border-gray-200 rounded-sm">
                                    <div class="col-span-5">
                                        <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Nombre</label>
                                        <input type="text" name="ticket_names[]" placeholder="Ej: General..." class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                                    </div>
                                    <div class="col-span-3">
                                        <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Precio (€)</label>
                                        <input type="number" name="ticket_prices[]" step="0.01" min="0" placeholder="0.00" class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                                    </div>
                                    <div class="col-span-3">
                                        <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Aforo</label>
                                        <input type="number" name="ticket_quantities[]" min="1" placeholder="500" class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                                    </div>
                                    <div class="col-span-1"></div>
                                </div>
                            @endforelse
                        </div>
                        <p class="text-xs text-gray-400 mt-3">⚠ Al guardar se reemplazarán todos los tipos de entrada existentes.</p>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase rounded-sm hover:bg-gray-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gray-900 text-white text-xs font-bold uppercase rounded-sm hover:bg-black shadow-sm transition-colors">
                        Actualizar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-ticket').addEventListener('click', function() {
            const container = document.getElementById('ticket-types-container');
            const row = document.createElement('div');
            row.className = 'ticket-row grid grid-cols-12 gap-3 items-end p-4 bg-gray-50 border border-gray-200 rounded-sm';
            row.innerHTML = `
                <div class="col-span-5">
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Nombre</label>
                    <input type="text" name="ticket_names[]" placeholder="Ej: VIP..." class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                </div>
                <div class="col-span-3">
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Precio (€)</label>
                    <input type="number" name="ticket_prices[]" step="0.01" min="0" placeholder="0.00" class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                </div>
                <div class="col-span-3">
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Aforo</label>
                    <input type="number" name="ticket_quantities[]" min="1" placeholder="500" class="w-full border-gray-300 py-2 px-3 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                </div>
                <div class="col-span-1 flex justify-center pb-1">
                    <button type="button" onclick="removeTicket(this)" class="text-red-400 hover:text-red-600 transition-colors p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            `;
            container.appendChild(row);
        });

        function removeTicket(btn) {
            const rows = document.querySelectorAll('.ticket-row');
            if (rows.length > 1) {
                btn.closest('.ticket-row').remove();
            }
        }
    </script>
</x-app-layout>
