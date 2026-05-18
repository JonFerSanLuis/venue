<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Entradas - VENUE/</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased selection:bg-pink-500 selection:text-white">

    @include('partials.navbar', ['active' => 'entradas'])

    <div class="min-h-screen pt-28 pb-16 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-12">
                <span class="text-pink-500 text-xs font-black uppercase tracking-[0.4em]">Mi cuenta</span>
                <h1 class="text-5xl font-black uppercase tracking-tighter mt-2">Mis Entradas</h1>
                <p class="text-gray-400 text-sm mt-2">{{ $orders->count() }} pedido{{ $orders->count() != 1 ? 's' : '' }} registrado{{ $orders->count() != 1 ? 's' : '' }}</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-900/30 border border-green-500/30 text-green-400 p-4 text-xs font-bold uppercase tracking-wide">{{ session('success') }}</div>
            @endif

            @if($orders->isEmpty())
                <div class="text-center py-24 border border-gray-800 bg-gray-950">
                    <svg class="w-16 h-16 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <p class="text-gray-500 uppercase tracking-widest text-sm mb-6">No tienes entradas todavía</p>
                    <a href="{{ route('festivals.index') }}" class="bg-gradient-to-r from-pink-600 to-red-600 text-white text-xs font-black uppercase px-8 py-3 tracking-widest hover:from-pink-500 hover:to-red-500 transition-all">Ver Festivales</a>
                </div>
            @else
                <div class="space-y-5">
                    @foreach($orders as $order)
                        <div class="bg-gray-950 border {{ $order->status === 'refunded' ? 'border-gray-700 opacity-60' : 'border-gray-800 hover:border-pink-600/40' }} transition-colors overflow-hidden">
                            <div class="flex">
                                <div class="w-32 shrink-0 hidden sm:block">
                                    <img src="{{ asset('storage/' . $order->ticketType->festival->image_url) }}" class="w-full h-full object-cover opacity-60">
                                </div>
                                <div class="flex-1 p-5">
                                    <div class="flex justify-between items-start flex-wrap gap-3">
                                        <div>
                                            <h3 class="font-black text-white uppercase tracking-tight text-xl leading-none">{{ $order->ticketType->festival->name }}</h3>
                                            <p class="text-gray-400 text-xs uppercase tracking-widest mt-1">{{ $order->ticketType->festival->location }} · {{ \Carbon\Carbon::parse($order->ticketType->festival->date)->format('d M Y') }}</p>
                                        </div>
                                        @if($order->status === 'refunded')
                                            <span class="bg-gray-800 border border-gray-700 text-gray-400 text-[10px] font-black uppercase px-3 py-1 tracking-widest">Devuelta</span>
                                        @else
                                            <span class="bg-green-500/10 border border-green-500/30 text-green-400 text-[10px] font-black uppercase px-3 py-1 tracking-widest">Confirmado</span>
                                        @endif
                                    </div>
                                    <div class="mt-4 flex flex-wrap gap-6 text-sm border-t border-gray-800 pt-4 items-end">
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Tipo</p>
                                            <p class="text-pink-500 font-black uppercase text-sm mt-0.5">{{ $order->ticketType->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Cantidad</p>
                                            <p class="text-white font-bold mt-0.5">{{ $order->quantity }} entrada{{ $order->quantity > 1 ? 's' : '' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Total</p>
                                            <p class="text-white font-bold mt-0.5">{{ number_format($order->total_price, 2) }}€</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Nº Pedido</p>
                                            <p class="text-gray-400 font-bold mt-0.5">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Fecha compra</p>
                                            <p class="text-gray-400 font-bold mt-0.5">{{ $order->created_at->format('d M Y') }}</p>
                                        </div>
                                        @if($order->status === 'confirmed')
                                            <div class="ml-auto">
                                                <form action="{{ route('orders.refund', $order->id) }}" method="POST" class="refund-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="button"
                                                        onclick="confirmarAccion(this.closest('form'), '¿Seguro que quieres devolver esta entrada?', 'Esta acción no se puede deshacer y el reembolso tardará 3-5 días hábiles.')"
                                                        class="text-[10px] font-black uppercase tracking-widest px-4 py-2 border border-red-500/40 text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-200">
                                                        Solicitar devolución
                                                    </button>
                                                </form>
                                            </div>
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
                <button onclick="cerrarModal()" class="flex-1 border border-gray-700 text-gray-300 text-xs font-black uppercase py-3 tracking-widest hover:border-white hover:text-white transition-all" style="background:none!important;border-radius:0!important;box-shadow:none!important;">Cancelar</button>
                <button id="modal-confirm-btn" class="flex-1 bg-red-600 hover:bg-red-500 text-white text-xs font-black uppercase py-3 tracking-widest transition-all" style="border-radius:0!important;box-shadow:none!important;border:none!important;">Confirmar</button>
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
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') cerrarModal(); });
    </script>

</body>
</html>