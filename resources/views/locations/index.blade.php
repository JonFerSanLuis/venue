<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 uppercase tracking-tight">Recintos</h1>
                    <p class="text-sm text-gray-500 mt-1">Gestiona los espacios donde se celebran los festivales.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 uppercase tracking-widest transition self-center">← Panel</a>                    <a href="{{ route('locations.create') }}" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-4 py-2 text-sm font-bold uppercase tracking-widest transition-colors">
                        + Nuevo Recinto
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 p-4 text-xs font-bold uppercase tracking-wide rounded-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-900">Recinto</th>
                            <th class="px-6 py-4 font-semibold text-gray-900">Ubicación</th>
                            <th class="px-6 py-4 font-semibold text-gray-900 text-center">Aforo</th>
                            <th class="px-6 py-4 font-semibold text-gray-900 text-center">Festivales</th>
                            <th class="px-6 py-4 font-semibold text-gray-900 text-center">Gestión</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($locations as $location)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $location->name }}</div>
                                    @if($location->description)
                                        <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $location->description }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div>{{ $location->city }}, {{ $location->country }}</div>
                                    <div class="text-xs text-gray-400">{{ $location->address }}</div>
                                </td>
                                <td class="px-6 py-4 text-center font-bold">{{ number_format($location->capacity) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-gray-100 text-gray-800">
                                        {{ $location->festivals_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('locations.edit', $location->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">Editar</a>
                                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Eliminar este recinto? Los festivales asociados quedarán sin recinto.')"
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-50 hover:bg-red-100 transition-colors">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">No hay recintos registrados todavía.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>