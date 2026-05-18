<x-guest-layout>
    <x-auth-card>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-400">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-900/30 border border-red-500/30 p-3">
                <p class="text-red-400 text-sm font-bold">Credenciales incorrectas. Revisa tu email y contraseña.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="Email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Contraseña" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-400 hover:text-pink-400 transition-colors" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
                <button type="submit"
                    style="background-color:#db2777!important;box-shadow:none!important;margin-top:0!important;"
                    class="px-6 py-2 text-white text-xs font-black uppercase tracking-widest hover:bg-pink-700 transition-colors"
                    onmouseover="this.style.backgroundColor='#be185d'" onmouseout="this.style.backgroundColor='#db2777'">
                    Entrar
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>