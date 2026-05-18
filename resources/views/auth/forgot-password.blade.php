<x-guest-layout>
    <x-auth-card>

        <div class="mb-6 text-sm text-gray-400">
            Introduce tu email y te enviaremos un enlace para restablecer tu contraseña.
        </div>

        {{-- Mensaje de éxito simulado --}}
        @if (session('status'))
            <div class="mb-4 bg-green-900/30 border border-green-500/30 p-3">
                <p class="text-green-400 text-sm font-bold">¡Enlace enviado! Revisa tu bandeja de entrada.</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-900/30 border border-red-500/30 p-3">
                <p class="text-red-400 text-sm font-bold">No encontramos ninguna cuenta con ese email.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <x-label for="email" value="Email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-pink-400 transition-colors">
                    Volver al login
                </a>
                <x-button>
                    Enviar enlace
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>