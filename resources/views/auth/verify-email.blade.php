<x-guest-layout>
    <!-- Session Status -->
    @if (session('status') == 'verification-link-sent')
        <div class="flex items-start gap-2 mb-5 px-2 py-3 rounded-md bg-green-100 border border-green-300 shadow-sm text-green-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
            </svg>
            <div class="font-medium text-sm text-green-600 font-medium text-sm text-green-700">
                {{ __('Enviamos um novo link de verificação para o seu e-mail.') }}
            </div>
        </div>
    @endif
    
    <div class="w-full mb-8">
        <p class="text-gray-900 text-3xl text-center mb-2">{{ __('Verifique seu e-mail') }}</p>
        <h2 class="text-base font-normal text-gray-500 text-center">
            {{ __('Verifique seu e-mail para ativar sua conta. Não recebeu? Podemos reenviar!') }}
        </h2>
    </div>
    
    <div class="mt-4 space-y-6">
        <!-- Botão de reenviar -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full flex justify-center items-center" size="text-sm">
                {{ __('Clique aqui para reenviar') }}
            </x-primary-button>
        </form>
        
        <!-- Botão encerrar sessão -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="w-full">
                <!-- Linha divisória -->
                <x-dividing-line-guest />
                <div class="flex flex-col md:flex-row justify-center gap-2">
                    <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500">
                        {{ __('Encerrar sessão') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
