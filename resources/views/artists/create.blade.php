<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Añadir Nuevo Artista</h1>
                    <p class="text-sm text-gray-500 mt-1">Registra un nuevo artista o banda en tu base de datos.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver al Panel
                </a>
            </div>
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6">

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre del Artista / Banda</label>
                            <input type="text" name="name" placeholder="Ej: Rosalía"
                                class="block w-full border-gray-300 rounded-sm shadow-sm focus:ring-gray-900 focus:border-gray-900 sm:text-sm p-2.5 border" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Género Musical</label>
                                <input type="text" name="genre" placeholder="Ej: Pop / Urbano"
                                    class="block w-full border-gray-300 rounded-sm shadow-sm focus:ring-gray-900 focus:border-gray-900 sm:text-sm p-2.5 border">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">País de Origen</label>
                                <input type="text" name="country" placeholder="Ej: España"
                                    class="block w-full border-gray-300 rounded-sm shadow-sm focus:ring-gray-900 focus:border-gray-900 sm:text-sm p-2.5 border">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Foto de Perfil (Opcional)</label>
                            <input type="file" name="image"
                                class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition-all cursor-pointer border border-gray-300 rounded-sm p-1">
                        </div>

                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="bg-gray-900 hover:bg-black text-white font-bold py-2.5 px-8 rounded-sm shadow-sm transition-all flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Registrar Artista
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>