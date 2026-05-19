<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 uppercase tracking-tight">Nuevo Recinto</h1>
                    <p class="text-sm text-gray-500 mt-1">Registra un espacio donde se celebrarán festivales.</p>
                </div>
                <a href="{{ route('locations.index') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 uppercase tracking-widest transition">← Volver</a>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-sm">
                    @foreach($errors->all() as $error)
                        <p class="text-red-600 text-xs font-bold uppercase">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('locations.store') }}" method="POST">
                @csrf
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-sm font-bold uppercase text-gray-700 tracking-widest">Datos del Recinto</h2>
                    </div>
                    <div class="p-8 space-y-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Nombre del Recinto</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" placeholder="Ej: WiZink Center" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Dirección</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" placeholder="Ej: Av. de Felipe II, s/n" required>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Ciudad</label>
                                <input type="text" name="city" value="{{ old('city') }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" placeholder="Ej: Madrid" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">País</label>
                                <input type="text" name="country" value="{{ old('country') }}" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" placeholder="Ej: España" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Aforo Máximo</label>
                            <input type="number" name="capacity" value="{{ old('capacity') }}" min="1" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" placeholder="Ej: 50000" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Descripción <span class="text-gray-400 normal-case font-normal">(opcional)</span></label>
                            <textarea name="description" rows="3" class="w-full border-gray-300 py-3 px-4 rounded-sm text-sm focus:ring-gray-900 focus:border-gray-900" placeholder="Describe brevemente el recinto...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('locations.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 text-xs font-bold uppercase rounded-sm hover:bg-gray-50 transition-colors">Cancelar</a>
                    <button type="submit" class="px-6 py-3 bg-gray-900 text-white text-xs font-bold uppercase rounded-sm hover:bg-black shadow-sm transition-colors">Guardar Recinto</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>