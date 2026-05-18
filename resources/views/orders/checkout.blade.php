<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - {{ $festival->name }} - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    {{-- NAVBAR --}}
    <nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
                VENUE<span class="text-pink-500">/</span>
            </a>
            <a href="{{ route('festivals.show', $festival->id) }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">
                ← Volver al Festival
            </a>
        </div>
    </nav>

    <div class="min-h-screen pt-28 pb-16 px-4">
        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-12">
                <span class="text-pink-500 text-xs font-black uppercase tracking-[0.4em]">Checkout</span>
                <h1 class="text-4xl font-black uppercase tracking-tighter mt-2">Completa tu compra</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

                {{-- FORMULARIO --}}
                <div class="lg:col-span-3">
                    <form action="{{ route('orders.store', [$festival->id, $ticketType->id]) }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Errores --}}
                        @if($errors->any())
                            <div class="bg-red-900/30 border border-red-500/30 p-4">
                                @foreach($errors->all() as $error)
                                    <p class="text-red-400 text-xs font-bold uppercase tracking-wide">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Nombre Completo</label>
                            <input type="text" name="buyer_name" value="{{ old('buyer_name', Auth::user()->name) }}"
                                class="w-full bg-gray-950 border border-gray-700 text-white px-4 py-3 text-sm focus:border-pink-500 focus:outline-none transition-colors"
                                required>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Email</label>
                            <input type="email" name="buyer_email" value="{{ old('buyer_email', Auth::user()->email) }}"
                                class="w-full bg-gray-950 border border-gray-700 text-white px-4 py-3 text-sm focus:border-pink-500 focus:outline-none transition-colors"
                                required>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Teléfono <span class="text-gray-600 normal-case font-normal">(opcional)</span></label>
                            <input type="tel" name="buyer_phone" value="{{ old('buyer_phone') }}"
                                class="w-full bg-gray-950 border border-gray-700 text-white px-4 py-3 text-sm focus:border-pink-500 focus:outline-none transition-colors"
                                placeholder="+34 600 000 000">
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Cantidad de Entradas</label>
                            <select name="quantity" id="quantity"
                                class="w-full bg-gray-950 border border-gray-700 text-white px-4 py-3 text-sm focus:border-pink-500 focus:outline-none transition-colors">
                                @for($i = 1; $i <= min(10, $ticketType->availableCount()); $i++)
                                    <option value="{{ $i }}" {{ old('quantity') == $i ? 'selected' : '' }}>{{ $i }} entrada{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Aviso simulación --}}
                        <div class="bg-yellow-900/20 border border-yellow-500/20 p-4">
                            <p class="text-yellow-500 text-xs font-bold uppercase tracking-wide">
                                ⚠ Plataforma de demostración — no se realizará ningún cargo real.
                            </p>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-pink-600 to-red-600 text-white font-black uppercase py-4 tracking-widest text-sm hover:from-pink-500 hover:to-red-500 transition-all shadow-lg shadow-pink-900/30">
                            Confirmar Compra
                        </button>
                    </form>
                </div>

                {{-- RESUMEN --}}
                <div class="lg:col-span-2">
                    <div class="bg-gray-950 border border-gray-800 p-6 sticky top-28">
                        <h3 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-5">Resumen</h3>

                        <img src="{{ asset('storage/' . $festival->image_url) }}" class="w-full h-36 object-cover mb-5 opacity-80">

                        <h4 class="font-black text-white uppercase tracking-tight text-xl leading-none">{{ $festival->name }}</h4>
                        <p class="text-gray-400 text-xs uppercase tracking-widest mt-1 mb-4">{{ $festival->location }} · {{ \Carbon\Carbon::parse($festival->date)->format('d M Y') }}</p>

                        <div class="border-t border-gray-800 pt-4 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400 uppercase tracking-wide text-xs font-bold">Tipo</span>
                                <span class="text-white font-bold">{{ $ticketType->name }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400 uppercase tracking-wide text-xs font-bold">Precio unitario</span>
                                <span class="text-white font-bold">{{ number_format($ticketType->price, 2) }}€</span>
                            </div>
                            <div class="flex justify-between text-sm border-t border-gray-800 pt-3">
                                <span class="text-gray-400 uppercase tracking-wide text-xs font-bold">Total</span>
                                <span class="text-pink-500 font-black text-xl" id="total-price">{{ number_format($ticketType->price, 2) }}€</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const price = {{ $ticketType->price }};
        const select = document.getElementById('quantity');
        const total = document.getElementById('total-price');

        select.addEventListener('change', function() {
            const t = (price * parseInt(this.value)).toFixed(2);
            total.textContent = t.replace('.', ',') + '€';
        });
    </script>

</body>
</html>
