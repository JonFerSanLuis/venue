<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Cartel: <span class="text-pink-600">{{ $festival->name }}</span></h1>
                    <p class="text-gray-500 font-medium mt-1">Configura los horarios de las actuaciones.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 uppercase tracking-widest transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Volver al Panel
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm h-fit">
                    <h3 class="font-bold text-gray-800 uppercase mb-4 border-b border-gray-100 pb-3 text-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                        Añadir Actuación
                    </h3>

                    @error('time')
                        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-3 text-xs font-bold uppercase">
                            {{ $message }}
                        </div>
                    @enderror

                    <form action="{{ route('festivals.lineup.store', $festival->id) }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Seleccionar Artista</label>
                            <select name="artist_id" class="w-full border-gray-300 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                                <option value="" disabled selected>-- Elige un artista --</option>
                                @foreach($allArtists as $artist)
                                    <option value="{{ $artist->id }}">{{ $artist->name }} ({{ $artist->genre ?? 'Sin género' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Hora Inicio</label>
                                <input type="time" name="start_time" class="w-full border-gray-300 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Hora Fin</label>
                                <input type="time" name="end_time" class="w-full border-gray-300 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" required>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-gray-900 text-white font-bold py-3 rounded-sm hover:bg-black uppercase tracking-wider transition shadow-sm mt-4">
                            Guardar en el Cartel
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="font-bold text-gray-800 uppercase text-sm">Cronograma Oficial</h3>
                    </div>

                    <div class="p-0">
                        @if($festival->artists->isEmpty())
                            <div class="text-center py-16">
                                <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-gray-500 font-medium">Cartel vacío. Añade artistas desde el panel izquierdo.</p>
                            </div>
                        @else
                            <div class="divide-y divide-gray-100">
                                @foreach($festival->artists as $artist)
                                    <div class="flex items-center p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="w-24 text-center border-r border-gray-200 pr-4 mr-4">
                                            <span class="block font-black text-xl text-gray-900 leading-none">
                                                {{ \Carbon\Carbon::parse($artist->pivot->performance_start)->format('H:i') }}
                                            </span>
                                            <span class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1 block">
                                                a {{ \Carbon\Carbon::parse($artist->pivot->performance_end)->format('H:i') }}
                                            </span>
                                        </div>

                                        <div class="flex-1 flex items-center gap-4">
                                            <img src="{{ asset('storage/' . ($artist->image_url ?? 'default.jpg')) }}" class="w-12 h-12 object-cover rounded-sm border border-gray-200 shadow-sm">
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg leading-tight uppercase">{{ $artist->name }}</h4>
                                                <p class="text-xs text-pink-600 font-semibold uppercase">{{ $artist->genre ?? 'Artista' }}</p>
                                            </div>
                                        </div>

                                        <div class="w-24 text-right">
                                            <form action="{{ route('festivals.lineup.destroy', [$festival->id, $artist->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-50 text-red-600 border border-red-200 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-sm text-[10px] font-black uppercase tracking-widest transition-colors shadow-sm" onclick="return confirm('¿Seguro que quieres quitar a este artista del cartel?')">
                                                    Quitar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>