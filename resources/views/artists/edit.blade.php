<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 uppercase tracking-tight">Editar Artista</h1>
                    <p class="text-sm text-gray-500 mt-1">Actualiza la información del artista.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 uppercase tracking-widest transition">← Volver</a>
            </div>

            <div class="bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden">
                <form action="{{ route('artists.update', $artist->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- DATOS BÁSICOS --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Nombre Artístico</label>
                            <input type="text" name="name" value="{{ $artist->name }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Género Musical</label>
                            <input type="text" name="genre" value="{{ $artist->genre }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">País de Origen</label>
                            <input type="text" name="country" value="{{ $artist->country }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Biografía</label>
                            <textarea name="bio" rows="4" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900">{{ $artist->bio }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Actualizar Foto (Opcional)</label>
                            @if($artist->image_url)
                                <img src="{{ asset('storage/' . $artist->image_url) }}" class="w-20 h-20 object-cover rounded-sm border border-gray-200 mb-3">
                            @endif
                            <input type="file" name="image" accept="image/*" class="w-full border-gray-300 py-2 px-4 rounded-sm text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-bold file:uppercase file:bg-gray-900 file:text-white hover:file:bg-black cursor-pointer">
                        </div>
                    </div>

                    {{-- REDES Y MEDIA --}}
                    <div class="border-t border-gray-100 pt-6">
                        <h2 class="text-xs font-bold uppercase text-gray-500 tracking-widest mb-4">Links y Media</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">URL de Spotify</label>
                                <input type="url" name="spotify_url" value="{{ $artist->spotify_url }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" placeholder="https://open.spotify.com/artist/...">
                                <p class="text-xs text-gray-400 mt-1">Abre Spotify, ve al artista, clic en "..." → Compartir → Copiar enlace</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">URL de YouTube</label>
                                <input type="url" name="youtube_url" value="{{ $artist->youtube_url }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" placeholder="https://www.youtube.com/watch?v=...">
                                <p class="text-xs text-gray-400 mt-1">Abre el vídeo en YouTube, clic en "Compartir" → Copiar enlace</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase rounded-sm hover:bg-gray-50">Cancelar</a>
                        <button type="submit" class="px-6 py-3 bg-gray-900 text-white text-xs font-bold uppercase rounded-sm hover:bg-black shadow-sm">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>