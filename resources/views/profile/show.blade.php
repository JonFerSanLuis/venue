<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Perfil - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    <nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-white hover:text-pink-500 transition-colors">
                VENUE<span class="text-pink-500">/</span>
            </a>
            <div class="flex items-center gap-6">
                <a href="{{ route('festivals.index') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Cartelera</a>
                <a href="{{ route('orders.my-orders') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Mis Entradas</a>
                @if(Auth::user()->role_id == 1)
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-pink-400 transition-colors">Panel Admin</a>
                @endif
                <span class="text-gray-600">|</span>
                <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                    @csrf
                    <button type="submit" style="background:none!important;padding:0!important;margin:0!important;border:none!important;box-shadow:none!important;" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-red-400 transition-colors">Salir</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="min-h-screen pt-28 pb-20 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-10 flex items-end gap-6">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-600 to-red-600 flex items-center justify-center text-3xl font-black text-white shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <span class="text-pink-500 text-xs font-black uppercase tracking-[0.4em]">Mi cuenta</span>
                    <h1 class="text-4xl font-black uppercase tracking-tighter mt-1">{{ Auth::user()->name }}</h1>
                    <p class="text-gray-400 text-sm mt-1">{{ Auth::user()->email }} · Miembro desde {{ Auth::user()->created_at->format('M Y') }}</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-900/30 border border-green-500/30 text-green-400 p-4 text-xs font-bold uppercase tracking-wide">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-6 bg-red-900/30 border border-red-500/30 p-4">
                    @foreach($errors->all() as $error)
                        <p class="text-red-400 text-xs font-bold uppercase tracking-wide">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- COLUMNA IZQUIERDA --}}
                <div class="space-y-6">

                    <div class="bg-gray-950 border border-gray-800 p-6">
                        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-5">Resumen</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400 text-xs uppercase tracking-widest font-bold">Entradas compradas</span>
                                <span class="text-white font-black text-xl">{{ $orders->where('status', 'confirmed')->sum('quantity') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400 text-xs uppercase tracking-widest font-bold">Festivales</span>
                                <span class="text-white font-black text-xl">{{ $orders->where('status', 'confirmed')->pluck('ticketType.festival_id')->unique()->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400 text-xs uppercase tracking-widest font-bold">Total gastado</span>
                                <span class="text-pink-500 font-black text-xl">{{ number_format($orders->where('status', 'confirmed')->sum('total_price'), 2) }}€</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-950 border border-gray-800 p-6">
                        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-5">Editar Datos</h2>
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Nombre</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}"
                                    class="w-full bg-gray-900 border border-gray-700 text-white px-3 py-2 text-sm focus:border-pink-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}"
                                    class="w-full bg-gray-900 border border-gray-700 text-white px-3 py-2 text-sm focus:border-pink-500 focus:outline-none transition-colors">
                            </div>
                            <button type="submit" style="border-radius:0!important;box-shadow:none!important;margin-top:0.5rem!important;"
                                class="w-full bg-gray-800 hover:bg-gray-700 text-white text-xs font-black uppercase py-2.5 tracking-widest transition-colors">
                                Guardar Cambios
                            </button>
                        </form>
                    </div>

                    <div class="bg-gray-950 border border-gray-800 p-6">
                        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-5">Cambiar Contraseña</h2>
                        <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Contraseña actual</label>
                                <input type="password" name="current_password"
                                    class="w-full bg-gray-900 border border-gray-700 text-white px-3 py-2 text-sm focus:border-pink-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Nueva contraseña</label>
                                <input type="password" name="password"
                                    class="w-full bg-gray-900 border border-gray-700 text-white px-3 py-2 text-sm focus:border-pink-500 focus:outline-none transition-colors">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Confirmar contraseña</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full bg-gray-900 border border-gray-700 text-white px-3 py-2 text-sm focus:border-pink-500 focus:outline-none transition-colors">
                            </div>
                            <button type="submit" style="border-radius:0!important;box-shadow:none!important;margin-top:0.5rem!important;"
                                class="w-full bg-gray-800 hover:bg-gray-700 text-white text-xs font-black uppercase py-2.5 tracking-widest transition-colors">
                                Actualizar Contraseña
                            </button>
                        </form>
                    </div>

                </div>

                {{-- COLUMNA DERECHA: Entradas --}}
                <div class="lg:col-span-2">
                    <h2 class="text-xs font-black uppercase tracking-[0.4em] text-pink-500 mb-5">Mis Entradas</h2>

                    @if($orders->isEmpty())
                        <div class="text-center py-16 border border-gray-800 bg-gray-950">
                            <svg class="w-12 h-12 text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            <p class="text-gray-500 uppercase tracking-widest text-xs mb-4">No tienes entradas todavía</p>
                            <a href="{{ route('festivals.index') }}" class="text-pink-500 text-xs font-black uppercase tracking-widest hover:text-pink-400 transition-colors">
                                Ver Festivales →
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="bg-gray-950 border {{ $order->status === 'refunded' ? 'border-gray-800 opacity-50' : 'border-gray-800 hover:border-pink-600/40' }} transition-colors overflow-hidden">
                                    <div class="flex">
                                        <div class="w-24 shrink-0 hidden sm:block">
                                            <img src="{{ asset('storage/' . $order->ticketType->festival->image_url) }}" class="w-full h-full object-cover opacity-60">
                                        </div>
                                        <div class="flex-1 p-4">
                                            <div class="flex justify-between items-start gap-2">
                                                <div>
                                                    <h3 class="font-black text-white uppercase tracking-tight text-base leading-none">
                                                        {{ $order->ticketType->festival->name }}
                                                    </h3>
                                                    <p class="text-gray-500 text-[10px] uppercase tracking-widest mt-1">
                                                        {{ \Carbon\Carbon::parse($order->ticketType->festival->date)->format('d M Y') }} · {{ $order->ticketType->name }}
                                                    </p>
                                                </div>
                                                @if($order->status === 'refunded')
                                                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 border border-gray-700 px-2 py-0.5 shrink-0">Devuelta</span>
                                                @else
                                                    <span class="text-[10px] font-black uppercase tracking-widest text-green-400 border border-green-500/30 px-2 py-0.5 shrink-0">Confirmada</span>
                                                @endif
                                            </div>

                                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-800">
                                                <div class="flex gap-4">
                                                    <div>
                                                        <p class="text-[10px] text-gray-600 uppercase tracking-widest">Cantidad</p>
                                                        <p class="text-white font-bold text-sm">{{ $order->quantity }}x</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-[10px] text-gray-600 uppercase tracking-widest">Total</p>
                                                        <p class="text-pink-500 font-black text-sm">{{ number_format($order->total_price, 2) }}€</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-[10px] text-gray-600 uppercase tracking-widest">Pedido</p>
                                                        <p class="text-gray-400 font-bold text-sm">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                                    </div>
                                                </div>

                                                @if($order->status === 'confirmed')
                                                    <form action="{{ route('orders.refund', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button"
                                                            onclick="confirmarAccion(this.closest('form'), '¿Devolver esta entrada?', 'El reembolso se procesará en 3-5 días hábiles. Esta acción no se puede deshacer.')"
                                                            style="border-radius:0!important;box-shadow:none!important;padding:0.25rem 0.75rem!important;margin:0!important;"
                                                            class="text-[10px] font-black uppercase tracking-widest border border-red-500/40 text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-200">
                                                            Devolver
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL DE CONFIRMACIÓN --}}
    <div id="modal-confirm" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="bg-gray-950 border border-gray-800 max-w-sm w-full p-8 shadow-2xl">
            <div class="w-12 h-12 rounded-full bg-red-500/10 border border-red-500/30 flex items-center justify-center mb-5">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <h3 id="modal-title" class="text-white font-black uppercase tracking-tight text-lg mb-2"></h3>
            <p id="modal-desc" class="text-gray-400 text-sm mb-8"></p>
            <div class="flex gap-3">
                <button onclick="cerrarModal()"
                    style="background:none!important;border-radius:0!important;box-shadow:none!important;border:1px solid rgb(55,65,81)!important;"
                    class="flex-1 text-gray-300 text-xs font-black uppercase py-3 tracking-widest hover:border-white hover:text-white transition-all">
                    Cancelar
                </button>
                <button id="modal-confirm-btn"
                    style="border-radius:0!important;box-shadow:none!important;border:none!important;"
                    class="flex-1 bg-red-600 hover:bg-red-500 text-white text-xs font-black uppercase py-3 tracking-widest transition-all">
                    Confirmar
                </button>
            </div>
        </div>
    </div>

    <script>
        let pendingForm = null;

        function confirmarAccion(form, titulo, descripcion) {
            pendingForm = form;
            document.getElementById('modal-title').textContent = titulo;
            document.getElementById('modal-desc').textContent = descripcion;
            document.getElementById('modal-confirm').classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modal-confirm').classList.add('hidden');
            pendingForm = null;
        }

        document.getElementById('modal-confirm-btn').addEventListener('click', function () {
            if (pendingForm) pendingForm.submit();
        });

        document.getElementById('modal-confirm').addEventListener('click', function(e) {
            if (e.target === this) cerrarModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') cerrarModal();
        });
    </script>

</body>
</html>