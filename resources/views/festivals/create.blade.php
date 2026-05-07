<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Añadir Nuevo Festival</h1>
                    <p class="text-sm text-gray-500 mt-1">Completa los datos para publicar el evento en la cartelera.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-pink-600 transition-colors flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver al Dashboard
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('festivals.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6">

                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nombre del Evento</label>
                            <input type="text" name="name" id="name" placeholder="Ej: Mad Cool Festival"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm p-2.5 border" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="location" class="block text-sm font-bold text-gray-700 mb-2">Localización / Ciudad</label>
                                <input type="text" name="location" id="location" placeholder="Ej: Madrid, España"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm p-2.5 border" required>
                            </div>

                            <div>
                                <label for="style" class="block text-sm font-bold text-gray-700 mb-2">Estilo Musical</label>
                                <input type="text" name="style" id="style" placeholder="Ej: Indie / Rock"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm p-2.5 border" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_date" class="block text-sm font-bold text-gray-700 mb-2">Fecha de Inicio</label>
                                <input type="date" name="start_date" id="start_date"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm p-2.5 border" required>
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-bold text-gray-700 mb-2">Cartel (Imagen JPG/PNG)</label>
                                <input type="file" name="image" id="image"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 transition-all cursor-pointer border border-gray-300 rounded-md p-1.5" required>
                            </div>
                        </div>

                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full md:w-auto bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-10 rounded-md shadow-md transition-all flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Guardar Festival
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>