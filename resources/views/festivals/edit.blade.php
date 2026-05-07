<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Editar Festival: <span class="text-blue-600">{{ $festival->name }}</span></h1>
                    <p class="text-sm text-gray-500 mt-1">Modifica los detalles del evento en la plataforma.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver al Panel
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('festivals.update', $festival->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-y-6">

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre del Evento</label>
                            <input type="text" name="name" value="{{ $festival->name }}"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2.5 border" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Localización / Ciudad</label>
                                <input type="text" name="location" value="{{ $festival->location }}"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2.5 border" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Estilo Musical</label>
                                <input type="text" name="style" value="{{ $festival->style }}"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2.5 border" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Inicio</label>
                                <input type="date" name="start_date" value="{{ $festival->date }}"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2.5 border" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Cambiar Cartel (Opcional)</label>
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $festival->image_url) }}" class="w-10 h-10 rounded object-cover border border-gray-200 shadow-sm">
                                    <input type="file" name="image"
                                        class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer border border-gray-300 rounded-md p-1">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-md shadow-sm transition-all flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Guardar Cambios
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>