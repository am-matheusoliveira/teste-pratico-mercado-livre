<x-guest-layout>
    
    <p class="text-gray-900 text-3xl text-center mb-8">{{ __('Criar uma conta') }}</p>
    
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <!-- Picture -->
        <div>
            <x-picture-input />
            
            {{-- <x-input-error :messages="$errors->get('file')" class="mt-2" /> --}}
            
            <x-upload-input-error />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" required />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" required />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" required />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        
        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" required />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-5">    
            <x-primary-button class="w-full flex justify-center items-center" size="text-sm">{{ __('Register') }}</x-primary-button>
        </div>

        <div class="w-full">
            <x-dividing-line-guest />

            <div class="flex flex-col md:flex-row justify-center gap-2">
                <p class="m-0 text-gray-500 text-center">{{ __('Already registered?') }}
                    <a class="text-sm text-blue-500 hover:text-blue-700 font-semibold rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-0 focus-visible:ring-indigo-500" href="{{ route('login') }}">                        
                        {{ __('Log in') }}
                    </a>
                </p>                
            </div>
        </div>
    </form>
</x-guest-layout>
