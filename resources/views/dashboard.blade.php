<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">                    
                    <!-- Título chamativo -->
                    <h2 class="text-xl font-bold text-gray-800 mb-4">{{ _('Menu do Sistema') }}</h2>
                    
                    <div class="flex flex-wrap gap-2 md:justify-between sm:justify-center">
                        <div class="bg-white border-b border-gray-200 shadow-md rounded-lg w-96"> <!-- Largura fixa do card -->
                            <!-- Descrição dentro de um card -->
                            <div class="p-4 rounded-lg mb-4 text-center">
                                <p class="whitespace-nowrap text-gray-600 font-semibold text-lg">{{ _('Novo Produto') }}</p>
                                
                                <!-- Botão centralizado -->
                                <div class="flex justify-center mt-4"> <!-- Centraliza o botão -->
                                    <x-nav-link-button size="text-sm" href="{{ route('produto') }}">{{ __('Acessar') }} <i class="ms-2 fa-solid fa-arrow-right"></i></x-nav-link-button>
                                    
                                    {{-- <x-nav-link-button size="text-sm" href="{{ route('delete-account') }}">{{ __('Excluir minha conta') }} <i class="ms-2 fa-solid fa-arrow-right"></i></x-nav-link-button> --}}
                                </div>
                            </div>
                        </div>                        
                    </div>                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
