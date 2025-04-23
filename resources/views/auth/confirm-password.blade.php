<x-guest-layout>
    <div class="w-full mb-8">
        <p class="text-gray-900 text-3xl text-center mb-2">{{ __('Confirme sua senha') }}</p>
        <h2 class="text-base font-normal text-gray-500 text-center">
            {{ __('Por favor, confirme sua senha antes de continuar.') }}
        </h2>
    </div>    

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mt-5">
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Password')" required />
                
                @if(Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:text-blue-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Question - Forgot Your Password?') }}
                    </a>
                @endif                
            </div>
            
            <x-text-input id="password" class="block mt-2 w-full" type="password" name="password" autocomplete="current-password" />
            
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        
        <div class="mt-5">    
            <x-primary-button class="w-full flex justify-center items-center" size="text-sm">{{ __('Confirm') }}</x-primary-button>
        </div>

        <div class="w-full">
            <x-dividing-line-guest />

            <div class="flex flex-col md:flex-row justify-center gap-2">     
                       
                <a href="{{ url()->previous() }}" class="text-sm text-gray-500 hover:text-gray-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500">
                    {{ __('Retornar') }}
                </a>
                
                <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-gray-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500">
                    {{ __('Forgot your password') }}
                </a>
            </div>
        </div>        
    </form>
</x-guest-layout>
