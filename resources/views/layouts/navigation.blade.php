<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="w-80">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-1 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">                            
                            <div class="flex items-center">                                
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover bg-gray-200">
                                @else
                                    <img src="{{ asset('img/profile/default-profile-image.png') }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover bg-gray-200">
                                @endif
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Cabeçalho do Menu - estilo Trello -->
                        <div class="px-4 py-3 bg-gray-800 text-white rounded-t-md">
                            <div class="flex items-center space-x-3">
                                @if(Auth::user()->profile_photo_path)                                    
                                    <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" alt="Avatar" class="h-10 w-10 rounded-full bg-gray-200">
                                @else
                                    <img src="{{ asset('img/profile/default-profile-image.png') }}" alt="Avatar" class="h-10 w-10 rounded-full bg-gray-200">
                                @endif
                                
                                <div class="w-64">
                                    <div class="font-semibold leading-tight truncate">{{ Auth::user()->name }}</div>
                                    <div class="text-sm text-gray-300 truncate ">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                        </div>                                                

                        <x-dropdown-link :href="route('profile.edit')">                            
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Seus repositórios') }}
                        </x-dropdown-link>                    
                        
                        <div class="border-t border-gray-700 my-2 mx-2"></div>
                        
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Seus projetos') }}
                        </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Suas estrelas') }}
                        </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Suas essências') }}
                        </x-dropdown-link>
                        
                        <div class="border-t border-gray-700 my-2 mx-2"></div>
                        
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Suas organizações') }}
                        </x-dropdown-link>                        
                        
                        <div class="border-t border-gray-700 my-2 mx-2"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center gap-2 px-4">
                <div>
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover bg-gray-200">
                    @else
                        <img src="{{ asset('img/profile/default-profile-image.png') }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover bg-gray-200">
                    @endif
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>                        
            
            <div class="mt-3 space-y-1 border-t border-gray-200">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200">
                    @csrf
                    
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
