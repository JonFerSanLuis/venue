<x-guest-layout>
    <x-auth-card>

        @if ($errors->any())
            <div class="mb-4 bg-red-900/30 border border-red-500/30 p-3">
                @foreach ($errors->all() as $error)
                    <p class="text-red-400 text-sm font-bold">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="Nombre" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="email" value="Email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Contraseña" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="Confirmar contraseña" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-gray-400 hover:text-pink-400 transition-colors" href="{{ route('login') }}">
                    ¿Ya tienes cuenta?
                </a>
                <button type="submit"
                    style="background-color:#db2777!important;box-shadow:none!important;margin-top:0!important;"
                    class="px-6 py-2 text-white text-xs font-black uppercase tracking-widest transition-colors"
                    onmouseover="this.style.backgroundColor='#be185d'" onmouseout="this.style.backgroundColor='#db2777'">
                    Registrarse
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>