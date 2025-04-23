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
    
    <div class="w-full mb-8">
        <p class="text-gray-900 text-3xl text-center mb-2">{{ __('Recuperação de senha') }}</p>
        <h2 class="text-base font-normal text-gray-500 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </h2>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" required />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <div class="mt-5">    
            <x-primary-button class="w-full flex justify-center items-center" size="text-sm">{{ __('Email Password Reset Link') }}</x-primary-button>
        </div>
        @guest
            <div class="w-full">
                <x-dividing-line-guest />
                
                <div class="flex flex-col md:flex-row justify-center gap-2">            
                    <a class="text-sm text-gray-500 hover:text-gray-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Log in') }}
                    </a>
                    
                    <a class="text-sm text-gray-500 hover:text-gray-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('Create your account') }}
                    </a>
                </div>
            </div>    
        @endguest   
    </form>
</x-guest-layout>
