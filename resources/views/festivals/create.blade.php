<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-white uppercase tracking-widest leading-tight">
                Nuevo <span class="text-pink-500">Festival</span>
            </h2>
            <a href="{{ url('/dashboard') }}" class="text-gray-400 hover:text-pink-500 text-sm font-bold uppercase tracking-widest transition">
                < Volver al Panel
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-10">

        <div class="bg-gray-900/80 backdrop-blur border border-gray-800 shadow-[0_0_30px_rgba(236,72,153,0.05)] sm:rounded-2xl p-8 relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-pink-600 to-yellow-500"></div>

            <form action="{{ route('festivals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="md:col-span-2">
                        <label class="block text-gray-400 font-bold uppercase tracking-widest text-xs mb-2">Nombre del Evento</label>
                        <input type="text" name="name" class="w-full bg-black/50 border border-gray-700 text-white rounded-lg focus:border-pink-500 focus:ring-1 focus:ring-pink-500 p-3 transition" placeholder="Ej: Mad Cool Festival" required>
                    </div>

                    <div>
                        <label class="block text-gray-400 font-bold uppercase tracking-widest text-xs mb-2">Localización / Ciudad</label>
                        <input type="text" name="location" class="w-full bg-black/50 border border-gray-700 text-white rounded-lg focus:border-pink-500 focus:ring-1 focus:ring-pink-500 p-3 transition" placeholder="Ej: Madrid, España" required>
                    </div>

                    <div>
                        <label class="block text-gray-400 font-bold uppercase tracking-widest text-xs mb-2">Estilo Musical</label>
                        <input type="text" name="style" class="w-full bg-black/50 border border-gray-700 text-white rounded-lg focus:border-pink-500 focus:ring-1 focus:ring-pink-500 p-3 transition" placeholder="Ej: Indie / Rock" required>
                    </div>

                    <div>
                        <label class="block text-gray-400 font-bold uppercase tracking-widest text-xs mb-2">Fecha de Inicio</label>
                        <input type="date" name="start_date" class="w-full bg-black/50 border border-gray-700 text-gray-300 rounded-lg focus:border-pink-500 focus:ring-1 focus:ring-pink-500 p-3 transition" required>
                    </div>

                    <div>
                        <label class="block text-gray-400 font-bold uppercase tracking-widest text-xs mb-2">Cartel (Archivo JPG/PNG)</label>
                        <input type="file" name="image" class="w-full bg-black/50 border border-gray-700 text-gray-300 rounded-lg focus:border-pink-500 focus:ring-1 focus:ring-pink-500 p-2 transition cursor-pointer" accept="image/jpeg, image/png, image/jpg" required>
                    </div>

                </div>

                <div class="pt-6 border-t border-gray-800 mt-8 flex justify-end">
                    <button type="submit" class="bg-pink-600 hover:bg-pink-500 text-white px-8 py-3 rounded-lg font-bold uppercase tracking-widest transition-all shadow-[0_0_15px_rgba(236,72,153,0.4)] hover:shadow-[0_0_25px_rgba(236,72,153,0.6)]">
                        Guardar Festival
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>