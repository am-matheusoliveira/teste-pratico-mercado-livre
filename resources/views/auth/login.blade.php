<x-guest-layout>    
    <!-- Session Status -->
    @if(session('status'))
        <div class="flex items-start gap-2 mb-5 px-2 py-3 rounded-md bg-green-100 border border-green-300 shadow-sm text-green-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
            </svg>
            <x-auth-session-status :status="session('status')" class="font-medium text-sm text-green-700" />
        </div>
    @endif

    <p class="text-gray-900 text-3xl text-center mb-8">Entrar</p>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" required />            
            <x-text-input id="email" class="block mt-2 w-full" type="text" name="email" :value="old('email')" autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Password -->
        <div class="mt-5">
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Password')" required />
                
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:text-blue-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Question - Forgot Your Password?') }}
                    </a>
                @endif                
            </div>
            
            <x-text-input id="password" class="block mt-2 w-full" type="password" name="password" autocomplete="current-password" />
            
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        
        <!-- Remember Me -->
        <div class="flex justify-start mt-5">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 shadow-sm focus:outline-none focus:ring-0 focus-visible:ring-2 focus:ring-offset-0 focus-visible:ring-offset-2 focus-visible:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-500 hover:text-gray-700 select-none">{{ __('Remember me') }}</span>
            </label>
        </div>
        <small class="text-sm text-gray-500 hidden" id="message_remember_me">{{ __('You will remain signed in on this device.') }}</small>
        
        <div class="mt-5">    
            <x-primary-button class="w-full flex justify-center items-center" size="text-sm">{{ __('Log in') }}</x-primary-button>            
        </div>
        
        <div class="w-full">
            <x-dividing-line-guest />

            <div class="flex flex-col md:flex-row justify-center gap-2">            
                <a class="text-sm text-gray-500 hover:text-gray-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500" href="{{ route('register') }}">
                    {{ __('Create your account') }}
                </a>
                
                <a class="text-sm text-gray-500 hover:text-gray-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password') }}
                </a>
            </div>
        </div>
    </form>
    
    <x-slot name="customJsCode"></x-slot>
</x-guest-layout>
